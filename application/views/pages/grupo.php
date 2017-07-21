<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<h1 class="page-header">Grupo</h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
	<?php if (!$update): ?>
		<?= form_open_multipart('Grupo/insertItem/Crear'); ?>
	<?php else: ?>
		<?= form_open_multipart('Grupo/updateItem/'.set_value('idGrupo').'/Update'); ?>
	<?php endif; ?>
		<div class="col-lg-6">
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
				<select name="idLider1" class="form-control" required>
					<option value=""> </option>
					<?php foreach ($lider as $item): ?>
						<?php if (set_value('idLider1') != $item['idPersona']): ?>
							<option value="<?=$item['idPersona']?>"><?=$item['Nombre'].' '.$item['Apellido']?></option>
						<?php else: ?>
							<option value="<?=$item['idPersona']?>" selected><?=$item['Nombre'].' '.$item['Apellido']?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Lider 2</label>
				<select name="idLider2" class="form-control">
					<option value=""> </option>
					<?php foreach ($lider as $item): ?>
						<?php if (set_value('idLider2') != $item['idPersona']): ?>
							<option value="<?=$item['idPersona']?>"><?=$item['Nombre'].' '.$item['Apellido']?></option>
						<?php else: ?>
							<option value="<?=$item['idPersona']?>" selected><?=$item['Nombre'].' '.$item['Apellido']?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-12">
			<button type="submit" class="btn btn-primary"><i class="fa fa-users fa-fw"></i> 
			<?php if (!$update): ?>
				Crear Grupo
			<?php else: ?>
				Actualizar Grupo
			<?php endif; ?>
			
			</button>
			<a class="btn btn-default" href="<?=site_url('Grupo')?>">Cancelar</a>
		</div>
	</form>

<?=$page['footer']?>

