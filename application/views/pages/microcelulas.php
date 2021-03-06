<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-md-8">
		<h1 class="page-header">Microcelulas</h1>
	</div>
	<div class="col-md-4">
		<ul class="nav nav-pills custbuttons">
			<li role="showlist">
				<a class="btn btn-primary" href="<?=site_url('Microcelula/insertItem/'.$userdata['idGrupo'])?>"><i class="fa fa-plus-square fa-fw"></i></a>
			</li>
		</ul>
	</div>
	<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>

	<!-- /.col-lg-12 -->
	<div class="col-lg-11">
		<div class="table">
			<table class="table table-striped table-bordered table-hover" id="dataTablesEvento">
				<thead>
					<tr>
						<th style="width:100px;">Nombre</th>
						<th>Descripci&oacute;n</th>
						<th style="width:10px;">Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($records as $item): ?>
						<tr>
							<td>
								<?=$item['Nombre']?>
							</td>
							<td>
								<?=$item['Descripcion']?>
							</td>
							<td class="row-center">
								<div class="btn-group">
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Acción <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li>
											<a href="<?=site_url('integrante/index/'.$item['idGrupo'].'/'.$item['idMicrocelula'])?>" id="">
											<i class="fa fa-user-circle fa-fw"></i> Ver Integrantes
											</a>
										</li>
										<li role="separator" class="divider"></li>
										<li>
											<a href="<?=site_url('Microcelula/updateItem/'.$item['idGrupo'].'/'.$item['idMicrocelula'])?>">
											<i class="fa fa-pencil-square-o fa-fw"></i> Actualizar
											</a>
										</li>
										<li>
											<a href="<?=site_url('Microcelula/deleteItem/'.$item['idGrupo'].'/'.$item['idMicrocelula'])?>">
											<i class="fa fa-trash-o fa-fw"></i> Eliminar
											</a>
										</li>
									</ul>
								</div>												
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<!-- /.table-responsive -->
	</div>
	<!-- /.col-lg-12 -->

<?=$page['footer']?>

