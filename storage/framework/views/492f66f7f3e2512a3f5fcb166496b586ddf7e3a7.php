    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO FAQS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for FAQS CRUD
    **Fecha: 12/12/2018
     -->


<?php $__env->startSection('content'); ?>
    <div ng-app="BrandApp" class="containerleads container">
        <br>

        <div class="container">
            <ng-view>
            </ng-view>
        </div>

    </div>
    <script src="<?php echo e(asset('js/appBrands/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appBrands/services/myService.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appBrands/controllers/Controller.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>