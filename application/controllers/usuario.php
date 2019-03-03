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
		$this->loadHTML($data,$this->pagelist);
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
			$this->loadHTML($data,$this->pagecard);
		} else {
			$data['insert'] = $_POST;

			$where = array (
				'Usuario'	=> $data['insert']['Usuario']
			);
			$data['other'] = $this->object_model->get($this->controller,'',$where);
			switch(true) {
				case (!empty($data['other'])):
					$this->loadData($data,$this->debug,'');
					$this->loadHTML($data,$this->pagecard,'USER_EXIST');
					break;
				case $data['insert']['Password'] !== $data['insert']['Password2']:
					//Establecer mensaje de error en contraseñas
					$this->loadData($data,$this->debug,'');
					$this->loadHTML($data,$this->pagecard,'PASS_NOEQUAL');
					break;
				default:
					unset($data['insert']['Password2']);
					if ($data['insert']['Password'] == '') {
						unset($data['insert']['Password']);
					} else {
						$data['insert']['Password'] = md5(sha1($data['insert']['Password']));
					}
					if ($data['insert']['idGrupo'] == '') {
						unset($data['insert']['idGrupo']);
					}
					
					$data['insert'][$this->pkfield] = 
						$this->object_model->insertItem($this->controller,$data['insert']);
					if($data['insert'][$this->pkfield] != 0) {
						$this->loadData($data,$this->debug,$data['insert'][$this->pkfield]);
						redirect($this->controller);
					} else {
						//Establecer mensaje de error en insercción de datos
						$this->loadData($data,$this->debug,'');
						$this->loadHTML($data,$this->pagecard);
					}
					break;
			}
		}
	}

	//Actualizar registro
	public function updateItem($id = '',$action = false) {
		$data['update'] = true;
		if (!$action) {
			$where = array($this->pkfield => $id);
			// echo "<hr><pre>";print_r($id);echo "</pre><hr>";
			$data['info'] = $this->object_model->get($this->controller,'',$where);
			// echo "<hr><pre>";print_r($data['info']);echo "</pre><hr>";
			$_POST = array_merge($_POST,$data['info'][0]);

			$this->loadData($data,$this->debug,$id);
			$this->loadHTML($data,$this->pagecard);
		} else {
			$data['update'] = $_POST;
			if ($data['update']['Password'] == $data['update']['Password2']) {
				unset($data['update']['Password2']);
				if ($data['update']['Password'] == '') {
					unset($data['update']['Password']);
				} else {
					$data['update']['Password'] = md5(sha1($data['update']['Password']));
				}

				if ($data['update']['idGrupo'] == '') {
					unset($data['update']['idGrupo']);
				}
				
				$this->loadData($data,$this->debug,$id);
				$where = array($this->pkfield => $id);
				if ($this->object_model->updateItem($this->controller,$data['update'],$where)) {
					redirect($this->controller);
				} else {
					//Establecer data nuevamente luego de error
					$where = array($this->pkfield => $id);
					$data['info'] = $this->object_model->get($this->controller,'',$where);
					$_POST = array_merge($_POST,$data['info'][0]);
					
					//Establecer mensaje de error en actualizar datos
					$this->loadData($data,$this->debug,$id);
					$this->loadHTML($data,$this->pagecard);
				}
			} else {
					//Establecer data nuevamente luego de error
					$where = array($this->pkfield => $id);
					$data['info'] = $this->object_model->get($this->controller,'',$where);
					$_POST = array_merge($_POST,$data['info'][0]);
					
					// echo "<hr><pre>";print_r($data['txtError']);echo "</pre><hr>";
					$this->loadData($data,$this->debug,$id);
					$this->loadHTML($data,$this->pagecard,'PASS_NOEQUAL');
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
		$data['Personas'] = $this->object_model->get('persona','Nombre');
		$data['TipoUsuario'] = $this->object_model->getTipoValues('usuario','TipoUsuario');
		$data['morrisjs'] = '';
		if($debug) {
			$print = $data;
		} else {
			$print = '';
		}
		$data['print'] = $print;
	}

	//Construccion de errores
	private function loadError(&$data,$code = '') {
		switch($code) {
			case 'USER_EXIST':
				$data['tipoError'] = 'e';
				$data['txtError'] = 
					'El Usuario seleccionado ya existe. Por favor seleccione otro usuario
					 y vuelva a intentarlo.';
				break;
			case 'PASS_NOEQUAL':
				$data['tipoError'] = 'e';
				$data['txtError'] = 'La contraseña no coincide con la confirmaci&oacute;n.';
				break;
			default:
				if (empty($data['tipoError']))	unset($data['tipoError']);
				if (empty($data['txtError']))	unset($data['txtError']);
				break;
		}
	}

	//construir la page completa y permite liberar funcion Index
	private function loadHTML(&$data,$page,$error = '') {
		// echo "<hr><pre>";print_r($error);echo "</pre><hr>";
		$this->loadError($data,$error);
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
		$this->load->view('pages/'.$page,$data);
		$this->loadError($data);
	}
	
}


?>