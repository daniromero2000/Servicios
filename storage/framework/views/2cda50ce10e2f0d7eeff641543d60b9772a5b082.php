    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for cities profiles CRUD
    **Fecha: 21/12/2018
     -->
     


<?php $__env->startSection('content'); ?>
    <div ng-app="ProfileCityApp" class="containerleads container">
        <br>

        <div class="container">
            <ng-view>
            </ng-view>
        </div>

    </div>
    <script src="<?php echo e(asset('js/appProfilesCities/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appProfilesCities/services/myService.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appProfilesCities/controllers/Controller.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>