<?=$page['header']?>

<?=$page['menu']?>
	<div class="col-md-12">
		<h1 class="page-header">Dashboard</h1>
		<?php if ($print) { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<?php if ($userdata['TipoUsuario'] == 'Admin'): ?>
	<div class="col-md-12">
		<div class="col-md-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-comments fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?= $cant_grupos ?></div>
							<div>Grupos de Conexion</div>
						</div>
					</div>
				</div>
				<a href="<?=site_url('grupo')?>">
					<div class="panel-footer">
						<span class="pull-left">Ver Grupos</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-3 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-tasks fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?= $cant_micros ?></div>
							<div>Microcelulas</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">&nbsp;</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-3 col-md-6">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-users fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?= $cant_personas ?></div>
							<div>Integrantes</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">&nbsp;</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-3 col-md-6">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-calendar fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?= $cant_eventos ?></div>
							<div>Eventos</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">&nbsp;</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!-- /.col-md-4 -->
	<div class="col-md-8">
		<?php if (!empty($asistencia)): ?>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart"></i> Asistencia General
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body autoscroll panel-dashboard">
					<div id="bar-asistencia" class="autoscroll panel-dashboard-graphic"></div>
				</div>
				<!-- /.panel-body -->
				<a href="statistics.html">
					<div class="panel-footer">
						<span class="pull-left">Ver Estadísticas</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
					<!-- panel-footer -->
				</a>
			</div>
			<!-- /.panel -->
		</div>
		<?php endif; ?>
		<?php if (!empty($eventos)): ?>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-calendar-o fa-fw"></i> Cronograma de Actividades
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body autoscroll panel-dashboard">
					<div class="table-responsive autoscroll panel-dashboard-calendar">
						<table class="table table-striped table-hover">
							<?php foreach ($eventos as $item): ?>
								<?php if ($month != $item['FechaEvento']) : ?>
									<thead>
										<tr>
											<th><?= $item['NomFechaEvento'] ?></th>
										</tr>
									</thead>
									<?php $month = $item['FechaEvento']; ?>
								<?php endif; ?>
									
									<tr>
										<td><?= $item['Nombre'] ?></td>
									</tr>
							<?php endforeach; ?>
						</table>
					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
				<!-- <a href="agenda.html"> -->
					<div class="panel-footer">
						<span class="pull-left">&nbsp;</span>
						<!-- <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
						<div class="clearfix"></div>
					</div>
					<!-- panel-footer -->
				<!-- </a> -->
				<!-- a footer -->
			</div>
			<!-- /.panel -->
		</div>
		<?php endif; ?>
		<!-- /.col-md-4 -->
		<?php if (!empty($birhtdays)): ?>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-birthday-cake fa-fw"></i> Cumpleaños
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body autoscroll panel-dashboard">
					<div class="table-responsive autoscroll panel-dashboard-calendar">
						<table class="table table-striped table-hover">
							<?php foreach ($birhtdays as $item): ?>
								<?php if ($month1 != $item['FechaEvento']) : ?>
									<thead>
										<tr>
											<th><?= $item['NomFechaEvento'] ?></th>
										</tr>
									</thead>
									<?php $month1 = $item['FechaEvento']; ?>
								<?php endif; ?>
									
									<tr>
										<td><?= $item['Nombre'] ?></td>
									</tr>
							<?php endforeach; ?>
						</table>
					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
				<!-- <a href="agenda.html"> -->
					<div class="panel-footer">
						<span class="pull-left">&nbsp;</span>
						<!-- <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
						<div class="clearfix"></div>
					</div>
					<!-- panel-footer -->
				<!-- </a> -->
				<!-- a footer -->
			</div>
			<!-- /.panel -->
		</div>
		<?php endif; ?>
		<!-- /.col-md-4 -->
			
		<?php if (!empty($annivers)): ?>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-heart fa-fw"></i> Aniversarios
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body autoscroll panel-dashboard">
					<div class="table-responsive autoscroll panel-dashboard-calendar">
						<table class="table table-striped table-hover">
							<?php foreach ($annivers as $item): ?>
								<?php if ($month2 != $item['FechaEvento']) : ?>
									<thead>
										<tr>
											<th><?= $item['NomFechaEvento'] ?></th>
										</tr>
									</thead>
									<?php $month2 = $item['FechaEvento']; ?>
								<?php endif; ?>
									
									<tr>
										<td><?= $item['Nombre'] ?></td>
									</tr>
							<?php endforeach; ?>
						</table>
					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
				<!-- <a href="agenda.html"> -->
					<div class="panel-footer">
						<span class="pull-left">&nbsp;</span>
						<!-- <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
						<div class="clearfix"></div>
					</div>
					<!-- panel-footer -->
				<!-- </a> -->
				<!-- a footer -->
			</div>
			<!-- /.panel -->
		</div>
		<?php endif; ?>
		<!-- /.col-md-4 -->
	</div>
	<!-- /.col-md-4 -->

	<div class="col-md-4">
	<?php if (empty($notif)): ?>
		<div class="panel panel-default">
			<div class="panel-heading"> 
				<i class="fa fa-warning"></i> Notificaciones (Ulltimo Evento)
			</div>
			<div class="panel-body">
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						2 Integrantes completaron 10 inasistencias.
					</div>
					<!-- /.alert -->
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						2 Integrantes servidores completaron 3 meses de inasistencias.
					</div>
					<!-- /.alert -->
					<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						Los hijos mayores de 4 Integrantes ya cumplieron los 8 años.
					</div>
					<!-- /.alert -->
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						6 Integrantes completaron 3 meses de asistencia. Invitalos a Encuentro!
					</div>
					<!-- /.alert -->
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						6 Integrantes acaban de completar Nivel 3. Invitalos a Conquistadores!
					</div>
					<!-- /.alert -->
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						14 Integrantes ya se encuentran sirviendo pero aún no han ido a Conquistadores. Anímalos a Consquitadores!
					</div>
					<!-- /.alert -->
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						10 Integrantes ya se encuentran sirviendo. Anímalos a Berea!
					</div>
					<!-- /.alert -->
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						16 Integrantes cumplieron 6 meses sin ausencia.
					</div>
					<!-- /.alert -->
			</div>
		</div>
	<?php endif; ?>
	</div>
			
<?=$page['footer']?>

<script>
	$(function() {
		// Bar Chart
		Morris.Bar({
			element: 'bar-asistencia',
			data: [
			<?php foreach ($asistencia as $item): ?>
			{
				asistencia: '<?= $item['FechaEvento'] ?>',
				p: <?= $item['Asistencia'] ?>
			},
			<?php endforeach; ?>
			],
			xkey: 'asistencia',
			ykeys: ['p'],
			labels: ['Integrantes'],
			barRatio: 0.4,
			xLabelAngle: 35,
			hideHover: 'auto',
			resize: true
		});	
	});
</script>
