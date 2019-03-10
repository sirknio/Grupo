<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Object_model extends CI_Model{
	private $log;
	
	function insertItem($table,$data) {
		if ($this->db->insert($table, $data) == 1) {
			$insertID = $this->db->insert_id();
			$this->initLog('Insercion',$table,$data,$this->db->insert_id());
			$this->applyLog();
			return($insertID);
		} else {
			return(0);
		}
	}
	
	function updateItem($table,$data,$where) {
		$this->initLog('Modificacion',$table,$data,'',$where);
		$dev = $this->db->update($table,$data,$where);
		// echo "<hr><pre>";print_r($this->db->last_query());echo "</pre><hr>";
		$this->applyLog();
		return $dev;
	}
	
	function deleteItem($table,$data) {
		$this->initLog('Eliminacion',$table,$data);
		$this->db->delete($table, $data);
		$this->applyLog();
	}

	function registerLogin($data) {
		$this->initLog('Acceso','Log In',$data);
		$this->applyLog();
	}

	function registerLogout() {
		$this->initLog('Acceso','Log Out');
		$this->applyLog();
	}

	function initLog($changeType,$table,$data = '',$id = '',$where = '') {
		$this->load->library('ChangeLog');
		$this->log = $this->changelog->insertChange($changeType,$table,$data,$id,$where);
	}

	function applyLog() {
		//Aqui debemos poner toda la información transformada para el Log de Cambios
		if (isset($this->log)) {
			if (is_array($this->log)) {
				// echo "<hr><pre>";print_r($this->log);echo "</pre><hr>";
				$this->db->insert('logcambios', $this->log);
			}
		}
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
			// echo "<pre>";print_r($orderby);echo "</pre>";
		}
		return $query->result_array();
	}

	function getSetup($showQuery = false) {
		$setup = array();
		$setup = $this->get('aplicacion','','',false);
		if(count($setup) == 0) {
			//Default values
			$data['LimiteEventosDashboard'] = 10;
			$this->insertItem('aplicacion',$data);
			$setup = $this->get('aplicacion','','',false);
		}
		if ($showQuery) {
			echo "<pre>";print_r($setup);echo " </pre>";
		}
		return $setup[0];
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

	function getTipoValues($table,$column) {
		$query = $this->db->query(
				"SHOW COLUMNS FROM $table LIKE '$column'");
		$array = $query->result_array();
		$array = $array[0]['Type'];
		$off  = strpos($array,"('");
        $array = substr($array, $off+2, strlen($array)-$off-4);
		$array = explode("','",$array);
		// echo"<pre>";print_r($array);echo"</pre>";
		return $array;
	}

	function getPK($table) {
		$array = array();
		$query = $this->db->query(
			"SELECT COLUMN_NAME
			FROM INFORMATION_SCHEMA.COLUMNS 
			WHERE 	TABLE_SCHEMA = 'grupo'
			AND 	TABLE_NAME = '$table'
			AND 	COLUMN_KEY IN('PRI', 'UNI')");
		$array = $query->result_array();
		// echo"<pre>";print_r($array);echo"</pre>";
		return $array;
	}

}
?>