<?php $__env->startSection('title', 'Oportunidades Sevicios - Nuestras tiendas.'); ?>

<?php $__env->startSection('content'); ?>
	<div id="ourStores">
		<h1 class="menuItem-title text-center">Nuestras Tiendas</h1>
		<div class="container">
			<div class="row resetRow">
				<div class="col-12 col-sm-8 offset-sm-2">
					<div id="acorddion">
						<?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="card">
								<div class="card-header" id="heading<?php echo e($store['number']); ?>">
									<h5 class="mb-0">
									<button class="btn btn-link ourStores-titleStore" data-toggle="collapse" data-target="#store<?php echo e($store['number']); ?>" aria-expanded="false" aria-controls="store<?php echo e($store['number']); ?>">
										<?php echo e($store['name']); ?>

									</button>
									</h5>
								</div>

								<div id="store<?php echo e($store['number']); ?>" class="collapse <?php if($store['number'] == 1): ?> show <?php endif; ?>" aria-labelledby="heading<?php echo e($store['number']); ?>" data-parent="#acorddion">
									<div class="card-body">
										<?php echo e($store['name']); ?> <br>
										<?php echo e($store['addres']); ?> <br>
										<?php echo e($store['city']); ?> <br>
										<?php echo e($store['telephone']); ?>

									</div>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>