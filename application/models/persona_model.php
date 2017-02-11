<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Persona_model extends CI_model{
	
	function getUser($idUsuario = ''){   
		if ($idPersona = '') {
			return(array());
		}
		$query = $this->db->where('idUsuario',$idUsuario);
		$query = $this->db->get('Usuario');
		return $query->row_array(); 
		
		$query = $this->db->where('idPersona',$idPersona);
		$query = $this->db->get('Persona');
		return $query->row();    							
	}

}
?>