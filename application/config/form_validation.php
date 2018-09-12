<?php
$errormsg = array (
	'required'    => 'El campo %s es requerido.',
	'is_unique'   => 'El valor en el campo {field} ya existe.',
	'min_length'  => 'El campo {field} debe tener al menos {param} caracteres.',
	'max_length'  => 'El campo {field} debe tener m&aacute;ximo {param} caracteres.',
	'valid_email' => 'El correo no es valido.',
	'matches'     => 'El contraseña no coincide con la confirmaci&oacute;n.'
);

$config = array(
	'Usuario/crearUsuario' => array(
		array(
				'field'  => 'Usuario',
				'label'  => 'Usuario',
				'rules'  => 'required|min_length[5]|max_length[20]|is_unique[usuario.Usuario]',
				'errors' => $errormsg
		),
		array(
				'field'  => 'Password',
				'label'  => 'Contraseña',
				'rules'  => 'required|min_length[5]|max_length[100]',
				'errors' => $errormsg
		),
		array(
				'field'  => 'Password2',
				'label'  => 'Confirmar Contraseña',
				'rules'  => 'required|matches[Password]',
				'errors' => $errormsg
		),
		array(
				'field'  => 'Email',
				'label'  => 'Correo Electr&oacute;nico',
				'rules'  => 'required|valid_email|is_unique[usuario.Email]',
				'errors' => $errormsg
		),
		array(
				'field'  => 'TipoUsuario',
				'label'  => 'Tipo Usuario',
				'rules'  => 'required',
				'errors' => $errormsg
		),
	),
	'Usuario/actualizarUsuario' => array(
		array(
				'field'  => 'Usuario',
				'label'  => 'Usuario',
				'rules'  => 'required|min_length[5]|max_length[20]',
				'errors' => $errormsg
		),
		array(
				'field'  => 'Password',
				'label'  => 'Contraseña',
				'rules'  => 'min_length[5]|max_length[100]',
				'errors' => $errormsg
		),
		array(
				'field'  => 'Password2',
				'label'  => 'Confirmar Contraseña',
				'rules'  => 'matches[Password]',
				'errors' => $errormsg
		),
		array(
				'field'  => 'Email',
				'label'  => 'Correo Electr&oacute;nico',
				'rules'  => 'required|valid_email',
				'errors' => $errormsg
		),
		array(
				'field'  => 'TipoUsuario',
				'label'  => 'Tipo Usuario',
				'rules'  => 'required',
				'errors' => $errormsg
		),
	),
	'Grupo/crearGrupo' => array(
		array(
				'field'  => 'Nombre',
				'label'  => 'Nombre',
				'rules'  => 'required|is_unique[grupo.Nombre]',
				'errors' => $errormsg
		),
		array(
				'field'  => 'Descripcion',
				'label'  => 'Descripcion',
				'rules'  => 'required',
				'errors' => $errormsg
		),
	),
	'Grupo/actualizarGrupo' => array(
		array(
				'field'  => 'Nombre',
				'label'  => 'Nombre',
				'rules'  => 'required',
				'errors' => $errormsg
		),
		array(
				'field'  => 'Descripcion',
				'label'  => 'Descripcion',
				'rules'  => 'required',
				'errors' => $errormsg
		),
	)
);
			
?>