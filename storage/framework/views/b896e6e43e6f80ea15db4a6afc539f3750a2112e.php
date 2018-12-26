<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="row text-center assessorHeader">
			<h3>
				<?php if(Auth::check()): ?>
				 	<?php echo e(Auth::guard('assessor')->user()->NOMBRE); ?>

				<?php endif; ?>
			</h3>
		</div>
		<div class="row">
			<div class="col-6 assessorModule text-center">
				<p>
					<a href="<?php echo e(route('step1Assessor')); ?>">Crédito Oportuya </a>
				</p>	
			</div>
			<div class="col-6 assessorModule text-center">
				<p>
					<a href="<?php echo e(route('step1Assessor')); ?>">Clientes </a>
				</p>	
			</div>			
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>