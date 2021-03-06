<?=$page['header']?>

<?=$page['menu']?>
	<div class="col-md-12">
		<h1 class="page-header">Dashboard</h1>
		<?php if ($print) { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<?php if (($userdata['TipoUsuario'] == 'Admin') && ($userdata['idGrupo'] == '')): ?>
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

	<?php if (($userdata['idGrupo'] != '')): ?>
	<div class="col-md-12">
		<div class="col-md-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-calendar-o fa-5x"></i>
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
		<div class="col-md-3 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-user fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?= $cant_nuevos ?></div>
							<div>Integrantes Nuevos</div>
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
							<div class="huge"><?= $cant_activ ?></div>
							<div>Integrantes Activos</div>
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
							<i class="fa fa-user-o fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?= $cant_inact ?></div>
							<div>Integrantes Inactivos</div>
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
				<a href="">
					<div class="panel-footer">
						<span class="pull-left">&nbsp;</span>
						<span class="pull-right">
							<!-- <i class="fa fa-arrow-circle-right"></i> -->
						</span>
						<div class="clearfix"></div>
					</div>
					<!-- panel-footer -->
				</a>
			</div>
			<!-- /.panel -->
		</div>
		<?php endif; ?>

		<div class="col-md-6">
			<?php if ((!empty($eventos)) || (!empty($birhtdays)) || (!empty($annivers))): ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-calendar-o fa-fw"></i> Calendario <?= $month ?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="list-group">
						<?php if(!empty($eventos)): ?>
						<a href="#" class="list-group-item">
							<i class="fa fa-calendar fa-fw"></i><b>&nbsp;Cronograma <?= $month ?></b> <br>
							<?php foreach ($eventos as $item): ?>
							<i class="fa fa-c fa-fw"></i><?= $item['Nombre'] ?><br>
							<?php endforeach; ?>
							<!-- &nbsp;
							<span class="pull-right text-muted small"><em>Ver mas</em>
							</span> -->
						</a>
						<?php endif; ?>
						<?php if(!empty($birhtdays)): ?>
						<a href="#" class="list-group-item">
							<i class="fa fa-birthday-cake fa-fw"></i><b>&nbsp;Cumpleaños <?= $month ?></b> <br>
							<?php foreach ($birhtdays as $item): ?>
							<i class="fa fa-c fa-fw"></i><?= $item['Nombre'] ?><br>
							<?php endforeach; ?>
							<!-- &nbsp;
							<span class="pull-right text-muted small"><em>Ver mas</em>
							</span> -->
						</a>
						<?php endif; ?>
						<?php if(!empty($annivers)): ?>
						<a href="#" class="list-group-item">
							<i class="fa fa-heart fa-fw"></i><b>&nbsp;Aniversarios  <?= $month ?></b> <br>
							<?php foreach ($annivers as $item): ?>
							<i class="fa fa-c fa-fw"></i><?= $item['Nombre'] ?><br>
							<?php endforeach; ?>
							<!-- &nbsp;
							<span class="pull-right text-muted small"><em>Ver mas</em>
							</span> -->
						</a>
						<?php endif; ?>
					</div>
					<!-- /.list-group -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		<?php endif; ?>
		</div>

			



		<?php if (($userdata['idGrupo'] != '')): ?>
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bell fa-fw"></i> Integrantes Fuera de Filtro
				</div>
				<div class="panel-body">
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse01">
										<i class="fa fa-comment fa-fw"></i>
										Música (4)
									</a>
								</h4>
							</div>
							<div id="collapse01" class="panel-collapse collapse">
								<div class="panel-body">
									<div> Erick Rojas </div> 
									<div> Carlos Arboleda </div> 
									<div> Edwin Velandia </div> 
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse02">
										<i class="fa fa-warning fa-fw"></i> Artes y Manualidades (28)
									</a>
								</h4>
							</div>
							<div id="collapse02" class="panel-collapse collapse">
								<div class="panel-body">
									<div> Erick Rojas </div> 
									<div> Carlos Arboleda </div> 
									<div> Edwin Velandia </div> 													
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse03">
										<i class="fa fa-users fa-fw"></i> Apoyo Social (6)
									</a>
								</h4>
							</div>
							<div id="collapse03" class="panel-collapse collapse">
								<div class="panel-body">
									<div> Erick Rojas </div> 
									<div> Carlos Arboleda </div> 
									<div> Edwin Velandia </div> 													
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse04">
										<i class="fa fa-users fa-fw"></i> Niños (16)
									</a>
								</h4>
							</div>
							<div id="collapse04" class="panel-collapse collapse">
								<div class="panel-body">
									<div> Erick Rojas </div> 
									<div> Carlos Arboleda </div> 
									<div> Edwin Velandia </div> 													
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse05">
										<i class="fa fa-upload fa-fw"></i> Dinámicas (10)
									</a>
								</h4>
							</div>
							<div id="collapse05" class="panel-collapse collapse">
								<div class="panel-body">
									<div> Erick Rojas </div> 
									<div> Carlos Arboleda </div> 
									<div> Edwin Velandia </div> 													
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse06">
										<i class="fa fa-upload fa-fw"></i> Decoración (10)
									</a>
								</h4>
							</div>
							<div id="collapse06" class="panel-collapse collapse">
								<div class="panel-body">
									<div> Marcela Meza </div> 
									<div> Tashee Ceballos </div> 
									<div> Andrés Roa </div> 
								</div>
							</div>
						</div>
					</div>
					<!-- /.panel-group -->
				</div>
			</div>
		</div>

		<?php endif; ?>




			
	</div>
	<!-- /.col-md-4 -->

	<div class="col-md-4">
	<?php if (!empty($notif)): ?>
		<div class="panel panel-default">
			<div class="panel-heading"> 
				<i class="fa fa-bell fa-fw"></i> Panel Notificaciones
			</div>
			<div class="panel-body">
				<?php if(!empty($notif['Absens1'])): ?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?= count($notif['Absens1']) ?> Integrantes completaron 2 meses inasistencias.
					<a class="alert-link" data-toggle="modal" data-target="#listModal" data-title="Integrantes con 2 meses inasistencias" data-name="Absens1">
						<i class="fa fa-eye fa-fw"></i> Ver Integrantes
					</a>
					<div class="oculto">
						<?php foreach ($notif['Absens1'] as $item): ?>
							<div class="Absens1"><?= "(".$item['idPersona'].") ".ucwords(strtolower($item['Nombre']))." ".ucwords(strtolower($item['Apellido']))?></div>
						<?php endforeach; ?>
				</div>
				</div>
				<? endif; ?>
				<?php if(!empty($notif['Absens2'])): ?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?= count($notif['Absens2']) ?> Integrantes completaron 6 meses inasistencias. Pasalo como Inactivo!
					<a class="alert-link" data-toggle="modal" data-target="#listModal" data-title="Integrantes con 6 meses inasistencias" data-name="Absens2">
						<i class="fa fa-eye fa-fw"></i> Ver Integrantes
					</a>
					<div class="oculto">
						<?php foreach ($notif['Absens2'] as $item): ?>
							<div class="Absens2"><?= "(".$item['idPersona'].") ".ucwords(strtolower($item['Nombre']))." ".ucwords(strtolower($item['Apellido']))?></div>
						<?php endforeach; ?>
					</div>
				</div>
				<? endif; ?>
				<?php if(!empty($notif['Assist1'])): ?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?= count($notif['Assist1']) ?> Integrantes completaron 3 meses de asistencia. Invitalos a Encuentro!
					<a class="alert-link" data-toggle="modal" data-target="#listModal" data-title="Integrantes con 3 meses asistencias" data-name="Assist1">
						<i class="fa fa-eye fa-fw"></i> Ver Integrantes
					</a>
					<div class="oculto">
						<?php foreach ($notif['Assist1'] as $item): ?>
							<div class="Assist1"><?= "(".$item['idPersona'].") ".ucwords(strtolower($item['Nombre']))." ".ucwords(strtolower($item['Apellido']))?></div>
						<?php endforeach; ?>
				</div>
				</div>
				<? endif; ?>
				<?php if(!empty($notif['Assist2'])): ?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?= count($notif['Assist2']) ?> Integrantes completaron 6 meses de asistencia. Invitalos a Encuentro!
					<a class="alert-link" data-toggle="modal" data-target="#listModal" data-title="Integrantes con 6 meses asistencias" data-name="Assist2">
						<i class="fa fa-eye fa-fw"></i> Ver Integrantes
					</a>
					<div class="oculto">
						<?php foreach ($notif['Assist2'] as $item): ?>
							<div class="Assist2"><?= "(".$item['idPersona'].") ".ucwords(strtolower($item['Nombre']))." ".ucwords(strtolower($item['Apellido']))?></div>
						<?php endforeach; ?>
					</div>
				</div>
				<? endif; ?>

				<!-- 
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					2 Integrantes completaron 10 inasistencias.
				</div>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					2 Integrantes servidores completaron 3 meses de inasistencias.
				</div>
				<div class="alert alert-warning alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Los hijos mayores de 4 Integrantes ya cumplieron los 8 años.
				</div>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					6 Integrantes completaron 3 meses de asistencia. Invitalos a Encuentro!
				</div>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					6 Integrantes acaban de completar Nivel 3. Invitalos a Conquistadores!
				</div>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					14 Integrantes ya se encuentran sirviendo pero aún no han ido a Conquistadores. Anímalos a Consquitadores!
				</div>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					10 Integrantes ya se encuentran sirviendo. Anímalos a Berea!
				</div>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					16 Integrantes cumplieron 6 meses sin ausencia.
				</div>
				-->
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
