<?=$page['header']?>

<?=$page['topmenu']?>

<?=$page['menu']?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:400px;margin-top:43px;">

<?php if ($print <> '') { echo "<hr><pre>";print_r($print);echo"<hr>";echo "</pre><hr>"; } ?>

	<header class="w3-container" style="padding-top:22px">
		<?php if (! $update) : ?>
			<h5><b><i class="fa fa-dashboard"></i>  Creaci&oacute;n Grupos</b></h5>
		<?php else: ?>
			<h5><b><i class="fa fa-dashboard"></i>  Modificaci&oacute;n Grupos</b></h5>
		<?php endif; ?>
	</header>
	
	<?php if(validation_errors() <> '') : ?>
		  <div class="w3-row-padding w3-margin-bottom">
			<div class="w3-half">
				<div class="w3-container w3-red w3-padding-16">
					<div class="w3-left">
						<i class="fa fa-comment w3-xxxlarge"></i>
					</div>
					<div class="w3-left">
						<h6><?= validation_errors();?></h6>
					</div>
				</div>
			</div>
		</div>
		
	<? endif; ?>

	<?= "<br>";?>
	<?php if (! $update) : ?>
	<?= form_open_multipart('Usuario/crearGrupo');?>
	<?php else : ?>
	<?= form_open_multipart('Usuario/actualizarGrupo/'.set_value('idGrupo'));?>
	<?php endif; ?>
		<table>
			<tr>
				<td>  Usuario:&nbsp;&nbsp;&nbsp;</td>
				<td>
					<?= form_error('Usuario'); ?>
					<?= form_input('Usuario', set_value('Usuario'), $attributes['Usuario']); ?>
				</td>
			</tr> 
			<tr>
				<td>  Contraseña:&nbsp;&nbsp;&nbsp;</td>
				<td>
					<?= form_error('Password'); ?>
					<?= form_password('Password', set_value('Password'), $attributes['Password']); ?>
				</td>
			</tr> 
			<tr>
				<td>  Confirmar contraseña:&nbsp;&nbsp;&nbsp;</td>
				<td>
					<?= form_error('Password2'); ?>
					<?= form_password('Password2', set_value('Password2'), $attributes['Password2']); ?>
				</td>
			</tr> 
			<tr>
				<td>  Correo Electr&oacute;nico:&nbsp;&nbsp;&nbsp;</td>
				<td>
					<?= form_error('Email'); ?>
					<?= form_input('Email', set_value('Email'), $attributes['Email']) ?>
				</td>
			</tr> 
			<tr>
				<td>  Tipo Usuario:&nbsp;&nbsp;&nbsp;</td>
				<td>
					<?= form_error('TipoUsuario'); ?>
					<?= form_dropdown('TipoUsuario', $options['TipoUsuario'], set_value('TipoUsuario'), $attributes['TipoUsuario']) ?>
				</td>
			</tr> 
			<tr>
				<td>  Imagen:&nbsp;&nbsp;&nbsp;</td>
				<td>
					<?= form_error('Imagen'); ?>
					<?= form_upload('Imagen', set_value('Imagen'), $attributes['Imagen']) ?>
				</td> 
			</tr> 
			<tr>
				<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			</tr> 		
			<tr>
				<td colspan="2" align=center>
					<?php if (! $update) : ?>
						<button type="submit" class="w3-btn">&nbsp;Crear Usuario&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-in"></i>&nbsp;</button>
					<?php else : ?>
						<button type="submit" class="w3-btn">&nbsp;Modificar Usuario&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-in"></i>&nbsp;</button>
					<?php endif; ?>
					<button type="button" class="w3-btn" onClick="window.location='<?=base_url('grupo')?>'">&nbsp;Cancelar&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-out"></i>&nbsp;</button>
				</td>
		   </tr>      
		</table>
	</form>


</div>

<?=$page['footer']?>

