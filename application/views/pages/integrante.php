<?=$page['header']?>

<?=$page['menu']?>

<?php $item = ''; ?>

	<div class="col-lg-12">
		<h1 class="page-header">Integrante</h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
	<?php if (!$update): ?>
		<?= form_open_multipart('Integrante/insertItem/Crear'); ?>
	<?php else: ?>
		<?= form_open_multipart('Integrante/updateItem/'.set_value('idPersona').'/Update'); ?>
	<?php endif; ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="col-sm-4">
					<div id="line-assistance" class="autoscroll assist-graphic"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Datos Básicos</h3>
					</div>
					<div class="panel-body">
						<input name="idEvento" type="hidden" value="<?= set_value('idEvento')?>">
						<input name="idGrupo" type="hidden" value="<?= set_value('idGrupo')?>">
						<div class="form-group">
							<label>Foto</label>
							<input type="file" name="foto" class="form-group" capture="camera">
						</div>
						<div class="form-group">
							<label>Nombre</label>
							<input name="Nombre" class="form-control" placeholder="Nombre" value="<?= set_value('Nombre')?>" required>
						</div>
						<div class="form-group">
							<label>Apellido</label>
							<input name="Apellido" class="form-control" placeholder="Apellido" value="<?= set_value('Apellido')?>" required>
						</div>
						<div class="form-group">
							<label>Tipo Documento</label>
							<select name="DocumentoTipo" class="form-control" placeholder="Seleccione Tipo Documento" required>
							<option value="" hidden>Tipo Documento</option>
								<?php foreach ($DocumentoTipo as $item): ?>
									<?php if (set_value('DocumentoTipo') != $item): ?>
										<option value="<?=$item?>"><?= $item?></option>
									<?php else: ?>
										<option value="<?=$item?>" selected><?=$item?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Número Documento</label>
							<input name="DocumentoNo" class="form-control" placeholder="Documento Identidad" value="<?= set_value('DocumentoNo')?>" onkeypress="return valida(event)" required>
						</div>
						<div class="form-group">
							<label>Genero</label>
							<select name="Genero" class="form-control" placeholder="Seleccione Genero" required>
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
							<label>Fecha Nacimiento</label>
							<div class="input-group date form_birthdate" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
							<input class="form-control" name="FechaNacimiento" size="16" type="text" <?php if (set_value('FechaNacimiento') != '0000-00-00') echo "value=".'"'.set_value('FechaNacimiento').'"';?> placeholder="Fecha Nacimiento" readonly>
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<input type="hidden" id="dtp_input2" value="" /><br/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Comunicación</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Correo Electrónico</label>
							<input name="Email" class="form-control" placeholder="Correo Electrónico" value="<?= set_value('Email')?>" required>
						</div>
						<div class="form-group">
							<label>Teléfono Celular</label>
							<input name="TelefonoMovil" class="form-control" placeholder="Telefono Celular" value="<?= set_value('TelefonoMovil')?>" required>
						</div>
						<div class="form-group">
							<label>Telefono Residencia</label>
							<input name="TelefonoResidencia" class="form-control" placeholder="Telefono Residencia" value="<?= set_value('TelefonoResidencia')?>">
						</div>
						<div class="form-group">
							<label>Telefono Oficina</label>
							<input name="TelefonoOficina" class="form-control" placeholder="Telefono Oficina" value="<?= set_value('TelefonoOficina')?>">
						</div>
						<div class="form-group">
							<label>Dirección</label>
							<input name="Direccion" class="form-control" placeholder="Direccion" value="<?= set_value('Direccion')?>">
						</div>
						<div class="form-group">
							<label>Profesion</label>
							<input name="Profesion" class="form-control" placeholder="Profesion" value="<?= set_value('Profesion')?>">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Estado Civil</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Estado Civil</label>
							<select name="EstadoCivil" class="form-control" placeholder="Seleccione Estado Civil">
							<option value="" hidden>Estado Civil</option>
								<?php foreach ($EstadoCivil as $item): ?>
									<?php if (set_value('EstadoCivil') != $item): ?>
										<option value="<?=$item?>"><?= $item?></option>
									<?php else: ?>
										<option value="<?=$item?>" selected><?=$item?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Conyugue</label>
							<select name="idConyugue" class="form-control">
							<option value="" hidden>Conyugue</option>
								<?php foreach ($Persona as $item): ?>
									<?php if (set_value('idConyugue') != $item['idPersona']): ?>
										<?php if (($item['idConyugue'] == 0) && (set_value('Genero') != $item['Genero'])): ?>
											<option value="<?=$item['idPersona']?>"><?=$item['Nombre'].' '.$item['Apellido']?></option>
										<?php endif; ?>
									<?php else: ?>
										<option value="<?=$item['idPersona']?>" selected><?=$item['Nombre'].' '.$item['Apellido']?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Fecha Matrimonio</label>
							<div class="input-group date form_birthdate" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
							<input class="form-control" name="FechaMatrimonio" size="16" type="text" <?php if (set_value('FechaMatrimonio') != '0000-00-00') echo "value=".'"'.set_value('FechaMatrimonio').'"';?> placeholder="Fecha Matrimonio" readonly>
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<input type="hidden" id="dtp_input2" value="" /><br/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Grupo Conexi&oacute;n (Solo para Microl&iacute;der)</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Fecha Ingreso</label>
							<div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
							<input class="form-control" name="FechaIngreso" size="16" type="text" value="<?= set_value('FechaIngreso')?>" placeholder="Fecha Ingreso" readonly>
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<input type="hidden" id="dtp_input2" value="" /><br/>
						</div>
						<div class="form-group">
							<label>Microcelula</label>
							<select name="idMicrocelula" class="form-control" required>
							<option value="" hidden>Microcelula</option>
								<?php foreach ($Micros as $item): ?>
									<?php if (set_value('idMicrocelula') != $item['idMicrocelula']): ?>
										<option value="<?=$item['idMicrocelula']?>"><?=$item['Descripcion']?></option>
									<?php else: ?>
										<option value="<?=$item['idMicrocelula']?>" selected><?=$item['Descripcion']?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Habilidades</label>
							<?php foreach ($Habilidades as $item): ?>
								<?php if (set_value('Habilidades') != $item): ?>
									<br><input type="checkbox" name="Habilidades" value="<?=$item?>"> <?=$item?>
								<?php else: ?>
									<br><input type="checkbox" name="Habilidades" value="<?=$item?>" checked> <?=$item?>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<?php if (isset($idEvent)): ?>
			<?php else: ?>
				<button type="submit" class="btn btn-primary"><i class="fa fa-users fa-fw"></i> 
				<?php if (!$update): ?>
					Crear Integrante
				<?php else: ?>
					Actualizar Integrante
				<?php endif; ?>
				</button>
				<a class="btn btn-default" href="<?=site_url('Integrante')?>">Cancelar</a>
			<?php endif; ?>
		</div>
	</form>

<?=$page['footer']?>

<script>
	$(function() {
		var week_data = [
			{"period": "2018-01-01", "asistencia": 1},
			{"period": "2018-01-07", "asistencia": 1},
			{"period": "2018-02-03", "asistencia": 1},
			{"period": "2018-02-10", "asistencia": 0},
			{"period": "2018-03-07", "asistencia": 1},
			{"period": "2018-05-05", "asistencia": 1},
			{"period": "2018-07-07", "asistencia": 1},
			{"period": "2018-08-08", "asistencia": 0},
			{"period": "2018-09-09", "asistencia": 1},
		];

	Morris.Line({
		element: 'line-assistance',
		axes: false,
		data: week_data,
		xkey: 'period',
		ykeys: ['asistencia'],
		labels: ['Asistencia'],
		barRatio: 0,
		hideHover: 'auto',
		resize: true,
		parseTime: false
	});

	// Bar Chart
	Morris.Bar({
		element: 'graph-default',
		data: [
		<?php if(isset($asistencia)): ?>
			<?php foreach ($asistencia as $item): ?>
			{
				asistencia: '<?= $item['FechaEvento'] ?>',
				p: <?= $item['Asistencia'] ?>
			},
			<?php endforeach; ?>
		<?php endif; ?>
		],
		xkey: 'asistencia',
		ykeys: ['p'],
		labels: ['Integrantes'],
		barRatio: 0.4,
		xLabelAngle: 35,
		hideHover: 'auto',
		resize: true
	});	
});
</script>

