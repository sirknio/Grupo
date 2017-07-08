<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Integrante extends CI_Controller {
	private $controller = 'Integrante';
	private $tablename = 'Persona';
	private $pagelist = 'integrantes';
	private $pagecard = 'integrante';
	private $pkfield = 'idPersona';
	private $orderfield = 'Nombre';
	private $imgfield = 'foto';
	private $imgpath = 'integrantes';
	private $debug = true;

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('integrante_model');
	}
	
	public function index($idGrupo = '',$idMicro = '',$id = '') {
		//echo"<pre>";print_r($idGrupo." - ".$idMicro." - ".$id);echo"</pre>";
		$this->loadData($data,$this->debug,$idGrupo,$idMicro,$id);
		$this->loadHTML($data);
		$this->load->view('pages/'.$this->pagelist,$data);
	}	
		
	//Eliminar registro
	public function deleteItem() {
		$data['delete'] = $_POST; 
		if($data['delete']['idPersona'] !== '') {
			$this->loadData($data,$this->debug,$data['delete']['idPersona']);
			if ($this->imgfield != '') {
				$this->deleteImg($data);
			}
			$this->object_model->deleteItem($this->tablename,$data['delete']);
		}
		/*/
		redirect($this->controller);
		$this->loadData($data,$this->debug);
		$this->loadHTML($data);
		$this->load->view('pages/'.$this->pagelist,$data);
		//*/
	}
	
	//Insertar registro
	public function insertItem($createId = '') {
		$data['update'] = false;
		$idEvento = 0;
		If($createId === '') {
			$this->loadData($data,$this->debug);
			$_POST = array_merge($_POST,array(
				'idGrupo' => $data['userdata']['idGrupo']
				));
			$eventos  = $this->object_model->get('evento', $this->orderfield, "Estado = 'Abierto'");
			if (count($eventos) != 0) {
				$_POST = array_merge($_POST,array(
					'idEvento' => $eventos[0]['idEvento'],
					'FechaIngreso' => $eventos[0]['FechaEvento']
					));
			} else {
				$_POST = array_merge($_POST,array(
					'FechaIngreso' => date('Y-m-d', time())
					));
			}
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		} else {
			$idEvento = $_POST['idEvento'];
			unset($_POST['idEvento']);
			$data['insert'] = $_POST;
			$data['insert'][$this->pkfield] = $this->object_model->insertItem($this->tablename,$data['insert']);
			if($data['insert'][$this->pkfield] != 0) {
				$this->loadData($data,$this->debug,'','',$data['insert'][$this->pkfield]);
				if ($this->imgfield != '') {
					$this->loadImg($data,'insert',$this->imgfield);
				}
				if ($idEvento != 0) {
					$asistencia = array(
						'idEvento' 		=> $idEvento,
						'idGrupo' 		=> $data['insert']['idGrupo'],
						'idMicro' 		=> $data['insert']['idMicrocelula'],
						'idPersona' 	=> $data['insert']['idPersona'],
						'Nombre' 		=> $data['insert']['Nombre'],
						'Apellido' 		=> $data['insert']['Apellido'],
						'DocumentoNo' 	=> $data['insert']['DocumentoNo'],
						'Asiste' 		=> '1'
					);
					$idEvento = $this->object_model->insertItem('asistencia',$asistencia);
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
			$data['info'] = $this->object_model->get($this->tablename,'',$where);
			$_POST = array_merge($_POST,$data['info'][0]);

			$this->loadData($data,$this->debug,$id);
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		} else {
			$idEvento = $_POST['idEvento'];
			unset($_POST['idEvento']);
			$data['update'] = $_POST;
			$this->loadData($data,$this->debug,'','',$id);
			$where = array($this->pkfield => $id);
			if ($this->object_model->updateItem($this->tablename,$data['update'],$where)) {
				$this->loadImg($data,'update',$this->imgfield);
				//echo "<pre>";echo "OK CARGUE DE IMAGEN";echo "</pre>";
				redirect($this->controller);
				//$this->loadData($data,$this->debug,$id);
				//$this->loadHTML($data);
				//$this->load->view('pages/'.$this->pagecard,$data);
			} else {
				//Establecer mensaje de error en actualizar datos
				$this->loadData($data,$this->debug,$data['update'][$this->pkfield]);
				$this->loadHTML($data);
				$this->load->view('pages/'.$this->pagecard,$data);
			}
		}
	}
	
	public function loadImg(&$data,$action,$fieldName) {
		//echo "<pre>";print_r($data);echo "</pre>";
		//echo "<pre>";print_r('foto'.str_pad($data['records']['0'][$this->pkfield],10,'0', STR_PAD_LEFT));echo "</pre>";
		//echo "<pre>";print_r($this);echo "</pre>";
		//echo "<pre>";print_r($_FILES['foto']);echo "</pre>";
		//echo "<pre>";print_r($data);echo "</pre>";
		if ($_FILES['foto']['name'] != '') {
			$img['upload_path']   = 'public/images/'.$this->imgpath.'/';
			$img['allowed_types'] = 'gif|jpg|png';
			$img['file_name'] = 'foto'.str_pad($data['records']['0'][$this->pkfield],10,'0', STR_PAD_LEFT);
			if ($data['records']['0']['foto_filename'] != '') {
				if (file_exists($img['upload_path'].$data['records']['0']['foto_filename'])) {
					unlink($img['upload_path'].$data['records']['0']['foto_filename']);
				}
			}
			$this->load->library('upload', $img);
			if ($this->upload->do_upload($fieldName)) {
				$data[$action]['file_info'] = $this->upload->data();
				$filedata = array(
						'foto_filename' => $data[$action]['file_info']['file_name'],
						'foto_filepath' => $data[$action]['file_info']['file_path']
					);
				$where = array($this->pkfield => $data['records']['0'][$this->pkfield]);
				$this->object_model->updateItem($this->tablename,$filedata,$where);
			} else {
				$data[$action]['fail'] = $img;
				//Establecer mensaje de error por la carga del archivo
			}		
		}
	}
		
	public function deleteImg(&$data) {
		if ($data['records']['0']['foto_filename'] != '') {
			if (file_exists('public/images/'.$this->imgpath.'/'.$data['records']['0']['foto_filename'])) {
				unlink('public/images/'.$this->imgpath.'/'.$data['records']['0']['foto_filename']);
			}
		}
	}
	
	private function loadData(&$data,$debug = false,$idGrupo = '',$idMicro = '',$id = '') {
		$data['userdata'] = $_SESSION;
		if (($idGrupo != '')||($idMicro != '')||($id != '')) {
			$data['records'] = $this->integrante_model->get($idGrupo,$idMicro,$id);
		} else {
			$data['records'] = $this->integrante_model->get();
		}
		$data['lider'] = $this->integrante_model->getLideres();
		$data['Micros'] = $this->integrante_model->getMicros($data['userdata']['idGrupo']);
		$data['DocumentoTipo'] = $this->integrante_model->getDocumentoTipoValues();
		$data['Genero'] = $this->integrante_model->getGeneroValues();
		$data['EstadoCivil'] = $this->integrante_model->getEstadoCivilValues();
		$data['Habilidades'] = $this->integrante_model->getHabilidadesValues();
		$data['Persona'] = $this->object_model->get('persona','Nombre');
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