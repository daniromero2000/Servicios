 <div class="contentDashboard">
    <div class="headerDashBoard">
        <h3>Bienvenido <?php echo e($currentUser->name); ?></h3>
    </div>
    <?php if($currentUser->idProfile == 1 ): ?>
        <?php echo $__env->make('profiles.adminUser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php elseif($currentUser->idProfile == 2): ?>
        <?php echo $__env->make('profiles.digitalUser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php elseif($currentUser->idProfile == 3): ?>
        <?php echo $__env->make('profiles.libranzaUser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php elseif($currentUser->idProfile == 5): ?>
        <?php echo $__env->make('profiles.fabricaUser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php elseif($currentUser->idProfile == 6): ?>
        <?php echo $__env->make('profiles.cruzado', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php elseif($currentUser->idProfile == 7): ?>
        <?php echo $__env->make('profiles.marketing', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('profiles.communityUser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
</div>