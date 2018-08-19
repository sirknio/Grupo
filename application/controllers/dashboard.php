<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Dashboard extends CI_Controller {
	private $debug = false;
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('evento_model');
		$this->load->library('statistics');
	}
	
	public function index($id = '') {
		$this->loadData($data,$this->debug,$id);
		$this->loadHTML($data);
		$this->load->view('pages/dashboard',$data);
	}

	private function loadData(&$data,$debug = false,$id = '') { 
		$data['userdata'] = $_SESSION;
		$data['setupapp'] = $this->object_model->getSetup(); 
		$data['date'] = '';
		
		//Este query para mostrar la grafica prioncipal de asistencia los ultimos grupos (Cuadro 1)
		$data['asistencia'] = $this->evento_model->getMainGraph(
			$data['userdata']['idGrupo'],
			$data['setupapp']['LimiteEventosDashboard']);
		
		//Este query muestra los eventos que se muestran en el dashboard (Cuadro 2)
		$data['eventos'] = $this->object_model->get('evento','FechaEvento DESC',
				array('idGrupo' => $data['userdata']['idGrupo']));

		//Esta linea esta cargando el js pero realmente no esta cargando nada porque el grafico esta por la view
		//$data['morrisjs'] = 'morris-data-dashboard.js';

		//Esta linea aun no se esta usando
		//$this->statistics->loadDashStatistics($data['statistics'],$data['userdata']['idGrupo']);
		
		if($debug) {
			$print = $data;
		} else {
			$print = '';
		}
		$data['print'] = $print;
	}

	//construir la page completa y permite liberar funcion Index
	private function loadHTML(&$data) {
		$data['page']['buttons'] = '';
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
	}
	

}


?>