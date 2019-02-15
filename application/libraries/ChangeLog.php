<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChangeLog {
    public function insertChange($changeType,$table,$data,$where = '') {
        date_default_timezone_set("America/Bogota");
        $dateNow = new DateTime("now");
        $user = $_SESSION;

        $CI =& get_instance();
        $CI->load->model('object_model');
        $def  = $CI->object_model->getPK($table);
        $orig = $CI->object_model->get($table,'',$def[0]['COLUMN_NAME']." = ".$data[$def[0]['COLUMN_NAME']]);
        
        // echo "<hr><pre>";print_r($orig[0]);echo "</pre><hr>";
        
        $log = array(
            'FechaLog' 		=> $dateNow->format('Y-m-d H:i:s'),
            'idUsuario' 	=> $user['idUsuario'],
            'Usuario' 		=> $user['Usuario'],
            'Nombre' 		=> $user['Nombre'],
            'Apellido' 		=> $user['Apellido'],
            'TipoUsuario' 	=> $user['TipoUsuario'],
            'TablaNombre' 	=> $table,
            'CampoNombre' 	=> '',
            'TipoCambio' 	=> $changeType,
            'ValorOriginal' => http_build_query($orig[0],'',', '),
            'ValorNuevo' 	=> '',
            'LlavePrimaria' => $def[0]['COLUMN_NAME']." = ".$data[$def[0]['COLUMN_NAME']]
        );
        
        // Para recuperar el registro original, reemplazar , por &
        // parse_str($log['ValorOriginal'],$pru);
        // echo "<hr><pre>";print_r($pru);echo "</pre><hr>";
        // echo "<hr><pre>";print_r($log);echo "</pre><hr>";
        return $log;
    }
}