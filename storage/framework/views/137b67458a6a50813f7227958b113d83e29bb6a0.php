    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DIGITAL
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for render PRODUCT CRUD
    **Fecha: 13/12/2018
     -->

<?php $__env->startSection('content'); ?>
    <div ng-app="ProductApp" class="containerleads container">
        <br>
        <div class="container">
            <ng-view>
            </ng-view>
        </div>

    </div>
    <script src="<?php echo e(asset('js/appProduct/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appProduct/services/myService.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appProduct/controllers/Controller.js')); ?>"></script>
    <script src="<?php echo e(asset('js/libsJs/flow.js')); ?>"></script>
    <script src="<?php echo e(asset('js/libsJs/fusty-flow.js')); ?>"></script>
    <script src="<?php echo e(asset('js/libsJs/fusty-flow-factory.js')); ?>"></script>
    <script src="<?php echo e(asset('js/libsJs/ng-flow.js')); ?>"></script>

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>