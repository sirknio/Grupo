<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Asistencia extends CI_Controller {
	private $controller = 'asistencia';
	private $pagelist = 'asistencia';
	private $pagecard = 'asistencia';
	private $pkfield = 'idEvento';
	private $orderfield = 'FechaEvento';
	private $imgfield = '';
	private $imgpath = '';
	private $debug = false;

	public function __construct() {
		parent::__construct();
		//Esta es la parte fundamental para el el registro de asistencia sin logueo
		//Aqui cree el branch de GraphAssistGender
		//if(!$this->session->userdata('usuario')) {
		//	redirect('login');
		//}
		$this->load->model('object_model');
		$this->load->model('integrante_model');
		$this->load->model('evento_model');
	}
	
	public function index($idGrupo = '') {
		$where = array(
			'Estado' 	=> 'Abierto',
			'idGrupo' 	=> $idGrupo
		);
		$evento = $this->object_model->get('evento', $this->orderfield, $where);
		if ((count($evento) == 0) || ($idGrupo == '')) {
			$data['no_evento'] = "Por favor seleccione un Grupo y abra un evento para tomar asistencia.";
		} else {
			$evento = $evento[0];
			$_POST = array_merge($_POST,array(
					'idEvento' => $evento['idEvento'],
					'idGrupo' => $evento['idGrupo']
				)
			);
			$data['evento'] = $evento;
		}
		$this->loadData($data,$this->debug);
		$this->loadHTML($data);
		$this->load->view('pages/'.$this->pagelist,$data);
	}	
	
	public function checkAsist() {
		$this->loadData($data,$this->debug);
		unset($data['error']);
		unset($data['success']);
		//echo "<pre>";print_r($_POST);echo "</pre>";
		$where = array(
			'idGrupo' => $_POST['idGrupo'],
			'idEvento' => $_POST['idEvento'],
			'DocumentoNo' => $_POST['DocumentoNo']
			);
		$asistencia = $this->object_model->get($this->controller,'',$where);
		if (count($asistencia) > 0) {
			$this->object_model->updateItem($this->controller,array('Asiste' => 1),$where);
			$asistencia = $asistencia[0];
			$data['success'] = "Bienvenido <b>".$asistencia['Nombre']." ".$asistencia['Apellido']."</b> al grupo de Conexión. Tu asistencia ha sido registrada exitosamente.";
		} else {
			$where = array(
				'DocumentoNo' => $_POST['DocumentoNo']
			);
			$persona = $this->object_model->get('persona','',$where);
			if (!empty($persona)) {
				$where = array('idEvento' 	=> $_POST['idEvento']);
				$evento  = $this->object_model->get('evento', '', $where);
				$evento = $evento[0];
		
				$where = array(
					'idGrupo' 		=> $_POST['idGrupo'],
					'DocumentoNo'	=> $_POST['DocumentoNo']
				);

				// echo "<pre>"; print_r($evento); echo "</pre>";
				if ($evento['TomarAsistencia'] == 1) {
					switch(true) {
						case $evento['Filtro'] == 'Mujeres':
							$where = array_merge($where,array('Genero' => 'Femenino'));	
							break;
						case $evento['Filtro'] == 'Hombres':
							$where = array_merge($where,array('Genero' => 'Masculino'));	
							break;
						case $evento['Filtro'] == 'Todos':
							break;
					}
					$persona = $this->object_model->get('persona','',$where);
					// echo "<pre>"; print_r($persona); echo "</pre>";

					if (!empty($persona)) {
						$persona = $persona[0];

						$where = array(
							'idGrupo' 	=> $evento['idGrupo'],
							'TipoMicro'	=> 'Inactivos'
						);
						$inac = $this->object_model->get('microcelula','',$where);
						$inac = $inac[0];
						// echo "<pre>"; print_r($inac); echo "</pre>";
	
						$where = array(
							'idGrupo' 	=> $evento['idGrupo'],
							'TipoMicro'	=> 'Nuevos'
						);
						$nuevos = $this->object_model->get('microcelula','',$where);
						$nuevos = $nuevos[0];
						// echo "<pre>"; print_r($nuevos); echo "</pre>";
	
						if ($persona['idMicrocelula'] == $inac['idMicrocelula']) {
							$update = array('idMicrocelula' => $nuevos['idMicrocelula']);
							$where = array('idPersona' => $persona['idPersona']);
							$this->object_model->updateItem('persona',$update,$where);
						}
			
						$asistencia = array(
							'idEvento' 		=> $evento['idEvento'],
							'idGrupo' 		=> $evento['idGrupo'],
							'idMicro' 		=> $nuevos['idMicrocelula'],
							'idPersona' 	=> $persona['idPersona'],
							'FechaEvento' 	=> $evento['FechaEvento'],
							'Asiste'		=> 1,
							'Nombre' 		=> $persona['Nombre'],
							'Apellido' 		=> $persona['Apellido'],
							'DocumentoNo' 	=> $persona['DocumentoNo']
						);

						$asistencia['idAsistencia'] = $this->object_model->insertItem('asistencia',$asistencia);
						$data['success'] = "Bienvenido <b>".$asistencia['Nombre']." ".$asistencia['Apellido']."</b> al grupo de Conexión. Tu asistencia ha sido registrada exitosamente.";
						// echo "<pre>"; print_r($asistencia); echo "</pre>";
					} else {
						$data['error']  = "No se puede registrar su asistencia. Recuerde que este evento esta registrado para <b>".$evento['Filtro']."</b>.";
					}
				}
			} else {
				$data['error']  = "El documento ingresado no se encuentra registrado en la aplicacion.";
			}	
		}

		$this->loadData($data,$this->debug,$_POST['idEvento']);
		$this->loadHTML($data);
		$this->load->view('pages/'.$this->pagelist,$data);
	}
	
	private function loadData(&$data,$debug = false,$id = '') {
		$evento = array();
		if ($id !== '') {
			$evento = $this->object_model->get('asistencia', 'FechaEvento', array('idEvento' => $id, 'Asiste' => 1));
			//echo "<pre>"; print_r($evento); echo "</pre>";
		}
		if (count($evento) > 0) {
			$data['asistcant'] = '('.count($evento).')';
		} else {
			$data['asistcant'] = '';
		}
		$data['evento'] = $evento;
		$data['userdata'] = $_SESSION;
		$data['morrisjs'] = '';
		if($debug) {
			$print = $data;
		} else {
			$print = '';
		}
		$data['print'] = $print;
	}

	//construir la page completa y permite liberar funcion Index
	private function loadHTML(&$data) {
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
	}
	
}