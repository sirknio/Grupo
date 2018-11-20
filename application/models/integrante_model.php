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
		if($idGrupo != '') $querytxt = $querytxt." AND g.idGrupo = ".$idGrupo;
		if($idMicro === '') {
			if($idMicro === 0) {
				$querytxt = $querytxt." AND m.idMicrocelula = 0";
			} else {
				$querytxt = $querytxt." AND m.idMicrocelula != 3";
			}
		} else {
			$querytxt = $querytxt." AND m.idMicrocelula = ".$idMicro;
		}
		if($id != '')      $querytxt = $querytxt." AND p.idPersona = ".$id;
		$querytxt = $querytxt." ORDER BY p.Nombre";
		$query = $this->db->query($querytxt);
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";		
		return $query->result_array();
	}
	
	function getMicros($idGrupo) {
		if ($idGrupo != '') {
			$query = $this->db->query(
					"SELECT *
					FROM 	`microcelula` as m
					WHERE 	m.idGrupo = ".$idGrupo."
					ORDER BY m.Nombre");
			$array = $query->result_array();
		}
		return $array;
	}
	
	function getLideres() {
		$query = $this->db->query(
				"SELECT p.idPersona, p.Nombre, p.Apellido 
				FROM 	`persona` as p, 
						`usuario` as u 
				WHERE 	p.idPersona = u.idPersona 
					AND TipoUsuario = 'Lider' 
				ORDER BY p.Nombre");
		$array = $query->result_array();
		return $array;
	}
	
	function getColideres() {
		$query = $this->db->query(
				"SELECT p.idPersona, p.Nombre, p.Apellido 
				FROM 	`persona` as p, 
						`usuario` as u 
				WHERE 	p.idPersona = u.idPersona 
					AND TipoUsuario = 'Microlider' 
				ORDER BY p.Nombre");
		$array = $query->result_array();
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