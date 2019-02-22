<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Novedad_model extends CI_model{
    public function getNews($idGrupo,$tipoUsuario,$idUsuario) {
        if (empty($idGrupo)) {
			return(array());
        }
        
        switch($tipoUsuario) {
            case 'Admin':
            case 'Lider':
                $query = $this->db->query(
                    // "SELECT n.idGrupo, n.idPersona, n.novedad
                    // FROM novedad as n
                    // WHERE   n.LeidoLider IS NULL
                    // AND     n.idGrupo = $idGrupo
                    // GROUP BY n.idGrupo, n.idPersona"
                    "SELECT n.idGrupo, n.idPersona, n.Novedad, 
                            u.Nombre, u.Apellido, 
                            p.Nombre as PersNombre, 
                            p.Apellido as PersApellido
                    FROM    novedad AS n, usuario AS u, persona AS p
                    WHERE   n.ReportaUsuario = u.idUsuario AND 
                            n.idPersona = p.idPersona AND
                            n.LeidoLider IS NULL AND 
                            n.idGrupo = $idGrupo AND 
                            n.idPersona IN (
                                SELECT p.idPersona
                                FROM persona AS p 
                                WHERE p.idGrupo IN (
                                    SELECT idGrupo
                                    FROM `grupo` AS g
                                    WHERE g.idLider1 = $idUsuario 
                                    OR g.idLider2 = $idUsuario))
                    GROUP BY n.idGrupo, n.idPersona"
                    );
                break;
            case 'Microlider':
                $query = $this->db->query(
                    "SELECT n.idGrupo, n.idPersona, n.Novedad, 
                            u.Nombre, u.Apellido, 
                            p.Nombre as PersNombre, 
                            p.Apellido as PersApellido
                    FROM    novedad AS n, usuario AS u, persona AS p
                    WHERE   n.ReportaUsuario = u.idUsuario AND 
                            n.idPersona = p.idPersona AND
                            n.LeidoMicro IS NULL AND 
                            n.idGrupo = $idGrupo AND 
                            n.idPersona IN (
                                SELECT p.idPersona
                                FROM persona AS p 
                                WHERE p.idMicrocelula IN (
                                    SELECT idMicrocelula
                                    FROM `microcelula` AS m
                                    WHERE m.idColider1 = $idUsuario 
                                    OR m.idColider2 = $idUsuario))
                    GROUP BY n.idGrupo, n.idPersona");
                break;
        }
        $array = $query->result_array();
        
        echo "<pre>";print_r($this->db->last_query());echo "</pre>";
        echo"<pre>";print_r($array);echo"</pre>";
		return $query->result_array(); 
		
    }
	
}
?>