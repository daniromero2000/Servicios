 
<?php $__env->startSection('content'); ?>

    <div class="containerUsers container">   
        <div class="row">
            <a href="<?php echo e(route('users.create')); ?>" class="buttonCreateUsers">Crear Usuario</a>
        </div>

        <br>
        <?php if(Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e(Session::get('success')); ?></p>
            </div>
        <?php endif; ?>
        <div class="table table-responsive">

            <table class="table table-bordered table-hover table-striped userTable">
                <thead>
                    <tr>
                        
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Última modificación</th>                        
                        <th> Tipo Usuario</th>
                        <th >Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->updated_at); ?></td>
                        <?php if($user->idProfile == 1): ?>
                            <td>Administrador</td>
                        <?php elseif($user->idProfile == 2): ?>
                            <td>Líder Canal Dígital</td>
                        <?php elseif($user->idProfile == 3): ?>
                            <td>Libranza</td>
                        <?php elseif($user->idProfile == 5): ?>
                            <td>Fábrica de crédito</td>
                        <?php else: ?>
                            <td>Community Manager</td>
                        <?php endif; ?>
                        

                        <td class="userTableOptions" >

                            <div class="row rowAdjust">
                                <div class="col-4">
                                       <a href="<?php echo e(route('users.show',$user->id)); ?>" class="btn " ><i class="fa fa-eye"></i></a><br>            
                                </div>
                                <div class="col-4">
                                       <a href="<?php echo e(route('users.edit',$user->id)); ?>" class="btn " ><i class="fas fa-pencil-alt"></i></i></a><br>            
                                </div>
                                <div class="col-4">
                                       <a href="#" class="btn"  data-toggle="modal" data-target="#userModal<?php echo $user->id ?>"><i class="fas fa-trash-alt"></i></a><br>           
                                </div>                             
                                
                            </div>      
                            
     
                            
                        </td>
                    </tr>
                    <div class="modal fade" id="userModal<?php echo $user->id ?>" tabindex="-1" role="dialog" aria-hidden="true">

                                <div class="modal-dialog">
                                    
                                    <div class="modal-content">
                                        
                                        <div class="modal-header">
                                            
                                        </div>

                                        <div class="modal-body">
                                            
                                            <div class="row">
                                                <p>¿Está seguro que desea eliminar el usuario?</p>
                                            </div>

                                             <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" >
                                                <?php echo method_field('DELETE'); ?>
                                                <?php echo csrf_field(); ?> 
                                                <button type="submit" class="btn btn-danger" value="Delete"> Elminar</button>                           
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                                
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
           
        <?php echo $users->links(); ?>

        
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>