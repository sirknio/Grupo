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
	<?php if (!empty($asistencia)): ?>
	<div class="col-md-4">
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
	<!-- /.col-md-4 -->
	<?php if (!empty($eventos)): ?>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-calendar-o fa-fw"></i> Cronograma de Actividades
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body autoscroll panel-dashboard">
				<div class="table-responsive autoscroll panel-dashboard-calendar">
					<table class="table table-striped table-hover">
						<?php foreach ($eventos as $item): ?>
							<?php if ($date != $item['FechaEvento']) : ?>
								<thead>
									<tr>
										<th><?= $item['FechaEvento'] ?></th>
									</tr>
								</thead>
								<?php $date = $item['FechaEvento']; ?>
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
			<a href="agenda.html">
				<div class="panel-footer">
					<span class="pull-left">Ver Calendario Eventos</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
				<!-- panel-footer -->
			</a>
			<!-- a footer -->
		</div>
		<!-- /.panel -->
	</div>
	<?php endif; ?>
	<!-- /.col-md-4 -->
		
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
