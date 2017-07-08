<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Integrante extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->model('object_model');
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
	}
	
	public function index($idGrupo = '',$idMicro = '') {
		$this->loadData($data,$idGrupo,$idMicro);
		$print = '';
		//$print = $data;
		$data['print'] = $print;
		$this->loadHTML($data);
		$this->load->view('pages/Integrantes',$data);
	}
	
	private function loadData(&$data,$idGrupo = '',$idMicro = '') {
		$data['userdata'] = $_SESSION;
		//Debe haber un filtor de seguridad que si el usuario no es admin no puede ver otro grupo
		$where = '';
		if ($idGrupo != '') {
			$where = 'idGrupo='.$idGrupo;
		}
		if ($idMicro != '') {
			if ($where != '') {
				$where = ' AND ';
			}
			$where = 'idMicrocelula='.$idMicro;
		}
		if ($where === '') {
			$data['persons'] = $this->object_model->get('Persona','Nombre');
		} else {
			$data['persons'] = $this->object_model->get('Persona','Nombre',$where);
		}
		$data['morrisjs'] = '';
	}

	//construir la page completa y permite liberar funcion Index
	private function loadHTML(&$data) {
		$data['page']['header'] = $this->load->view('templates/header',$data,true);
		$data['page']['menu']   = $this->load->view('templates/menu',$data,true);
		$data['page']['footer'] = $this->load->view('templates/footer',$data,true);
	}
	
}


?>