<?php $__env->startSection('title', 'Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta.'); ?>

<?php $__env->startSection('metaTags'); ?>
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div id="step1">
		<div class="row resetRow container-header-forms">
			<div class="form-container-logoHeader">
				<img src="<?php echo e(asset('images/formsLogoOportuya.png')); ?>" class="img-fluid" alt="Oportuya" />
			</div>
			<div class="col-12 conatiner-logoImg">
				<img src="/<?php echo e($digitalAnalyst['img']); ?>" alt="<?php echo e($digitalAnalyst['name']); ?>" class="img-fluid steps-imgAnalista" />
				<span class="steps-textStep"><strong>Solicitud de Crédito Paso 1</strong> > (Cuéntanos Sobre Ti)</span>
			</div>
		</div>
		<div class="row resetRow">
			<div class="col-12 step2-containTitle">
				<h2 class="text-center step2-titleAnalista"><strong>Hola!</strong> soy <?php echo e($digitalAnalyst['name']); ?> tu analista digital</h2>
				<p class="text-center step2-textAnalista">En este momento te encuentras haciendo tu solicitud de crédito, por favor diligencia <br> todos los datos para que tu aprobación sea más fácil</p>
				<h3 class="forms-text-analyst text-center">Solo te tomará unos minutos solicitar tu tarjeta Oportuya</h3>
			</div>
			<div class="col-12">
				<div class="step3-containerForm">
					<img src="<?php echo e(asset('images/iconoStartProgreso.png')); ?>" alt="" class="img-fluid imgStartProgress" />
					<div class="progreso">
						<div class="barra_vacia" style="width: 0;"></div>
						<div class="puntos punto_uno listo">
						</div>
						<span></span>
						<label>Cuentanos sobre ti</label>
						<div class="puntos punto_dos">
						</div>
						<span></span>
						<label>Información Personal</label>
						<div class="puntos punto_tres">
						</div>
						<span></span>
						<label>Información Laboral</label>
						<div class="puntos punto_cuatro">
						</div>
						<span></span>
						<label>Confirmación</label>
					</div>
					<img src="<?php echo e(asset('images/iconoEndProgreso.png')); ?>" alt="" class="img-fluid imgEndProgress" />
				</div>
			</div>
		</div>
		<div class="step1-containerForm">
			<div class="row resetRow">
				<div class="forms-descStep">
					<strong>Información básica</strong><br>
					<span class="forms-descText">Ingresa tus datos personales</span>
					<img src="<?php echo e(asset('images/datosPersonales.png')); ?>" class="img-fluid forms-descImg" />
					<span class="forms-descStepNum">1</span>
				</div>
			</div>
			<form role=form method="POST" id="saveLeadOportuya" action="<?php echo e(route('oportuyaV2.store')); ?>">
				<?php echo e(csrf_field()); ?>

				<input type="hidden" name="step" value="1">
				<input type="hidden" name="channel" value="1">
				<input type="hidden" name="typeService" value="terjeta de crédito Oportuya">
				<div class="row resetRow">
					<div class="col-sm-12 col-md-6 form-group">
						<label for="name" class="control-label">Nombres</label>
						<input type="text" name="name" validation-pattern="name" class="form-control inputsSteps inputText" id="name" required="true"/>
					</div>
					<div class="col-sm-12 col-md-6 form-group">
						<label for="lastName" class="control-label">Apellidos</label>
						<input type="text" name="lastName" validation-pattern="name" class="form-control inputsSteps inputText" id="lastName" required="true"/>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-sm-12 form-group">
						<label for="email" class="control-label">Correo electronico</label>
						<input type="email" name="email" validation-pattern="email" class="form-control inputsSteps inputText" id="email" required="true"/>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-12 col-sm-6">
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono</label>
							<input type="text" name="telephone" validation-pattern="telephone" class="form-control inputsSteps inputText" id="telephone" required="true"/>
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<label for="occupation">Ocupación</label>
						<select class="form-control inputsSteps inputSelect" name="occupation" required="">
							<option value="EMPLEADO">Empleado</option>
							<option value="SOLDADO-MILITAR-POLICÍA">Soldado - Militar - Policía</option>
							<option value="PRESTACIÓN DE SERVICIOS">Prestación de Servicios</option>
							<option value="INDEPENDIENTE CERTIFICADO">Independiente Certificado</option>
							<option value="NO CERTIFICADO">No Certificado</option>
							<option value="RENTISTA">Rentista</option>
							<option value="PENSIONADO">Pensionado</option>
						</select>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-12 col-sm-6 form-group">
						<label for="typeDocument">Tipo de documento</label>
						<select class="form-control inputsSteps inputSelect" name="typeDocument" id="typeDocument" required="">
							<option value="1">Cédula de ciudadanía</option>
							<option value="2">Cédula de extranjería</option>
						</select>
					</div>
					<div class="col-12 col-sm-6 form-group">
						<label for="identificationNumber">Número de identificación</label>
						<input class="form-control inputsSteps inputText" type="text" validation-pattern="number" name="identificationNumber" id="identificationNumber" required="" />
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-12">
						<div class="form-group">
							<label for="city" class="control-label">Ciudad</label>
							<select name="city" id="city" class="form-control inputsSteps inputSelect" required="">
								<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($city['value']); ?>"><?php echo e($city['label']); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1" required>
					<label for="termsAndConditions" style="font-size: 13px; font-style: italic;">
						Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
					</label>
				</div>
				<p class="textCityForm">
					*Válido solo para ciudades que se desplieguen en la casilla.
				</p>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
						Siguiente
					</button>
					<a href="/oportuya" class=" btn btn-danger buttonFormModal" data-dismiss="modal" aria-label="Close">
						Volver
					</a>
				</div>
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.steps', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>