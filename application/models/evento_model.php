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
		if ($idGrupo == '') { $idGrupo = 0; };
		if ($limit != 0) 	{ $querytxt = $querytxt." LIMIT ".$limit; };

		$querytxt = "SELECT `e`.`idGrupo` AS `idGrupo`,
							`e`.`idEvento` AS `idEvento`,
							`e`.`FechaEvento` AS `FechaEvento`,
							`e`.`Filtro` AS `Filtro`,
							sum(`a`.`Asiste`) AS `Asistencia` 
					FROM `evento` `e` JOIN `asistencia` `a` 
					WHERE 	((`a`.`idEvento` = `e`.`idEvento`) AND 
							(`e`.`Estado` = 'Cerrado')) AND
							`a`.idGrupo = ".$idGrupo. 
				  " GROUP BY `e`.`idEvento` 
					ORDER BY `e`.`FechaEvento` DESC ";
		
		if($limit != 0) { $querytxt = $querytxt . "LIMIT " . $limit; }
		$query = $this->db->query($querytxt);
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";		
		return $query->result_array();
	}
	

}
?>