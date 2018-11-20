<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<h1 class="page-header">Lista de Asistencia <?php if(isset($FechaEvento)){ echo $FechaEvento;}?></h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
	<div class="col-lg-8">
		<div class="table">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Apellidos</th>
						<th>Nombres</th>
						<th>Cédula</th>
						<th>Dirección</th>
						<th>Telefono</th>
						<th>Celular</th>
						<th>Email</th>
						<th>Nacimiento</th>
						<th>Género</th>
						<th>Estado Civil</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($records as $item): ?>
						<tr>
							<td>
								<?= strtoupper($item['Apellido']) ?>
							</td>
							<td>
								<?= strtoupper($item['Nombre']) ?>
							</td>
							<td>
								<?= $item['DocumentoNo'] ?>
							</td>
							<td>
								<?= $item['Direccion'] ?>
							</td>
							<td>
								<?= $item['TelefonoResidencia'] ?>
							</td>
							<td>
								<?= $item['TelefonoMovil'] ?>
							</td>
							<td>
								<?= $item['Email'] ?>
							</td>
							<td>
								<?= $item['FechaNacimiento'] ?>
							</td>
							<td>
								<?= $item['Genero'] ?>
							</td>
							<td>
								<?= $item['EstadoCivil'] ?>
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

