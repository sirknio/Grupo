<?=$page['header']?>

<?php if (!$update): ?>
	<?= form_open_multipart('Usuario/insertItem/Crear'); ?>
<?php else: ?>
	<?= form_open_multipart('Usuario/updateItem/'.set_value('idUsuario').'/Update'); ?>
<?php endif; ?>

<?=$page['menu']?>
<div class="col-lg-12">
<h1 class="page-header">Usuario</h1>
<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
</div>
<!-- /.col-lg-12 -->
<div class="col-lg-6">
	<div class="form-group">
		<label>Usuario</label>
		<input name="Usuario" class="form-control" placeholder="Usuario" value="<?= set_value('Usuario')?>" required />
	</div>
	<div class="form-group">
		<label>Nombres</label>
		<input name="Nombre" class="form-control" placeholder="Nombres" value="<?= set_value('Nombre')?>" required />
	</div>
	<div class="form-group">
		<label>Apellidos</label>
		<input name="Apellido" class="form-control" placeholder="Apellidos" value="<?= set_value('Apellido')?>" required />
	</div>
	<div class="form-group">
		<label>Correo Electronico</label>
		<input name="Email" class="form-control" placeholder="Correo Electronico" value="<?= set_value('Email')?>" required />
	</div>
	<div class="form-group">
		<label>Grupo al que pertenece</label>
		<select name="idGrupo" class="form-control" <?= $page['disabled']?>>
			<option  dfs a value="0"> </option>
			<?php foreach ($Grupo as $item): ?>
				<?php if (set_value('idGrupo') != $item['idGrupo']): ?>
					<option value="<?=$item['idGrupo']?>"><?=$item['Nombre'] ?></option>
				<?php else: ?>
					<option value="<?=$item['idGrupo']?>" selected><?=$item['Nombre'] ?></option>
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
		
<?=$page['footer']?>

</form>

