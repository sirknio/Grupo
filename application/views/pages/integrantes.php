<?=$page['header']?>

<?=$page['menu']?>

<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	<div class="col-md-8">
		<h1 class="page-header">Integrantes</h1>
	</div>
	<div class="col-md-4">
		<ul class="nav nav-pills custbuttons">
			<li>
				<a class="btn btn-primary" href="<?=site_url('Integrante/insertItem')?>"><i class="fa fa-plus-square fa-fw"></i></a>
			</li>
			<li role="showlist" class="active">
				<a href="<?=site_url('Integrante/index/'.$userdata['idGrupo'])?>"><span class="glyphicon glyphicon-th-list"></span></a>
			</li>
			<li role="showlist">
				<a href="<?=site_url('Integrante/index/'.$userdata['idGrupo'].'/0/0/square')?>"><span class="glyphicon glyphicon-th"></span></a>
			</li>
		</ul>
	</div>
	
	<!-- /.col-lg-12 -->
	<div class="col-md-11">
		<div class="table">
			<table class="table table-striped table-bordered table-hover display" style="width:100%" id="dataTables-integrantes">
				<thead>
					<tr>
						<th style="width:50px;">Foto</th>
						<!-- <th style="width:80px;">Código</th> -->
						<th>Nombre</th>
						<?php if (!$mobile): ?>
						<th style="width:80px;">Micro</th>
						<?php endif; ?>
						<th>Documento</th>
						<?php if (!$mobile): ?>
						<th>Telefono</th>
						<th>Fecha Nacimiento</th>
						<th>Fecha Matrimonio</th>
						<th>Email</th>
						<?php endif; ?>
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
									<img src="<?= $img_src ?>" class="logo-circle" style="width:36px;height:36px">
								</a>
							</td>
							<!-- <td class="row-center">
								<input name="idPersona" type="hidden" value="<?=$item['idPersona']?>">
								<?=$item['idPersona']?>
							</td> -->
							<td>
								<?=$item['Nombre']?>&nbsp;<?=$item['Apellido']?>
							</td>
							<?php if (!$mobile): ?>
							<td class="row-center">
								<?=$item['NombreMicro']?>
							</td>
							<?php endif; ?>
							<td>
								<?=$item['DocumentoNo']?>
							</td>
							<?php if (!$mobile): ?>
							<td>
								<?=$item['TelefonoMovil']?>
							</td>
							<td>
								<?=$item['FechaNacimiento']?>
							</td>
							<td>
								<?=$item['FechaMatrimonio']?>
							</td>
							<td>
								<?=$item['Email']?>
							</td>
							<?php endif; ?>
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
											<a href="<?=site_url('Integrante/createNewsItem/'.$item['idPersona'])?>">
											<i class="fa fa-table fa-fw"></i> Reportar Novedad
											</a>
										</li>
										<li class="divider"></li>
										<?php if ((!empty($inactivos)) && ($inactivos['idMicrocelula'] != $item['idMicrocelula'])): ?>
										<li>
											<a data-toggle="modal" data-target="#archiveModal" data-code="<?= $item['idPersona']?>" data-name="<?= $item['Nombre']?>" data-surname="<?= $item['Apellido']?>">
											<i class="fa fa-archive fa-fw"></i> Pasar Inactivo
											</a>
										</li>
										<?php endif; ?>
										<?php if ($userdata['TipoUsuario'] == 'Admin'): ?>
										<li>
											<a data-toggle="modal" data-target="#deleteModal" data-code="<?= $item['idPersona']?>" data-name="<?= $item['Nombre']?>" data-surname="<?= $item['Apellido']?>">
											<i class="fa fa-trash-o fa-fw"></i> Eliminar
											</a>
										</li>
										<?php endif; ?>
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

