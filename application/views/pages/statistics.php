<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<h1 class="page-header">Estadísticas</h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
	<div class="col-lg-8">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart"></i> Asistencia General
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div id="bar-asistencia"></div>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart"></i> Asistencia General
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div id="bar-asistencia-genre"></div>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart"></i> Formación Iglesia
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div id="bar-formacionIglesia"></div>
				</div>
				<!-- /.panel-body -->
			</div>
		</div>
		<!-- /.panel -->
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart"></i> Integrantes por Microcelula
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div id="donut-asistencia"></div>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-6 -->
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart"></i> Estado Civil
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div id="donut-estadocivil"></div>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-6 -->
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart"></i> Edad Hijo Mayor
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div id="donut-EdadHijoMayor"></div>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-6 -->
		
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bell fa-fw"></i> Habilidades
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
	</div>
	<!-- /.col-lg-8 -->
	<div class="col-lg-4">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<i class="fa fa-warning"></i> Alertas por revisar
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
	</div>
	<!-- /.col-lg-4 -->

<?=$page['footer']?>

