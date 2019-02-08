<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('usuario_model');
	}
	
	public function index() {
		if($this->session->userdata('usuario')) {
			redirect('dashboard');
		}
		
		if((isset($_POST['password'])) && ($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))) {
			$user = $this->usuario_model->login(
						$this->input->post('usuario',true),
						md5(sha1($_POST['password'])));
			if(isset($user['Usuario'])) {
				if($user['Usuario'] != '') {
					$this->session->set_userdata('usuario',$_POST['usuario']);
					$this->session->set_userdata('idUsuario',$user['idUsuario']);
					$this->session->set_userdata('Usuario',$user['Usuario']);
					$this->session->set_userdata('Password',md5(sha1($user['Password'])));
					$this->session->set_userdata('Email',$user['Email']);
					$this->session->set_userdata('TipoUsuario',$user['TipoUsuario']);
					$this->session->set_userdata('idPersona',$user['idPersona']);
					$this->session->set_userdata('idGrupo',$user['idGrupo']);
					$this->session->set_userdata('Nombre',$user['Nombre']);
					$this->session->set_userdata('Apellido',$user['Apellido']);
					$this->session->set_userdata('AsistAbierta',$user['AsistAbierta']);
					redirect('Dashboard');
				} else {
					redirect('login#bad-attempt');
				}
			} else {
				redirect('login#bad-attempt');
			}
		}
		
		$data['token'] = $this->token();
		$this->load->view('login',$data);
	}

	public function token() {
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('login');
		//$this->load->view('login');
	}
}


?>