<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Grupo extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->model('object_model');
	}
	
	public function index($print = '') {
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		//$print = $_SESSION;
		$data['groups'] = $this->object_model->get('Grupo');
		$data['print'] = $print;
		$this->loadLibraries($data);
		$this->load->view('pages/Grupos',$data);
	}

	//construir la page completa y permite liberar funcion Index
	private function loadLibraries (&$data) {
		//$this->construirCampos($data);
		$data['userdata'] = $_SESSION;
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
	}
	
}


?>