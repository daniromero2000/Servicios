 
<?php $__env->startSection('content'); ?>
    <h2> Create new Page </h2>
    <hr>
 
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post" action="<?php echo e(route('pages.store')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
            <label>Page name</label>
            <input type="text" name="name" class="form-control" placeholder="Page name">
        </div>
        <div class="form-group">
            <label>Page Description</label>
            <textarea name="description" rows="4" class="form-control"></textarea>
        </div>
        <a href="<?php echo e(route('pages.index')); ?>" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>