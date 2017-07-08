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
	<?= form_open_multipart('Grupo/crearGrupo');?>
	<?php else : ?>
	<?= form_open_multipart('Grupo/actualizarGrupo/'.set_value('idGrupo'));?>
	<?php endif; ?>
		<table>
			<tr>
				<td>  Nombre Grupo:&nbsp;&nbsp;&nbsp;</td>
				<td>
					<?= form_error('Nombre'); ?>
					<?= form_input('Nombre', set_value('Nombre'), $attributes['Nombre']); ?>
				</td>
			</tr> 
			<tr>
				<td>  Descripci&oacute;n:&nbsp;&nbsp;&nbsp;</td>
				<td>
					<?= form_error('Descripcion'); ?>
					<?= form_input('Descripcion', set_value('Descripcion'), $attributes['Descripcion']) ?>
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
						<button type="submit" class="w3-btn">&nbsp;Crear Grupo&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-in"></i>&nbsp;</button>
					<?php else : ?>
						<button type="submit" class="w3-btn">&nbsp;Modificar Grupo&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-in"></i>&nbsp;</button>
					<?php endif; ?>
					<button type="button" class="w3-btn" onClick="window.location='<?=base_url('grupo')?>'">&nbsp;Cancelar&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-out"></i>&nbsp;</button>
				</td>
		   </tr>      
		</table>
	</form>


</div>

<?=$page['footer']?>

