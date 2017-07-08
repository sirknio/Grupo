<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Evento extends CI_Controller {
	private $controller = 'Evento';
	private $pagelist = 'eventos';
	private $pagecard = 'evento';
	private $pkfield = 'idEvento';
	private $orderfield = 'FechaEvento';
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
		$this->load->model('evento_model');
	}
	
	public function index($id = '') {
		//echo"<pre>";echo $this->calendar->generate();echo"</pre>";
		$this->loadData($data,$this->debug,$id);
		$this->loadHTML($data);
		$this->load->view('pages/'.$this->pagelist,$data);
	}	
	
	public function createStats($idEvento) {
		
		
		$this->loadData($data,$this->debug);
		$this->loadHTML($data);
		$this->load->view('pages/'.$this->pagelist,$data);
	}	
	
	public function showAssistance($id) {
		$evento = $this->object_model->get($this->controller, $this->orderfield, array($this->pkfield => $id));
		$evento = $evento[0];

		$this->loadData($data,$this->debug,$id);
		$where = array (
			'idEvento' => $id,
			'Asiste' => '1'
		);
		$data['records'] = $this->object_model->get('asistencia','Apellido ASC',$where);
		$data['FechaEvento'] = $evento['FechaEvento'];
		$this->loadHTML($data);
		$this->load->view('pages/asistencias',$data);
	}
	
	public function closeEvent($id) {
		$evento = $this->object_model->get($this->controller, $this->orderfield, array($this->pkfield => $id));
		$evento = $evento[0];

		$update = array('Estado' => 'Cerrado');
		$where = array($this->pkfield => $id);
		$this->object_model->updateItem($this->controller,$update,$where);
		redirect('Evento');
	}
		
	public function openEvent($id) {
		$insert   = false;
		$eventos  = $this->object_model->get($this->controller, $this->orderfield, "Estado = 'Abierto'");
		if (count($eventos) == 0) {
			$evento   = $this->object_model->get($this->controller, $this->orderfield, $this->pkfield.'='.$id);
			$evento   = $evento[0];
			$personas = $this->integrante_model->get($evento['idGrupo']);
			foreach ($personas as $persona) {
				$asistencia = array(
					'idEvento' 		=> $evento['idEvento'],
					'idGrupo' 		=> $evento['idGrupo'],
					'FechaEvento' 	=> $evento['FechaEvento'],
					'idMicro' 		=> $persona['idMicrocelula'],
					'idPersona' 	=> $persona['idPersona'],
					'Nombre' 		=> $persona['Nombre'],
					'Apellido' 		=> $persona['Apellido'],
					'DocumentoNo' 	=> $persona['DocumentoNo']
				);
				switch($evento['Filtro']) {
					case "Todos": 	$insert = true; break;
					case "Hombres": $insert = ($persona['Genero'] == 'Masculino'); 	break;
					case "Mujeres": $insert = ($persona['Genero'] == 'Femenino'); 	break;
				}
				if ($insert) {
					$idEvento = $this->object_model->insertItem('asistencia',$asistencia);
				}
			}
			$update = array('Estado' => 'Abierto');
			$where = array($this->pkfield => $id);
			$this->object_model->updateItem($this->controller,$update,$where);
			redirect('Evento');
		} else {
			//Mostrar error dicendo que ya existen eventos
			//echo "<pre>";print_r($eventos);echo "Ya existen eventos [".count($eventos)."] abiertos</pre>";
			redirect('Evento');
		}
	}
	
	public function mostrar_calendario($year = '',$month = '') {
		date_default_timezone_set("America/Bogota");
		$prefs = array(
				'start_day'         => 'monday',
				'month_type'        => 'long',
				'day_type'          => 'short',
				'next_prev_url'     => 'Evento/mostrar_calendario',
				'show_next_prev'    => false,
				'show_next_prev'    => false,
				'show_other_days'   => false,
				'template'			=> array(
						'table_open'            => '<table class="table table-striped row-center bordered">',
						'heading_previous_cell' => '<th class="row-center"><a href="{previous_url}">&lt;&lt;</a></th>',
						'heading_title_cell'    => '<th colspan="{colspan}" class="row-center">{heading}</th>',
						'heading_next_cell'     => '<th class="row-center"><a href="{next_url}">&gt;&gt;</a></th>',
						'cal_cell_start'        => '<td class="day">',
						'cal_cell_start_today'  => '<td class="today">')
		);
		$this->load->library('calendar', $prefs);
		if ($year  == '') $year  = date('o');
		if ($month == '') $month = date('n');
		
		$cal_links = array(
			3  => 'evento/2006/06/03/"> test',
			7  => 'evento/2006/06/07/',
			13 => 'evento/2006/06/13/',
			26 => 'evento/2006/06/26/'
		);

		return($this->calendar->generate($year,$month,$cal_links));
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
			$data['insert'][$this->pkfield] = $this->object_model->insertItem($this->controller,$data['insert']);
			if($data['insert'][$this->pkfield] != 0) {
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

			$this->loadData($data,$this->debug,$id);
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		} else {
			$data['update'] = $_POST;
			$this->loadData($data,$this->debug,$id);
			$where = array($this->pkfield => $id);
			if ($this->object_model->updateItem($this->controller,$data['update'],$where)) {
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
		$img['allowed_types'] = 'gif|jpg|png';
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
			$data['records'] = $this->object_model->get($this->controller,$this->orderfield.' DESC');
		} else {
			$data['records'] = $this->object_model->get($this->controller,$this->orderfield,$this->pkfield.'='.$id);
		}
		$data['morrisjs'] = '';
		
		$data['calendario'] = '';
		//$data['calendario'] = $this->mostrar_calendario();
		$data['filtro'] = $this->evento_model->getFiltroValues();

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