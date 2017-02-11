<?=$page['header']?>

<?=$page['topmenu']?>

<?=$page['menu']?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<?php if ($print <> '') { echo "<hr><pre>";print_r($print);echo"<hr>";echo "</pre><hr>"; } ?>

	<header class="w3-container" style="padding-top:22px">
		<h5><b><i class="fa fa-dashboard"></i>  Grupos</b></h5>
	</header>
	
	<?php if ($userdata['TipoUsuario'] === 'Admin'): ?>

	<div class="w3-container" style="margin-left:50px;margin-top:0px;">
		<table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
			<tr>
				<th style="width:10px;">Logo</th>
				<th>Nombre Grupo</th>
				<th>Descripci&oacute;n</th>
				<th style="width:10px;">Modificar</th>
				<th style="width:10px;">Eliminar</th>
			</tr>
		<?php foreach ($groups as $item): ?>
			<tr>
				<td style="text-align:center;">
					<a class="example-image-link" href="<?=base_url('')?>public/images/avatar2.png" data-lightbox="Foto<?= $item['idGrupo']; ?>">
					<img src="<?=base_url('')?>public/images/avatar2.png"  class="w3-circle w3-margin-right" style="width:36px">
					</a>
				</td>
				<td style="vertical-align:middle;"><?=$item['Nombre']?></td>
				<td style="vertical-align:middle;"><?=$item['Descripcion']?></td>
				<td style="text-align:center;vertical-align:middle;"><a href="<?=site_url('Grupo/pageActualizarGrupo/'.$item['idGrupo'])?>" class="w3-hover-none w3-hover-text-red w3-show-inline-block" alt="Modificar Grupo"><i class="fa fa-pencil-square"></i></a></td>
				<td style="text-align:center;vertical-align:middle;"><a href="<?=site_url('Grupo/eliminarGrupo/'.$item['idGrupo']);?>" class="w3-hover-none w3-hover-text-red w3-show-inline-block" alt="Eliminar Grupo"><i class="fa fa-trash"></i></a></td>
			</tr>
		<?php endforeach; ?>
		</table><br>
		<button class="w3-btn" OnClick="window.location='<?=site_url('Grupo/pageCrearGrupo')?>';">Crear Grupo  <i class="fa fa-arrow-right"></i></button>
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

