<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Object_model extends CI_Model{
	
	function insertItem($table,$data) {
		if ($this->db->insert($table, $data) == 1) {
			return($this->db->insert_id());
		} else {
			return(0);
		}
	}
	
	function updateItem($table,$data,$where) {
		return $this->db->update($table,$data,$where);
	}
	
	function deleteItem($table,$data) {
		return $this->db->delete($table, $data);
	}
	
	function get($table,$orderby = '',$where = '',$showQuery = false) {
		if ($orderby != '') {
			$this->db->order_by($orderby);
		}
		if ($where === '') {
			$query = $this->db->get($table);
		} else {
			$query = $this->db->get_where($table, $where);
		}
		if ($showQuery) {
			echo "<pre>";print_r($this->db->last_query());echo "</pre>";
			echo "<pre>";print_r($orderby);echo "</pre>";
		}
		return $query->result_array();
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