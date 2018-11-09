<script src="<?php echo e(asset('/appCanalDigital/app.js')); ?>"></script>
<script src="<?php echo e(asset('/appCanalDigital/services/myService.js')); ?>"></script>
<!-- App Controller -->
<script src="<?php echo e(asset('/appCanalDigital/controllers/ItemController.js')); ?>"></script>
<?php $__env->startSection('content'); ?>

    <div class="containerleads container">
        <br>
        <?php if(Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e(Session::get('success')); ?></p>
            </div>
        <?php endif; ?>
    ------------------------------------------------------------------------------------------------------------------------------------------------------
	<div class="row tituloLeads">
		<div class="col-12">
			<h3>Consulta de Leads </h3>
		</div>
	</div>
        <div class="table table-responsive">

            <table class="table table-hover table-striped leadTable">
                <thead class="headTableLeads" >
                    <tr>
                        
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Tel&eacutefono</th>
                        <th>Ciudad</th>
                        <th>Servicio</th>
                        <th>Producto</th>
                        <th>Fecha de creaci&oacuten</th>
                        
                        <th >M&aacutes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $leadsQuery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        

                       
                        <td><?php echo e($lead->name); ?></td>
                        <td><?php echo e($lead->lastName); ?></td>
                        <td><?php echo e($lead->telephone); ?></td>
                        <td><?php echo e($lead->city); ?></td>
                        <td><?php echo e($lead->typeService); ?></td>
			<td><?php echo e($lead->typeProduct); ?></td>
                        <td> <?php echo e($lead->created_at); ?></td>
                        <td class="leadTableOptions" >

                            <div class="row rowAdjust">
                                <div class="col-12">
                                    <?php if($lead->idLead != NULL): ?>    
                                            <a href="" class="btn" data-toggle="modal" data-target="#leadModal<?php echo $lead->id ?>" ><i class="fa fa-eye"></i></a><br>
                                    <?php else: ?>
                                            
                                            <span> <i class="fas fa-eye-slash"></i> </span> 
                                    <?php endif; ?>
                                </div>
                              
                                
                            </div>      
                            
     
                            
                        </td>
                    </tr>

			<div class="modal fade hide" id="leadModal<?php echo $lead->id ?>" tabindex="-1" role="dialog" aria-hidden="true">

                                <div class="modal-dialog">
                                    
                                    <div class="modal-content">
                                        
                                        <div class="modal-header">
                                            <h4>Tarjeta Oportuya Gray</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
         					 <span aria-hidden="true">&times;</span>
       						 </button>
                                        </div>

                                        <div class="modal-body">
                                            
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Nombre</strong>
							<br>
                                                        <?php echo e($lead->name); ?>

                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Apellido</strong>
							<br>
                                                        <?php echo e($lead->lastName); ?>

                                                    </div>
                                                </div>
					    </div>
					    <div class="row">					 
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Email</strong>
							<br>
                                                        <?php echo e($lead->email); ?>

                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>tel&eacutefono</strong>
							<br>
                                                        <?php echo e($lead->telephone); ?>

                                                    </div>
                                                </div>
					    </div>
					    <div class="row">

                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>Ciudad</strong>
							<br>
                                                        <?php echo e($lead->city); ?>

                                                    </div>
                                                </div>
					    </div>
					    <div class="row">
	
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Servicio</strong>
							<br>
                                                        <?php echo e($lead->typeService); ?>

                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Producto</strong>
							<br>
                                                        <?php echo e($lead->typeProduct); ?>

                                                    </div>
                                                </div>
					   </div>
					    <div class="row">


                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>L&iacutenea de Credito</strong>
							<br>
                                                        <?php echo e($lead->creditLine); ?>

                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Pagadur&iacutea</strong>
							<br>
                                                        <?php echo e($lead->pagaduria); ?>

                                                    </div>
                                                </div>

					</div>
					    <div class="row">

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Edad</strong>
							<br>
                                                        <?php echo e($lead->age); ?>

                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <strong>Tipo de cliente</strong>
							<br>
                                                        <?php echo e($lead->customerType); ?>

                                                    </div>
                                                </div>
					</div>
					    <div class="row">

                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <strong>Salario</strong>
							<br>
                                                        <?php echo e($lead->salary); ?>

                                                    </div>
                                                </div>


                                            </div>


                                        </div>

                                    </div>

                                </div>
                                
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
           
     <?php echo e($leadsQuery->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>