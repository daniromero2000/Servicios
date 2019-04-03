    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to catalog
    **Date: 18/01/2019
     -->
     


<?php $__env->startSection('content'); ?>

    <div class="publicHeader row">
      <div class="headerLogo col-12 col-sm-6">
        <a href="/">
          <img src="https://www.serviciosoportunidades.com/images/oportunidadesServiciosFinancierosLogo.png" alt="Oportunidades Servicios Financieros" class="img-fluid">
        </a>
      </div>
      <div class= "col-12 col-sm-6 headerText" >
        <div class="row">
          <div class="phoneCatalog col-md-6">
            <span>Línea de atención nacional: 01 8000 117 787<span/>
          </div>
          <div class="restrictCatalog col-md-6">
            <a hfre="#">*Aplican condiciones y restricciones</a>
          </div>  
        </div>
      </div>
    </div>
    <div class="row catalogSlide">
    <div class="col">
      <img class="productsCatalog" src="<?php echo e(asset('/images/slide-catalog-productos-02.png')); ?>">
    </div>
    <div class="col">
      <img class="descCatalog" src="<?php echo e(asset('/images/desc-catalogproductos-03.png')); ?>">
    </div>
    </div>
    <div ng-app="PublicApp">
        <ng-view>
        </ng-view>
    </div>
    <script src="<?php echo e(asset('js/appCatalog/appPublic/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appCatalog/appPublic/services/myService.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appCatalog/appPublic/controllers/Controller.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appCatalog/appPublic/controllers/ControllerDetails.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appFooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>