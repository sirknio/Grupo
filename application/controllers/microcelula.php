<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Microcelula extends CI_Controller {
	private $controller = 'microcelula';
	private $pagelist = 'microcelulas';
	private $pagecard = 'microcelula';
	private $pkfield = 'idMicrocelula';
	private $orderfield = 'Nombre';
	private $imgfield = '';
	private $imgpath = '';
	private $debug = false;

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('integrante_model');
	}
	
	public function index($idGrupo = '',$idMicro = '') {
		$this->loadData($data,$this->debug,$idGrupo,$idMicro);
		$this->loadHTML($data);
		$this->load->view('pages/'.$this->pagelist,$data);
	}	
		
	//Eliminar registro
	public function deleteItem($idGrupo = '',$idMicro = '') {
		if($idMicro !== '') {
			$this->loadData($data,$this->debug,$idGrupo,$idMicro);
			if ($this->imgfield != '') {
				$this->deleteImg($data);
			}
			$this->object_model->deleteItem($this->controller,array($this->pkfield => $idMicro));
		}
		redirect($this->controller.'/index/'.$idGrupo);
	}
	
	//Insertar registro
	public function insertItem($idGrupo = '',$createId = '') {
		$data['update'] = false;
		If($createId === '') {
			$this->loadData($data,$this->debug,$idGrupo);
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		} else {
			$data['insert'] = $_POST;
			
			$this->loadData($aux,$this->debug,$data['insert']['idGrupo']);
			if ($data['insert']['idColider1'] == '') {
				unset($data['insert']['idColider1']);
			}
			
			if ($data['insert']['idColider2'] == '') {
				unset($data['insert']['idColider2']);
			}

			$data['insert'][$this->pkfield] = $this->object_model->insertItem($this->controller,$data['insert']);
			if($data['insert'][$this->pkfield] != 0) {
				$this->loadData($data,$this->debug,$data['insert'][$this->pkfield]);
				redirect($this->controller.'/index/'.$data['insert']['idGrupo']);
			} else {
				//Establecer mensaje de error en insercción de datos
				$this->loadData($data,$this->debug,$data['insert'][$this->pkfield]);
				$this->loadHTML($data);
				$this->load->view('pages/'.$this->pagecard,$data);
			}
		}
	}

	//Actualizar registro
	public function updateItem($idGrupo = '',$idMicro = '',$action = false) {
		$data['update'] = true;
		if (!$action) {
			$where = array($this->pkfield => $idMicro);
			$data['info'] = $this->object_model->get($this->controller,'',$where);
			$_POST = array_merge($_POST,$data['info'][0]);

			$this->loadData($data,$this->debug,$idMicro);
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		} else {
			$data['update'] = $_POST;
			//echo "<pre>";print_r($data['update']);echo "</pre>";

			if ($data['update']['idColider1'] == '') {
				unset($data['update']['idColider1']);
			}
			
			if ($data['update']['idColider2'] == '') {
				unset($data['update']['idColider2']);
			}
			
			$this->loadData($data,$this->debug,$idMicro);
			$where = array($this->pkfield => $idMicro);
			if ($this->object_model->updateItem($this->controller,$data['update'],$where)) {
				redirect($this->controller.'/index/'.$data['update']['idGrupo']);
			} else {
				//Establecer mensaje de error en actualizar datos
				$this->loadData($data,$this->debug,$data['insert'][$this->pkfield]);
				$this->loadHTML($data);
				$this->load->view('pages/'.$this->pagecard,$data);
			}
		}
	}
	
	public function loadImg(&$data,$action,$fieldName) {
		$img['upload_path']   = 'public/images/'.$this->imgpath.'/';
		$img['allowed_types'] = 'gif|jpeg|jpg|png';
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
	
	private function loadData(&$data,$debug = false,$idGrupo = '',$idMicro = '') {
		$data['userdata'] = $_SESSION;
		if ($idMicro === '') {
			$where = array('idGrupo' => $idGrupo);
			$data['records'] = $this->object_model->get($this->controller,'',$where);
		} else {
			$where = array($this->pkfield => $idMicro);
			$data['records'] = $this->object_model->get($this->controller,'',$where);
		}

		$data['colider'] = $this->integrante_model->getColideres($idGrupo);
		$data['TipoMicro'] = $this->object_model->getTipoValues('Microcelula','TipoMicro');
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