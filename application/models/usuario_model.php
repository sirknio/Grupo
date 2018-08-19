<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Usuario_model extends CI_Model{
	
	function login($username,$password){
		$query = $this->db->where('Usuario',$username); //poner seguridad de parseo de la cadena para SQL injection
		$query = $this->db->where('Password',$password); //poner seguridad de parseo de la cadena para SQL injection
		$query = $this->db->get('usuario');
		if($query->num_rows() == 1) {
			//echo "<pre>";print_r($this->db->last_query());echo "</pre>";
			$user = $query->row_array();
			
			//$query = $this->db->where('idPersona',$user['idPersona']);
			//$query = $this->db->get('persona');
			//$person = $query->row_array();

			//echo "<pre>";print_r($person);echo "</pre>";
			
			$query = $this->db->where('Estado','Abierto');
			$query = $this->db->get('evento');
			//$evento = $query->row_array();
			//echo "<pre>";print_r($evento);echo "</pre>";
			$user['AsistAbierta'] = $query->num_rows() >= 1;
			
			//$user['idPersona'] = $person['idPersona'];
			//$user['idGrupo'] = $person['idGrupo'];
			//$user['idMicrocelula'] = $person['idMicrocelula'];
			//$user['NombreUsuario'] = $person['NombreUsuario'];
			//$user['Nombre'] = $person['Nombre'];
			//$user['Apellido'] = $person['Apellido'];
			return($user);
		} else {
			$user = '';
			return($user);
		}
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