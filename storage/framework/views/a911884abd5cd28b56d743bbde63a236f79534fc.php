<?php $__env->startSection('title', 'Preguntas Frecuentes'); ?>
<?php $__env->startSection('linkStyleSheets'); ?>   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div ng-app="FaqsPublic" class="containerleads container">
        <br>
        <?php if(Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e(Session::get('success')); ?></p>
            </div>
        <?php endif; ?>
        <div class="container">
            <ng-view>
            </ng-view>
        </div>

    </div>
    <script src="<?php echo e(asset('js/appFaqPublic/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appFaqPublic/services/myService.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appFaqPublic/controllers/Controller.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>