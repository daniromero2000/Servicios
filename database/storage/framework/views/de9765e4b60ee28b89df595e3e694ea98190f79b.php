<?php $__env->startSection('content'); ?>
	<div class="row resetRow">
		<div class="col-12 text-center resetCol thankContainer">
			<div class="containerThankPage">	
				<img src="<?php echo e(asset('images/imageThankPage.jpg')); ?>" class="img-fluid">
			</div>
			<div class="dialogThakPage">	
				<img src="<?php echo e(asset('images/dialogThankPage.png')); ?>" class="img-fluid">
				<p>	Tu solicitud de crédito no ha sido aprobada, un asesor de crédito hará una verificación y se comunicará contigo.</p>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>