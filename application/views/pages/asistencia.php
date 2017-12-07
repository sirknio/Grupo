<?=$page['header']?>

<?=$page['menu']?>

	<?= form_open_multipart('Asistencia/checkAsist'); ?>
		<div class="col-lg-12"><h4></h4></div>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
		<div class="col-lg-3">
			<?php if (!isset($no_evento)) :?>
				<div class="row">
					<input name="idEvento" type="hidden" value="<?= set_value('idEvento')?>">
					<input name="idGrupo" type="hidden" value="<?= set_value('idGrupo')?>">
					<div class="form-group">
						<label>Ingrese No. de Identificación</label>
						<input name="DocumentoNo" class="form-control" type="number" placeholder="Número de Cédula" autofocus required autocomplete="off">
					</div>
					<div class="form-group">
						<center>
							<button type="submit" class="btn btn-primary">
								Registrar Asistencia <?= $asistcant ?>
							</button>
						</center>
					</div>
					<!--<div class="form-group">
						<center>
							<a class="btn btn-success" href="<?=site_url('Integrante/insertItem')?>">
								Crear Asistente
							</a>
							 <a class="btn btn-warning">
								Buscar
							</a>
						</center>
					</div> -->
				</div>
				<div class="row">
					&nbsp;
				</div>
				<div class="row">
					<?php if (isset($success)): ?> 
						<div class="alert alert-success"><?= $success ?></div>
					<?php endif; ?>
					<?php if (isset($error)): ?>
						<div class="alert alert-danger"><?= $error ?></div>
					<?php endif; ?>
				</div>
			<?php else :?>
				<div class="alert alert-danger"><?= $no_evento ?></div>
			<?php endif; ?>
		</div>
		<!-- /.col-lg-4 -->
	</form>

<?=$page['footer']?>

