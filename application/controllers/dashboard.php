<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Dashboard extends CI_Controller {
	private $debug = false;
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('notificacion_model');
		$this->load->model('evento_model');
	}
	
	public function index($id = '') {
		$this->loadData($data,$this->debug,$id);
		$this->loadHTML($data);
		$this->load->view('pages/dashboard',$data);
	}

	private function loadData(&$data,$debug = false,$id = '') { 
		//$data['Statistics']['Grupos']       = $this->object_model->RecCount('Grupo');
		//$data['Statistics']['Microcelulas'] = $this->object_model->RecCount('Persona','idMicrocelula');
		//$data['Statistics']['Usuarios']     = $this->object_model->RecCount('Usuario');
		$data['userdata'] = $_SESSION;
		$data['eventos'] = $this->object_model->get('Evento','FechaEvento DESC',array('idGrupo' => $data['userdata']['idGrupo']));
		$data['asistencia'] = $this->evento_model->getMainGraph($data['userdata']['idGrupo'],5);
		$data['morrisjs'] = 'morris-data-dashboard.js';
		
		//Establecer cuantas parejas cumplieron las tres asistencias para subirlas al reporte de la iglesia
		$data['statistics']['MinAsist'] = $this->notificacion_model->getNewMinAsist($data['userdata']['idGrupo']);

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