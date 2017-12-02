<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<h1 class="page-header">Configuración General</h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
    <?= form_open_multipart('Aplicacion/updateItem'); ?>
		<div class="col-lg-6">
			<div class="form-group">
				<label>No. Limite de Eventos en Dashboard</label>
				<input name="LimiteEventosDashboard" class="form-control" placeholder="Limite Eventos Dashboard" value="<?= set_value('LimiteEventosDashboard')?>" required>
			</div>
			<!--
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
			-->
		</div>
		<div class="col-lg-12">
			<button type="submit" class="btn btn-primary"><i class="fa fa-cogs fa-fw"></i> 
				Actualizar Configuración		
			</button>
		</div>
	</form>
	<div class="col-lg-4">
	</div>
	<!-- /.col-lg-4 -->

<?=$page['footer']?>

