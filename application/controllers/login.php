<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('usuario_model');
	}
	
	public function index() {
		if($this->session->userdata('usuario')) {
			redirect('master');
		}
		if(isset($_POST['password'])) {
			$user = $this->usuario_model->login($_POST['usuario'],$_POST['password']);
			if($user['Usuario'] != '') {
				$this->session->set_userdata('usuario',$_POST['usuario']);
				$this->session->set_userdata('idUsuario',$user['idUsuario']);
				$this->session->set_userdata('Usuario',$user['Usuario']);
				$this->session->set_userdata('Email',$user['Email']);
				$this->session->set_userdata('TipoUsuario',$user['TipoUsuario']);
				$this->session->set_userdata('idPersona',$user['idPersona']);
				$this->session->set_userdata('idGrupo',$user['idGrupo']);
				$this->session->set_userdata('idMicrocelula',$user['idMicrocelula']);
				$this->session->set_userdata('NombreUsuario',$user['NombreUsuario']);
				$this->session->set_userdata('Nombre',$user['Nombre']);
				$this->session->set_userdata('Apellido',$user['Apellido']);
				redirect('master');
			} else {
				redirect('login#bad-password');
			}
		}
		
		$this->load->view('login');
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}
}


?>