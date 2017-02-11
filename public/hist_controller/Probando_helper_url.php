<?php

class Probando_helper_url extends CI_Controller {
   
   ///////////////////////////////////////////////////////////////////////////
   //Constructor
   function __construct(){
      parent::__construct();
      
      //cargo el helper de url
      $this->load->helper('url');
   }

///////////////////////////////////////////////////////////////////////////
//método index, función por defecto del controlador
function index(){
   //escribo desde el controlador, aunque debería hacerlo desde la vista
   echo "<h1>Probando helper URL</h1>";
   
   //genero el enlace de este controlador, para la función creada muestra_base_url()
   $enlace = site_url("probando_helper_url/muestra_base_url");
   
   //escribo un enlace con esa función del controlador
   echo '<a href="' . $enlace . '">Muestra la URL base</a>';
   
}

   ///////////////////////////////////////////////////////////////////////////
   //funcion muestra_base_url, para mostrar la URL principal de esta aplicación web
   function muestra_base_url(){
      //escribo desde el controlador, aunque debería hacerlo desde la vista
      echo base_url();
      
      //un enlace para volver
      echo '<p><a href="' . site_url('probando_helper_url') . '">Volver</a></p>';
   }
   
   ///////////////////////////////////////////////////////////////////////////
   //funcion muestra_url_actual, para mostrar la URL actual de esta página
   function muestra_url_actual(){
      //escribo desde el controlador, aunque debería hacerlo desde la vista
      echo current_url();
      
      //un enlace para volver
      echo '<p><a href="' . site_url('probando_helper_url') . '">Volver</a></p>';
   }
}

?>