<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Notificacion_model extends CI_Model{
    
   	//Establecer cuantas parejas cumplieron las tres asistencias para subirlas al reporte de la iglesia
	//Funcionara desde la tercera toma de asistencia
	function getNewMinAsist($idGrupo) {
		if ($idGrupo != '') {
			$querytxt = 
				"SELECT * 
				FROM Persona 
				WHERE
				`idPersona` IN (
					SELECT a.`idPersona`
					FROM `asistencia` a
					WHERE a.`idGrupo` = ".$idGrupo."
					GROUP BY a.`idPersona`
					HAVING COUNT(a.`idEvento`) = 5)";
		}
		return $this->get($querytxt);
	}

   	function get($querytxt) {
		$query = $this->db->query($querytxt);
		$array = $query->result_array();
		return $array;
	}

}
?>