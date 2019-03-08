<?=$page['header']?>

<?=$page['menu']?>

<?php $item = ''; ?>
	<div class="col-md-12">
		<div class="col-8 col-md-8">
			<h1 class="page-header"><?= $records[0]['Nombre'].' '.$records[0]['Apellido'] ?></h1>
			<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
		</div>
		<div class="col-4 col-md-4">
			<a class="btn btn-default custbuttons" href="<?=site_url('Integrante/index/'.$userdata['idGrupo'])?>" title="Volver">
				<i class="fa fa-arrow-left"></i>
			</a>
		</div>
	</div>
	<!-- /.col-lg-12 -->
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="chat-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-comments fa-fw"></i> Reporte Novedades </h3>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-news">
					<ul class="chat">
						<?php $counter = 0; ?>
						<?php foreach ($news as $item): ?>
						<li class="clearfix">
							<div class="chat-body clearfix">
								<div class="header">
									<?php if ($item['ImportanteUrgente']): ?>
									<button type="button" class="btn btn-danger btn-circle"><i class="fa fa-exclamation"></i></button>
									<?php endif; ?>
									<strong class="primary-font"><?=$item['NombreUsuario']?></strong>
									<small class="pull-right text-muted">
										<?php if ($userdata['TipoUsuario'] == 'Lider'): ?>
											<?php if ($item['LeidoLider'] == ''): ?>
											<span class="badge badge-warning">Sin Leer</span>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ($userdata['TipoUsuario'] == 'Microlider'): ?>
											<?php if ($item['LeidoMicro'] == ''): ?>
											<span class="badge badge-warning">Sin Leer</span>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ($userdata['TipoUsuario'] == 'Admin'): ?>
											<?php if (($lider) && ($item['LeidoLider'] == '')): ?>
											<span class="badge badge-warning">Sin Leer</span>
											<?php endif; ?>
											<?php if (($colider) && ($item['LeidoMicro'] == '')): ?>
											<span class="badge badge-warning">Sin Leer</span>
											<?php endif; ?>
										<?php endif; ?>
										<i class="fa fa-clock-o fa-fw"></i> <?=$item['diffText']?>
									</small>
								</div>
								<p>
									<?=$item['Novedad']?> 
								</p>
							</div>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<!-- /.panel-body -->
				<?= form_open_multipart('Integrante/createNewsItem/'.$records[0]['idPersona'].'/insert'); ?>
				<div class="panel-footer">
					<div class="col-10">
						<div class="input-group">
							<input type="hidden" name="idPersona" value="<?= $records[0]['idPersona'] ?>">
							<input id="btn-input" type="text" name="Novedad" class="form-control input-sm" placeholder="Escriba el reporte aqui..."  autofocus />
							<span class="input-group-btn">
								<button type="submit" class="btn btn-warning btn-sm" id="btn-chat">
									Reportar
								</button>
							</span>
						</div>
					</div>
					<div class="col-2">
						<div class="input-group">
							<input type="checkbox" name="ImportanteUrgente" title="Marcar como Urgente/Importante" />
							&nbsp; <i class="fa fa-exclamation fa-fw"></i> Urgente/Importante
						</div>
					</div>
				</form>
				</div>
				<!-- /.panel-footer -->
			</div>
			<!-- /.panel .chat-panel -->
		</div>
	</div>

<?=$page['footer']?>
