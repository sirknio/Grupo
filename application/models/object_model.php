<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Object_model extends CI_Model{
	
	function insertar($table,$data) {
		return $this->db->insert($table, $data);
	}
	
	function actualizar($table,$data,$where) {
		return $this->db->update($table,$data,$where);
	}
	
	function eliminar($table,$data) {
		return $this->db->delete($table, $data);
	}
	
	function get($table,$where = '') {
		if ($where === '') {
			$query = $this->db->get($table);
			return $query->result_array();
		} else {
			$query = $this->db->get_where($table, $where);
			return $query->row_array();
		}
	}
	
	function RecCount($table,$field = '') {
		if ($field === '') {
			return $this->db->count_all_results($table);
		} else {
			$campoCant = 'Cantidad';
			$query = $this->db->query(
					'SELECT COUNT(tabla.campo) as '.$campoCant.' '.
					'FROM ( '.
						'SELECT DISTINCT '.$field.' AS campo '.
						'FROM '.$table.') AS tabla');
			$array = $query->row_array();
			return $array[$campoCant];
		}
		
	}
}
?>