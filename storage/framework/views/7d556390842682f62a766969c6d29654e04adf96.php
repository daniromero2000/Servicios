 
<?php $__env->startSection('content'); ?>
 <div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> <?php echo e($user->name); ?></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?php echo e(route('users.index')); ?>"> Regresar </a>
            </div>
        </div>
    </div>
 
 
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email</strong>
                <?php echo e($user->email); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tipo de Usuario</strong>
                <?php if($user->idProfile==1): ?>
                    <span>Administrador</span>
                <?php elseif($user->idProfile==2): ?>
                    <span>Líder Canal Dígital</span>
                <?php else: ?>
                    <span>Community Manager</span>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
 </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>