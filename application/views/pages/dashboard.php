<?=$page['header']?>

<?=$page['menu']?>
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard</h1>
		<?php if ($print) { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-4 -->
	<div class="col-lg-4">
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
	<!-- /.col-lg-4 -->
	<div class="col-lg-4">
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
	<!-- /.col-lg-4 -->
		
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
