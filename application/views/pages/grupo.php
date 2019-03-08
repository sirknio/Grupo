<?=$page['header']?>

<?=$page['menu']?>

<?php $item = ''; ?>

	<?php if (!$update): ?>
		<?= form_open_multipart('Grupo/insertItem/Crear'); ?>
	<?php else: ?>
		<?= form_open_multipart('Grupo/updateItem/'.set_value('idGrupo').'/Update'); ?>
	<?php endif; ?>

		<div class="col-md-12">
			<div class="col-8 col-md-8">
				<h1 class="page-header">Grupo</h1>
				<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
			</div>
			<div class="col-4 col-md-4">
				<?php if (isset($idEvent)): ?>
				<?php else: ?>
					<!-- <a class="btn btn-primary" href="<?=site_url('Grupo')?>" title="Abrir Reporte"><i class="fa fa-comments fa-fw"></i></a> -->
					<button type="submit" class="btn btn-primary custbuttons"
					<?php if (!$update): ?>
						title="Crear nuevo Grupo"><i class="fa fa-plus-square fa-fw"></i>
					<?php else: ?>
						title="Actualizar Grupo"><i class="fa fa-pencil-square-o fa-fw"></i>
					<?php endif; ?>
					</button>
					<?php if ($userdata['TipoUsuario'] == 'Admin'): ?>
					<a class="btn btn-default" href="<?=site_url('Grupo')?>" title="Cancelar"><i class="fa fa-times-circle"></i></a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<!-- /.col-lg-12 -->
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Datos Básicos</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Logo</label>
							<input name="logo" type="file">
						</div>
						<div class="form-group">
							<label>Nombre</label>
							<input name="Nombre" class="form-control" placeholder="Nombre" value="<?= set_value('Nombre')?>" required>
						</div>
						<div class="form-group">
							<label>Descripción</label>
							<input name="Descripcion" class="form-control" placeholder="Descripción" value="<?= set_value('Descripcion')?>">
						</div>
						<div class="form-group">
							<label>Lider 1</label>
							<select name="idLider1" class="form-control">
								<option value=""> </option>
								<?php foreach ($lider as $item): ?>
									<?php if (set_value('idLider1') != $item['idUsuario']): ?>
										<option value="<?=$item['idUsuario']?>"><?=$item['Nombre'].' '.$item['Apellido']?></option>
									<?php else: ?>
										<option value="<?=$item['idUsuario']?>" selected><?=$item['Nombre'].' '.$item['Apellido']?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Lider 2</label>
							<select name="idLider2" class="form-control">
								<option value=""> </option>
								<?php foreach ($lider as $item): ?>
									<?php if (set_value('idLider2') != $item['idUsuario']): ?>
										<option value="<?=$item['idUsuario']?>"><?=$item['Nombre'].' '.$item['Apellido']?></option>
									<?php else: ?>
										<option value="<?=$item['idUsuario']?>" selected><?=$item['Nombre'].' '.$item['Apellido']?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Categorización del Grupo</h3>
					</div>
					<div class="panel-body">

						<div class="form-group">
							<label>Tipo Grupo</label>
							<select name="TipoGrupo" class="form-control">
								<?php foreach ($TipoGrupo as $item): ?>
									<?php if (set_value('TipoGrupo') != $item): ?>
										<option value="<?=$item?>"><?=$item?></option>
									<?php else: ?>
										<option value="<?=$item?>" selected><?=$item?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Edad Minima</label>
							<input name="EdadMinima" class="form-control" placeholder="Edad Minima" value="<?= set_value('EdadMinima')?>">
						</div>
						<div class="form-group">
							<label>Edad Maxima</label>
							<input name="EdadMaxima" class="form-control" placeholder="Edad Maxima" value="<?= set_value('EdadMaxima')?>">
						</div>
						<div class="form-group">
							<label>Genero</label>
							<select name="Genero" class="form-control" placeholder="Seleccione Genero">
							<option value="" hidden>Genero</option>
								<?php foreach ($Genero as $item): ?>
									<?php if (set_value('Genero') != $item): ?>
										<option value="<?=$item?>"><?= $item?></option>
									<?php else: ?>
										<option value="<?=$item?>" selected><?=$item?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Estado Civil</label>
							<?php foreach ($EstadoCivil as $item): ?>
								<?php if (in_array($item,set_value('EstadoCivil'))): ?>
									<br><input type="checkbox" name="EstadoCivil[ ]" value="<?=$item?>" checked> <?=$item?>
								<?php else: ?>
									<br><input type="checkbox" name="EstadoCivil[ ]" value="<?=$item?>"> <?=$item?>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
						<div class="form-group">
							<label>Cantidad de hijos</label>
							<input name="CantidadHijos" class="form-control" placeholder="Cantidad Hijos" value="<?= set_value('CantidadHijos')?>">
						</div>
						<div class="form-group">
							<label>Edad Minima por Hijo Mayor</label>
							<input name="EdadMinHijoMayor" class="form-control" placeholder="Edad Minima por Hijo Mayor" value="<?= set_value('EdadMinHijoMayor')?>">
						</div>
						<div class="form-group">
							<label>Edad Maxima por Hijo Mayor</label>
							<input name="EdadMaxHijoMayor" class="form-control" placeholder="Edad Maxima por Hijo Mayor" value="<?= set_value('EdadMaxHijoMayor')?>">
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

<?=$page['footer']?>

