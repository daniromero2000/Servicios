

<?php $__env->startSection('title', 'Viajes'); ?>

<?php $__env->startSection('metaTags'); ?>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div id="construccion">
		<div class="container">
			<h2 class="creditoLibranza-title text-center">Esta sección está actualmente en construcción</h2>
			<p class="text-center">Si te interesa conocer más sobre nuestros créditos para viajes, déjanos tus datos y un asesor se pondrá en contacto</p>
			<div class="modalFormulario-body" style="margin: auto;">
				<div class="modal-containerFormulario">
					<h3 class="modal-titleForm titleForm-viajes">Viajes</h3>
					<form role=form method="POST" id="saveLeadViajes" action="<?php echo e(route('viajes.store')); ?>">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="typeProduct" value="Viajes">
						<input type="hidden" name="typeService" value="Viajes">
						<div class="form-group">
							<label for="name" class="control-label">Nombres</label>
							<input type="text" name="name" class="form-control" id="name" required="true" />
						</div>
						<div class="form-group">
							<label for="lastName" class="control-label">Apellidos</label>
							<input type="text" name="lastName" class="form-control" id="lastName" required="true" />
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Correo electrónico</label>
							<input type="email" name="email" class="form-control" id="email" required="true" />
						</div>
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono</label>
							<input type="text" name="telephone" class="form-control" id="telephone" required="true" />
						</div>
						<div class="form-group">
							<label for="ciudad class="control-label">Ciudad</label>
							<select name="city" id="city" class="form-control" >
								<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($city['value']); ?>"><?php echo e($city['label']); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
								Guardar
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>