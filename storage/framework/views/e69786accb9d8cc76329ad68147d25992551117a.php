    <!--
    **Proyecto: SERVISIOS FINANCIEROS
    **Caso de Uso: MODULO FAQS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for FAQS CRUD
    **Fecha: 12/12/2018
     -->

<?php $__env->startSection('title', 'Preguntas Frecuentes'); ?>
<?php $__env->startSection('content'); ?>

    <link rel="stylesheet" >
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
      <div class="container">

        <?php if(Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e(Session::get('success')); ?></p>
            </div>
        <?php endif; ?>
        
        <h1 class="menuItem-title text-center titelFAQ">Preguntas Frecuentes</h1>

        <?php
            $show=true;
        ?>
    <div id="accordion">
        <?php $__currentLoopData = $preguntas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pregunta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
          <div class="card cardFQA">
            <div class="card-header card-headerFQA" id="heading<?php echo e($pregunta->id); ?>">
                <button class="btn btn-default ourStores-titleStore btn-FAQ cardItem<?php echo e($key); ?>" data-toggle="collapse" data-target="#collapse<?php echo e($pregunta->id); ?>" aria-expanded="false" aria-controls="collapse<?php echo e($pregunta->id); ?>">
                    <div class="row rowFAQ">
                      <h5 class="h5FAQ"><?php echo e($pregunta->question); ?></h5>
                      <i class="fas fa-angle-down downFAQ" name="collapse<?php echo e($pregunta->id); ?>"></i> 
                    </div>
                </button>
            </div>

            <div id="collapse<?php echo e($pregunta->id); ?>" class="collapse <?php if($show): ?> <?php echo 'show'; $show=false ?> <?php endif; ?>" aria-labelledby="heading<?php echo e($pregunta->id); ?>" data-parent="#accordion">
              <div class="card-body">
                <?php echo $pregunta->answer; ?>

              </div>
            </div>
          </div>
        
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>