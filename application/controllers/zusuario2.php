<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Usuario extends CI_Controller {
	//Constructor
	public function __construct() {
		parent::__construct();
		$this->load->model('object_model');
		$confimg['upload_path']   = 'public/';
		$confimg['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $confimg);
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
	}
	
	//Muestra la page principal de usuarios
	public function index($print = '') {
		$data['users'] = $this->object_model->get('Usuario');
		$data['print'] = $print;
		$this->construirPage($data);
		$this->load->view('pages/Usuarios',$data);
	}
	
	//Muestra la page para insertar los datos
	public function pageCrearUsuario ($print = '') {
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$data['update'] = false;
		$data['print'] = $print;
		$this->construirPage($data);
		$this->load->view('pages/UsuarioCrear',$data);
	}
	
	//Action para validar datos e Insertar usuario
	public function crearUsuario () {		
		$this->form_validation->set_error_delimiters('<div class="error">&nbsp;&nbsp;&nbsp;*** ', '</div>');
		if ($this->form_validation->run() == FALSE) {
			$this->pageCrearUsuario();
			
		} else {
			$data = $_POST;
			unset($data['Password2']);
			if($this->object_model->insertar('usuario',$data)) {
				if ($this->upload->do_upload('Imagen')) {
					$data['file_uploaded'] = array('upload_data' => $this->upload->data());
				} else {
					$data['file_uploaded'] = 'NO SUBIOOO';
				}
				$this->index();
			}
		}
	}
	
	//Muestra la page para actualizar los datos
	public function pageActualizarUsuario ($id,$print = '') {
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$data['print'] = $print;
		$data['update'] = true;
		$where = array('idUsuario' => $id);
		$data['user'] = $this->object_model->get('Usuario',$where);
		$_POST = array_merge($_POST,$data['user']);
		$_POST['Password'] = '';
		$this->construirPage($data);
		$this->load->view('pages/UsuarioCrear',$data);
	}
	
	//Action para validar datos y Actualizar usuario
	public function actualizarUsuario ($id) {
		$this->form_validation->set_error_delimiters('<div class="error">&nbsp;&nbsp;&nbsp;*** ', '</div>');
		if ($this->form_validation->run() == FALSE) {
			$this->pageActualizarUsuario($id);
		} else {
			$data = $_POST;
			unset($data['Password2']);
			if($data['Password'] === '') {
				unset($data['Password']);
			}
			$where = array('idUsuario' => $id);
			if($this->object_model->actualizar('usuario',$data,$where)) {
				if ($this->upload->do_upload('Imagen')) {
					$data['file_uploaded'] = array('upload_data' => $this->upload->data());
				} else {
					$data['file_uploaded'] = "NO SUBIO";
				}
				$this->index();
			}
		}
	}
	
	//eliminar usuario
	public function eliminarUsuario($id = '') {
		if($id !== '') {
			$data = array('idUsuario' => $id);
			$this->object_model->eliminar('usuario',$data);
		}
		$this->index();
	}
	
	//Contruir los atributos y los campos para la page
	private function construirCampos(&$data) {
		$attributes = array(
			'class' => 'form-control'
		);
		
		$attribText = array(
			'size' => '25'
		);
		
		$attribDropDown = array(
			'style' => 'width:220px'
		);
		
		$data['attributes']['TipoUsuario'] = array(
			'placeholder' => '   Tipo Usuario'
		);
		
		$data['options']['TipoUsuario'] = array(
			''           => "&nbsp;",
			'Asistente'  => "Asistente",
			'Apoyo'      => "Apoyo",
			'Microlider' => "Microlider",
			'Lider'      => "Lider",
			'Admin'      => "Admin"
		);
		
		$data['attributes']['Usuario'] = array(
			'placeholder' => '   Usuario',
			'autofocus'   => ''
		);
		
		$data['attributes']['Password'] = array(
			'placeholder' => '   Contraseña'
		);
		
		$data['attributes']['Password2'] = array(
			'placeholder' => '   Confirmar contraseña'
		);
		
		$data['attributes']['Email'] = array(
			'placeholder' => '   Correo Electr&oacute;nico'
		);
		
		$data['attributes']['Imagen'] = array(
			'placeholder' => '   Imagen'
		);
		
		$data['attributes']['Password']   = array_merge($data['attributes']['Password'],$attributes,$attribText);
		$data['attributes']['Password2']   = array_merge($data['attributes']['Password2'],$attributes,$attribText);
		$data['attributes']['Email']       = array_merge($data['attributes']['Email'],$attributes,$attribText);
		$data['attributes']['TipoUsuario'] = array_merge($data['attributes']['TipoUsuario'],$attributes,$attribDropDown);
		$data['attributes']['Imagen']      = array_merge($data['attributes']['Imagen'],$attributes);
	}

	//construir la page completa y permite liberar funcion Index
	private function construirPage (&$data) {
		$this->construirCampos($data);
		$data['userdata'] = $_SESSION;
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['topmenu'] = $this->load->view('templates/topmenu',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
	}
	
}









?>