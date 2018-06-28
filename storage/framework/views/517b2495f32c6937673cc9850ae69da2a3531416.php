<?php $__env->startSection('content-title', 'Dashboard'); ?>

<?php $__env->startSection('content-subtitle', 'Panel de Control' ); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Dashboard</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>