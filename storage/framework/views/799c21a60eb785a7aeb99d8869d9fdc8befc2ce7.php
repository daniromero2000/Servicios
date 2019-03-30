<?php $__env->startSection('content'); ?>
<div class="container containerLogin">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header row">
                	<div class="col-6 loginText">
                		<p> <?php echo e(__('Asesores')); ?> </p>	
                	</div>
                	<div class="col-6 loginLogo">
                		<img src="<?php echo e(asset('images/logoDashboard.png')); ?>">
                	</div>
                	
                </div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('assessors.access')); ?>" id="loginForm">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="codigo" class="col-sm-4 col-form-label text-md-right"><?php echo e(__('Código')); ?></label>

                            <div class="col-md-6">
                                <input id="codigo" type="text" class="form-control<?php echo e($errors->has('codigo') ? ' is-invalid' : ''); ?>" name="codigo" value="<?php echo e(old('codigo')); ?>" required autofocus>

                                <?php if($errors->has('codigo')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('codigo')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="num_doc" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Contraseña')); ?></label>

                            <div class="col-md-6">
                                <input id="num_doc" type="password" class="form-control<?php echo e($errors->has('num_doc') ? ' is-invalid' : ''); ?>" name="num_doc" required>

                                <?php if($errors->has('num_doc')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('num_doc')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="remember">
                                        <?php echo e(__('Recordar')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Iniciar sesión')); ?>

                                </button>

                                <a class="btn btn-link" href="<?php echo e(route('assessors.password.request')); ?>">
                                    <?php echo e(__('¿ Olvidaste tu contraseña ?')); ?>

                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>