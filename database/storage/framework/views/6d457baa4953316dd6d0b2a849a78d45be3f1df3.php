<?php $__env->startSection('linkStyleSheets'); ?>
    <link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div ng-app="customersApp" class="containerleads container">
        <br>
        <?php if(Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e(Session::get('success')); ?></p>
            </div>
        <?php endif; ?> 

        
            <?php if(Auth::guard('assessor')->check()): ?>
            
            <div class="container">
                <ng-view></ng-view>
            </div> 

        <?php else: ?>

            <script type="text/javascript">
                window.location = "/assessor/login";
            </script>  

        <?php endif; ?>

    </div>
    <script src="<?php echo e(asset('js/appClientesAssessor/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appClientesAssessor/services/myService.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appClientesAssessor/controller/clientesAssessors.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scriptsJs'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
        <script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angucomplete-alt/3.0.0/angucomplete-alt.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>