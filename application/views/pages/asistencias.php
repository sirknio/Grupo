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
						<th>Apellido</th>
						<th>Nombre</th>
						<th>Cédula</th>
						<th>Telefono</th>
						<th>E-mail</th>
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
								<?= $item['TelefonoMovil'] ?>
							</td>
							<td>
								<?= $item['Email'] ?>
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

