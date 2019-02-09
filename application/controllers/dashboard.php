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
	}
	
	public function index($id = '') {
		$this->loadData($data,$this->debug,$id);
		$this->loadHTML($data);
		$this->load->view('pages/dashboard',$data);
	}

	private function loadData(&$data,$debug = false,$id = '') { 
		$data['userdata'] = $_SESSION;
		$data['setupapp'] = $this->object_model->getSetup(); 
		$data['date'] = '';
		if($data['userdata']['idGrupo'] !== null) {
			$data['asistencia'] = $this->evento_model->getMainGraph($data['userdata']['idGrupo'],
					$data['setupapp']['LimiteEventosDashboard']);
			$data['eventos'] = $this->object_model->get('evento','FechaEvento DESC',
					array('idGrupo' => $data['userdata']['idGrupo']));
			$data['morrisjs'] = 'morris-data-dashboard.js';
		} else {
			$data['asistencia'] = array();
			$data['eventos'] = array();
		}
		if ($data['userdata']['TipoUsuario'] == 'Admin') {
			$data['cant_grupos'] = $this->object_model->RecCount('grupo');
			$data['cant_micros'] = $this->object_model->RecCount('microcelula');
			$data['cant_personas'] = $this->object_model->RecCount('persona');
			$data['cant_eventos'] = $this->object_model->RecCount('evento');
		}
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


?>