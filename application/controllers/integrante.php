<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Integrante extends CI_Controller {
	private $controller = 'integrante';
	private $tablename = 'persona';
	private $pagelist = 'integrantes';
	private $pagesquare = 'integrantes-square';
	private $pagecard = 'integrante';
	private $pagequickcard = 'integrante-quick';
	private $pkfield = 'idPersona';
	private $orderfield = 'Nombre';
	private $imgfield = 'foto';
	private $imgpath = 'integrantes';
	private $debug = false;

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('integrante_model');
		$this->load->model('novedad_model');
		$Updnovedad = $this->novedad_model->getNews($this->session->userdata('idGrupo'), 
			$this->session->userdata('TipoUsuario'), 
			$this->session->userdata('idUsuario'));
		$this->session->set_userdata('Novedades', $Updnovedad);
	}
	
	public function index($idGrupo = '',$idMicro = '',$id = '',$viewList = 'list') {
		//echo"<pre>";print_r($idGrupo." - ".$idMicro." - ".$id);echo"</pre>";
		//if ($idMicro == 0) { $idMicro = ''; }
		if ($id == 0) { $id = ''; }
		$this->loadData($data,$this->debug,$idGrupo,$idMicro);
		// echo"<pre>";print_r($data);echo"</pre>";
		switch ($viewList) {
			case 'list':
				$this->loadHTML($data,$this->pagelist);
				break;		
			case 'square':
				$person = array();
				$j = 0;
				for($i = 0;$i < count($data['records']);$i++) {
					//$pos = strpos(); //Mostrar solo el primer apellido
					if ($data['records'][$i]['Genero'] == 'Masculino') {
						$person[$j] = array(
							'idPersona'			=> $data['records'][$i]['idPersona'],
							'Nombre'			=> $data['records'][$i]['Nombre'],
							'Apellido'			=> $data['records'][$i]['Apellido'],
							'Genero'			=> $data['records'][$i]['Genero'],
							'foto_filename' 	=> $data['records'][$i]['foto_filename'],
							'idConyugue'		=> $data['records'][$i]['idConyugue'],
							'NombreConyugue'	=> '',
							'ApellidoConyugue'	=> ''
						);
						for($k = 0;$k < count($data['records']);$k++) {
							if ($person[$j]['idConyugue'] === $data['records'][$k]['idPersona']) {
								$person[$j]['NombreConyugue'] 	=  $data['records'][$k]['Nombre'];
								$person[$j]['ApellidoConyugue'] =  $data['records'][$k]['Apellido'];
							}
						}
						$j++;
					}
				}
				$data['records'] = $person;
				$this->loadHTML($data,$this->pagesquare);
				break;		
		}
	}	
		
	//Eliminar registro
	public function deleteItem($idGrupo = '') {
		$data['delete'] = $_POST; 
		// echo "<hr><pre>";print_r($data['delete']);echo "</pre><hr>";
		if($data['delete']['idPersona'] !== '') {
			$this->loadData($data,$this->debug,'','',$data['delete']['idPersona']);
			if ($this->imgfield != '') {
				$this->deleteImg($data);
			}
			$this->object_model->deleteItem($this->tablename,$data['delete']);
		}
		redirect($this->controller."/index/".$idGrupo);
	}
	
	//Inactivar registro
	public function archiveItem($idGrupo = '') {
		$data['archive'] = $_POST; 
		// echo "<hr><pre>";print_r($data['archive']);echo "</pre><hr>";

		if(!empty($data['archive']['idPersona'])) {
			$where = array(
				'idGrupo' 	=> $idGrupo,
				'TipoMicro'	=> 'Inactivos'
			);
			$inactivos = $this->object_model->get('microcelula','',$where);
			$inactivos = $inactivos[0];
			// echo "<hr><pre>";print_r($inactivos);echo "</pre><hr>";

			if (!empty($inactivos)) {
				$leido = array('idMicrocelula' => $inactivos['idMicrocelula']);
				$where = array('idPersona' => $data['archive']['idPersona']);
				$this->object_model->updateItem('persona',$leido,$where);

				date_default_timezone_set("America/Bogota");
				$dateNow = new DateTime("now");
				$this->loadDataNews($data,$this->debug,'','',$data['archive']['idPersona']);
				// echo "<hr><pre>";print_r($data);echo "</pre><hr>";

				$data['insert'] = array();
				$data['insert'] = array_merge($data['insert'],array(
					'idPersona' => $data['archive']['idPersona']
					));
			
				$data['insert'] = array_merge($data['insert'],array(
					'idGrupo' => $data['userdata']['idGrupo']
					));
			
				$data['insert'] = array_merge($data['insert'],array(
					'Novedad' => 'Cambio a Inactivo: '.$data['archive']['razonCambio']
					));
			
				$data['insert'] = array_merge($data['insert'],array(
					'ReportaUsuario' => $data['userdata']['idUsuario']
					));
			
				$data['insert'] = array_merge($data['insert'],array(
					'ReportaFecha' => $dateNow->format('Y-m-d H:i:s')
					));
			
				if ($data['lider']) {
					$data['insert'] = array_merge($data['insert'],array(
						'LeidoLider' => 1
						));
				}
	
				if ($data['colider']) {
					$data['insert'] = array_merge($data['insert'],array(
						'LeidoMicro' => 1
						));
				}
	
				$data['insert']['idNovedad'] = $this->object_model->insertItem('novedad',$data['insert']);
				// echo "<hr><pre>";print_r($data['insert']);echo "</pre><hr>";
			}

		}
		redirect($this->controller."/index/".$idGrupo);
	}
	
	//Insertar registro
	public function insertQuickItem($createId = '') {
		$this->insertItem($createId,TRUE);
	}

	//Insertar registro
	public function insertItem($createId = '',$quick = false) {
		$data['update'] = false;
		$idEvento = 0;
		If($createId === '') {

			$_POST = array_merge($_POST,array(
				'Habilidades' => array(
					0 => ''
				)
			));

			$_POST = array_merge($_POST,array(
				'ProcesoFormacion' => array(
					0 => ''
				)
			));

			$this->loadData($data,$this->debug);
			$where = array (
				'idGrupo' => $data['userdata']['idGrupo'],
				'TipoMicro' => 'Nuevos'
			);
			$microNuevos = $this->object_model->get('microcelula', '', $where);
			
			$where = array(
				'Estado' 	=> 'Abierto',
				'idGrupo' 	=> $data['userdata']['idGrupo']
			);
			$eventos  = $this->object_model->get('evento', $this->orderfield, $where);
			
			if (count($eventos) != 0) {
				$_POST = array_merge($_POST,array(
					'idGrupo' 		=> $data['userdata']['idGrupo'],
					'idMicrocelula' => $microNuevos[0]['idMicrocelula'],
					'idEvento' 		=> $eventos[0]['idEvento'],
					'FechaIngreso' 	=> $eventos[0]['FechaEvento']
					));
			} else {
				$_POST = array_merge($_POST,array(
					'idGrupo' => $data['userdata']['idGrupo'],
					'idMicrocelula' => $microNuevos[0]['idMicrocelula'],
					'FechaIngreso' => date('Y-m-d', time())
					));
			}
			// echo "<hr><pre>";print_r($_POST);echo "</pre><hr>";
			if ($quick) {
				$this->loadHTML($data,$this->pagequickcard);
			} else {
				$this->loadHTML($data,$this->pagecard);
			}
		} else {
			// echo "<hr><pre>";print_r($_POST);echo "</pre><hr>";
			if (isset($_POST['Habilidades'])) {
				$_POST['Habilidades'] = implode(",", $_POST['Habilidades']);
			}
			
			if (isset($_POST['ProcesoFormacion'])) {
				$_POST['ProcesoFormacion'] = implode(",", $_POST['ProcesoFormacion']);
			}
			
			$idEvento = $_POST['idEvento'];
			unset($_POST['idEvento']);
			
			$data['insert'] = $_POST;
			$where = array (
				'DocumentoNo'	=> $data['insert']['DocumentoNo']
			);
			$data['other'] = $this->object_model->get($this->tablename,'',$where);
			
			switch(true) {
				case (!empty($data['other'])):
					$this->loadData($data,$this->debug);
				
					if (isset($_POST['Habilidades'])) {
						$_POST['Habilidades'] = explode(",",$_POST['Habilidades']);
					} else {
						$_POST = array_merge($_POST,array(
							'Habilidades' => array(
								0 => ''
							)
						));			
					}
						
					if (isset($_POST['ProcesoFormacion'])) {
						$_POST['ProcesoFormacion'] = explode(",",$_POST['ProcesoFormacion']);
					} else {
						$_POST = array_merge($_POST,array(
							'ProcesoFormacion' => array(
								0 => ''
							)
						));
					}

					if ($quick) {
						$this->loadHTML($data,$this->pagequickcard,'DOC_EXIST');
					} else {
						$this->loadHTML($data,$this->pagecard,'DOC_EXIST');
					}
					break;
				default:	
					$data['insert'][$this->pkfield] = $this->object_model->insertItem($this->tablename,$data['insert']);
					if($data['insert'][$this->pkfield] != 0) {
						$this->loadData($data,$this->debug,'','',$data['insert'][$this->pkfield]);
						if ($idEvento != 0) {
							$asistencia = array(
								'idEvento' 		=> $idEvento,
								'idGrupo' 		=> $data['insert']['idGrupo'],
								'idMicro' 		=> $data['insert']['idMicrocelula'],
								'idPersona' 	=> $data['insert']['idPersona'],
								'Nombre' 		=> $data['insert']['Nombre'],
								'Apellido' 		=> $data['insert']['Apellido'],
								'DocumentoNo' 	=> $data['insert']['DocumentoNo'],
								'FechaEvento' 	=> $data['insert']['FechaIngreso'],
								'Asiste' 		=> '1'
							);
							$idEvento = $this->object_model->insertItem('asistencia',$asistencia);
						}
						if ($quick) {
							redirect('asistencia/index/'.$data['insert']['idGrupo']);
						} else {
							redirect($this->controller.'/index/'.$data['insert']['idGrupo']);
						}
					} else {
						//Establecer mensaje de error en insercción de datos
						$this->loadData($data,$this->debug,'','',$data['insert'][$this->pkfield]);
						if ($quick) {
							$this->loadHTML($data,$this->pagequickcard);
						} else {
							$this->loadHTML($data,$this->pagecard);
						}
					}
					break;
			}
		}
	}

	//Crear Novedad sobre integrante
	public function createNewsItem($id = '',$action = '') {
		date_default_timezone_set("America/Bogota");
		$dateNow = new DateTime("now");
		$this->loadDataNews($data,$this->debug,'','',$id);

		// echo "<hr><pre>";print_r($data);echo "</pre><hr>";

		if ($action !== '') {
			if ($data['lider']) {
				$_POST = array_merge($_POST,array(
					'LeidoLider' => 1
					));
			}

			if ($data['colider']) {
				$_POST = array_merge($_POST,array(
					'LeidoMicro' => 1
					));
			}

			$_POST = array_merge($_POST,array(
				'idGrupo' => $data['userdata']['idGrupo']
				));
		
			$_POST = array_merge($_POST,array(
				'ReportaUsuario' => $data['userdata']['idUsuario']
				));
		
			$_POST = array_merge($_POST,array(
				'ReportaFecha' => $dateNow->format('Y-m-d H:i:s')
				));
		
			if (isset($_POST['ImportanteUrgente'])) {
				if ($_POST['ImportanteUrgente'] === 'on') {
					$_POST['ImportanteUrgente'] = 1;
				}
			}

			$data['insert'] = $_POST;
			$data['insert'][$this->pkfield] = $this->object_model->insertItem('novedad',$data['insert']);
			if($data['insert'][$this->pkfield] != 0) { 
				$where = array($this->pkfield => $id);
				$data['news'] = $this->object_model->get('novedad','',$where);
				// echo "<hr><pre>";print_r($_POST);echo "</pre><hr>";
			}
		} else {
			if (isset($data['news'][0])) {
				$where = array('idGrupo' => $data['news'][0]['idGrupo']);
				$grupo = $this->object_model->get('grupo','',$where);
				// echo "<hr><pre>";print_r($grupo);echo "</pre><hr>";
	
				$where = array('idPersona' => $data['news'][0]['idPersona']);
				$persona = $this->object_model->get('persona','',$where);
				// echo "<hr><pre>";print_r($persona);echo "</pre><hr>";
	
				$where = array('idMicrocelula' => $persona[0]['idMicrocelula']);
				$micro = $this->object_model->get('microcelula','',$where);
				// echo "<hr><pre>";print_r($data['userdata']);echo "</pre><hr>";

				$idUser = $data['userdata']['idUsuario'];

				$lider = ((($grupo[0]['idLider1'] == $idUser) || ($grupo[0]['idLider2'] == $idUser)) 
					&& (($data['userdata']['TipoUsuario'] == 'Lider') || ($data['userdata']['TipoUsuario'] == 'Admin')));
				$colider = ((($micro[0]['idColider1'] == $idUser) || ($micro[0]['idColider2'] == $idUser)) 
					&& ($data['userdata']['TipoUsuario'] == 'Microlider'));

				// echo "<hr><pre>";print_r($lider);echo "</pre><hr>";

				if ($lider || $colider) {
					// echo "<hr><pre>";print_r($data['news']);echo "</pre><hr>";
					foreach ($data['news'] as $novedad) {
						if ($lider && empty($novedad['LeidoLider'])) {
							// echo "<hr><pre>";print_r($novedad);echo "</pre><hr>";
							$leido = array('LeidoLider' => 1);
							$where = array('idNovedad' => $novedad['idNovedad']);
							$this->object_model->updateItem('novedad',$leido,$where);
						}
						
						if ($colider && empty($novedad['LeidoMicro'])) {
							// echo "<hr><pre>";print_r($novedad);echo "</pre><hr>";
							$leido = array('LeidoMicro' => 1);
							$where = array('idNovedad' => $novedad['idNovedad']);
							$this->object_model->updateItem('novedad',$leido,$where);
						}

					}
				}
	
			}
		}

		$Updnovedad = $this->novedad_model->getNews($this->session->userdata('idGrupo'), 
			$this->session->userdata('TipoUsuario'), 
			$this->session->userdata('idUsuario'));
		$this->session->set_userdata('Novedades', $Updnovedad);
		$data['userdata']['Novedades'] = $Updnovedad;

		$data['news'] = array_reverse($data['news']);
		// echo "<hr><pre>";print_r($data['news']);echo "</pre><hr>";

		foreach ($data['news'] as &$novedad) {
			//agregar otros datos desde otra tabla
			$where = array('idUsuario' => $novedad['ReportaUsuario']);
			$novedad['NombreUsuario'] = $this->object_model->get('usuario','',$where);
			
			// echo "<hr><pre>";print_r($novedad['NombreUsuario']);echo "</pre><hr>";
			
			$novedad['NombreUsuario'] = $novedad['NombreUsuario'][0]['Nombre'].' '.
				$novedad['NombreUsuario'][0]['Apellido'];
			
			//$n = $this->object_model->get('usuario','',"Usuario = '".$novedad['ReportaUsuario']."'");
			//$novedad['UsuarioNombre'] = $n[0]['Nombre'];
			//$novedad['usuarioApellido'] = $n[0]['Apellido'];
			
			$datetime2 = date_create($novedad['ReportaFecha']);
			$interval = date_diff($dateNow, $datetime2);
			$novedad['diff'] = $interval;
			$novedad['dateNow'] = $dateNow;

			switch (true) {
				case ($interval->y !== 0):
					$novedad['diffText'] = $interval->y.' año(s) atras';
					break;

				case ($interval->m !== 0):
					$novedad['diffText'] = $interval->m.' mes(es) atras';
					break;

				case ($interval->d !== 0):
					$novedad['diffText'] = $interval->d.' dia(s) atras';
					break;

				case ($interval->h !== 0):
					$novedad['diffText'] = $interval->h.' hora(s) atras';
					break;

				case ($interval->i !== 0):
					$novedad['diffText'] = 'hace unos minutos';
					break;

				case (($interval->s !== 0) || ($interval->f !== 0)):
					$novedad['diffText'] = 'hace unos instantes';
					break;
			}

		}	

		$this->loadHTML($data,'novedad');
	}

	//Borrar hijo de la ficha de Integrante
	public function deleteChild($idPadre,$idHijo) {
		$data['idHijo'] = $idHijo;
		$this->object_model->deleteItem('hijos',$data);
		redirect($this->controller."/updateItem/".$idPadre);
	}

	//Actualizar registro
	public function updateItem($id = '',$action = false) {
		$data['update'] = true;
		if (!$action) {
			$this->loadData($data,$this->debug,'','',$id);
			$_POST = array_merge($_POST,$data['records'][0]);
			
			if (isset($_POST['Habilidades'])) {
				$_POST['Habilidades'] = explode(",",$_POST['Habilidades']);
			}

			if (isset($_POST['ProcesoFormacion'])) {
				$_POST['ProcesoFormacion'] = explode(",",$_POST['ProcesoFormacion']);
			}
			// echo "<hr><pre>";print_r($_POST);echo "</pre><hr>";
			// echo "<hr><pre>";print_r($data);echo "</pre><hr>";
			$this->loadHTML($data,$this->pagecard);
		} else {
			if (isset($_POST['Habilidades'])) {
				$_POST['Habilidades'] = implode(",", $_POST['Habilidades']);
			} else {
				$_POST['Habilidades'] = '';
			}
			
			if (isset($_POST['ProcesoFormacion'])) {
				$_POST['ProcesoFormacion'] = implode(",", $_POST['ProcesoFormacion']);
			} else {
				$_POST['ProcesoFormacion'] = '';
			}
			
			switch(true) {
				case (!empty($_POST['HijoNombre']) || !empty($_POST['HijoNacimiento']) || !empty($_POST['HijoGenero'])):
					if (isset($_POST['Habilidades'])) {
						$_POST['Habilidades'] = explode(",",$_POST['Habilidades']);
					}
						
					if (isset($_POST['ProcesoFormacion'])) {
						$_POST['ProcesoFormacion'] = explode(",",$_POST['ProcesoFormacion']);
					}

					$hijo = array();
					if ($_POST['Genero'] == 'Masculino') {
						$hijo['idPersPadre'] = $_POST['idPersona'];
						if (!empty($_POST['idConyugue'])) $hijo['idPersMadre'] = $_POST['idConyugue'];
					} else {
						$hijo['idPersMadre'] = $_POST['idPersona'];
						if (!empty($_POST['idConyugue'])) $hijo['idPersPadre'] = $_POST['idConyugue'];
					}
					$hijo['Nombre'] 			= $_POST['HijoNombre'];
					$hijo['FechaNacimiento'] 	= $_POST['HijoNacimiento'];
					$hijo['Genero'] 			= $_POST['HijoGenero'];

					$other = $this->object_model->get('hijos','',$hijo);
					
					switch (true) {
						case (empty($_POST['HijoNombre']) || empty($_POST['HijoNacimiento']) || empty($_POST['HijoGenero'])):
							//Establecer mensaje de error en actualizar datos
							$this->loadData($data,$this->debug,'','',$id);
							// echo "<hr><pre>";print_r($data['hijos']);echo "</pre><hr>";
							$this->loadHTML($data,$this->pagecard,'DATA_HIJO');
							break;
						case (!empty($other)):
							//Establecer mensaje de error en actualizar datos
							$this->loadData($data,$this->debug,'','',$id);
							$this->loadHTML($data,$this->pagecard,'DUPL_HIJO');
							break;
						case (empty($hijo['idPersMadre'])):
							//Establecer mensaje de error en actualizar datos
							$this->loadData($data,$this->debug,'','',$id);
							$this->loadHTML($data,$this->pagecard,'DATA_MADRE');
							break;
						case (empty($hijo['idPersMadre'])):
							//Establecer mensaje de error en actualizar datos
							$this->loadData($data,$this->debug,'','',$id);
							$this->loadHTML($data,$this->pagecard,'DATA_PADRE');
							break;
						default;
							unset($_POST['HijoNombre']);
							unset($_POST['HijoNacimiento']);
							unset($_POST['HijoGenero']);

							// echo "<hr><pre>";print_r($hijo);echo "</pre><hr>";
							// echo "<hr><pre>";print_r($_POST);echo "</pre><hr>";

							$idHijo = $this->object_model->insertItem('hijos',$hijo);
			
							//Establecer mensaje de error en actualizar datos
							$this->loadData($data,$this->debug,'','',$id);
							// echo "<hr><pre>";print_r($data['hijos']);echo "</pre><hr>";
							$this->loadHTML($data,$this->pagecard);
							break;
					}
					break;
				default:
					$idEvento = $_POST['idEvento'];
					unset($_POST['idEvento']);

					unset($_POST['HijoNombre']);
					unset($_POST['HijoNacimiento']);
					unset($_POST['HijoGenero']);

					$data['update'] = $_POST;

					$this->loadData($data,$this->debug,'','',$id);
					$where = array($this->pkfield => $id);
					if ($this->object_model->updateItem($this->tablename,$data['update'],$where)) {
						//Actualizar el conyugue con la información
						$dataspouse = [];
						$dataspouse = ['idConyugue' => $id];
						if ($data['update']['FechaMatrimonio'] != "0000-00-00")
							$dataspouse += ['FechaMatrimonio' => $data['update']['FechaMatrimonio']];
						if ($data['update']['idMicrocelula'] != "")
							$dataspouse += ['idMicrocelula' => $data['update']['idMicrocelula']];
						if ($data['update']['EstadoCivil'] != "")
							$dataspouse += ['EstadoCivil' => $data['update']['EstadoCivil']];
						if (isset($data['update']['foto_filepath']))
						if ($data['update']['foto_filepath'] != "")
							$dataspouse += ['foto_filepath' => $data['update']['foto_filepath']];
						if (isset($data['update']['foto_filename']))
						if ($data['update']['foto_filename'] != "")
							$dataspouse += ['foto_filename' => $data['update']['foto_filename']];
						$where = array($this->pkfield => $data['update']['idConyugue']);
						$this->object_model->updateItem($this->tablename,$dataspouse,$where);
						
						$this->loadImg($data,'update',$this->imgfield);
						redirect($this->controller."/index/".$data['update']['idGrupo']);
					} else {
						if (isset($_POST['Habilidades'])) {
							$_POST['Habilidades'] = explode(",",$_POST['Habilidades']);
						}
							
						if (isset($_POST['ProcesoFormacion'])) {
							$_POST['ProcesoFormacion'] = explode(",",$_POST['ProcesoFormacion']);
						}
						
						//Establecer mensaje de error en actualizar datos
						$this->loadData($data,$this->debug,'','',$id);
						$this->loadHTML($data,$this->pagecard,'DOC_EXIST');
					}
					break;
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
			$img['allowed_types'] = 'gif|jpg|jpeg|png';
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
		//echo "<pre>";print_r($data);echo "</pre>";
		if ($data['records']['0']['foto_filename'] != '') {
			if (file_exists('public/images/'.$this->imgpath.'/'.$data['records']['0']['foto_filename'])) {
				unlink('public/images/'.$this->imgpath.'/'.$data['records']['0']['foto_filename']);
			}
		}
	}
	
	private function loadData(&$data,$debug = false,$idGrupo = '',$idMicro = '',$id = '') {
		$data['userdata'] = $_SESSION;
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$data['mobile'] = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
		$data['useragent'] =  $_SERVER['HTTP_USER_AGENT'];
		$data['Genero'] = $this->integrante_model->getGeneroValues();
		if (($idGrupo != '')||($idMicro != '')||($id != '')) {
			if (empty($idMicro)) $idMicro = $data['userdata']['idMicro'];
			$data['records'] = $this->integrante_model->get($idGrupo,$idMicro,$id);
			if (!empty($id)) {
				$idGenero = ($data['records'][0]['Genero'] == $data['Genero'][0]);
				$where = "
					idGrupo 		= ".$data['userdata']['idGrupo']." AND
					((idConyugue 	= '0') OR 
					(idPersona	= '".$data['records'][0]['idConyugue']."')) AND
					Genero		= '".$data['Genero'][$idGenero]."'";
				$data['Persona'] = $this->object_model->get('persona','Nombre',$where);
				$where = "
					`idPersPadre`	= $id OR
					`idPersMadre`	= $id
				";
				$data['hijos'] = $this->object_model->get('hijos','Nombre',$where);
			}
		} else {
			$where = array(
				'idGrupo' => $data['userdata']['idGrupo'],
				'idConyugue' => '0'
			);
			$data['Persona'] = $this->object_model->get('persona','Nombre',$where);
			// echo "<hr><pre>";print_r($data['Persona']);echo "</pre><hr>";
		}
		$data['Micros'] = $this->integrante_model->getMicros($data['userdata']['idGrupo']);
		$data['DocumentoTipo'] = $this->integrante_model->getDocumentoTipoValues();
		$data['EstadoCivil'] = $this->integrante_model->getEstadoCivilValues();
		$data['Habilidades'] = $this->integrante_model->getHabilidadesValues();
		$data['ProcesoFormacion'] = $this->integrante_model->getProcesosValues();
		$where = array(
			'idGrupo' 	=> $idGrupo,
			'TipoMicro'	=> 'Inactivos'
		);
		$data['inactivos'] = $this->object_model->get('microcelula','',$where);
		if (!empty($data['inactivos'])) $data['inactivos'] = $data['inactivos'][0];
		$data['morrisjs'] = '';
		if($debug) {
			$print = $data;
		} else {
			$print = '';
		}
		$data['print'] = $print;
	}

	private function loadDataNews(&$data,$debug = false,$idGrupo = '',$idMicro = '',$id = '') {
		$data['userdata'] = $_SESSION;
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$data['mobile'] = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
		$data['useragent'] =  $_SERVER['HTTP_USER_AGENT'];
		if (($idGrupo != '')||($idMicro != '')||($id != '')) {
			$data['records'] = $this->integrante_model->get($idGrupo,$idMicro,$id);
		} else {
			$data['records'] = $this->integrante_model->get();
		}

		$where = array('idGrupo' => $data['userdata']['idGrupo']);
		$grupo = $this->object_model->get('grupo','',$where);
		// echo "<hr><pre>";print_r($grupo);echo "</pre><hr>";
		
		$where = array('idPersona' => $data['records'][0]['idPersona']);
		$persona = $this->object_model->get('persona','',$where);
		// echo "<hr><pre>";print_r($persona);echo "</pre><hr>";

		$where = array('idMicrocelula' => $persona[0]['idMicrocelula']);
		$micro = $this->object_model->get('microcelula','',$where);
		// echo "<hr><pre>";print_r($micro);echo "</pre><hr>";

		$idUser = $data['userdata']['idUsuario'];

		$data['lider'] = 
			((($grupo[0]['idLider1'] == $idUser) || ($grupo[0]['idLider2'] == $idUser))
			&& (($data['userdata']['TipoUsuario'] == 'Lider') || ($data['userdata']['TipoUsuario'] == 'Admin')));
		$data['colider'] = 
			((($micro[0]['idColider1'] == $idUser) || ($micro[0]['idColider2'] == $idUser))
			&& ($data['userdata']['TipoUsuario'] == 'Microlider'));

		// echo "<hr><pre>";print_r($data['userdata']);echo "</pre><hr>";

		$data['morrisjs'] = '';
		$where = array($this->pkfield => $id);
		$data['news'] = $this->object_model->get('novedad','',$where);

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
			case 'DOC_EXIST':
				$data['tipoError'] = 'e';
				$data['txtError'] = 'El documento identidad ya se encuentra registrado en el sistema.';
				break;
			case 'DATA_HIJO':
				$data['tipoError'] = 'e';
				$data['txtError'] = 'Debe diligenciar los datos completos del hijo que desea registrar.';
				break;
			case 'DUPL_HIJO':
				$data['tipoError'] = 'e';
				$data['txtError'] = 'Los datos que desea insertar ya se encuentran registrados.';
				break;
			case 'DATA_MADRE':
				$data['tipoError'] = 'e';
				$data['txtError'] = 'El integrante no registra aún esposa, y no se puede relacionar la madre al hijo que desea ingresar.';
				break;
			case 'DATA_PADRE':
				$data['tipoError'] = 'e';
				$data['txtError'] = 'El integrante no registra aún esposo, y no se puede relacionar el padre al hijo que desea ingresar.';
				break;
			default:
				if (empty($data['tipoError']))	unset($data['tipoError']);
				if (empty($data['txtError']))	unset($data['txtError']);
				break;
		}
	}

	//construir la page completa y permite liberar funcion Index
	private function loadHTML(&$data,$page,$error = '') {
		$this->loadError($data,$error);
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
		$this->load->view('pages/'.$page,$data);
		$this->loadError($data);
	}
	
}


?>