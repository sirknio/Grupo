<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Usuario_model extends CI_Model{
	
	function login($username,$password){
		$query = $this->db->where('Usuario',$username);
		$query = $this->db->where('Password',$password);
		$query = $this->db->get('Usuario');
		$user = $query->row_array();
		
		$query = $this->db->where('idUsuario',$user['idUsuario']);
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
}
?>