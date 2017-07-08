<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<h1 class="page-header">Usuario</h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
	<? if (!$update): ?>
		<?= form_open_multipart('Usuario/insertItem/Crear'); ?>
	<? else: ?>
		<?= form_open_multipart('Usuario/updateItem/'.set_value('idUsuario').'/Update'); ?>
	<? endif; ?>
		<div class="col-lg-6">
			<div class="form-group">
				<label>Usuario</label>
				<input name="Usuario" class="form-control" placeholder="Usuario" value="<?= set_value('Usuario')?>" required />
			</div>
			<div class="form-group">
				<label>Correo Electronico</label>
				<input name="Email" class="form-control" placeholder="Correo Electronico" value="<?= set_value('Email')?>" required />
			</div>
			<div class="form-group">
				<label>Persona Asociada</label>
				<select name="idPersona" class="form-control">
					<option value="0"> </option>
					<? foreach ($Persona as $item): ?>
						<? if (set_value('idColider1') != $item['idPersona']): ?>
							<option value="<?=$item['idPersona']?>"><?=$item['Nombre'].' '.$item['Apellido']?></option>
						<? else: ?>
							<option value="<?=$item['idPersona']?>" selected><?=$item['Nombre'].' '.$item['Apellido']?></option>
						<? endif; ?>
					<? endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Contraseña</label>
				<input type="Password" name="Password" class="form-control" placeholder="Digite su contraseña" value="" >
			</div>
			<div class="form-group">
				<label>Confirmar Contraseña</label>
				<input type="Password" name="Password2" class="form-control" placeholder="Confirme su contraseña" value="" >
			</div>
			<div class="form-group">
				<label>Tipo Usuario</label>
				<select name="TipoUsuario" class="form-control" placeholder="Seleccione Tipo Usuario">
					<option value="0"> </option>
					<? foreach ($TipoUsuario as $item): ?>
						<? if (set_value('TipoUsuario') != $item): ?>
							<option value="<?=$item?>"><?= $item?></option>
						<? else: ?>
							<option value="<?=$item?>" selected><?=$item?></option>
						<? endif; ?>
					<? endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-12">
			<button type="submit" class="btn btn-primary"><i class="fa fa-users fa-fw"></i> 
			<? if (!$update): ?>
				Crear Usuario
			<? else: ?>
				Actualizar Usuario
			<? endif; ?>
			
			</button>
			<a class="btn btn-default" href="<?=site_url('Usuario')?>">Cancelar</a>
		</div>
	</form>

<?=$page['footer']?>

