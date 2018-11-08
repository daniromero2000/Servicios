 
<?php $__env->startSection('content'); ?>

    <div class="containerPages">   
        <div class="row">
            <a href="<?php echo e(route('pages.create')); ?>" class="btn btn-success pull-right">Create Page</a>
        </div>
        <br>
        <?php if(Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e(Session::get('success')); ?></p>
            </div>
        <?php endif; ?>
     
        <div class="table table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        
                        <th style="width: 25%;">name</th>
                        <th style="width: 50%;">Description</th>
                        <th style="width: 25%;">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        
                       
                        <td style="width: 25%;"><?php echo e($page->name); ?></td>
                        <td style="width: 50%;"><?php echo e($page->description); ?></td>
                        <td style="width: 25%">
                            <a href="<?php echo e(route('pages.show', $page->id)); ?>" class="btn btn-success" ><i class="fa fa-eye"></i></a><br>
                            <a href="<?php echo e(route('pages.edit', $page->id)); ?>" class="btn btn-info" ><i class="fa fa-pencil-square-o"></i></a>
     
                            <form action="<?php echo e(route('pages.destroy', $page->id)); ?>" method="POST" >
                                <?php echo method_field('DELETE'); ?>
                                <?php echo csrf_field(); ?> 
                                <button type="submit" class="btn btn-danger" value="Delete"> <i class="fa fa-trash-o"></i>  </button>                           
                               
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo $pages->links(); ?>

     
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>