<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Notificacion_model extends CI_Model{
    
   	//Establecer cuantas personas cumplieron x inasistencias para dar manejo
	//Funcionara desde la tercera toma de asistencia
	function getAbsence($idGrupo,$cant = 10) {
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
					HAVING COUNT(a.`idEvento`) = ".$cantMin.")";
		}
		return $this->get($querytxt);
	}

   	//Establecer cuantas personas cumplieron las tres asistencias para subirlas al reporte de la iglesia
	//Funcionara desde la tercera toma de asistencia
	function getNewMinAsist($idGrupo,$cantMin = 3) {
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
					HAVING COUNT(a.`idEvento`) = ".$cantMin.")";
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