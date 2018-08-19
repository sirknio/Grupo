<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<h1 class="page-header">Usuarios</h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
	<div class="col-lg-11">
		<div class="table">
			<table class="table table-striped table-bordered table-hover" id="dataTableDefault">
				<thead>
					<tr>
						<th style="width:100px;">Usuario</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Email</th>
						<th style="width:100px;">Tipo Usuario</th>
						<th style="width:70px;">Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($records as $item): ?>
						<tr>
							<td>
								<?=$item['Usuario']?>
							</td>
							<td>
								<?=$item['Nombre']?>
							</td>
							<td>
								<?=$item['Apellido']?>
							</td>
							<td>
								<?=$item['Email']?>
							</td>
							<td>
								<?=$item['TipoUsuario']?>
							</td>
							<td class="row-center">
								<div class="btn-group btn-group-sm">
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Acción <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li>
											<a href="<?=site_url('Usuario/updateItem/'.$item['idUsuario'])?>">
											<i class="fa fa-pencil-square-o fa-fw"></i> Actualizar
											</a>
										</li>
										<li>
											<a href="<?=site_url('Usuario/deleteItem/'.$item['idUsuario'])?>">
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

