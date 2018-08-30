<button type="submit" class="btn btn-primary"><i class="fa fa-users fa-fw"></i> 
<?php if (!$update): ?>
    Crear
<?php else: ?>
    Actualizar
<?php endif; ?>

</button>
<a class="btn btn-default" href="<?=site_url('Usuario')?>">Cancelar</a>