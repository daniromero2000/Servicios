<?php $__env->startSection('content'); ?>
	<div class="row resetRow">
		<div class="col-12 text-center resetCol thankContainer">
			<div class="containerThankPage">	
				<img src="<?php echo e(asset('images/imageThankPage.jpg')); ?>" class="img-fluid">
			</div>
			<div class="dialogThakPage">	
				<img src="<?php echo e(asset('images/dialogThankPage.png')); ?>" class="img-fluid">
				<p>	Gracias, un asesor de crédito se comunicará contigo para coordinar la entrega del producto.</p>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>