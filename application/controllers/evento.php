<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Evento extends CI_Controller {
	private $controller = 'evento';
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
	
	public function index($idGrupo = '', $id = '') {
		//echo"<pre>";echo $this->calendar->generate();echo"</pre>";
		$this->loadData($data,$this->debug,$idGrupo,$id);
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
		//Obtiene los asistentes a un evento 
		$where = array (
			'idEvento' => $id,
			'Asiste' => '1'
		);
		$data['records'] = $this->object_model->get('asistencia','Nombre ASC',$where);
		
		//Obtener la información de la lista para poner nuevas columnas
		foreach ($data['records'] as &$persona) {
			$p = $this->object_model->get('persona','','idPersona ='.$persona['idPersona']);
			$persona = $p[0];
		}
		
		$data['FechaEvento'] = $evento['FechaEvento'];
		//$data['print'] = $data['records'];
		$this->loadHTML($data);
		$this->load->view('pages/asistencias',$data);
	}
	
	public function showNewAssistance($id) {
		$evento = $this->object_model->get($this->controller, $this->orderfield, array($this->pkfield => $id));
		$evento = $evento[0];

		$this->loadData($data,$this->debug,$id);
		$where = array (
			'idEvento' => $id,
			'Asiste' => '1'
		);
		$data['nuevos'] = $this->object_model->get('asistencia','Apellido ASC',$where);
		$data['records'] = array();

		//Obtener la información de la lista para poner nuevas columnas
		foreach ($data['nuevos'] as $clave => $persona) {
			$where = array (
				'idPersona' => $persona['idPersona'],
				'FechaIngreso' => $evento['FechaEvento']
			);
			$p = $this->object_model->get('persona','',$where);
			if (isset($p[0])) {
				$persona = $p[0];
				$data['records'][$clave] = $persona;
			} else {
				unset($persona);
			}			
		}
		
		$data['FechaEvento'] = $evento['FechaEvento'];
		//$data['print'] = $data['records'];
		$this->loadHTML($data);
		$this->load->view('pages/asistencias',$data);
	}
	
	public function closeEvent($id) {
		$evento = $this->object_model->get($this->controller, $this->orderfield, array($this->pkfield => $id));
		$evento = $evento[0];

		$update = array('Estado' => 'Cerrado');
		$where = array($this->pkfield => $id);
		$this->object_model->updateItem($this->controller,$update,$where);
		$this->session->set_userdata('AsistAbierta',false);
		redirect($this->controller."/index/".$evento['idGrupo']);
	}
		
	public function reopenEvent($id) {
		$evento = $this->object_model->get($this->controller, $this->orderfield, array($this->pkfield => $id));
		$evento = $evento[0];

		$where = array(
			'Estado' 	=> 'Abierto',
			'idGrupo' 	=> $evento['idGrupo']
		);
		$eventos  = $this->object_model->get($this->controller, $this->orderfield, $where);
		if (count($eventos) == 0) {
			$update = array('Estado' => 'Abierto');
			$where = array($this->pkfield => $id);
			$this->object_model->updateItem($this->controller,$update,$where);
			$this->session->set_userdata('AsistAbierta',true);
		}
		redirect($this->controller."/index/".$evento['idGrupo']);
	}
		
	public function openEvent($id) {
		$insert   = false;
		$evento   = $this->object_model->get($this->controller, $this->orderfield, $this->pkfield.'='.$id);
		$evento   = $evento[0];
		
		$where = array(
			'Estado' 	=> 'Abierto',
			'idGrupo' 	=> $evento['idGrupo']
		);
		$eventos  = $this->object_model->get($this->controller, $this->orderfield, $where);
		if (count($eventos) == 0) {
			$idInac = 0;
			$where = array(
				'idGrupo' 	=> $evento['idGrupo'],
				'TipoMicro'	=> 'Inactivos'
			);
			$inac = $this->object_model->get('microcelula','',$where);
			if (!empty($inac)) $idInac = $inac[0]['idMicrocelula'];

			$personas = $this->object_model->get('persona','',
				array('idGrupo' => $evento['idGrupo']));

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

				$insert = $insert && ($persona['idMicrocelula'] != $idInac);
				if ($insert) {
					$idEvento = $this->object_model->insertItem('asistencia',$asistencia);
				}
			}
			$update = array('Estado' => 'Abierto');
			$where = array($this->pkfield => $id);
			$this->object_model->updateItem($this->controller,$update,$where);
			$this->session->set_userdata('AsistAbierta',true);
			redirect($this->controller."/index/".$evento['idGrupo']);
		} else {
			//Mostrar error dicendo que ya existen eventos
			//echo "<pre>";print_r($eventos);echo "</pre><hr>Ya existen eventos [".count($eventos)."] abiertos";
			redirect($this->controller."/index/".$evento['idGrupo']);
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
	public function deleteItem($idGrupo = '',$id = '') {
		if($id !== '') {
			$this->loadData($data,$this->debug,$id);
			if ($this->imgfield != '') {
				$this->deleteImg($data);
			}
			$this->object_model->deleteItem($this->controller,array($this->pkfield => $id));
		}
		redirect($this->controller.'/index/'.$idGrupo);
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
				redirect($this->controller."/index/".$data['insert']['idGrupo']);
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
				redirect($this->controller."/index/".$data['update']['idGrupo']);
			} else {
				//Establecer mensaje de error en actualizar datos
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
	
	private function loadData(&$data,$debug = false,$idGrupo = '',$id = '') {
		$data['userdata'] = $_SESSION;
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$data['mobile'] = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
		$data['useragent'] =  $_SERVER['HTTP_USER_AGENT'];
		if ($id === '') {
			$data['records'] = $this->object_model->get($this->controller,$this->orderfield.' DESC');
		} else {
			$data['records'] = $this->object_model->get($this->controller,$this->orderfield,$this->pkfield.'='.$id);
		}
		$data['records'] = $this->evento_model->get($idGrupo,$id);
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