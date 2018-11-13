<?php $__env->startSection('linkStyleSheets'); ?>
    <link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-switcher/master/dist/angular-switcher.min.css">
    <link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div ng-app="leadsApp" class="containerleads container">
        <br>
        <?php if(Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e(Session::get('success')); ?></p>
            </div>
        <?php endif; ?>
        <div class="container">
            <ng-view></ng-view>
        </div>

    </div>
    <script src="<?php echo e(asset('js/appCanalDigital/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appCanalDigital/services/myService.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appCanalDigital/controllers/leadsController.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scriptsJs'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
        <script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>