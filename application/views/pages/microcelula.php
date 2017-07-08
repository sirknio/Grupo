<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<h1 class="page-header">Microcelula</h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
	<? if (!$update): ?>
		<?= form_open_multipart('Microcelula/insertItem/'.$userdata['idGrupo'].'/Create'); ?>
	<? else: ?>
		<?= form_open_multipart('Microcelula/updateItem/'.set_value('idMicrocelula').'/Update'); ?>
	<? endif; ?>
		<div class="col-lg-6">
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
				<label>Colider 1</label>
				<select name="idColider1" class="form-control">
					<option value="0"> </option>
					<? foreach ($colider as $item): ?>
						<? if (set_value('idColider1') != $item['idPersona']): ?>
							<option value="<?=$item['idPersona']?>"><?=$item['Nombre'].' '.$item['Apellido']?></option>
						<? else: ?>
							<option value="<?=$item['idPersona']?>" selected><?=$item['Nombre'].' '.$item['Apellido']?></option>
						<? endif; ?>
					<? endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Colider 2</label>
				<select name="idColider2" class="form-control">
					<option value="0"> </option>
					<? foreach ($colider as $item): ?>
						<? if (set_value('idColider2') != $item['idPersona']): ?>
							<option value="<?=$item['idPersona']?>"><?=$item['Nombre'].' '.$item['Apellido']?></option>
						<? else: ?>
							<option value="<?=$item['idPersona']?>" selected><?=$item['Nombre'].' '.$item['Apellido']?></option>
						<? endif; ?>
					<? endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-12">
			<button type="submit" class="btn btn-primary"><i class="fa fa-users fa-fw"></i> 
			<? if (!$update): ?>
				Crear Microcelula
			<? else: ?>
				Actualizar Microcelula
			<? endif; ?>
			
			</button>
			<a class="btn btn-default" href="<?=site_url('Microcelula')?>">Cancelar</a>
		</div>
	</form>

<?=$page['footer']?>

