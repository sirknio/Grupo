<!-- Sidenav/menu -->
<nav class="w3-sidenav w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidenav"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
		<img src="<?=base_url('')?>public/images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8">
		<span>Bienvenido, <strong><?=$userdata['NombreUsuario']?></strong></span><br>
  <?php if ($userdata['TipoUsuario'] === 'sally'): ?>
		<a href="#" class="w3-hover-none w3-hover-text-red w3-show-inline-block"><i class="fa fa-envelope"></i></a>
		<a href="#" class="w3-hover-none w3-hover-text-green w3-show-inline-block"><i class="fa fa-user"></i></a>
		<a href="#" class="w3-hover-none w3-hover-text-blue w3-show-inline-block"><i class="fa fa-cog"></i></a>
  <?php endif; ?>
		<a href="<?=site_url('login/logout')?>" class="w3-hover-none w3-hover-text-red w3-show-inline-block"><i class="fa fa-sign-out"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
		<a href="#" class="w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
	<?php if ($userdata['TipoUsuario'] === 'Admin'): ?>
		<a href="<?=site_url('master')?>" class="w3-padding"><i class="fa fa-tachometer fa-fw"></i>&nbsp;&nbsp;Principal</a> <!-- Ver Estadisticas App (grupos), Invitar Usuarios(CRUD), -->
		<a href="<?=site_url('grupo')?>" class="w3-padding"><i class="fa fa-users fa-fw"></i>&nbsp;&nbsp;Grupos</a> <!-- Ver Lista Grupos (CRUD), Marcación de Lideres(CRUD) -->
		<a href="#" class="w3-padding"><i class="fa fa-street-view fa-fw"></i>&nbsp;&nbsp;Microcelulas</a> <!-- Ver Estadisticas Microcelula, Invitar Usuarios al Grupo, Marcación de Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-eye fa-fw"></i>&nbsp;&nbsp;Fotos</a> <!-- Ver Estadisticas Microcelula, Invitar Usuarios al Grupo, Marcación de Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-server fa-fw"></i>&nbsp;&nbsp;Reuniones</a> <!-- Ver Estadisticas Grupo, Invitar Usuarios al Grupo (CRUD), Marcación de MicroLideres/Microcelula, Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-address-book fa-fw"></i>&nbsp;&nbsp;Asistentes</a> <!-- Ver Estadisticas Grupo, Invitar Usuarios al Grupo (CRUD), Marcación de MicroLideres/Microcelula, Apoyos, Crear Asistentes -->
		<a href="<?=site_url('usuario')?>" class="w3-padding"><i class="fa fa-user-circle-o fa-fw"></i>&nbsp;&nbsp;Usuarios</a> <!-- Ver Estadisticas Grupo, Invitar Usuarios al Grupo (CRUD), Marcación de MicroLideres/Microcelula, Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-cog fa-fw"></i>&nbsp;&nbsp;Configuraci&oacute;n</a> <!-- Ver Estadisticas Grupo, Invitar Usuarios al Grupo (CRUD), Marcación de MicroLideres/Microcelula, Apoyos, Crear Asistentes -->
	<?php endif; ?>
	<?php if (($userdata['TipoUsuario'] === 'Lider')): ?>
		<a href="#" class="w3-padding"><i class="fa fa-users fa-fw"></i>&nbsp;&nbsp;Principal</a> <!-- Ver Estadisticas Grupo, Invitar Usuarios al Grupo (CRUD), Marcación de MicroLideres/Microcelula, Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-street-view fa-fw"></i>&nbsp;&nbsp;Microcelulas</a> <!-- Ver Estadisticas Microcelula, Invitar Usuarios al Grupo, Marcación de Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-eye fa-fw"></i>&nbsp;&nbsp;Fotos</a> <!-- Ver Estadisticas Microcelula, Invitar Usuarios al Grupo, Marcación de Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-server fa-fw"></i>&nbsp;&nbsp;Reuniones</a> <!-- Ver Estadisticas Grupo, Invitar Usuarios al Grupo (CRUD), Marcación de MicroLideres/Microcelula, Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-address-book fa-fw"></i>&nbsp;&nbsp;Asistentes</a> <!-- Ver Estadisticas Grupo, Invitar Usuarios al Grupo (CRUD), Marcación de MicroLideres/Microcelula, Apoyos, Crear Asistentes -->
	<?php endif; ?>
	<?php if (($userdata['TipoUsuario'] === 'Microlider')): ?>
		<a href="#" class="w3-padding"><i class="fa fa-users fa-fw"></i>&nbsp;&nbsp;Principal</a> <!-- Ver Estadisticas Microcelula, Invitar Usuarios al Grupo, Marcación de Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-eye fa-fw"></i>&nbsp;&nbsp;Fotos</a> <!-- Ver Estadisticas Microcelula, Invitar Usuarios al Grupo, Marcación de Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-server fa-fw"></i>&nbsp;&nbsp;Reuniones</a> <!-- Ver Estadisticas Grupo, Invitar Usuarios al Grupo (CRUD), Marcación de MicroLideres/Microcelula, Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-address-book fa-fw"></i>&nbsp;&nbsp;Asistentes</a> <!-- Ver Estadisticas Grupo, Invitar Usuarios al Grupo (CRUD), Marcación de MicroLideres/Microcelula, Apoyos, Crear Asistentes -->
	<?php endif; ?>
	<?php if (($userdata['TipoUsuario'] === 'Asistente')): ?>
		<a href="#" class="w3-padding"><i class="fa fa-users fa-fw"></i>&nbsp;&nbsp;Principal</a> <!-- Ver Estadisticas Microcelula, Invitar Usuarios al Grupo, Marcación de Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-eye fa-fw"></i>&nbsp;&nbsp;Fotos</a> <!-- Ver Estadisticas Microcelula, Invitar Usuarios al Grupo, Marcación de Apoyos, Crear Asistentes -->
		<a href="#" class="w3-padding"><i class="fa fa-address-book fa-fw"></i>&nbsp;&nbsp;Reuniones</a> <!-- Ver Estadisticas Grupo, Invitar Usuarios al Grupo (CRUD), Marcación de MicroLideres/Microcelula, Apoyos, Crear Asistentes -->
	<?php endif; ?>
	<?php if (($userdata['TipoUsuario'] === 'sally')): ?>
		<a href="#" class="w3-padding"><i class="fa fa-eye fa-fw"></i>  </a>
		<a href="#" class="w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Geo</a>
		<a href="#" class="w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Grupos</a>
		<a href="#" class="w3-padding"><i class="fa fa-diamond fa-fw"></i>  Orders</a>
		<a href="#" class="w3-padding"><i class="fa fa-bell fa-fw"></i>  News</a>
		<a href="#" class="w3-padding"><i class="fa fa-bank fa-fw"></i>  General</a>
		<a href="#" class="w3-padding"><i class="fa fa-history fa-fw"></i>  History</a>
		<a href="<?=site_url('login/logout')?>" class="w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a>
	<?php endif; ?>
	<a href="<?=site_url('login/logout')?>" class="w3-padding"><i class="fa fa-sign-out fa-fw"></i>  Desconectarse</a><br><br>
</nav>

<!-- Overlay effect when opening sidenav on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

