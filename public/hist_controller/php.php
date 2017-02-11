<?php

class Php extends CI_Controller {

   function login($idioma=null)
   {
      
	  echo "<hr><pre>";
	  print_r($_POST);
	  echo "</pre><hr>";
      
	  //Setear dinámicamente el idioma que deseamos que ejecute nuestra aplicación
	  //$this->config->set_item('language', 'spanish');      
      
	  //Si no recibimos ningún valor proveniente del formulario, significa que el usuario recién ingresa.   
	  if(!isset($_POST['maillogin'])){   
        //Por lo tanto le presentamos la pantalla del formulario de ingreso.
		$this->load->view('login');      
      } else {
		
		//Si el usuario ya pasó por la pantalla inicial y presionó el botón "Ingresar"
		$this->form_validation->set_rules('maillogin','e-mail','required|valid_email');      
		
		//Configuramos las validaciones ayudandonos con la librería form_validation del Framework Codeigniter
		$this->form_validation->set_rules('passwordlogin','password','required');
		
		//Verificamos si el usuario superó la validación
		if(($this->form_validation->run() == FALSE)){         
			//En caso que no, volvemos a presentar la pantalla de login
            $this->load->view('login');                 
		
		//Si ambos campos fueron correctamente rellanados por el usuario,	
		} else {                                       
            $this->load->model('usuarios_model');
			
			//Comprobamos que el usuario exista en la base de datos y la password ingresada sea correcta
            $ExistUserPass = $this->usuarios_model->ValidarUsuario($_POST['maillogin'],$_POST['passwordlogin']);   
            
			//La variable $ExisteUsuarioyPassoword recibe valor TRUE si el usuario existe y FALSE en caso que no. Este valor lo determina el modelo.
			if($ExistUserPass){   
				//Si el usuario ingresó datos de acceso válido, imprimos un mensaje de validación exitosa en pantalla
				echo "Validacion Ok<br><br><a href=''>Volver</a>";  
			
				$data = array();	
				$this->load->view('login',$data);

				//Si no logró validar
            } else {   
               $data['error'] = "E-mail o password incorrecta, por favor vuelva a intentar";
			   //Lo regresamos a la pantalla de login y pasamos como parámetro el mensaje de error a presentar en pantalla
               $this->load->view('login',$data);   
            }
         }
      }
   }
}
?>