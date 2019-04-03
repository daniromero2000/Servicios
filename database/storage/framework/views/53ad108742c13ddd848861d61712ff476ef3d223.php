<?php $__env->startSection('title', 'Viajes'); ?>

<?php $__env->startSection('metaTags'); ?>
	<link rel="canonical" href="https://www.serviciosoportunidades.com/viajes" />
	<meta name="description" content="Viaja a donde siempre soñaste con las facilidades de crédito que te da Oportunidades, los mejores planes para disfrutar en familia y sin preocuparte por la financiación.">
	<meta name="keywords" content="Viajar, viajes, paseo en familia, viajes en familia, planes de viajes, credito para viajes, credito para viajeros, viajar por Colombia, viajar por el mundo, viajar a Cartagena, viajar a santa marta, viajar en pareja, agencia de viajes, vuelos baratos, vuelos económicos, los tiquetes mas baratos, planes vacacionales, planes para viajar, vacaciones económicas, agencias de viajes, agencias de viajes económicas, agencias, vacaciones en familia, tiquetes a santa marta, tiquetes a cartagena, eje cafetero, hotel soratama, hotel san Simon, hoteles en eje cafetero, planes a eje cafetero, planes turísticos eje cafetero, visitar eje cafetero, hoteles en eje cafetero, hoteles en pereira, paquetes turísticos.">
	<meta property="og:title" content="Credito para que viajes a dónde quieras y con los mejores precios." />
	<meta property="og:url" content="https://www.serviciosoportunidades.com/viajes" />
	<meta property="og:type" content="Website" />
	<meta property="og:image" content="<?php echo e(asset('images/ViajesPortadaOg.png')); ?>" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />
	<meta property="og:description" content="Viaja a donde siempre soñaste con las facilidades de crédito que te da Oportunidades, los mejores planes para disfrutar en familia y sin preocuparte por la financiación.">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div id="construccion">
		<div class="container">
			<h2 class="creditoLibranza-title text-center">Esta sección está actualmente en construcción</h2>
			<p class="text-center">Si te interesa conocer más sobre nuestros créditos para viajes, déjanos tus datos y un asesor se pondrá en contacto</p>
			<div class="modalFormulario-body" style="margin: auto;">
				<div class="modal-containerFormulario">
					<h3 class="modal-titleForm titleForm-viajes">Viajes</h3>
					<form role=form method="POST" id="saveLeadmotos" action="<?php echo e(route('motos.store')); ?>">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="typeProduct" value="viajes">
						<input type="hidden" name="typeService" value="viajes">
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
	</div>

<!-- Header viajes -->

<div id="viajesHeader">
	<div class="row viajesHeaderContent">
		<div class="col-sm-3 col-xl-3 col-lg-2 helperRow">
			
		</div>

		<div class="col-sm-12 col-xl-9 col-md-12 col-lg-10 viajesList">
			<div class="row">
				
				<div class="col-sm-9  col-11 col-md-7 viajesListItems toggleResponsive">

					<div class="buttonResponsiveViajes">
						<div class="innerButtonResponsive"></div>
						<div class="innerButtonResponsive1"></div>
						<div class="innerButtonResponsive2"></div>
					</div>

					<ul>
						<li> <span>BusTour</span></li>
					 	<li> <span>Santa Marta</span></li>
					 	<li> <span>Cartagena</span></li>
					 	<li> <span>San Andrés</span></li>
					 	<li> <span>Cruceros</span></li>
					</ul>
					
				</div>
				<div class="col-sm-1 col-1 offset-sm-0  col-md-3 viajesWhatsappButton">
					<a href="https://api.whatsapp.com/send?phone=573105216830" target="_blank" class="viajesHeaderButton">
						Tel: 310 521 68 30   
					    <span>  <i class="fab fa-whatsapp"></i></span>
					</a>
					<a href="https://api.whatsapp.com/send?phone=573105216830" target="_blank" class="viajesHeaderButtonResponsive">
					    <span>  <i class="fab fa-whatsapp"></i></span>
					</a>
				</div>
				<div class="col-sm-2 col-1 col-8 col-md-2 viajesContactenosLink">
					<p>
						<a href="" data-toggle="modal" data-target="#contactanosModal">
						Contáctanos
					</a>	
					</p>
					
				</div>
			</div>

		</div>

	</div>
</div>


<div class="modal modalFormulario fade hide" id="contactanosModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body modalFormulario-body">
				<div class="modal-containerFormulario">
					<h3 class="modal-titleForm titleForm-viajes">Dejanos tús datos para establecer contacto</h3>
					<form role=form method="POST" id="saveLeadViajes" action="<?php echo e(route('viajes.store')); ?>">
						<?php echo e(csrf_field()); ?>

						
						<input type="hidden" name="typeService" value="Viajes">
						<input type="hidden" name="channel" value="1">
						<input type="hidden" name="typeProduct" value="suscripción recibir ofertas">
						<div class="form-group">
							<label for="name" class="control-label">Nombres</label>
							<input type="text" name="name" class="form-control" id="name" validation-pattern="name" required="true" />
						</div>
						<div class="form-group">
							<label for="lastName" class="control-label">Apellidos</label>
							<input type="text" name="lastName" class="form-control" id="lastName" validation-pattern="name" required="true" />
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Correo electrónico</label>
							<input type="email" name="email" class="form-control" id="email" validation-pattern="email" required="true" />
						</div>
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono</label>
							<input type="text" name="telephone" class="form-control" id="telephone" validation-pattern="telephone" required="true" />
						</div>
						<div class="form-group">
							<label for="city" class="control-label">Ciudad</label>
							<select name="city" id="city" class="form-control" >
								<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($city['value']); ?>"><?php echo e($city['label']); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<p class="textCityForm">
							*Válido solo para ciudades que se desplieguen en la casilla.
						</p>

						<div class="form-group">
							<input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1" required>
							<label for="termsAndConditions" style="font-size: 13px; font-style: italic;">
								Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
							</label>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
								Guardar
							</button>
							<button type="button" class=" btn btn-danger buttonFormModal" data-dismiss="modal" aria-label="Close">
								Cerrar
							</button>
						</div>
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>





<!-- Slider Viajes -->


<div id="viajesSlider">
	<?php $__currentLoopData = $imagesViajes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="containImg">
			<img src="/images/<?php echo e($slider['img']); ?>" class="img-fluid img-responsive" title="<?php echo e($slider['title']); ?>" />
			<div class="viajesSliderContent">
				<div class="viajesSliderTitle">
					
					<p>
					   <?php

					   $viajesText= explode('_',$slider['title']);


					   	echo $viajesText[0].'  <span class="viajesTextSpan">'.$viajesText[1].'</span>';
					   ?>					
					</p>
				</div>
				
				<div class="viajesSliderDescription">
					<p>
						<?php
						  echo $slider['description'];
						?>
					</p>
				</div>
				
				<div class="viajesSliderButton">
					<p>
						<a href="" data-toggle="modal" data-target="#viajesModal">
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

<div class="modal modalFormulario fade hide" id="viajesModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body modalFormulario-body">
				<div class="modal-containerFormulario">
					<h3 class="modal-titleForm titleForm-viajes">Viajes</h3>
					<form role=form method="POST" id="saveLeadViajes" action="<?php echo e(route('viajes.store')); ?>">
						<?php echo e(csrf_field()); ?>

						
						<input type="hidden" name="typeService" value="Viajes">
						<input type="hidden" name="channel" value="1">
						<div class="form-group">
							<label for="name" class="control-label">Nombres</label>
							<input type="text" name="name" class="form-control" id="name" validation-pattern="name" required="true" />
						</div>
						<div class="form-group">
							<label for="lastName" class="control-label">Apellidos</label>
							<input type="text" name="lastName" class="form-control" id="lastName" validation-pattern="name" required="true" />
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Correo electrónico</label>
							<input type="email" name="email" class="form-control" id="email" validation-pattern="email" required="true" />
						</div>
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono</label>
							<input type="text" name="telephone" class="form-control" id="telephone" validation-pattern="telephone" required="true" />
						</div>

						<div class="row">
							
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Plan de interés:</label>
									<select class="form-control"  id="typeProduct" name="typeProduct" required="true">
										<option value="Cartagena">Cartagena</option>
										<option value="Santa Marta">Santa Marta</option>
										<option value="San Andrés">San Andrés</option>
										<option value="BusTour">BusTour</option>
										<option value="Cruceros">Cruceros</option>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="city" class="control-label">Ciudad</label>
									<select name="city" id="city" class="form-control" >
										<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($city['value']); ?>"><?php echo e($city['label']); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
						</div>

						<p class="textCityForm">
							*Válido solo para ciudades que se desplieguen en la casilla.
						</p>

						<div class="form-group">
							<input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1" required>
							<label for="termsAndConditions" style="font-size: 13px; font-style: italic;">
								Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
							</label>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
								Guardar
							</button>
							<button type="button" class=" btn btn-danger buttonFormModal" data-dismiss="modal" aria-label="Close">
								Cerrar
							</button>
						</div>
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- conoce Colombia -->

<div id="conoceViajes">
	<div class="containImg">
		<img src="/images/viajesConoce.jpg" class="img-fluid">
	</div>
	<div class="conoceViajesContent">
		<div class="conoceViajesTitle">
			<p>Conoce los lugares más hermosos</p>
			<p>de Colombia con Oportunidades</p>
		</div>
		<div class="conoceViajesPlay">
			<img src="/images/viajesIconPlay.png" class="img-fluid">
		</div>
	</div>
</div>	

<!-- Bustour -->



<div id="bustour" class="w-100">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-6 bustourMainContent">
			<div class="busTourContent">
				
				<div class="busTourTitle">
					<p class="busTourMainTitle">
						BusTours
					</p>
					<p class="busTourSubtitle">
						Eje Cafetero
					</p>	
				</div>
				<div class="busTourText">
					<p><span>Conoce</span> todas <span>las maravillas</span> del <span>eje cafetero</span></p>
					<p>con nuestro gran plan super <span>económico</span></p>
					<br>
					<p><span>02 Nov. 2018 - 30 Abril 2019</span></p>
					<br>
					<p><span>Desde</span></p>
					<br>
					<p class="busTourPrice">$789.000</p>
				</div>
				<div class="busTourButton">
					<p>						
						<a href="https://api.whatsapp.com/send?phone=573105216830" target="_blank">
							Hablar por WhatsApp
						</a>
					</p>
				</div>

			</div>
		</div>

		<div class="col-sm-12 col-md-12 col-lg-6 imagesBustour">
			<div class="row">
				<div class="col-sm-4 ">
					<img src="/images/viajes-busToursPaisaje1.jpg" class="img-fluid">
				</div>
				<div class="col-sm-4">
					<img src="/images/viajes-busToursPaisaje2.jpg" class="img-fluid">
				</div>
				<div class="col-sm-4">
					<img src="/images/viajes-busToursPaisaje3.jpg" class="img-fluid">
				</div>
			</div>			
		</div>

	</div>
</div>


<!--Plans-->

<div id="plans">
	<div class="row">
		<div class="plansTitle">
			<h3 class="plansMainTitle">Disfruta tus Vacaciones</h3>
			<h3 class="plansSubtitle">con los <span>mejores paquetes</span></h3>
		</div>
	</div>
	<div class="row plansContent">
		
		
		<?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

			<div class="col-sm-12 col-md-12 col-lg-3">
			<section>
				<div class="imgPLan">
					<img src="images/<?php echo $plan['img']; ?>" class="img-fluid">
				</div>
				<div class="plansdate">
					
					<?php
						$beginDate=date('d  M.  Y',strtotime($plan['beginDate']));
						$endingDate=date('d  M.  Y',strtotime($plan['endingDate']));

						echo "<p>".$beginDate." - ".$endingDate."</p>";
					?>

				</div>
				<p class="plansDescription">
					<?php echo e($plan['description']); ?>

				</p>
				<p class="planPrice">
					
					<?php

						$money=($plan['isLocal']==1)?'$'.number_format($plan['price']).'*':number_format($plan['price']).' USD*';
					?>

					<?php echo e($money); ?>

				</p>
				<p class="planButton">
					<a href="https://api.whatsapp.com/send?phone=573105216830" target="_blank">
						<?php echo e($plan['textButton']); ?> <span>  <i class="fab fa-whatsapp"></i></span>
					</a>
				</p>
			</section>
		</div>

		
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>
-->
<!--Travel Offers-->



<div id="travelOffers">
	<div class="row">
		<div class="travelOffersIcon col-sm-4 col-4 offset-md-3 col-md-2 travelOffersImg">
			<img src="<?php echo e(asset('images/viajesMailIcon.png')); ?>" class="img-fluid">
		</div>
		<div class="travelOffersText col-sm-4 col-4 col-md-2">
			<p class="travelMainText">Descuentos en viajes</p>
			<p class="travelSecondText">Recibe ofertas y</p>
			<p class="travelAnyText">descubre Colombia</p>
		</div>
		<div class="travelOffersButton  col-sm-4 col-4 col-md-2">
			<p><a href="" data-toggle="modal" data-target="#travelSuscribe">Suscribir</a></p>
		</div>
	</div>
</div>

<div class="modal modalFormulario fade hide" id="travelSuscribe" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body modalFormulario-body">
				<div class="modal-containerFormulario">
					<h3 class="modal-titleForm titleForm-viajes">Suscribirse</h3>
					<form role=form method="POST" id="saveLeadViajes" action="<?php echo e(route('viajes.store')); ?>">
						<?php echo e(csrf_field()); ?>

						
						<input type="hidden" name="typeService" value="Viajes">
						<input type="hidden" name="channel" value="1">
						<input type="hidden" name="typeProduct" value="suscripción recibir ofertas">
						<div class="form-group">
							<label for="name" class="control-label">Nombres</label>
							<input type="text" name="name" class="form-control" id="name" validation-pattern="name" required="true" />
						</div>
						<div class="form-group">
							<label for="lastName" class="control-label">Apellidos</label>
							<input type="text" name="lastName" class="form-control" id="lastName" validation-pattern="name" required="true" />
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Correo electrónico</label>
							<input type="email" name="email" class="form-control" id="email" validation-pattern="email" required="true" />
						</div>
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono</label>
							<input type="text" name="telephone" class="form-control" id="telephone" validation-pattern="telephone" required="true" />
						</div>
						<div class="form-group">
							<label for="city" class="control-label">Ciudad</label>
							<select name="city" id="city" class="form-control" >
								<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($city['value']); ?>"><?php echo e($city['label']); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<p class="textCityForm">
							*Válido solo para ciudades que se desplieguen en la casilla.
						</p>

						<div class="form-group">
							<input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1" required>
							<label for="termsAndConditions" style="font-size: 13px; font-style: italic;">
								Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
							</label>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
								Guardar
							</button>
							<button type="button" class=" btn btn-danger buttonFormModal" data-dismiss="modal" aria-label="Close">
								Cerrar
							</button>
						</div>
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>



<!-- Want to Travel -->

<div id="wantToTravel">
	<div class="containImg">
		<img src="<?php echo e(asset('images/viajes-quieroViajar.jpg')); ?>" class="img-fluid">
	</div>
	<div class="wantToContent">
		<div class="WantToTitle">
			<p class="wantToMainTex">¡Quiero viajar!</p>
			<p class="wantToSecondTex">Conoce todas la facilidades de crédito que 
				<br>
				te damos para que puedas viajar.
			</p>
		</div>
		<div class="wantToButton">
			<p>
				<a href="" data-toggle="modal" data-target="#viajesModal">
					Preguntar ya
				</a>
			</p>
		</div>
	</div>
</div>	

	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>