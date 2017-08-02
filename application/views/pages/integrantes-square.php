<?=$page['header']?>

<?=$page['menu']?>

	<div class="col-lg-12">
		<div class="col-lg-9">
			<h1 class="page-header">Integrantes</h1>
		</div>
		<div class="col-lg-2">
			<br><br>
			<ul class="nav nav-pills">
				<li role="showlist">
					<a href="<?=site_url('Integrante/index/'.$userdata['idGrupo'])?>"><span class="glyphicon glyphicon-th-list"></span></a>
				</li>
				<li role="showlist" class="active">
					<a href="<?=site_url('Integrante/index/'.$userdata['idGrupo'].'///square')?>"><span class="glyphicon glyphicon-th"></span></a>
				</li>
			</ul>
		</div>
	</div>
	<?php if ($print <> '') { echo "<pre>";print_r($print['records'][1]);echo "</pre>"; } ?>
	<!-- /.col-lg-12 -->
	<div class="col-lg-12">

		<div class="col-lg-11">
			<?php foreach ($records as $item): ?>
				<?php 
				if ($item['foto_filename'] === '') {
					$img_name  = 'Foto'.$item['idPersona'];
					if ($item['Genero'] == 'Masculino') {
						$img_src = base_url('').'public/images/default/avatar2.png';
					} else {
						$img_src = base_url('').'public/images/default/avatar5.png';
					}
					$img_size = array(0,0);
				} else {
					$img_name = $item['foto_filename'];
					$img_src  = base_url('').'public/images/integrantes/'.$item['foto_filename'];
					$img_size = getimagesize($img_src);
				} 
				if ($img_size[0] < $img_size[1]) {
					$img_class = "portrait";
				} else {
					$img_class = "";
				}
				$img_title = strtoupper($item['Nombre'].' '.$item['Apellido']);
				if ($item['NombreConyugue'] !== '') {
					$img_title = $img_title . ' Y ';
					$img_title = $img_title . strtoupper($item['NombreConyugue'].' '.$item['ApellidoConyugue']); 
				}
				?>
				<div class="col-lg-3">
							<a class="example-image-link" href="<?= $img_src ?>" data-lightbox="example-set" data-title="<?= $img_title ?>">
					<div class="thumbnail">
						<div>
								<img src="<?= $img_src ?>" class="<?= $img_class ?>">
						</div>
						<div class="asquare">
							<?= $img_title ?> &nbsp; 
						</div>
					</div>
							</a>
				</div>
			<?php endforeach; ?>
		</div><!-- /.col-lg-4 -->

		<div class="col-lg-12">
			<a class="btn btn-primary" href="<?=site_url('Integrante/insertItem')?>"><i class="fa fa-user fa-fw"></i> Crear Integrante</a>
		</div>
		<!-- /.table-responsive -->
	</div>
	<!-- /.col-lg-12 -->

<?=$page['footer']?>

