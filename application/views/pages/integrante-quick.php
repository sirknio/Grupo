<?=$page['header']?>

<?=$page['menu']?>

<?php $item = ''; ?>

<div class="col-lg-12">
		<?= form_open_multipart('Integrante/insertQuickItem/Crear'); ?>
		<div class="row">
			<div class="col-lg-6">
				<h1 class="page-header">Integrante</h1>
				<?php if (isset($txtError)): ?>
					<?php if ($tipoError == 'e'): ?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?= $txtError; ?>
					</div>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
			</div>
		</div>
		<!-- /.col-lg-12 -->
		<div class="row">
			<div class="col-lg-6">
				<input name="idEvento" type="hidden" value="<?= set_value('idEvento')?>">
				<input name="idGrupo" type="hidden" value="<?= set_value('idGrupo')?>">
				<input name="idMicrocelula" type="hidden" value="<?= set_value('idMicrocelula')?>">
				<input name="FechaIngreso" type="hidden" value="<?= set_value('FechaIngreso')?>">
				<div class="form-group quick-form-group">
					<input name="Nombre" class="form-control" placeholder="Nombres Completos" value="<?= set_value('Nombre')?>" autocomplete="off" required>
				</div>
				<div class="form-group quick-form-group">
					<input name="Apellido" class="form-control" placeholder="Apellidos" value="<?= set_value('Apellido')?>" autocomplete="off" required>
				</div>
				<div class="form-group quick-form-group">
					<div class="input-group date form_birthdate" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
					<input class="form-control" name="FechaNacimiento" size="16" type="text" <?php if (set_value('FechaNacimiento') != '0000-00-00') echo "value=".'"'.set_value('FechaNacimiento').'"';?> placeholder="Fecha Nacimiento" required readonly>
						<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					</div>
					<input type="hidden" id="dtp_input2" value="" />
				</div>
				<div class="form-group quick-form-group">
					<select name="DocumentoTipo" class="form-control" placeholder="Seleccione Tipo Documento" autocomplete="off" required>
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
				<div class="form-group quick-form-group">
					<input name="DocumentoNo" class="form-control" placeholder="Documento Identidad" value="<?= set_value('DocumentoNo')?>" onkeypress="return valida(event)"autocomplete="off" required>
				</div>
				<div class="form-group quick-form-group">
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
				<div class="form-group quick-form-group">
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
				<div class="form-group quick-form-group">
					<input name="TelefonoMovil" class="form-control" placeholder="Telefono Celular" value="<?= set_value('TelefonoMovil')?>" required>
				</div>
				<div class="form-group quick-form-group">
					<input name="TelefonoResidencia" class="form-control" placeholder="Telefono Residencia" value="<?= set_value('TelefonoResidencia')?>">
				</div>
				<div class="form-group quick-form-group">
					<input name="Direccion" class="form-control" placeholder="Direccion" value="<?= set_value('Direccion')?>">
				</div>
				<div class="form-group quick-form-group">
					<input name="Email" class="form-control" placeholder="Correo Electrónico" value="<?= set_value('Email')?>" required>
				</div>
			</div>
			<div class="col-lg-8">
				<button type="submit" class="btn btn-primary"><i class="fa fa-users fa-fw"></i> 
					Crear
				</button>
				<a class="btn btn-default" href="<?=site_url('asistencia/index/'.set_value('idGrupo'))?>">Cancelar</a>
			</div>
		</div>
	</form>
</div>

<?=$page['footer']?>

