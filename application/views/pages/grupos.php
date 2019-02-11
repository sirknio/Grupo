<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-md-8">
		<h1 class="page-header">Grupos</h1>		
	</div>
	<div class="col-md-4">
		<ul class="nav nav-pills custbuttons">
			<li role="showlist">
				<a class="btn btn-primary" href="<?=site_url('Grupo/insertItem')?>"><i class="fa fa-plus-square fa-fw"></i></a>
			</li>
		</ul>
	</div>
	<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>

	<!-- /.col-lg-12 -->
	<div class="col-md-11">
		<div class="table">
			<table class="table table-striped table-bordered table-hover" style="width:100%" id="dataTables-integrantes">
				<thead>
					<tr>
						<th>Logo</th>
						<th>Nombre Grupo</th>
						<th style="width:100px;">Selecci&oacute;n</th>
						<th>Descripci&oacute;n</th>
						<th style="width:10px;">Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($records as $item): ?>
						<tr>
							<td style="text-align:center;">
								<?php if ($item['logo_filename'] === ''): ?>
									<a class="example-image-link" href="<?=base_url('')?>public/images/default/avatar2.png" 
										data-lightbox="Logo<?= $item['idGrupo']; ?>" 
										data-title="<?=$item['Nombre']?>: <?=$item['Descripcion']?>">
										<img src="<?=base_url('')?>public/images/default/avatar2.png" class="logo-circle" style="width:36px">
									</a>
								<?php else: ?>
									<a class="example-image-link" href="<?=base_url('')?>public/images/grupos/<?= $item['logo_filename']?>" 
										data-lightbox="<?= $item['logo_filename'] ?>" 
										data-title="<?=$item['Nombre']?>: <?=$item['Descripcion']?>">
										<img src="<?=base_url('')?>public/images/grupos/<?= $item['logo_filename']?>" class="logo-circle" style="width:36px">
									</a>
								<?php endif; ?>
							</td>
							<td>
								<?=$item['Nombre']?>
							</td>
							<td>
								<?php if ($userdata['TipoUsuario'] == 'Admin'): ?>
									<?php if ($userdata['idGrupo'] === $item['idGrupo']): ?>
										<a class="btn btn-success btn-block" href="<?=site_url('Grupo/selectGroup')?>">
											Desmarcar
										</a>
									<?php else: ?>
										<a class="btn btn-default btn-block" href="<?=site_url('Grupo/selectGroup/'.$item['idGrupo'])?>">
											Seleccionar
										</a>
									<?php endif; ?>
								<?php endif; ?>
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
											<a href="<?=site_url('integrante/index/'.$item['idGrupo'])?>" id="">
											<i class="fa fa-user-circle fa-fw"></i> Ver Integrantes
											</a>
										</li>
										<li>
											<a href="<?=site_url('microcelula/index/'.$item['idGrupo'])?>" id="">
											<i class="fa fa-users fa-fw"></i> Ver Microcelulas
											</a>
										</li>
										<li role="separator" class="divider"></li>
										<li>
											<a href="<?=site_url('Grupo/updateItem/'.$item['idGrupo'])?>">
											<i class="fa fa-pencil-square-o fa-fw"></i> Actualizar
											</a>
										</li>
										<li>
											<a href="<?=site_url('Grupo/deleteItem/'.$item['idGrupo'])?>">
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

