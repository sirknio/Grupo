<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<h1 class="page-header">Integrante</h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
	<? if (!$update): ?>
		<?= form_open_multipart('Integrante/insertItem/Crear'); ?>
	<? else: ?>
		<?= form_open_multipart('Integrante/updateItem/'.set_value('idPersona').'/Update'); ?>
	<? endif; ?>
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
								<option value=""> </option>
								<? foreach ($DocumentoTipo as $item): ?>
									<? if (set_value('DocumentoTipo') != $item): ?>
										<option value="<?=$item?>"><?= $item?></option>
									<? else: ?>
										<option value="<?=$item?>" selected><?=$item?></option>
									<? endif; ?>
								<? endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Número Documento</label>
							<input name="DocumentoNo" class="form-control" placeholder="Documento Identidad" value="<?= set_value('DocumentoNo')?>" onkeypress="return valida(event)" required>
						</div>
						<div class="form-group">
							<label>Genero</label>
							<select name="Genero" class="form-control" placeholder="Seleccione Genero" required>
								<option value=""> </option>
								<? foreach ($Genero as $item): ?>
									<? if (set_value('Genero') != $item): ?>
										<option value="<?=$item?>"><?= $item?></option>
									<? else: ?>
										<option value="<?=$item?>" selected><?=$item?></option>
									<? endif; ?>
								<? endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Fecha Nacimiento</label>
							<div class="input-group date form_birthdate" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
								<input class="form-control" name="FechaNacimiento" size="16" type="text" value="<?= set_value('FechaNacimiento')?>" placeholder="Seleccione Fecha" readonly>
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
								<option value=""> </option>
								<? foreach ($EstadoCivil as $item): ?>
									<? if (set_value('EstadoCivil') != $item): ?>
										<option value="<?=$item?>"><?= $item?></option>
									<? else: ?>
										<option value="<?=$item?>" selected><?=$item?></option>
									<? endif; ?>
								<? endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Conyugue</label>
							<select name="idConyugue" class="form-control">
								<option value=""> </option>
								<? foreach ($Persona as $item): ?>
									<? if (set_value('idConyugue') != $item['idPersona']): ?>
										<option value="<?=$item['idPersona']?>"><?=$item['Nombre'].' '.$item['Apellido']?></option>
									<? else: ?>
										<option value="<?=$item['idPersona']?>" selected><?=$item['Nombre'].' '.$item['Apellido']?></option>
									<? endif; ?>
								<? endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Fecha Matrimonio</label>
							<div class="input-group date form_birthdate" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
								<input class="form-control" name="FechaMatrimonio" size="16" type="text" value="<?= set_value('FechaMatrimonio')?>" placeholder="Seleccione Fecha" readonly>
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
						<h3 class="panel-title">Iglesia</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Fecha Ingreso</label>
							<div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
								<input class="form-control" name="FechaIngreso" size="16" type="text" value="<?= set_value('FechaIngreso')?>" placeholder="Seleccione Fecha" readonly>
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<input type="hidden" id="dtp_input2" value="" /><br/>
						</div>
						<div class="form-group">
							<label>Microcelula</label>
							<select name="idMicrocelula" class="form-control" required>
								<option value=""> </option>
								<? foreach ($Micros as $item): ?>
									<? if (set_value('idMicrocelula') != $item['idMicrocelula']): ?>
										<option value="<?=$item['idMicrocelula']?>"><?=$item['Descripcion']?></option>
									<? else: ?>
										<option value="<?=$item['idMicrocelula']?>" selected><?=$item['Descripcion']?></option>
									<? endif; ?>
								<? endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Habilidades</label>
							<? foreach ($Habilidades as $item): ?>
								<? if (set_value('Habilidades') != $item): ?>
									<br><input type="checkbox" name="Habilidades" value="<?=$item?>"> <?=$item?>
								<? else: ?>
									<br><input type="checkbox" name="Habilidades" value="<?=$item?>" checked> <?=$item?>
								<? endif; ?>
							<? endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<? if (isset($idEvent)): ?>
				<? else: ?>
					<button type="submit" class="btn btn-primary"><i class="fa fa-users fa-fw"></i> 
					<? if (!$update): ?>
						Crear Integrante
					<? else: ?>
						Actualizar Integrante
					<? endif; ?>
					</button>
					<a class="btn btn-default" href="<?=site_url('Integrante')?>">Cancelar</a>
				<? endif; ?>
			</div>
		</div>
	</form>

<?=$page['footer']?>

