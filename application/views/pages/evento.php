<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<h1 class="page-header">Evento</h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
	<? if (!$update): ?>
		<?= form_open_multipart('Evento/insertItem/Crear'); ?>
	<? else: ?>
		<?= form_open_multipart('Evento/updateItem/'.set_value('idEvento').'/Update'); ?>
	<? endif; ?>
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
					<option value="0" <? if (set_value('TomarAsistencia') === '0'): ?> selected <? endif; ?>>
						Evento solo informativo
					</option>
					<option value="1" <? if (set_value('TomarAsistencia') === '1'): ?> selected <? endif; ?>>
						Evento con Asistencia
					</option>
				</select>
			</div>
				<div class="form-group">
					<label>Aplicar filtro de asistencia</label>
					<select name="Filtro" class="form-control" placeholder="Seleccione filtro">
						<? foreach ($filtro as $item): ?>
							<? if (set_value('Filtro') != $item): ?>
								<option value="<?=$item?>"><?= $item?></option>
							<? else: ?>
								<option value="<?=$item?>" selected><?=$item?></option>
							<? endif; ?>
						<? endforeach; ?>
					</select>
				</div>
		</div>
		<div class="col-lg-12">
			<button type="submit" class="btn btn-primary"><i class="fa fa-calendar fa-fw"></i> 
			<? if (!$update): ?>
				Crear Evento
			<? else: ?>
				Actualizar Evento
			<? endif; ?>
			
			</button>
			<a class="btn btn-default" href="<?=site_url('Evento')?>">Cancelar</a>
		</div>
	</form>
	<div class="col-lg-4">
	</div>
	<!-- /.col-lg-4 -->

<?=$page['footer']?>

