 <div class="contentDashboard">
           <div class="headerDashBoard">
               <h3>Bienvenido <?php echo e($currentUser->name); ?></h3>
           </div>
           
           <?php if($currentUser->idProfile == 1 ): ?>
                <?php echo $__env->make('profiles.adminUser', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php else: ?>

                <?php echo $__env->make('profiles.digitalUser', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           <?php endif; ?>

        </div>