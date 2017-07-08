<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Usuario_model extends CI_Model{
	
	function login($username,$password){
		$query = $this->db->where('Usuario',$username);
		$query = $this->db->where('Password',$password);
		$query = $this->db->get('Usuario');
		$user = $query->row_array();
		
		$query = $this->db->where('idPersona',$user['idPersona']);
		$query = $this->db->get('Persona');
		$person = $query->row_array();
		
		$user['idPersona'] = $person['idPersona'];
		$user['idGrupo'] = $person['idGrupo'];
		$user['idMicrocelula'] = $person['idMicrocelula'];
		$user['NombreUsuario'] = $person['NombreUsuario'];
		$user['Nombre'] = $person['Nombre'];
		$user['Apellido'] = $person['Apellido'];
		return($user);
	}
	
	function getTipoUsuarioValues() {
		$query = $this->db->query(
				"SHOW COLUMNS FROM usuario LIKE 'TipoUsuario'");
		$array = $query->result_array();
		$array = $array[0]['Type'];
		$off  = strpos($array,"('");
        $array = substr($array, $off+2, strlen($array)-$off-4);
		$array = explode("','",$array);
		//echo"<pre>";print_r($array);echo"</pre>";
		return $array;
	}


}
?>