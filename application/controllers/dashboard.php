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
		$this->load->model('stats_model');
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
		$where = array(
			'idGrupo' 	=> $data['userdata']['idGrupo'],
			'TipoMicro'	=> 'Inactivos'
		);
		$data['inactivos'] = $this->object_model->get('microcelula','',$where);
		if (!empty($data['inactivos'])) $data['inactivos'] = $data['inactivos'][0];
		if (empty($data['inactivos'])) $data['inactivos']['idMicrocelula'] = 0;
		$where = array(
			'idGrupo' 	=> $data['userdata']['idGrupo'],
			'TipoMicro'	=> 'Nuevos'
		);
		$data['nuevos'] = $this->object_model->get('microcelula','',$where);
		if (!empty($data['nuevos'])) $data['nuevos'] = $data['nuevos'][0];
		if (empty($data['nuevos'])) $data['nuevos']['idMicrocelula'] = 0;

		if($data['userdata']['idGrupo'] !== null) {
			$data['asistencia'] = $this->evento_model->getMainGraph($data['userdata']['idGrupo'],
					$data['setupapp']['LimiteEventosDashboard']);
			
			$this->buildEvents($data,$dateNow,$data['eventos'],$data['birhtdays'],$data['annivers']);
			$this->buildNotif($data,$data['notif']);
			
			$data['morrisjs'] = 'morris-data-dashboard.js';
			
			$data['cant_eventos'] = count($data['eventos']);
			$where = array(
				'idGrupo' => $data['userdata']['idGrupo'],
				'idMicrocelula' => $data['nuevos']['idMicrocelula']
			);
			$data['cant_nuevos'] = $this->object_model->RecCount('persona',$where);
			$where = 
				"idGrupo = ".$data['userdata']['idGrupo']." AND ".
				"idMicrocelula !=".$data['nuevos']['idMicrocelula']." AND ".
				"idMicrocelula !=".$data['inactivos']['idMicrocelula']
			;
			$data['cant_activ'] = $this->object_model->RecCount('persona',$where);
			$where = array(
				'idGrupo' => $data['userdata']['idGrupo'],
				'idMicrocelula' => $data['inactivos']['idMicrocelula']
			);
			$data['cant_inact'] = $this->object_model->RecCount('persona',$where);
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

	private function buildNotif(&$data,&$notif) {
		$notif = array();
		// echo"<pre>";print_r($data);echo"</pre>";

		// Determina el ultimo Evento Cerrado
		$data['lastEvent'] = $this->stats_model->getLastEvent($data['userdata']['idGrupo']);
		// echo"<pre>";print_r($notif['lastEvent']);echo"</pre>";

		//Notificación por Ausencia de N meses atrás (2 meses)
		$notif['Absens1'] = $this->stats_model->absensePerDate($data['userdata']['idGrupo'],
				$data['lastEvent']['FechaEvento'],2,0);

		//Notificación por Ausencia de N meses atrás (6 meses)
		$notif['Absens2'] = $this->stats_model->absensePerDate($data['userdata']['idGrupo'],
				$data['lastEvent']['FechaEvento'],6,0);
		
		$i = 0;
		foreach($notif['Absens2'] as $item1) {
			foreach($notif['Absens1'] as $key2 => $item2) {
				if($item1['idPersona'] === $item2['idPersona']) {
					unset($notif['Absens1'][$key2]);
				}
			}
		}
		
		//Notificación por Asistencia de N meses atrás (3 meses - tolerancia 2 inasistencias)
		$notif['Assist1'] = $this->stats_model->AssistancePerDate($data['userdata']['idGrupo'],
				$data['lastEvent']['FechaEvento'],3,0,2);
		
		//Notificación por Asistencia de N meses atrás (6 meses - tolerancia 4 inasistencias)
		$notif['Assist2'] = $this->stats_model->AssistancePerDate($data['userdata']['idGrupo'],
				$data['lastEvent']['FechaEvento'],6,4,4);		
	}

	private function buildEvents(&$data,$dateNow,&$eventos,&$birhtdays,&$annivers) {
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