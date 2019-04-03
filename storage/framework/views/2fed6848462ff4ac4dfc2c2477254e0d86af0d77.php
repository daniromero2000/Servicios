    <!--
    **Project: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to warranty terms and conditions
    **Date: 6/03/2019
     -->


     

     <?php $__env->startSection('content'); ?>
     <div>
        <div class="row resetRow TermsHeader">
            <div class="logoHeaderTerms">
                <a href="<?php echo e(url()->previous()); ?>"> <img src="<?php echo e(asset('images/warranty-oportunidades.png')); ?>" class="img-fluid" alt="Oportuya" /> </a>
            </div>
         </div>
        <h1 class="titleTerms text-center">TÉRMINOS Y CONDICIONES</h1>
        <div class="container">
            <p class="menuItem-text" align="justify">
                El artículo 13 de la ley 1480 del 2011  denomina la “Garantía Suplementaria como la ampliación
                del término legal de la garantía o el mejoramiento de esta, la garantía suplementaria puede otorgarse
                de manera gratuita o de manera onerosa, el consumidor debe pagar un porcentaje adicional al precio
                de la cosa adquirida y además es necesario que este acepte de manera expresa pagar el costo” 
                Señor usuario este servicio lo presta la aseguradora siempre y cuando usted hay adquirido la
                garantía suplementaria, por favor verifique sus facturas, para mayor información se puede comunicar
                a los números: 01 8000 117 787 o (6) 33 91 946 en Pereira.
            </p>
        </div>
    </div>
     <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.BasicIncludes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>