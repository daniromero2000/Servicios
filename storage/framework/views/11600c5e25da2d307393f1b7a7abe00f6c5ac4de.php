 
<?php $__env->startSection('content'); ?>

<style>
    .card{
        margin: 10px;
    }

    .create {
        margin: auto;
    }

    .create button {
       
        margin: 10px 15px ;
    }
    .card-header{
        background: white;
    }
    .ulFAQ{
        padding: 0px;
        list-style: none;
        float: right;
        
    }
    .ulFAQ li{
        display: inline-block;
    }
    .col-faq{
        padding: 0px !important;
    }
    .col-sm-2 a {
        padding: 3px 6px;
    }
    .textareaReadOnly{
        background-color: white !important; 
    }
    .btn-FAQ{
      background-color: white !important;
      white-space: normal;
    }
    .btn-FAQ:focus{
      box-shadow: unset;
    }
    .titelFAQ{
      margin-top: 30px; 
    }
    .downFAQ{
        padding: 5px;
        font-size: 20px;
    }
    
</style>

      <div class="container">
        

      
    
        <?php if(Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e(Session::get('success')); ?></p>
            </div>
        <?php endif; ?>
        
        <h1 class="menuItem-title text-center titelFAQ">Preguntas Frecuentes</h1>

        <?php
            $show=true;
            $s='show';
        ?>
    <div id="accordion">
        <?php $__currentLoopData = $preguntas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pregunta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
          <div class="card">
            <div class="card-header" id="heading<?php echo e($pregunta->id); ?>">
              <h5 class="mb-0">
                <button class="btn btn-default ourStores-titleStore btn-FAQ" data-toggle="collapse" data-target="#collapse<?php echo e($pregunta->id); ?>" aria-expanded="false" aria-controls="collapse<?php echo e($pregunta->id); ?>">
                    <div class="row rowFAQ">
                      <h5 ><?php echo e($pregunta->question); ?></h5>
                      <i class="fas fa-angle-down downFAQ"></i> 
                    </div>
                </button>
              </h5>
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