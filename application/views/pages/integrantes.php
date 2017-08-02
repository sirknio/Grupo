<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<div class="col-lg-9">
			<h1 class="page-header">Integrantes</h1>
		</div>
		<div class="col-lg-2">
			<br><br>
			<ul class="nav nav-pills">
				<li role="showlist" class="active">
					<a href="<?=site_url('Integrante/index/'.$userdata['idGrupo'])?>"><span class="glyphicon glyphicon-th-list"></span></a>
				</li>
				<li role="showlist">
					<a href="<?=site_url('Integrante/index/'.$userdata['idGrupo'].'/0/0/square')?>"><span class="glyphicon glyphicon-th"></span></a>
				</li>
			</ul>
		</div>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
	<div class="col-lg-11">
		<div class="table">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th style="width:50px;">Foto</th>
						<!-- <th style="width:80px;">Código</th> -->
						<th style="width:150px;">Nombre</th>
						<th style="width:80px;">Micro</th>
						<th>Telefono</th>
						<th>Email</th>
						<th style="width:10px;">Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($records as $item): ?>
						<tr>
							<td style="text-align:center;">
								<?php if ($item['foto_filename'] === '') {
									$img_name  = 'Foto'.$item['idPersona'];
									if ($item['Genero'] == 'Masculino') {
										$img_src = base_url('').'public/images/default/avatar2.png';
									} else {
										$img_src = base_url('').'public/images/default/avatar5.png';
									}
								} else {
									$img_name = $item['foto_filename'];
									$img_src  = base_url('').'public/images/integrantes/'.$item['foto_filename'];
								} 
								$img_title = $item['Nombre'].' '.$item['Apellido'];
								?>
								<a class="example-image-link" href="<?= $img_src ?>" data-lightbox="<?= $img_name ?>" 
									data-title="<?= $img_title ?>">
									<img src="<?= $img_src ?>" class="logo-circle" style="width:36px">
								</a>
							</td>
							<!-- <td class="row-center">
								<input name="idPersona" type="hidden" value="<?=$item['idPersona']?>">
								<?=$item['idPersona']?>
							</td> -->
							<td>
								<?=$item['Nombre']?>&nbsp;<?=$item['Apellido']?>
							</td>
							<td class="row-center">
								<?=$item['NombreMicro']?>
							</td>
							<td>
								<?=$item['TelefonoMovil']?>
							</td>
							<td>
								<?=$item['Email']?>
							</td>
							<td class="row-center">
								<div class="btn-group  btn-group-sm">
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Acción <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li>
											<a href="<?=site_url('Integrante/updateItem/'.$item['idPersona'])?>">
											<i class="fa fa-pencil-square-o fa-fw"></i> Actualizar
											</a>
										</li>
										<li>
											<a data-toggle="modal" data-target="#deleteModal" data-code="<?= $item['idPersona']?>" data-name="<?= $item['Nombre']?>" data-surname="<?= $item['Apellido']?>">
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
		<div class="col-lg-12">
			<a class="btn btn-primary" href="<?=site_url('Integrante/insertItem')?>"><i class="fa fa-user fa-fw"></i> Crear Integrante</a>
		</div>
		<!-- /.table-responsive -->
	</div>
	<!-- /.col-lg-12 -->

<?=$page['footer']?>

