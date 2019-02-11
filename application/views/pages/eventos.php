<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-md-8">
		<h1 class="page-header">Eventos</h1>
	</div>
	<div class="col-md-4">
		<ul class="nav nav-pills custbuttons">
			<li role="showlist">
				<a class="btn btn-primary" href="<?=site_url('Evento/insertItem')?>"><i class="fa fa-plus-square fa-fw"></i></a>
			</li>
		</ul>
	</div>
	<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>

	<!-- /.col-lg-12 -->
	<div class="col-md-11">
		<div class="table">
			<table class="table table-striped table-bordered table-hover" id="dataTablesEvento">
				<thead>
					<tr>
						<th style="width:60px;">Fecha</th>
						<th>Nombre</th>
						<th style="width:100px;">Estado</th>
						<th style="width:10px;">Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($records as $item): ?>
						<tr>
							<td>
								<?=$item['FechaEvento']?>
							</td>
							<td>
								<?=$item['Nombre']?>
							</td>
							<td>
								<?php if ($item['TomarAsistencia'] === '1'): ?>
									<?php if ($item['Estado'] === 'Creado'): ?>
										<a class="btn btn-success btn-block" href="<?=site_url('Evento/openEvent/'.$item['idEvento'])?>">
											Abrir Asistencia
										</a>
									<?php elseif ($item['Estado'] === 'Abierto'): ?>
										<a class="btn btn-warning btn-block" href="<?=site_url('Evento/closeEvent/'.$item['idEvento'])?>">
											Cerrar Asistencia
										</a>
									<?php elseif ($item['Estado'] === 'Cerrado'): ?>
										<a class="btn btn-default btn-block" href="<?=site_url('Evento/showAssistance/'.$item['idEvento'])?>">
											Ver Asistencia
										</a>
									<?php endif; ?>
								<?php else: ?>
									<a class="btn btn-default btn-block">
										Informativo
									</a>
								<?php endif; ?>
							</td>
							<td class="row-center">
								<div class="btn-group">
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Acción <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li>
											<a href="<?=site_url('Evento/updateItem/'.$item['idEvento'])?>">
											<i class="fa fa-pencil-square-o fa-fw"></i> Cambiar
											</a>
										</li>
										<?php if ($item['Estado'] == 'Creado'): ?>
										<li>
											<a href="<?=site_url('Evento/deleteItem/'.$item['idEvento'])?>">
											<i class="fa fa-trash-o fa-fw"></i> Eliminar
											</a>
										</li>
										<?php endif; ?>
										<?php if ($item['Estado'] == 'Cerrado'): ?>
										<li>
											<a href="<?=site_url('Evento/showNewAssistance/'.$item['idEvento'])?>">
											<i class="fa fa-list fa-fw"></i> Ver Nuevos
											</a>
										</li>
										<li>
											<a href="<?=site_url('Evento/reopenEvent/'.$item['idEvento'])?>">
											<i class="fa fa-calendar fa-fw"></i> Reabrir Asistencia
											</a>
										</li>
										<li>
											<a href="<?=site_url('Evento/createStats/'.$item['idEvento'])?>">
											<i class="fa fa-pie-chart fa-fw"></i> Crear Estadisticas
											</a>
										</li>
										<?php endif; ?>
										<?php if ($item['Estado'] == 'Abierto'): ?>
										<li>
											<a href="<?=site_url('Evento/showAssistance/'.$item['idEvento'])?>">
											<i class="fa fa-list fa-fw"></i> Verificar Lista
											</a>
										</li>
										<?php endif; ?>
									</ul>
								</div>												
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="col-lg-12">
			<a class="btn btn-primary" href="<?=site_url('Evento/insertItem')?>"><i class="fa fa-calendar fa-fw"></i> Crear Evento</a>
		</div>
		<!-- /.table-responsive -->
	</div>
	<!-- /.col-lg-12 -->
	<div class="col-lg-3  col-lg-offset-1">
		<div class="table">
			<?= $calendario	?>
		</div>
	</div>

<?=$page['footer']?>

