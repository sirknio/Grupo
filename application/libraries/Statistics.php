<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics {

        //public function __construct() {
            //parent::_construct();
            //$CI =& get_instance();
            //$this->load->model('notificacion_model');
        //}

        public function loadDashStatistics (&$data = array(),$idGrupo) {
            //Establecer cuantas parejas cumplieron las tres asistencias para subirlas al reporte de la iglesia
            //$data['MinAsist'] = $this->notificacion_model->getNewMinAsist($data['userdata']['idGrupo'],5);


        }

        public function pendientes() {
            //$data['Statistics']['Grupos']       = $this->object_model->RecCount('Grupo');
            //$data['Statistics']['Microcelulas'] = $this->object_model->RecCount('Persona','idMicrocelula');
            //$data['Statistics']['Usuarios']     = $this->object_model->RecCount('Usuario');
        }
}