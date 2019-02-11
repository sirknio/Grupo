<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Integrante_model extends CI_Model{
	
	function getHabilidadesValues() {
		return $this->getFieldValues('Habilidades');
	}

function getEstadoCivilValues() {
		return $this->getFieldValues('EstadoCivil');
	}

	function getDocumentoTipoValues() {
		return $this->getFieldValues('DocumentoTipo');
	}

	function getGeneroValues() {
		return $this->getFieldValues('Genero');
	}

	function getFieldValues($field) {
		$query = $this->db->query(
				"SHOW COLUMNS FROM persona LIKE '".$field."'");
		$array = $query->result_array();
		$array = $array[0]['Type'];
		$off  = strpos($array,"('");
        $array = substr($array, $off+2, strlen($array)-$off-4);
		$array = explode("','",$array);
		//echo"<pre>";print_r($array);echo"</pre>";
		return $array;
	}

	function get($idGrupo = '',$idMicro = '',$id = '') {
		$querytxt = 
				"SELECT p.*,g.Nombre as NombreGrupo,
						m.Nombre as NombreMicro
				FROM 	`persona` as p, 
						`microcelula` as m,
						`grupo` as g
				WHERE 	p.idGrupo = g.idGrupo
				AND 	p.idMicrocelula = m.idMicrocelula";
		if($idGrupo !== '') $querytxt .= " AND g.idGrupo = $idGrupo";
		if($idMicro !== '') {
			$querytxt .= " AND m.idMicrocelula = $idMicro";
		} else {
			// if($idMicro === 0) {
			// 	$querytxt = $querytxt." AND m.idMicrocelula = 0";
			// } else {
			// 	$querytxt = $querytxt." AND m.idMicrocelula != 3";
			// }
		}
		if($id != '') $querytxt = $querytxt." AND p.idPersona = ".$id;
		$querytxt = $querytxt." ORDER BY p.Nombre";
		$query = $this->db->query($querytxt);
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";
		return $query->result_array();
	}
	
	function getMicros($idGrupo) {
		$array = array();
		if ($idGrupo != '') {
			$query = $this->db->query(
					"SELECT *
					FROM 	`microcelula` as m
					WHERE 	m.idGrupo = ".$idGrupo."
					ORDER BY m.Nombre");
			$array = $query->result_array();
		}
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";
		return $array;
	}
	
	function getSelectLideres($idLider1 = '',$idLider2 = '') {
		$query = $this->db->query(
				"SELECT u.idUsuario, u.Nombre, u.Apellido 
				FROM 	`usuario` as u 
				WHERE 	((TipoUsuario = 'Lider' OR TipoUsuario = 'Admin')
				AND		idGrupo IS NULL)
				OR 		(idUsuario = $idLider1)
				OR		(idUsuario = $idLider2)
				ORDER BY u.Nombre");
		$array = $query->result_array();
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";
		return $array;
	}
	
	function getLideres() {
		$query = $this->db->query(
				"SELECT u.idUsuario, u.Nombre, u.Apellido 
				FROM 	`usuario` as u 
				WHERE 	TipoUsuario = 'Lider' 
				ORDER BY u.Nombre");
		$array = $query->result_array();
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";
		return $array;
	}
	
	function getColideres($idGrupo) {
		$query = $this->db->query(
				"SELECT u.idUsuario, u.Nombre, u.Apellido 
				FROM 	`usuario` as u 
				WHERE 	(u.TipoUsuario = 'Microlider' 
				OR		u.TipoUsuario = 'Lider'
				OR		u.TipoUsuario = 'Admin')
				AND		(u.idGrupo = $idGrupo)
				ORDER BY u.Nombre");
		$array = $query->result_array();
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";
		return $array;
	}
	
	function RecCount($table,$field = '') {
		if ($field === '') {
			return $this->db->count_all_results($table);
		} else {
			$campoCant = 'Cantidad';
			$query = $this->db->query(
					'SELECT COUNT(tabla.campo) as '.$campoCant.' '.
					'FROM ( '.
						'SELECT DISTINCT '.$field.' AS campo '.
						'FROM '.$table.') AS tabla');
			$array = $query->row_array();
			return $array[$campoCant];
		}
		
	}
}
?>