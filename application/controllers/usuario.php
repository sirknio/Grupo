<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Usuario extends CI_Controller {
	private $controller = 'usuario';
	private $pagelist = 'usuarios';
	private $pagecard = 'usuario';
	private $pkfield = 'idUsuario';
	private $orderfield = 'Usuario';
	private $imgfield = '';
	private $imgpath = '';
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
		$this->loadData($data,$this->debug,$id);
		$this->loadHTML($data);
		$this->load->view('pages/'.$this->pagelist,$data);
	}	
		
	//Eliminar registro
	public function deleteItem($id = '') {
		if($id !== '') {
			$this->loadData($data,$this->debug,$id);
			if ($this->imgfield != '') {
				$this->deleteImg($data);
			}
			$this->object_model->deleteItem($this->controller,array($this->pkfield => $id));
		}
		redirect($this->controller);
	}
	
	//Insertar registro
	public function insertItem($createId = '') {
		$data['update'] = false;
		If($createId === '') {
			$this->loadData($data,$this->debug);
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		} else {
			$data['insert'] = $_POST;
			if ($data['insert']['Password'] = $data['insert']['Password']) {
				unset($data['insert']['Password2']);
				$data['insert']['Password'] = md5(sha1($data['insert']['Password']));
				$data['insert'][$this->pkfield] = $this->object_model->insertItem($this->controller,$data['insert']);
				if($data['insert'][$this->pkfield] != 0) {
					$this->loadData($data,$this->debug,$data['insert'][$this->pkfield]);
					redirect($this->controller);
				} else {
					//Establecer mensaje de error en insercción de datos
					$this->loadData($data,$this->debug,$data['insert'][$this->pkfield]);
					$this->loadHTML($data);
					$this->load->view('pages/'.$this->pagecard,$data);
				}
			} else {
					//Establecer mensaje de error en contraseñas
					$this->loadData($data,$this->debug,$data['insert'][$this->pkfield]);
					$this->loadHTML($data);
					$this->load->view('pages/'.$this->pagecard,$data);
			}
		}
	}

	//Actualizar registro
	public function updateItem($id = '',$action = false) {
		$data['update'] = true;
		if (!$action) {
			$where = array($this->pkfield => $id);
			$data['info'] = $this->object_model->get($this->controller,'',$where);
			$_POST = array_merge($_POST,$data['info'][0]);

			$this->loadData($data,$this->debug,$id);
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		} else {
			$data['update'] = $_POST;
			if ($data['update']['Password'] == $data['update']['Password2']) {
				unset($data['update']['Password2']);
				if ($data['update']['Password'] == '') {
					unset($data['update']['Password']);
				} else {
					$data['update']['Password'] = md5(sha1($data['update']['Password']));
				}
				
				$this->loadData($data,$this->debug,$id);
				$where = array($this->pkfield => $id);
				if ($this->object_model->updateItem($this->controller,$data['update'],$where)) {
					redirect($this->controller);
				} else {
					//Establecer mensaje de error en actualizar datos
					$this->loadData($data,$this->debug,$data['update'][$this->pkfield]);
					$this->loadHTML($data);
					$this->load->view('pages/'.$this->pagecard,$data);
				}
			} else {
					//Establecer mensaje de error en contraseña
					$this->loadData($data,$this->debug,$data['update'][$this->pkfield]);
					$this->loadHTML($data);
					$this->load->view('pages/'.$this->pagecard,$data);
			}
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
		if ($id === '') {
			$data['records'] = $this->object_model->get($this->controller);
		} else {
			$data['records'] = $this->object_model->get($this->controller,$this->orderfield,$this->pkfield.'='.$id);
		}
		$data['Grupos'] = $this->object_model->get('grupo','Nombre');
		$data['TipoUsuario'] = $this->usuario_model->getTipoUsuarioValues();
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