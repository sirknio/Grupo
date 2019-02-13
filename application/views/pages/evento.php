<?=$page['header']?>

<?=$page['menu']?>

<?php $item = ''; ?>

	<?php if (!$update): ?>
		<?= form_open_multipart('Evento/insertItem/Crear'); ?>
	<?php else: ?>
		<?= form_open_multipart('Evento/updateItem/'.set_value('idEvento').'/Update'); ?>
	<?php endif; ?>

		<div class="col-md-12">
			<div class="col-8 col-md-8">
				<h1 class="page-header">Evento</h1>
				<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
			</div>
			<div class="col-4 col-md-4">
				<?php if (isset($idEvent)): ?>
				<?php else: ?>
					<!-- <a class="btn btn-primary" href="<?=site_url('Evento')?>" title="Abrir Reporte"><i class="fa fa-comments fa-fw"></i></a> -->
					<button type="submit" class="btn btn-primary custbuttons"
					<?php if (!$update): ?>
						title="Crear nuevo Evento"><i class="fa fa-plus-square fa-fw"></i>
					<?php else: ?>
						title="Actualizar Evento"><i class="fa fa-pencil-square-o fa-fw"></i>
					<?php endif; ?>
					</button>
					<a class="btn btn-default" href="<?=site_url('Evento/index/'.$userdata['idGrupo'])?>" title="Cancelar"><i class="fa fa-times-circle"></i></a>
				<?php endif; ?>
			</div>
		</div>
		<!-- /.col-lg-12 -->
		<div class="col-lg-6">
			<input name="idGrupo" type="hidden" value="<?= $userdata['idGrupo']?>">
			<div class="form-group">
				<label>Fecha</label>
				<div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" required>
					<input class="form-control" name="FechaEvento" size="16" type="text" value="<?= set_value('FechaEvento')?>" placeholder="Seleccione Fecha" readonly>
					<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>
				<input type="hidden" id="dtp_input2" value="" /><br/>
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
				<label>Asistencia</label>
				<select name="TomarAsistencia" class="form-control" placeholder="Seleccione filtro">
					<option value="0" <?php if (set_value('TomarAsistencia') === '0'): ?> selected <?php endif; ?>>
						Evento solo informativo
					</option>
					<option value="1" <?php if (set_value('TomarAsistencia') === '1'): ?> selected <?php endif; ?>>
						Evento con Asistencia
					</option>
				</select>
			</div>
				<div class="form-group">
					<label>Aplicar filtro de asistencia</label>
					<select name="Filtro" class="form-control" placeholder="Seleccione filtro">
						<?php foreach ($filtro as $item): ?>
							<?php if (set_value('Filtro') != $item): ?>
								<option value="<?=$item?>"><?= $item?></option>
							<?php else: ?>
								<option value="<?=$item?>" selected><?=$item?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
		</div>
	</form>
	<div class="col-lg-4">
	</div>
	<!-- /.col-lg-4 -->

<?=$page['footer']?>

