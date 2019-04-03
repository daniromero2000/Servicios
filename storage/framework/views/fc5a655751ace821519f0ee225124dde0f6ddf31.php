    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to catalog
    **Date: 18/01/2019
     -->
     


<?php $__env->startSection('content'); ?>
    <div ng-app="PublicApp">
        <ng-view>
        </ng-view>
    </div>
    <script src="<?php echo e(asset('js/appCatalog/appPublic/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appCatalog/appPublic/services/myService.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appCatalog/appPublic/controllers/Controller.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appFooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>