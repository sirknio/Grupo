<?=$page['header']?>

<?=$page['menu']?>

<?php $item = ''; ?>

	<?php if (!$update): ?>
		<?= form_open_multipart('Usuario/insertItem/Crear'); ?>
	<?php else: ?>
		<?= form_open_multipart('Usuario/updateItem/'.set_value('idUsuario').'/Update'); ?>
	<?php endif; ?>
		<!-- Titulo -->
		<div class="col-md-12">
			<div class="col-8 col-md-8">
				<h1 class="page-header">Usuario</h1>
				<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
			</div>
			<div class="col-4 col-md-4">
				<?php if (isset($idEvent)): ?>
				<?php else: ?>
					<!-- <a class="btn btn-primary" href="<?=site_url('Usuario')?>" title="Abrir Reporte"><i class="fa fa-comments fa-fw"></i></a> -->
					<button type="submit" class="btn btn-primary custbuttons"
					<?php if (!$update): ?>
						title="Crear nuevo Usuario"><i class="fa fa-plus-square fa-fw"></i>
					<?php else: ?>
						title="Actualizar Usuario"><i class="fa fa-pencil-square-o fa-fw"></i>
					<?php endif; ?>
					</button>
					<a class="btn btn-default" href="<?=site_url('Usuario')?>" title="Cancelar"><i class="fa fa-times-circle"></i></a>
				<?php endif; ?>

			</div>
		</div>
		<!-- /.col-lg-12 -->
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>Usuario</label>
					<input name="Usuario" class="form-control" placeholder="Usuario" value="<?= set_value('Usuario')?>" required />
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
					<label>Asociar a Integrante</label>
					<select name="idPersona" class="form-control">
						<option value=""> </option>
						<?php foreach ($Personas as $item): ?>
							<?php if (set_value('idPersona') != $item['idPersona']): ?>
								<option value="<?=$item['idPersona']?>"><?=$item['Nombre']?> <?=$item['Apellido']?></option>
							<?php else: ?>
								<option value="<?=$item['idPersona']?>" selected><?=$item['Nombre']?> <?=$item['Apellido']?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
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
					<label>Contraseña</label>
					<input type="Password" name="Password" class="form-control" placeholder="Digite su contraseña" value="" >
				</div>
				<div class="form-group">
					<label>Confirmar Contraseña</label>
					<input type="Password" name="Password2" class="form-control" placeholder="Confirme su contraseña" value="" >
				</div>
			</div>
		</div>
	</form>

<?=$page['footer']?>

