    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to warranty form
    **Date: 05/03/2019
     -->
     


<?php $__env->startSection('content'); ?>

    <div ng-app="WarrantyApp">
        <ng-view>
        </ng-view>
    </div>
    <script src="<?php echo e(asset('js/appWarranty/appPublic/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appWarranty/appPublic/controllers/warranty.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.BasicIncludes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>