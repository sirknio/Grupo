<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Usuario extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->model('object_model');
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
	}
	
	public function index($idUsuario = '') {
		$this->loadData($data);
		$this->loadHTML($data);
		$this->load->view('pages/Grupos',$data);
	}
	
	private function loadData(&$data) {
		//crear una manera de que cuando no existan las variables se creen automaticamente o que no genere errores en la pagina
		$data['userdata'] = $_SESSION;
		$data['groups'] = $this->object_model->get('Usuario');
		$data['morrisjs'] = '';
		$print = '';
		//$print = $data;
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