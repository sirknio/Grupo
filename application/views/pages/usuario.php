<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<h1 class="page-header">Usuario</h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
	<?php if (!$update): ?>
		<?= form_open_multipart('Usuario/insertItem/Crear'); ?>
	<?php else: ?>
		<?= form_open_multipart('Usuario/updateItem/'.set_value('idUsuario').'/Update'); ?>
	<?php endif; ?>
		<div class="col-lg-6">
		<div class="form-group">
				<label>Usuario</label>
				<input name="Usuario" class="form-control" placeholder="Usuario" value="<?= set_value('Usuario')?>" required />
			</div>
			<div class="form-group">
				<label>Nombre</label>
				<input name="Nombre" class="form-control" placeholder="Nombres" value="<?= set_value('Nombre')?>" required />
			</div>
			<div class="form-group">
				<label>Apellido</label>
				<input name="Apellido" class="form-control" placeholder="Apellidos" value="<?= set_value('Apellido')?>" required />
			</div>
			<div class="form-group">
				<label>Correo Electronico</label>
				<input name="Email" class="form-control" placeholder="Correo Electronico" value="<?= set_value('Email')?>" required />
			</div>
			<div class="form-group">
				<label>Asociar a Grupo Conexion</label>
				<select name="idGrupo" class="form-control">
					<option value="0"> </option>
					<?php foreach ($Grupos as $item): ?>
						<?php if (set_value('idGrupo') != $item['idGrupo']): ?>
							<option value="<?=$item['idGrupo']?>"><?=$item['Nombre']?></option>
						<?php else: ?>
							<option value="<?=$item['idGrupo']?>" selected><?=$item['Nombre']?></option>
						<?php endif; ?>
					<?php endforeach; ?>
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
					<?php foreach ($TipoUsuario as $item): ?>
						<?php if (set_value('TipoUsuario') != $item): ?>
							<option value="<?=$item?>"><?= $item?></option>
						<?php else: ?>
							<option value="<?=$item?>" selected><?=$item?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-12">
			<button type="submit" class="btn btn-primary"><i class="fa fa-users fa-fw"></i> 
			<?php if (!$update): ?>
				Crear Usuario
			<?php else: ?>
				Actualizar Usuario
			<?php endif; ?>
			
			</button>
			<a class="btn btn-default" href="<?=site_url('Usuario')?>">Cancelar</a>
		</div>
	</form>

<?=$page['footer']?>

