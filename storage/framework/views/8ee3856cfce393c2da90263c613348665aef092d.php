<?php $__env->startSection('content'); ?>

    <div class="containerleads container">
        <br>
        <?php if(Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e(Session::get('success')); ?></p>
            </div>
        <?php endif; ?>
    ------------------------------------------------------------------------------------------------------------------------------------------------------
	<div class="row tituloLeads">
		<div class="col-12">
			<h3>Consulta de Leads </h3>
		</div>
	</div>

    <script src="<?php echo e(asset('/appCanalDigital/app.js')); ?>"></script>
    <script src="<?php echo e(asset('/appCanalDigital/services/myService.js')); ?>"></script>
    <script src="<?php echo e(asset('/appCanalDigital/controllers/leadsController.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>