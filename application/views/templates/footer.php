					<div class="col-lg-12"><h6>&nbsp;</h6></div>
										
					<!-- modal fade -->
					<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<!-- modal-dialog -->
						<div class="modal-dialog" role="document">
						<!-- modal-content -->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Eliminar integrante</h4>
							</div>
							<div class="modal-body">
							  <?php echo form_open(site_url("Integrante/deleteItem"), array("class" => "form-horizontal")) ?>
								<div class="form-group">
									<div class="col-lg-12">
										<h5>Esta seguro que desea eliminar el integrante?</h5>
									</div>
									<input type="hidden" class="form-control" name="idPersona" id="idPersona" value="0" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								<input type="submit" class="btn btn-primary" value="Eliminar Integrante">
							</div>
							<?php echo form_close() ?>
						</div>
						<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal fade -->
					
				</div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?=base_url('')?>public/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url('')?>public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url('')?>public/vendor/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?=base_url('')?>public/vendor/bootstrap/js/bootstrap-datetimepicker.es.js"></script>
	<script src="<?=base_url('')?>public/vendor/custom/datepicker.js"></script>
	<script src="<?=base_url('')?>public/vendor/custom/custom.js"></script>
    <script src="<?=base_url('')?>public/vendor/moment/moment.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url('')?>public/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- 
	********************************************************************************************************************
	VALIDAR SI LAS LIBRERIAS DE DATATABLES, MORRIS Y LIGHTBOX  SON NECESARIAS EN LA PAGINA, SI NO NO CARGARLAS
	********************************************************************************************************************
	-->

    <!-- DataTables JavaScript -->
    <script src="<?=base_url('')?>public/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url('')?>public/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
	<script src="<?=base_url('')?>public/vendor/datatables-responsive/dataTables.responsive.js"></script>
	<?php if (isset($mobile) && $mobile): ?>
	<script src="<?=base_url('')?>public/vendor/custom/datatable.mobile.js"></script>
	<?php else: ?>
	<script src="<?=base_url('')?>public/vendor/custom/datatable.js"></script>
	<?php endif; ?>

    <!-- Morris Charts JavaScript -->
    <script src="<?=base_url('')?>public/vendor/raphael/raphael.min.js"></script>
    <script src="<?=base_url('')?>public/vendor/morrisjs/morris.min.js"></script>
    <script src="<?=base_url('')?>public/data/morrisjs/<?= $morrisjs ?>"></script>

    <!-- Lightbox for show images on modal popoup -->
	<script src="<?=base_url('')?>public/vendor/lightbox/js/lightbox.js"></script>

    <!-- 
	********************************************************************************************************************
	-->
    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url('')?>public/vendor/sbadmin/js/sb-admin-2.js"></script>

	<!-- Page-Level Demo Scripts - Tables - Use for reference -->


</body>

</html>
