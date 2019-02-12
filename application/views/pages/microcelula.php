<?=$page['header']?>

<?=$page['menu']?>

<?php $item = ''; ?>

	<?php if (!$update): ?>
		<?= form_open_multipart('Microcelula/insertItem/'.$userdata['idGrupo'].'/Create'); ?>
	<?php else: ?>
		<?= form_open_multipart('Microcelula/updateItem/'.$userdata['idGrupo'].'/'.set_value('idMicrocelula').'/Update'); ?>
	<?php endif; ?>

		<div class="col-md-12">
			<div class="col-8 col-md-8">
				<h1 class="page-header">Microcelula</h1>
				<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
			</div>
			<div class="col-4 col-md-4">
				<?php if (isset($idEvent)): ?>
				<?php else: ?>
					<!-- <a class="btn btn-primary" href="<?=site_url('Microcelula')?>" title="Abrir Reporte"><i class="fa fa-comments fa-fw"></i></a> -->
					<button type="submit" class="btn btn-primary custbuttons"
					<?php if (!$update): ?>
						title="Crear nueva Microcelula"><i class="fa fa-plus-square fa-fw"></i>
					<?php else: ?>
						title="Actualizar Microcelula"><i class="fa fa-pencil-square-o fa-fw"></i>
					<?php endif; ?>
					</button>
					<a class="btn btn-default" href="<?=site_url('Microcelula/index/'.$userdata['idGrupo'])?>" title="Cancelar"><i class="fa fa-times-circle"></i></a>
				<?php endif; ?>
			</div>
		</div>
		<!-- /.col-lg-12 -->
		<div class="col-md-12">
			<div class="col-md-6">
				<input name="idGrupo" class="form-control" type="hidden" value="<?= $userdata['idGrupo']?>">
				<div class="form-group">
					<label>Código</label>
					<input name="Nombre" class="form-control" placeholder="Nombre" value="<?= set_value('Nombre')?>">
				</div>
				<div class="form-group">
					<label>Descripción</label>
					<input name="Descripcion" class="form-control" placeholder="Descripción" value="<?= set_value('Descripcion')?>">
				</div>

				<div class="form-group">
					<label>Tipo Microcelula</label>
					<select name="TipoMicro" class="form-control" placeholder="Seleccione Tipo Microcelula">
						<?php foreach ($TipoMicro as $item): ?>
							<?php if (set_value('TipoMicro') != $item): ?>
								<option value="<?=$item?>"><?= $item?></option>
							<?php else: ?>
								<option value="<?=$item?>" selected><?=$item?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group">
					<label>Colider 1</label>
					<select name="idColider1" class="form-control">
						<option value=""> </option>
						<?php foreach ($colider as $item): ?>
							<?php if (set_value('idColider1') != $item['idUsuario']): ?>
								<option value="<?=$item['idUsuario']?>"><?=$item['Nombre'].' '.$item['Apellido']?></option>
							<?php else: ?>
								<option value="<?=$item['idUsuario']?>" selected><?=$item['Nombre'].' '.$item['Apellido']?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Colider 2</label>
					<select name="idColider2" class="form-control">
						<option value=""> </option>
						<?php foreach ($colider as $item): ?>
							<?php if (set_value('idColider2') != $item['idUsuario']): ?>
								<option value="<?=$item['idUsuario']?>"><?=$item['Nombre'].' '.$item['Apellido']?></option>
							<?php else: ?>
								<option value="<?=$item['idUsuario']?>" selected><?=$item['Nombre'].' '.$item['Apellido']?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
		<!-- <div class="col-lg-12">
			<button type="submit" class="btn btn-primary"><i class="fa fa-users fa-fw"></i> 
			<?php if (!$update): ?>
				Crear Microcelula
			<?php else: ?>
				Actualizar Microcelula
			<?php endif; ?>
			
			</button>
			<a class="btn btn-default" href="<?=site_url('Microcelula')?>">Cancelar</a>
		</div> -->
	</form>

<?=$page['footer']?>

