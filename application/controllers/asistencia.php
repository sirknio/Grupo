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
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('integrante_model');
		$this->load->model('evento_model');
	}
	
	public function index() {
		$evento = $this->object_model->get('evento', $this->orderfield, "Estado = 'Abierto'");
		if (count($evento) == 0) {
			$data['no_evento'] = "Por favor abra un evento para tomar asistencia.";
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
		//echo "<pre>";print_r($check);echo "</pre>";
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
			$data['error']  = "El documento ingresado no se encuentra en la lista de asistencia.<hr>";
			$data['error'] .= "Si el integrante ya esta registrado es necesario ";
			$data['error'] .= "que vaya a la lista para encontrarlo, corregir el No. de Documento y tomarle nuevamente asistencia.";
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