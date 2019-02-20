<?=$page['header']?>

<?=$page['menu']?>

<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	<div class="col-md-8">
		<h1 class="page-header">Log de Cambios</h1>
	</div>
	<div class="col-md-4">
		<ul class="nav nav-pills custbuttons">
			<li>
				<a class="btn btn-primary" href="<?=site_url('Usuario/insertItem')?>"><i class="fa fa-plus-square fa-fw"></i></a>
			</li>
		</ul>
	</div>

	<!-- /.col-lg-12 -->
	<div class="col-md-8">
		<div class="table">
			<table class="table table-striped table-bordered table-hover" id="dataTables-integrantes">
				<thead>
					<tr>
						<th>Fecha Log</th>
						<th>Usuario</th>
						<th>ID Grupo</th>
						<th>ID Grupo</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Tipo Usuario</th>
						<th>Tabla</th>
						<th>Cambio</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($records as $item): ?>
					<?php $dateNow = new DateTime($item['FechaLog']); ?>
						<tr>
							<td>
								<?=$dateNow->format('Y-m-d H:i')?>
							</td>
							<td>
								<?=$item['Usuario']?>
							</td>
							<td>
								<?=$item['idGrupo']?>
							</td>
							<td>
								<?=$item['GrupoNombre']?>
							</td>
							<td>
								<?=$item['Nombre']?>
							</td>
							<td>
								<?=$item['Apellido']?>
							</td>
							<td>
								<?=$item['TipoUsuario']?>
							</td>
							<td>
								<?=$item['TablaNombre']?>
							</td>
							<td>
								<?=$item['TipoCambio']?>
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

