<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Evento_model extends CI_model{
	
	function get($idGrupo = '',$id = '',$showQuery = false) {
		$querytxt = 
				"SELECT e.*
				FROM 	`evento` as e
				WHERE";
		if($idGrupo.$id == '') 	$querytxt = $querytxt." e.idGrupo IS NULL";
		if($idGrupo != '') 		$querytxt = $querytxt." e.idGrupo = $idGrupo";
		if($id != '')      		$querytxt = $querytxt." AND e.idEvento = $id";
		$querytxt = $querytxt." ORDER BY e.FechaEvento DESC";
		$query = $this->db->query($querytxt);
		if($showQuery) { echo"<pre>";print_r($this->db->last_query());echo"</pre>";	}
		return $query->result_array();
	}
	
	function getFiltroValues() {
		return $this->getFieldValues('Filtro');
	}

	function getFieldValues($field) {
		$query = $this->db->query(
				"SHOW COLUMNS FROM evento LIKE '".$field."'");
		$array = $query->result_array();
		$array = $array[0]['Type'];
		$off  = strpos($array,"('");
        $array = substr($array, $off+2, strlen($array)-$off-4);
		$array = explode("','",$array);
		//echo"<pre>";print_r($array);echo"</pre>";
		return $array;
	}

	function getMainGraph($idGrupo = 0, $limit = 0) {
		$querytxt = '';
		if ($idGrupo != '') { $querytxt = $querytxt." WHERE idGrupo = ".$idGrupo; };
		if ($limit != 0) 	{ $querytxt = $querytxt." LIMIT ".$limit; };
		$querytxt = "SELECT e.idGrupo 		AS idGrupo,
							e.idEvento 		AS idEvento,
							e.FechaEvento 	AS FechaEvento,
							e.Filtro 		AS Filtro,
							SUM(`a`.`Asiste`) AS Asistencia 
					FROM 	`evento` as e, 
							`asistencia` as a 
					WHERE 	((a.idEvento = e.idEvento) AND (e.Estado = 'Cerrado')) 
					AND		(e.idGrupo = $idGrupo)
					group by e.idEvento 
					order by e.FechaEvento desc ";
		if($limit != 0) {
			$querytxt = $querytxt . "LIMIT $limit";
		}
		$query = $this->db->query($querytxt);
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";		
		return $query->result_array();
	}
	

}
?>