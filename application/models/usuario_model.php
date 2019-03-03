<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Usuario_model extends CI_Model{
	
	function login($username,$password){
		$query = $this->db->where('Usuario',$username); //poner seguridad de parseo de la cadena para SQL injection
		$query = $this->db->where('Password',$password); //poner seguridad de parseo de la cadena para SQL injection
		$query = $this->db->get('usuario');
		//echo "<pre>";print_r($this->db->last_query());echo "</pre>";
		if($query->num_rows() == 1) {
			$user = $query->row_array();
			
			$query = $this->db->where('Estado','Abierto');
			$query = $this->db->where('idGrupo',$user['idGrupo']);
			$query = $this->db->get('evento');
			$user['AsistAbierta'] = $query->num_rows() >= 1;
			
			$query = $this->db->where('idGrupo',$user['idGrupo']);
			$query = $this->db->get('grupo');
			$user['grupo'] = $query->row_array();
			
			if ($user['TipoUsuario'] == 'Microlider') {
				$query = $this->db->where('idGrupo',$user['idGrupo']);
				$query = $this->db->where('idColider1',$user['idUsuario']);
				$query = $this->db->or_where('idColider2',$user['idUsuario']);
				$query = $this->db->get('microcelula');
				$user['microcelula'] = $query->row_array();
			}

			// echo "<pre>";print_r($this->db->last_query());echo "</pre>";
			// echo "<pre>";print_r($user);echo "</pre>";
			
			return($user);
		} else {
			$user = '';
			return($user);
		}
	}
	
}
?>