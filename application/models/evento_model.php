<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Evento_model extends CI_model{
	
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

	function getMainGraph($idGrupo, $limit = 0) {
		$querytxt = "SELECT * FROM asistevento";
		if ($idGrupo != '') { $querytxt = $querytxt." WHERE idGrupo = ".$idGrupo; };
		if ($limit != 0) 	{ $querytxt = $querytxt." LIMIT ".$limit; };
		$query = $this->db->query($querytxt);
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";		
		return $query->result_array();
	}
	

}
?>