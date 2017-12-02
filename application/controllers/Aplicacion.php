<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Aplicacion extends CI_Controller {
	private $controller = 'aplicacion';
	private $pagecard = 'aplicacion';
	private $pkfield = 'pkfield';
	private $debug = false;

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('usuario_model');
	}
	
	public function index($id = '') {
		$this->loadData($data,$this->debug,0);
		$this->loadHTML($data);
		$this->load->view('pages/'.$this->pagecard,$data);
	}	
		
	//Actualizar registro
	public function updateItem($action = false) {
		$data['update'] = $_POST;
		$where = array($this->pkfield => 0);
		if ($this->object_model->updateItem($this->controller,$data['update'],$where)) {
			redirect($this->controller);
		} else {
			//Establecer mensaje de error en actualizar datos
			$this->loadData($data,$this->debug,$data['update'][$this->pkfield]);
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		}
	}
	
	public function loadImg(&$data,$action,$fieldName) {
		$img['upload_path']   = 'public/images/'.$this->imgpath.'/';
		$img['allowed_types'] = 'gif|jpg|jpeg|png';
		$img['file_name'] = 'logo'.str_pad($data['records']['0'][$this->pkfield],10,'0', STR_PAD_LEFT);
		if ($data['records']['0']['logo_filename'] != '') {
			if (file_exists($img['upload_path'].$data['records']['0']['logo_filename'])) {
				unlink($img['upload_path'].$data['records']['0']['logo_filename']);
			}
		}
		$this->load->library('upload', $img);
		if ($this->upload->do_upload($fieldName)) {
			$data[$action]['file_info'] = $this->upload->data();
			$filedata = array(
					'logo_filename' => $data[$action]['file_info']['file_name'],
					'logo_filepath' => $data[$action]['file_info']['file_path']
				);
			$where = array($this->pkfield => $data['records']['0'][$this->pkfield]);
			$this->object_model->updateItem($this->controller,$filedata,$where);
		} else {
			$data[$action]['fail'] = $img;
			//Establecer mensaje de error por la carga del archivo
		}
	}
		
	public function deleteImg(&$data) {
		if ($data['records']['0']['logo_filename'] != '') {
			if (file_exists('public/images/'.$this->imgpath.'/'.$data['records']['0']['logo_filename'])) {
				unlink('public/images/'.$this->imgpath.'/'.$data['records']['0']['logo_filename']);
			}
		}
	}
	
	private function loadData(&$data,$debug = false,$id = '') {
		$data['userdata'] = $_SESSION;
		$data['setupapp'] = $this->object_model->getSetup(); 
		if ($id === '') {
			$data['records'] = $this->object_model->get($this->controller);
		} else {
			$data['records'] = $this->object_model->get($this->controller,'',$this->pkfield.'='.$id);
		}

		$where = array($this->pkfield => $id);
		$data['info'] = $this->object_model->get($this->controller,'',$where);
		$_POST = array_merge($_POST,$data['info'][0]);

		//$data['Persona'] = $this->object_model->get('persona','Nombre');
		//$data['TipoUsuario'] = $this->usuario_model->getTipoUsuarioValues();
		$data['morrisjs'] = '';
		if($debug) {
			$print = $data;
		} else {
			$print = '';
		}
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