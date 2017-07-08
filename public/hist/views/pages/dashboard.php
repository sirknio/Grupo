<?=$page['header']?>

<?=$page['topmenu']?>

<?=$page['menu']?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<?php //echo "<pre>";print_r($userdata);echo "</pre>"; ?>

	<header class="w3-container" style="padding-top:22px">
		<h5><b><i class="fa fa-dashboard"></i>  Principal</b></h5>
	</header>
	
	<?php if ($userdata['TipoUsuario'] === 'Admin'): ?>
		<div class="w3-row-padding w3-margin-bottom">
			<div class="w3-quarter" onclick="window.location='<?=site_url('grupo')?>'">
				<div class="w3-container w3-teal w3-text-white w3-padding-16">
					<div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
					<div class="w3-right"><h3><?= $Statistics['Grupos'] ?></h3></div>
					<div class="w3-clear"></div>
					<h4>Grupos</h4>
				</div>
			</div>
			<div class="w3-quarter">
				<div class="w3-container w3-red w3-text-white w3-padding-16">
					<div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
					<div class="w3-right"><h3><?= $Statistics['Microcelulas'] ?></h3></div>
					<div class="w3-clear"></div>
					<h4>Microcelulas</h4>
				</div>
			</div>
			<div class="w3-quarter">
				<div class="w3-container w3-orange w3-text-white w3-padding-16">
					<div class="w3-left"><i class="fa fa-user w3-xxxlarge"></i></div>
					<div class="w3-right"><h3><?= $Statistics['Usuarios'] ?></h3></div>
					<div class="w3-clear"></div>
					<h4>Usuarios</h4>
				</div>
			</div>
			<div class="w3-quarter">
				<div class="w3-container w3-blue w3-text-white w3-padding-16">
					<div class="w3-left"><i class="fa fa-user w3-xxxlarge"></i></div>
					<div class="w3-right"><h3><?= $Statistics['Personas'] ?></h3></div>
					<div class="w3-clear"></div>
					<h4>Personas</h4>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($userdata['TipoUsuario'] === 'Lider'): ?>
	
	<?php endif; ?>

	<?php if ($userdata['TipoUsuario'] === 'Microlider'): ?>
	
	<?php endif; ?>

	<?php if ($userdata['TipoUsuario'] === 'Asistente'): ?>
	
	<?php endif; ?>


</div>

<?=$page['footer']?>

