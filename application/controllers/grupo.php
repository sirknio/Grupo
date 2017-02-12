<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Grupo extends CI_Controller {
	//Constructor
	public function __construct() {
		parent::__construct();
		$this->load->model('object_model');
		
		$confimg['upload_path']   = 'public/';
		$confimg['allowed_types'] = 'gif|jpg|png';
		//$confimg['max_size']      = 100;
		//$confimg['max_width']     = 1024;
		//$confimg['max_height']    = 768;
		$this->load->library('upload', $confimg);
	}
	
	//Muestra la page principal de Grupos
	public function index($print = '') {
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$data['groups'] = $this->object_model->get('Grupo');
		$data['print'] = $print;
		$this->construirPage($data);
		$this->load->view('pages/Grupos',$data);
	}
	
	//Muestra la page para insertar los datos
	public function pageCrearGrupo ($print = '') {
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$data['update'] = false;
		$data['print'] = $print;
		$this->construirPage($data);
		$this->load->view('pages/GrupoCrear',$data);
	}
	
	//Action para validar datos e Insertar usuario
	public function crearGrupo () {		
		$this->form_validation->set_error_delimiters('<div class="error">&nbsp;&nbsp;&nbsp;*** ', '</div>');
		if ($this->form_validation->run() == FALSE) {
			$this->pageCrearGrupo();
			
		} else {
			$data = $_POST;
			if($this->object_model->insertar('grupo',$data)) {
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
	public function pageActualizarGrupo ($id,$print = '') {
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$data['print'] = $print;
		$data['update'] = true;
		$where = array('idGrupo' => $id);
		$data['grupo'] = $this->object_model->get('Grupo',$where);
		$_POST = array_merge($_POST,$data['grupo']);
		$this->construirPage($data);
		$this->load->view('pages/grupoCrear',$data);
	}
	
	//Action para validar datos y Actualizar usuario
	public function actualizarGrupo ($id) {
		$this->form_validation->set_error_delimiters('<div class="error">&nbsp;&nbsp;&nbsp;*** ', '</div>');
		if ($this->form_validation->run() == FALSE) {
			$this->pageActualizarGrupo($id);
		} else {
			$data = $_POST;
			$where = array('idGrupo' => $id);
			if($this->object_model->actualizar('grupo',$data,$where)) {
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
	public function eliminarGrupo($id = '') {
		if($id !== '') {
			$data = array('idGrupo' => $id);
			$this->object_model->eliminar('grupo',$data);
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
		
		$data['attributes']['Nombre'] = array(
			'placeholder' => '   Nombre',
			'autofocus'   => ''
		);
		
		$data['attributes']['Descripcion'] = array(
			'placeholder' => '   Descripci&oacute;n'
		);
		
		$data['attributes']['Imagen'] = array(
			'placeholder' => '   Imagen'
		);
		
		$data['attributes']['Nombre']       = array_merge($data['attributes']['Nombre'],$attributes,$attribText);
		$data['attributes']['Descripcion'] = array_merge($data['attributes']['Descripcion'],$attributes,$attribDropDown);
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