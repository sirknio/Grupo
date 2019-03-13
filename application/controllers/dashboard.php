<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Dashboard extends CI_Controller {
	private $debug = false;
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('evento_model');
		$this->load->library('statistics');
		$this->load->model('novedad_model');
		$Updnovedad = $this->novedad_model->getNews($this->session->userdata('idGrupo'), 
			$this->session->userdata('TipoUsuario'), 
			$this->session->userdata('idUsuario'));
		$this->session->set_userdata('Novedades', $Updnovedad);
	}
	
	public function index($id = '') {
		$this->loadData($data,$this->debug,$id);
		$this->loadHTML($data,'pages/dashboard');
	}

	private function loadData(&$data,$debug = false,$id = '') { 
		date_default_timezone_set("America/Bogota");
		setlocale(LC_ALL,"es_ES"); 
		$dateNow = new DateTime("now");
		$data['month'] = ucwords(strftime("%B", strtotime($dateNow->format('Y-m-d'))));

		$data['userdata'] = $_SESSION;
		$data['setupapp'] = $this->object_model->getSetup(); 
		if($data['userdata']['idGrupo'] !== null) {
			$data['asistencia'] = $this->evento_model->getMainGraph($data['userdata']['idGrupo'],
					$data['setupapp']['LimiteEventosDashboard']);
			$this->buildEvent($data,$dateNow,$data['eventos'],$data['birhtdays'],$data['annivers']);
			$this->buildNotif($data,$dateNow,$data['notif']);
			// $data['personas'] = $this->object_model->get('evento','Fecha DESC',
			// array('idGrupo' => $data['userdata']['idGrupo']));
			// Solo necesito determinar las fechas de cumpleaños de los siguiente 3 meses!!!! y luego
			// agregarlo a la lista de $eventos
			$data['morrisjs'] = 'morris-data-dashboard.js';
			$data['cant_grupos'] = 4;
			$data['cant_micros'] = 15;
			$data['cant_personas'] = 9;
			$data['cant_eventos'] = 8;
	} else {
			$data['asistencia'] = array();
			$data['eventos'] = array();
			if ($data['userdata']['TipoUsuario'] == 'Admin') {
				$data['cant_grupos'] = $this->object_model->RecCount('grupo');
				$data['cant_micros'] = $this->object_model->RecCount('microcelula');
				$data['cant_personas'] = $this->object_model->RecCount('persona');
				$data['cant_eventos'] = $this->object_model->RecCount('evento');
			}
		}

		if($debug) {
			$print = $data;
		} else {
			$print = '';
		}
		$data['print'] = $print;
	}

	private function buildNotif(&$data,$dateNow,&$notif) {
		$notif = 1;
	}

	private function buildEvent(&$data,$dateNow,&$eventos,&$birhtdays,&$annivers) {
		$grupo = $this->object_model->get('grupo','',
			array('idGrupo' => $data['userdata']['idGrupo']));
		if (!empty($grupo)) $grupo = $grupo[0];

		$eventos = $this->object_model->get('evento','FechaEvento',
				"(idGrupo = ".$data['userdata']['idGrupo']." OR idGrupo IS NULL) AND ".
				"MONTH(FechaEvento) = '".$dateNow->format('m')."' AND ".
				"YEAR(FechaEvento) = '".$dateNow->format('Y')."'"
			);

		$i = 0;
		$date1 = '';
		foreach($eventos as $item) {
			$eventDate = new DateTime($item['FechaEvento']);
			if ($date1 != $eventDate->format('Y-m')) {
				$date1 = $eventDate->format('Y-m');
			}
			$eventos[$i]['FechaEvento'] = $date1;
			$eventos[$i]['NomFechaEvento'] = ucwords(strftime("%B %Y", strtotime($eventDate->format('Y-m-1'))));
			$eventos[$i]['Nombre'] = $item['Nombre']." (".$eventDate->format('d').")";
			$eventos[$i]['Evento'] = 1;
			// echo "<pre>"; print_r($item); echo "</pre>";
			// echo "<pre>"; print_r($eventos[$i]); echo "</pre>";
			$i++;
		}

		
		$personas = $this->object_model->get('persona','DAY(FechaNacimiento)',
				"idGrupo = ".$data['userdata']['idGrupo']." AND ".
				"MONTH(FechaNacimiento) = '".$dateNow->format('m')."'"
			);
		$date1 = '';
		$date2 = '';
		foreach($personas as $item) {
			if($item['FechaNacimiento'] != '0000-00-00') {
				$eventDate = new DateTime($item['FechaNacimiento']);
				if ($date1 != $eventDate->format($dateNow->format('Y').'-m')) {
					$date1 = $eventDate->format($dateNow->format('Y').'-m');
				}
				$date2 = new DateTime($eventDate->format($dateNow->format('Y').'-m-1'));
				$birhtdays[$i]['FechaEvento'] = $date1;
				$birhtdays[$i]['NomFechaEvento'] = ucwords(strftime("%B", strtotime($date2->format('Y-m-1'))));
				$birhtdays[$i]['Nombre'] = ucwords(strtolower($item['Nombre']." ".$item['Apellido']))." (".$eventDate->format('d').")";
				$birhtdays[$i]['Evento'] = 2;
				$i++;
			}
			// echo "<pre>"; print_r($item['FechaNacimiento']); echo "</pre>";
		}

		if ($grupo['TipoGrupo'] == 'Parejas') {
			$where = array (
				'idGrupo' 		=> $data['userdata']['idGrupo'],
				'MONTH(FechaMatrimonio)' => $dateNow->format('m'),
				'Genero'		=> 'Masculino'
			);
			$personas = $this->object_model->get('persona','DAY(FechaMatrimonio)',$where);

			$date1 = '';
			$date2 = '';
			foreach($personas as $item) {
				if($item['FechaMatrimonio'] != '0000-00-00') {
					$dateNow = new DateTime("now");
					$eventDate = new DateTime($item['FechaMatrimonio']);
					if ($date1 != $eventDate->format($dateNow->format('Y').'-m')) {
						$date1 = $eventDate->format($dateNow->format('Y').'-m');
					}
					$date2 = new DateTime($eventDate->format($dateNow->format('Y').'-m-1'));
					// echo "<pre>"; print_r($date2); echo "</pre>";
					$annivers[$i]['FechaEvento'] = $date1;
					$annivers[$i]['NomFechaEvento'] = ucwords(strftime("%B", strtotime($date2->format('Y-m-1'))));
					if ((empty($item['idConyugue'])) || ($item['idConyugue'] == 0)) {
						$annivers[$i]['Nombre'] = ucwords($item['Nombre']." ".$item['Apellido'])." (".$eventDate->format('d').")";
					} else {
						$where = array ('idPersona' => $item['idConyugue']);
						$spouse = $this->object_model->get('persona','',$where);
						if (empty($spouse)) {
							$annivers[$i]['Nombre'] = ucwords(strtolower($item['Nombre']." ".$item['Apellido']))." (".$eventDate->format('d').")";
						} else {
							$spouse = $spouse[0];
							$annivers[$i]['Nombre'] = ucwords(strtolower($item['Nombre']." ".$item['Apellido']))." y ";
							$annivers[$i]['Nombre'] .= ucwords(strtolower($spouse['Nombre']." ".$spouse['Apellido']))." (".$eventDate->format('d').")";
						}
					}
					$annivers[$i]['Evento'] = 3;
					$i++;
				}
			}
		}
	}

	//construir la page completa y permite liberar funcion Index
	private function loadHTML(&$data,$page) {
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
		$this->load->view($page,$data);
	}
	

}


?>