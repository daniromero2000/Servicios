<?php $__env->startSection('title', 'Avances'); ?>

<?php $__env->startSection('metaTags'); ?>
	
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="oportuyaSlider">
		<?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="containImg">
				<img src="/images/<?php echo e($slider['img']); ?>" class="img-fluid img-responsive" title="<?php echo e($slider['title']); ?>" />
				<div class="oportuyaSliderContent avanceSliderContent">
					<div class="oportuyaSliderTitle">
							<?php
								$titleChunk=explode("-",$slider['title'],2);								
								$chunkOne= @$titleChunk[0];
								$chunkTwo= @$titleChunk[1];
								$chunkOneExplode= explode("_", $chunkOne,2);
								$chunkTwoExplode= explode("_",$chunkTwo,2);
								$chunkExplodeOne=@$chunkOneExplode[0];
								$chunkExplodeTwo=@$chunkOneExplode[1];
								$chunkExplodeThree=@$chunkTwoExplode[0];
								$chunkExplodeFour=@$chunkTwoExplode[1];
							?>
						<p>
							<?php
								echo $chunkExplodeOne.' <span class="textTitleSliderPink">'.$chunkExplodeTwo.'</span>';
							?>							
						</p>
						<p>
							<?php
								echo $chunkExplodeThree.' <span class="textTitleSliderBlue">'.$chunkExplodeFour.'</span>';
							?>							
						</p>
					</div>
					<br>
					<div class="oportuyaSliderDescription">
						<p>
							<?php
							  echo $slider['description'];
							?>
						</p>
					</div>
					<br>
					<br>
					<div class="oportuyaSliderButton  oportuyaSliderButtonAdvance">
						<p>
							<a href="/avance/step1" alt="Realizar Solicitud de Crédito">
								<?php
								  echo $slider['textButton'];
								?>
							</a>
						</p>
					</div>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>

	<div id="prestamos">
		<div class="container text-center">
			<h3>Préstamos online hasta $500.000, en cualquiera de nuestras sucursales</h3>
		</div>
	</div>
	<!--<div id="requisitos-prestamo">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-4 col-md-2 col-lg-2 requisitos-texto">
					<h4>
						REQUISITOS
					</h4>
					<span>PARA APLICAR A UN PRÉSTAMO</span>
				</div>
				<div class="col-12 col-sm-4 col-md-2 col-lg-2 requisitos-items">
					<div class="row">
					<div class="col-5 col-sm-4 col-md-12 col-lg-5">
						<img src="<?php echo e(asset('images/avanceMap.png')); ?>" alt="" class="rounded-circle img-fluid">
					</div>
					<div class="col-7 col-sm-8 col-md-12 col-lg-7">
						<span>RESIDENTE EN <br>	COLOMBIA</span>				
					</div>
					</div>
				</div>
				<div class="col-12 col-sm-4 col-md-2 col-lg-2 requisitos-items">
					<div class="row">
					<div class="col-5 col-sm-4 col-md-12 col-lg-5">
						<img src="<?php echo e(asset('images/avanceEdad.png')); ?>" alt="" class="rounded-circle img-fluid">
					</div>
					<div class="col-7 col-sm-8 col-md-12 col-lg-7">
						<span>MAYOR DE EDAD<br>	(18 AÑOS A +)</span>				
					</div>
					</div>
				</div>
				<div class="col-12 col-sm-4 col-md-2 col-lg-2 requisitos-items">
					<div class="row">
					<div class="col-5 col-sm-4 col-md-12 col-lg-5">
						<img src="<?php echo e(asset('images/avanceMail.png')); ?>" alt="" class="rounded-circle img-fluid">
					</div>
					<div class="col-7 col-sm-8 col-md-12 col-lg-7">
						<span>E-MAIL <br>PERSONAL</span>				
					</div>
					</div>
				</div>
				<div class="col-12 col-sm-4 col-md-2 col-lg-2 requisitos-items">
					<div class="row">
					<div class="col-5 col-sm-4 col-md-12 col-lg-5">
						<img src="<?php echo e(asset('images/avanceCuenta.png')); ?>" alt="" class="rounded-circle img-fluid">
					</div>
					<div class="col-7 col-sm-8 col-md-12 col-lg-7">
						<span>BUEN HISTORIAL<br> CREDITICIO</span>				
					</div>
					</div>
				</div>
				<div class="col-12 col-sm-4 col-md-2 col-lg-2 requisitos-items">
					<div class="row">
					<div class="col-5 col-sm-4 col-md-12 col-lg-5">
						<img src="<?php echo e(asset('images/avanceMovil.png')); ?>" alt="" class="rounded-circle img-fluid">
					</div>
					<div class="col-7 col-sm-8 col-md-12 col-lg-7">
						<span>TELÉFONO MÓVIL<br>PERSONAL</span>				
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="solicitudAvances">
		<div class="container">
			<div class="solicitudAvanceTitulo text-center">
				<h3>SOLICITAR TU CRÉDITO ES MUY SENCILLO, SOLO <br> DEBES SEGUIR ESTOS SENCILLOS PASOS</h3>
			</div>
			<div class="avancePasos row">
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 solicitudPasos">
					<div>
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 imageSolicitudPasos">
								<img src="<?php echo e(asset('images/avancesCalculo.png')); ?>" alt="" class="img-fluid">
							</div>
							<div class="col-12 col-sm-6 col-lg-8 tituloSolicitudPasos">
								<span>
									CALCULA Y SOLICITA TU CRÉDITO
								</span>
							</div>
						</div>
						<br>
						<div class="row">
							<p class="descripcionSolicitudPasos">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra enim eget elit vehicula sollicitudin. Donec sed malesuada purus. Integer ac mi ac velit egestas interdum. Nulla varius feugiat purus eu consequat. Suspendisse consequat aliquet dictum. Cras posuere augue nisl, at luctus odio ultrices a.
							</p>
						</div>					
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 solicitudPasos">
					<div>
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 imageSolicitudPasos">
								<img src="<?php echo e(asset('images/avancesIngresa.png')); ?>" alt="" class="img-fluid">
							</div>
							<div class="col-12 col-sm-6 col-lg-8 tituloSolicitudPasos">
								<span>
									INGRESA Y VALIDA TUS DATOS
								</span>
							</div>
						</div>
						<br>
						<div class="row">
							<p class="descripcionSolicitudPasos">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra enim eget elit vehicula sollicitudin. Donec sed malesuada purus. Integer ac mi ac velit egestas interdum. Nulla varius feugiat purus eu consequat. Suspendisse consequat aliquet dictum. Cras posuere augue nisl, at luctus odio ultrices a.
							</p>
						</div>					
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 solicitudPasos">
					<div>
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 imageSolicitudPasos">
								<img src="<?php echo e(asset('images/avancesResultado.png')); ?>" alt="" class="img-fluid">
							</div>
							<div class="col-12 col-sm-6 col-lg-8 tituloSolicitudPasos">
								<span>
									RESULTADO DE TU SOLICITUD
								</span>
							</div>
						</div>
						<br>
						<div class="row">
							<p class="descripcionSolicitudPasos">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra enim eget elit vehicula sollicitudin. Donec sed malesuada purus. Integer ac mi ac velit egestas interdum. Nulla varius feugiat purus eu consequat. Suspendisse consequat aliquet dictum. Cras posuere augue nisl, at luctus odio ultrices a.
							</p>
						</div>					
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 solicitudPasos">
					<div>
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 imageSolicitudPasos">
								<img src="<?php echo e(asset('images/avancesContrato.png')); ?>" alt="" class="img-fluid">
							</div>
							<div class="col-12 col-sm-6 col-lg-8 tituloSolicitudPasos">
								<span>
									CONTRATO Y CÓDIGO DE VERIFICACIÓN
								</span>
							</div>
						</div>
						<br>
						<div class="row">
							<p class="descripcionSolicitudPasos">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra enim eget elit vehicula sollicitudin. Donec sed malesuada purus. Integer ac mi ac velit egestas interdum. Nulla varius feugiat purus eu consequat. Suspendisse consequat aliquet dictum. Cras posuere augue nisl, at luctus odio ultrices a.
							</p>
						</div>					
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 solicitudPasos">
					<div>
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 imageSolicitudPasos">
								<img src="<?php echo e(asset('images/avancesDesembolso.png')); ?>" alt="" class="img-fluid">
							</div>
							<div class="col-12 col-sm-6 col-lg-8 tituloSolicitudPasos">
								<span>
									DESEMBOLSO
								</span>
							</div>
						</div>
						<br>
						<div class="row">
							<p class="descripcionSolicitudPasos">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra enim eget elit vehicula sollicitudin. Donec sed malesuada purus. Integer ac mi ac velit egestas interdum. Nulla varius feugiat purus eu consequat. Suspendisse consequat aliquet dictum. Cras posuere augue nisl, at luctus odio ultrices a.
							</p>
						</div>					
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-4 solicitudPasos">
					<div>
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 imageSolicitudPasos">
								<img src="<?php echo e(asset('images/avancesPaga.png')); ?>" alt="" class="img-fluid">
							</div>
							<div class="col-12 col-sm-6 col-lg-8 tituloSolicitudPasos">
								<span>
									PAGA TU CRÉDITO
								</span>
							</div>
						</div>
						<br>
						<div class="row">
							<p class="descripcionSolicitudPasos">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra enim eget elit vehicula sollicitudin. Donec sed malesuada purus. Integer ac mi ac velit egestas interdum. Nulla varius feugiat purus eu consequat. Suspendisse consequat aliquet dictum. Cras posuere augue nisl, at luctus odio ultrices a.
							</p>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div id="solicitudPasosBoton">
		<div class="container">
			<div class="botonSolicitudContainer">
				<a href="/avance/step1">
					Solicítalo aquí
				</a>
			</div>
		</div>
	</div>
	<br>
	<br>-->

	<div id="creditoLibranza" class="cupoAvance">
		<div class="containerCreditoLibranza">
			<h2 class="creditoLibranza-title text-center">¿Qué necesitas y cómo<br> solicitas tu <strong>Avance</strong>?</h2>
			<div class="row" id="creditoLibranza-slider">
				<div class="col-md-12 col-lg-6 container-creditoLibranzaCards">
					<div class="creditoLibranza-contianerTexto creditoLibranza-electrodomesticos avance-containerText">
						<img src="<?php echo e(asset('images/requirementsIcon.png')); ?>" alt="Crédito para electrodomésticos" class="img-fluid creditoLibranza-img">
						<div class="containerText-creditoLibranzaCards cardTextAdvance">
							<h3 class="creditoLibranza-titleText">Requisitos</h3>
						</div>
						<div>
						
					<ul class="requirementsList requirementsListAdvance">
						<li>Ser empleado o independiente con un tiempo mínimo de cuatro (4) meses.</li>
						<li>No presentar reportes negativos en las centrales de riesgo.</li>
						<li>Tener ingresos iguales o superior a 1 SMMLV.</li>
						<li>No haber cumplido los 70 años de edad.</li>
						<li>Si tiene entre 70 y 80 años debe ser pensionado.</li>
						<li>Presentar un buen historial de crédito en el sector financiero.</li>
						<li>Ser mayor de edad.</li>
					</ul>
				
						</div>
						<div class="row" style="padding-bottom: 15px;">
							<div class="col-12 text-center">
								<a href="https://api.whatsapp.com/send?phone=573115195753&text=Deseo%20obtener%20más%20información%20acerca%20de%20un%20cupo%20de%20Avanceo" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-lg-6 container-creditoLibranzaCards">
					<div class="creditoLibranza-contianerTexto creditoLibranza-motos avance-containerText">
						<img src="<?php echo e(asset('images/howGetIcon.png')); ?>" alt="Crédito para motos" class="img-fluid creditoLibranza-img">
						<div class="containerText-creditoLibranzaCards cardTextAdvance">
							<h3 class="creditoLibranza-titleText">¿Cómo tenerla?</h3>
						</div>
						<p class="descriptionRequirements descriptionRequirementsAdvance">
						<br>	
						Solo debes ingresar los datos y te llamaremos, o si quieres ir a nuestras oficinas ubicadas en 48 ciudades del Pais, Cualquiera de nuestros asesores estará listo para atenderte. <br> <br>	<b>Te esperamos! </b>
						</p>
						<div class="row" style="padding-bottom: 15px;">
							<div class="col-12 text-center">
								<a href="https://api.whatsapp.com/send?phone=573115195753&text=Deseo%20obtener%20más%20información%20acerca%20de%20un%20cupo%20de%20Avance" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>

	<div id="travelOffers">
	<div class="row">
		<div class="travelOffersIcon col-sm-4 col-4 offset-lg-3 col-md-4 col-lg-2 travelOffersImg">
			<img src="<?php echo e(asset('images/convenios-credibilidadIcon.png')); ?>" class="img-fluid">
		</div>
		<div class="travelOffersText col-sm-4 col-4 col-md-4 col-lg-2">
			<p class="travelMainText">No te quedes</p>
			<p class="travelSecondText">sin tu avance </p>
			<p class="travelAnyText">en efectivo</p>
		</div>
		<div class="travelOffersButton travelOffersButtonAdvance  col-sm-4 col-4 col-md-4 col-lg-2">
			<p><a href="/avance/step1">!Solicítalo aquí!</a></p>
		</div>
	</div>
</div>


	<div id="credibilidad" class="avanceCredibilidad">
		<div class="container">
			<h2 class="credibilidad-title text-center">Experiencia y <strong>Calidad</strong></h2>
			<div class="row">
				<div class="col-md-12 col-lg-4 text-center">
					<a href="/Nuestras-tiendas">
						<img src="<?php echo e(asset('images/libranza-experienciaMapa.png')); ?>" alt="" class="img-fluid credibilidad-img">
					</a>
					<p class="credibilidad-text ">
						48 puntos de atención  <br>
						al público
					</p>
				</div>
				<div class="col-md-12 col-lg-4 text-center">
					<img src="<?php echo e(asset('images/libranza-experienciaAliados.png')); ?>" alt="" class="img-fluid credibilidad-img">
					<p class="credibilidad-text ">
						Adquiere experiencia  <br>
						crediticia con nosotros
					</p>
				</div>
				<div class="col-md-12 col-lg-4 text-center">
					<img src="<?php echo e(asset('images/libranza-experienciaClientes.png')); ?>" alt="" class="img-fluid credibilidad-img">
					<p class="credibilidad-text ">
						Más de 500.000 clientes <br>
						atendidos en los últimos 5 años
					</p>
				</div>
			</div>
		</div>
	</div>

	



	<!--
	<div id="construccion">
		<div class="container">
			<h2 class="creditoLibranza-title text-center">Esta sección está actualmente en construcción</h2>
			<p class="text-center">Si te interesa conocer más sobre nuestros avances de créditos, déjanos tus datos y un asesor se pondrá en contacto</p>
			<div class="modalFormulario-body" style="margin: auto;">
				<div class="modal-containerFormulario">
					<h3 class="modal-titleForm titleForm-avances">Avance</h3>
					<form role=form method="POST" id="saveLeadadvance" action="<?php echo e(route('avance.store')); ?>">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="typeProduct" value="avance">
						<input type="hidden" name="typeService" value="avance">
						<input type="hidden" name="channel" value="1">
						<div class="form-group">
							<label for="name" class="control-label">Nombres</label>
							<input type="text" name="name" id="name" class="form-control" validation-pattern="name" required="true"  />
						</div>
						<div class="form-group">
							<label for="lastName" class="control-label">Apellidos</label>
							<input type="text" name="lastName" id="lastName" class="form-control" validation-pattern="name" required="true"/>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Correo electrónico</label>
							<input type="email" name="email" id="mail" class="form-control" validation-pattern="email" required="true"/>
						</div>
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono</label>
							<input type="text" name="telephone" id="telephone" class="form-control" validation-pattern="telephone" required="true"/>
						</div>
						<div class="form-group">
							<label for="ciudad class="control-label">Ciudad</label>
							<select name="city" id="city" class="form-control" >
								<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($city['value']); ?>"><?php echo e($city['label']); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
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
						<div class="form-group text-right">
							<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
								Guardar
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>