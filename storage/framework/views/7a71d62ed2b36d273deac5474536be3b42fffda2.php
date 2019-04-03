 
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
    }
    .btn-FAQ:focus{
      box-shadow: unset;
    }
    .titelFAQ{
      margin-top: 30px; 
    }
   
    
</style>

      <div class="container">
        

      
    
        <?php if(Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e(Session::get('success')); ?></p>
            </div>
        <?php endif; ?>
        
        <h1 class="menuItem-title text-center titelFAQ">Preguntas Frecuentes</h1>

        <?php $__currentLoopData = $preguntas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pregunta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-default btn-FAQ" data-toggle="collapse" data-target="#collapse<?php echo e($pregunta->id); ?>" aria-expanded="true" aria-controls="collapseOne">
                  <h5 ><?php echo e($pregunta->question); ?></h5>
                  <i class="fas fa-angle-down"></i> 
                </button>
              </h5>
            </div>

            <div id="collapse<?php echo e($pregunta->id); ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                <?php echo e($pregunta->answer); ?>

              </div>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        

        </div>      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>