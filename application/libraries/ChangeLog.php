<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChangeLog {
    public function insertChange($changeType,$table = '',$data = '',$id = '',$where = '') {
        date_default_timezone_set("America/Bogota");
        $dateNow = new DateTime("now");
        $user = $_SESSION;

        $CI =& get_instance();
        $CI->load->model('object_model');
        $def  = $CI->object_model->getPK($table);
        switch($changeType) {
            case 'Insercion':
                if ($table == 'asistencia') {
                    return '';
                }
                $orig = '';
                $data[$def[0]['COLUMN_NAME']] = $id;
                $new = $CI->object_model->get($table,'',$def[0]['COLUMN_NAME']." = ".$data[$def[0]['COLUMN_NAME']]);
                $new = http_build_query($new[0],'',', ');
                $defPK = $def[0]['COLUMN_NAME']." = ".$data[$def[0]['COLUMN_NAME']];
                break;
            case 'Eliminacion':
                $new = '';
                $orig = $CI->object_model->get($table,'',$def[0]['COLUMN_NAME']." = ".$data[$def[0]['COLUMN_NAME']]);
                $orig = http_build_query($orig[0],'',', ');
                $defPK = $def[0]['COLUMN_NAME']." = ".$data[$def[0]['COLUMN_NAME']];
                break;
            case 'Modificacion':
                if ($table == 'asistencia') {
                    return '';
                }
                $data[$def[0]['COLUMN_NAME']] = $where[$def[0]['COLUMN_NAME']];
                $orig = $CI->object_model->get($table,'',$def[0]['COLUMN_NAME']." = ".$data[$def[0]['COLUMN_NAME']]);
                $orig = http_build_query($orig[0],'',', ');
                $new = http_build_query($data,'',', ');
                $defPK = $def[0]['COLUMN_NAME']." = ".$data[$def[0]['COLUMN_NAME']];
                break;
            case 'Acceso':
                $new = '';
                $defPK = '';
                if (isset($user['__ci_last_regenerate'])) {
                    unset($user['__ci_last_regenerate']);
                }
                if (isset($user['token'])) {
                    unset($user['token']);
                }
                $orig = http_build_query($user,'',', ');
                break;
        }
        
        // echo "<hr><pre>";print_r($table);echo "</pre><hr>";
        // echo "<hr><pre>";print_r($data);echo "</pre><hr>";
        // echo "<hr><pre>";print_r($where);echo "</pre><hr>";
        // echo "<hr><pre>";print_r($def);echo "</pre><hr>";
        // echo "<hr><pre>";print_r($orig);echo "</pre><hr>";
        // echo "<hr><pre>";print_r($new);echo "</pre><hr>";
        
        $log = array(
            'FechaLog' 		=> $dateNow->format('Y-m-d H:i:s'),
            'idUsuario' 	=> $user['idUsuario'],
            'Usuario' 		=> $user['Usuario'],
            'Nombre' 		=> $user['Nombre'],
            'Apellido' 		=> $user['Apellido'],
            'TipoUsuario' 	=> $user['TipoUsuario'],
            'TablaNombre' 	=> $table,
            'TipoCambio' 	=> $changeType,
            'ValorOriginal' => $orig,
            'ValorNuevo' 	=> $new,
            'LlavePrimaria' => $defPK
        );
        
        // Para recuperar el registro original, reemplazar , por &
        // parse_str($log['ValorOriginal'],$pru);
        // echo "<hr><pre>";print_r($pru);echo "</pre><hr>";
        // echo "<hr><pre>";print_r($log);echo "</pre><hr>";
        return $log;
    }
}