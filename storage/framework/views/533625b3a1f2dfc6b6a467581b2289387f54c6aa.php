    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for Lines CRUD
    **Fecha: 19/12/2018
     -->


<?php $__env->startSection('content'); ?>
    <div ng-app="LineApp" class="containerleads container">
        <br>

        <div class="container">
            <ng-view>
            </ng-view>
        </div>

    </div>
    <script src="<?php echo e(asset('js/appLines/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appLines/services/myService.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appLines/controllers/Controller.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>