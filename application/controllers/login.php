<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->model('object_model');
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
					$this->session->set_userdata('Email',$user['Email']);
					$this->session->set_userdata('TipoUsuario',$user['TipoUsuario']);
					$this->session->set_userdata('idGrupo',$user['idGrupo']);
					if (!empty($user['grupo'])) {
						$this->session->set_userdata('NombreGrupo',$user['grupo']['Nombre']);
					} else {
						$this->session->set_userdata('NombreGrupo',null);
					}
					if (!empty($user['microcelula'])) {
						$this->session->set_userdata('idMicro',$user['microcelula']['idMicrocelula']);
					} else {
						$this->session->set_userdata('idMicro',null);
					}
					$this->load->model('novedad_model');
					$novedad = $this->novedad_model->getNews($user['idGrupo'],$user['TipoUsuario'],$user['idUsuario']);
					$this->session->set_userdata('Novedades', $novedad);			
					$this->session->set_userdata('Nombre',$user['Nombre']);
					$this->session->set_userdata('Apellido',$user['Apellido']);
					$this->session->set_userdata('AsistAbierta',$user['AsistAbierta']);
					$this->object_model->registerLogin($user);
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
		$this->object_model->registerLogout();
		$this->session->sess_destroy();
		redirect('login');
	}
}


?>