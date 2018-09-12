<?=$page['header']?>

<?= form_open_multipart('Aplicacion/updateItem'); ?>
<?=$page['menu']?>

<div class="col-lg-12">
	<h1 class="page-header">Configuración General</h1>
	<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
</div>
<!-- /.col-lg-12 -->
<div class="col-lg-3">
	<div class="form-group">
		<label>Cantidad Eventos Dashboard</label>
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
	
</form>
<?=$page['footer']?>

