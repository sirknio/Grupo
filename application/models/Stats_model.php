<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Stats_model extends CI_model{
	
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

	function absensePerQty($idGrupo,$cant = 0,$showQuery = false) {
		$querytxt = "
			SET @rowid := 0;
			SELECT 
				`idPersona`,
				`Nombre`,
				`Apellido`,
				`DocumentoNo`,
				COUNT(Asiste) as Listas,
				SUM(Asiste) as Asistio 
			FROM `asistencia` 
			WHERE idGrupo = $idGrupo AND
				idEvento IN (
					SELECT idEvento 
					FROM (
						SELECT @rowid := @rowid  + 1  as idr,idEvento
						FROM `evento` as e
						WHERE idGrupo = $idGrupo
						ORDER BY FechaEvento DESC
						) as t
					WHERE idr <= $cant
				)
			GROUP BY `idPersona`,`Nombre`,`Apellido`,`DocumentoNo`
			HAVING SUM(Asiste) = 0                
		";
		$query = $this->db->query($querytxt);
		if ($showQuery) { echo"<pre>";print_r($this->db->last_query());echo"</pre>"; }
		return $query->result_array();
	}

	function test($idGrupo,$months = 0,$showQuery = false) {
		$querytxt = "
			SELECT idEvento
				FROM `evento` as e
				WHERE 	idGrupo = $idGrupo AND 
						FechaEvento BETWEEN date_sub(now(), interval $months month) AND NOW() 
				ORDER BY FechaEvento DESC
								
		";
		$query = $this->db->query($querytxt);
		if ($showQuery) { echo"<pre>";print_r($this->db->last_query());echo"</pre>"; }
		return $query->result_array();
	}

	function select($querytxt,&$query,$showResults,$showQuery) {
		$query = $this->db->query($querytxt);
		$result = $query->row_array();
		if ($showQuery) { echo"<pre>";print_r($this->db->last_query());echo"</pre>"; }
		if ($showResults) { echo"<pre>";print_r($result);echo"</pre>"; }
		return $query;
	}

	function getLastEvent($idGrupo,$showResults = false,$showQuery = false) {
		$querytxt = "
			SELECT idEvento,FechaEvento
			FROM `evento` as e
			WHERE 	idGrupo = $idGrupo AND 
					Estado = 'Cerrado'
			ORDER BY FechaEvento DESC
			LIMIT 100
			";
		
		$this->select($querytxt,$query,$showResults,$showQuery);
		return $query->row_array();
	}

	function absensePerDate($idGrupo,$date,$months,$showResults = false,$showQuery = false) {
		$querytxt = "
			SELECT
				'danger' as MsgType, 
				`idPersona`,
				`Nombre`,
				`Apellido`,
				`DocumentoNo`,
				COUNT(Asiste) as Listas,
				SUM(Asiste) as Asistio 
			FROM `asistencia` 
			WHERE idGrupo = $idGrupo AND
				idEvento IN (
				SELECT idEvento
				FROM `evento` as e
				WHERE 	idGrupo = $idGrupo AND 
						FechaEvento BETWEEN date_sub('$date', interval $months month) AND NOW() 
				ORDER BY FechaEvento DESC
				)
			GROUP BY `idPersona`,`Nombre`,`Apellido`,`DocumentoNo`
			HAVING SUM(Asiste) = 0						
		";
		$this->select($querytxt,$query,$showResults,$showQuery);
		return $query->result_array();
	}
	
	function AssistancePerDate($idGrupo,$date,$months,$showResults = false,$showQuery = false) {
		$querytxt = "
			SELECT 
				'success' as MsgType,
				`idPersona`,
				`Nombre`,
				`Apellido`,
				`DocumentoNo`,
				COUNT(Asiste) as Listas,
				SUM(Asiste) as Asistio 
			FROM `asistencia` 
			WHERE idGrupo = $idGrupo AND
				idEvento IN (
				SELECT idEvento
				FROM `evento` as e
				WHERE 	idGrupo = $idGrupo AND 
						FechaEvento BETWEEN date_sub('$date', interval $months month) AND NOW() 
				ORDER BY FechaEvento DESC
				)
			GROUP BY `idPersona`,`Nombre`,`Apellido`,`DocumentoNo`
			HAVING SUM(Asiste) >= (COUNT(Asiste) - 2) 
								
		";
		$this->select($querytxt,$query,$showResults,$showQuery);
		return $query->result_array();
	}

}
?>