<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Grupo extends CI_Controller {
	private $controller = 'grupo';
	private $pagelist = 'grupos';
	private $pagecard = 'grupo';
	private $pkfield = 'idGrupo';
	private $orderfield = 'Nombre';
	private $imgfield = 'logo';
	private $imgpath = 'grupos';
	private $debug = false;

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('integrante_model');
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
			if (isset($_POST['EstadoCivil'])) {
				$_POST['EstadoCivil'] = explode(",",$_POST['EstadoCivil']);
			} else {
				$_POST['EstadoCivil'] = array();
			}
			// echo "<pre>"; print_r($_POST); echo "</pre>";

			$this->loadData($data,$this->debug);
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		} else {
			if (isset($_POST['EstadoCivil'])) {
				$_POST['EstadoCivil'] = implode(",", $_POST['EstadoCivil']);
			}

			$data['insert'] = $_POST;
			
			if ($data['insert']['idLider1'] == '') {
				unset($data['insert']['idLider1']);
			}
			
			if ($data['insert']['idLider2'] == '') {
				unset($data['insert']['idLider2']);
			}
			
			$data['insert'][$this->pkfield] = $this->object_model->insertItem($this->controller,$data['insert']);
			if($data['insert'][$this->pkfield] != 0) {
				if (isset($data['insert']['idLider1'])) {
					$group = array('idGrupo' => $id);
					$where = array(
						'idUsuario' => $data['insert']['idLider1'],
						'TipoUsuario !=' => 'Admin'
					);
					$this->object_model->updateItem('usuario',$group,$where);
				}
				
				if (isset($data['insert']['idLider2'])) {
					$group = array('idGrupo' => $id);
					$where = array(
						'idUsuario' => $data['insert']['idLider2'],
						'TipoUsuario !=' => 'Admin'
					);
					$this->object_model->updateItem('usuario',$group,$where);
				}
				
				$this->loadData($data,$this->debug,$data['insert'][$this->pkfield]);
				if ($this->imgfield != '') {
					$this->loadImg($data,'insert',$this->imgfield);
				}
				redirect($this->controller);
			} else {
				//Establecer mensaje de error en insercción de datos
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
			// echo "<pre>"; print_r($data['info'][0]); echo "</pre>";
			
			if (isset($_POST['EstadoCivil'])) {
				$_POST['EstadoCivil'] = explode(",",$_POST['EstadoCivil']);
			} else {
				$_POST['EstadoCivil'] = array();
			}
			// echo "<pre>"; print_r($_POST); echo "</pre>";

			$this->loadData($data,$this->debug,$id);
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		} else {
			if (isset($_POST['EstadoCivil'])) {
				$_POST['EstadoCivil'] = implode(",", $_POST['EstadoCivil']);
			}

			$data['update'] = $_POST;

			if ($data['update']['idLider1'] == '') {
				unset($data['update']['idLider1']);
			}
			
			if ($data['update']['idLider2'] == '') {
				unset($data['update']['idLider2']);
			}
			
			$this->loadData($data,$this->debug,$id);
			$where = array($this->pkfield => $id);
			if ($this->object_model->updateItem($this->controller,$data['update'],$where)) {
				if (isset($data['update']['idLider1'])) {
					$group = array('idGrupo' => $id);
					$where = array(
						'idUsuario' => $data['update']['idLider1'],
						'TipoUsuario !=' => 'Admin'
					);
					$this->object_model->updateItem('usuario',$group,$where);
				}
				
				if (isset($data['update']['idLider2'])) {
					$group = array('idGrupo' => $id);
					$where = array(
						'idUsuario' => $data['update']['idLider2'],
						'TipoUsuario !=' => 'Admin'
					);
					$this->object_model->updateItem('usuario',$group,$where);
				}
				
				$this->loadImg($data,'update',$this->imgfield);
				redirect($this->controller);
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
			$data['lider'] = $this->integrante_model->getSelectLideres(
				$id,
				$data['records'][0]['idLider1'],
				$data['records'][0]['idLider2']
			);
		}
		$data['TipoGrupo'] = $this->object_model->getTipoValues('grupo','TipoGrupo');
		$data['Genero'] = $this->object_model->getTipoValues('grupo','Genero');
		$data['EstadoCivil'] = $this->object_model->getTipoValues('grupo','EstadoCivil');
		$data['morrisjs'] = '';
		if($debug) {
			$print = $data;
		} else {
			$print = '';
		}
		$data['print'] = $print;
	}

	public function selectGroup($idGrupo = null) {
		$group = $this->object_model->get('grupo','','idGrupo='.$idGrupo);
		$this->session->set_userdata('idGrupo',$idGrupo);
		if (count($group) !== 0) {
			$this->session->set_userdata('NombreGrupo',$group[0]['Nombre']);
		} else {
			$this->session->set_userdata('NombreGrupo',null);
		}

		$where = array(
			'Estado' 	=> 'Abierto',
			'idGrupo' 	=> $idGrupo
		);
		$eventos = $this->object_model->get('Evento','',$where);
		$this->session->set_userdata('AsistAbierta',count($eventos) !== 0);

		$this->load->model('novedad_model');
		$novedad = $this->novedad_model->getNews($idGrupo, $this->session->userdata('TipoUsuario'), $this->session->userdata('idUsuario'));
		$this->session->set_userdata('Novedades', $novedad);
		redirect($this->controller);
	}

	//construir la page completa y permite liberar funcion Index
	private function loadHTML(&$data) {
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
	}
	
}


?>