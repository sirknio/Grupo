<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Master extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('object_model');
		$this->load->model('persona_model');
	}
	
	public function index() {
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		
		$data['userdata'] = $_SESSION;
		$data['Statistics']['Grupos']       = $this->object_model->RecCount('Grupo');
		$data['Statistics']['Microcelulas'] = $this->object_model->RecCount('Persona','idMicrocelula');
		$data['Statistics']['Usuarios']     = $this->object_model->RecCount('Usuario');
		$data['Statistics']['Personas']     = $this->object_model->RecCount('Persona');
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['topmenu'] = $this->load->view('templates/topmenu',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
		$this->load->view('pages/dashboard',$data);
	}
}


?>