<?php if(session()->has('success')): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Operación Exitosa</h4>
        <p><?php echo e(session()->get('success')); ?></p>
    </div>
<?php endif; ?>