



<?php $__env->startSection('title', 'Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta.'); ?>

<?php $__env->startSection('metaTags'); ?>
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
	<link rel="canonical" href="https://www.serviciosoportunidades.com/oportuya" />
	<meta name="description" content="Tarjeta Oportuya, nuestro cupo de tarjeta de crédito con el que podrás obtener todos los beneficios de ser un cliente Oportunidades.">
	<meta name="keywords" content="Tarjeta de credito, Tarjeta de crédito, solicitar tarjeta de credito, solicitar tarjeta de crédito, tarjeta de credito online, tarjeta de crédito online, su tarjeta de crédito, su tarjeta de credito, como sacar una tarjeta de credito, como sacar una tarjeta de crédito, como tramitar una tarjeta de credito, como tramitar una tarjeta de crédito, requisitos para tarjeta de crédito, requisitos para tarjeta de credito, obtén una tarjeta de credito, obtén una tarjeta de crédito, requisitos tarjeta de credito, requisitos tarjeta de crédito, quiero una tarjeta de credito, quiero una tarjeta de crédito, tarjeta oportunidades, oportunidades, tarjeta con credito para compras, tarjeta con crédito para compras, credito en tarjeta, crédito en tarjeta.">
	<meta property="og:title" content="Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta." />
	<meta property="og:url" content="https://www.serviciosoportunidades.com/oportuya" />
	<meta property="og:type" content="Website" />
	<meta property="og:image" content="<?php echo e(asset('images/OportuyaPortadaOg.png')); ?>" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />
	<meta property="og:description" content="Tarjeta Oportuya, nuestro cupo de tarjeta de crédito con el que podrás obtener todos los beneficios de ser un cliente Oportunidades">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Slider Section Oportuya Page -->
	<div id="oportuyaSlider">
		<?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="containImg">
				<img src="/images/<?php echo e($slider['img']); ?>" class="img-fluid img-responsive" title="<?php echo e($slider['title']); ?>" />
				<div class="oportuyaSliderContent">
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
					<div class="oportuyaSliderButton">
						<p>
							<a href="/step1" alt="Realizar Solicitud de Crédito">
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

<!-- Credit Card Section -->

	<div id="oportuyaCards">
		<div class="row oportuyaCardsContent">
			<div class="row contentCards">
				<div class="col-lg-4 col-md-12 col-xs-12 col-sm-12 contentCreditcards beforeLine">
					<div class="cardImageContainer">
						<div class="cardImage cardImageGray">
							<div class="side">
								<img src="<?php echo e(asset('/images/tarjetaGray.png')); ?>" class="img-fluid">
							</div>
							<div class="side back">
								<ul>
									<li>Aplica para aquellas personas que aún no cuentan con historial de 
									crédito en el sector financiero.</li><hr style="visibility: hidden;height: 1pt; margin:7px;">
									<li>Cuenta con un cupo hasta por $2.000.000 dependiendo de su 
									capacidad de endeudamiento.</li><hr style="visibility: hidden;height: 1pt; margin:7px;">
									<li>Todas las compras tienen un descuento del 10%.							 
									Cupo rotativo.</li><hr style="visibility: hidden;height: 1pt; margin:7px;">
									<li>No aplica cuota de manejo si no se está haciendo uso del cupo de 
									la tarjeta.</li>
								</ul>
							</div>
						</div>	
					</div>
					<h1 class="titleContentCard">
						<span>Tarjeta de crédito Gray<i class="fa fa-check-square-o checkIcon"></i></span>  
					</h1>
					<p class="descriptionContentCard">
						Ofertas especiales permanentes
					</p>
					<p class="buttonCard">
						<a href="" class="buttonCreditCard buttonCreditCardGray	" data-toggle="modal" data-target="#tarjetaGrayModal">Conoce más</a>
					</p>
				</div>
				<div class="col-lg-4 col-md-12 col-xs-12 col-sm-12 contentCreditcards beforeLine">
					<div class="cardImageContainer">
						<div class="cardImage cardImageBlue ">
							<div class="side">
								<img src="<?php echo e(asset('/images/tarjetaBlue.png')); ?>" class="img-fluid">
							</div>
							<div class="side back">
								<ul>
									<li>Aplica para nuestros clientes actuales de crédito tradicional 
									Oportunidades con buen hábito de pago y buena calificación en las 
									centrales de riesgo.</li><hr style="visibility: hidden;height: 1pt; margin:4px;">
									<li>Cuenta con un cupo hasta por $3.000.000.</li><hr style="visibility: hidden;height: 1pt; margin:4px;">
									<li>Tiene avance en efectivo hasta $500.000.</li><hr style="visibility: hidden;height: 1pt; margin:4px;">
									<li> Puede diferir el avance desde 6 hasta 9 meses.</li><hr style="visibility: hidden;height: 1pt; margin:4px;">
									<li>Todas las compras tienen un descuento del 10%.</li><hr style="visibility: hidden;height: 1pt; margin:4px;">
									<li>Cupo rotativo.</li><hr style="visibility: hidden;height: 1pt; margin:4px;">								
									<li>No aplica cuota de manejo si no se está haciendo uso del cupo de 
									la tarjeta.</li>
								</ul>
							</div>
						</div>
					</div>
					<h1 class="titleContentCard">
						<span>Tarjeta de crédito Blue<i class="fa fa-check-square-o checkIcon"></i></span>  
					</h1>
					<p class="descriptionContentCard">
						¿Aún no la tienes? ¡Pidela ya!
					</p>
					<p  class="buttonCard">
						<a href="" class="buttonCreditCard  buttonCreditCardBlue" data-toggle="modal" data-target="#tarjetaBlueModal">Conoce más</a>
					</p>
				</div>

				<div class="col-lg-4 col-md-12 col-xs-12 col-sm-12 contentCreditcards">
					<div class="cardImageContainer">
						<div class="cardImage cardImageBlack ">
							<div class="side">
								<img src="<?php echo e(asset('/images/tarjetaBlack.png')); ?>" class="img-fluid">
							</div>
							<div class="side back">
								<ul>
									<li>Aplica para todos los clientes con calificación AAA en las 
									centrales de riesgo.</li><hr style="visibility: hidden;height: 1pt; margin:3px;">
									<li>Cuenta con cupo hasta por $3.000.000.</li><hr style="visibility: hidden;height: 1pt; margin:3px;">
									<li>Tiene avance en efectivo hasta $500.000.</li><hr style="visibility: hidden;height: 1pt; margin:3px;">
									<li> Puede diferir el avance desde 6 hasta 9 meses.</li><hr style="visibility: hidden;height: 1pt; margin:3px;">
									<li>Todas las compras tienen un descuento del 10%.</li><hr style="visibility: hidden;height: 1pt; margin:3px;">
									<li>Promociones y descuentos en temporadas especiales en nuestras 
									tiendas.</li><hr style="visibility: hidden;height: 1pt; margin:3px;">
									<li>No aplica cuota de manejo si no se está haciendo uso del cupo de 
									la tarjeta.</li>
								</ul>
							</div>
						</div>
					</div>
					<h1 class="titleContentCard">
						<span>Tarjeta de crédito Black<i class="fa fa-check-square-o checkIcon"></i></span>  
					</h1>
					<p class="descriptionContentCard">
						Con tu tarjeta oportuya tienes avance de efectivo hasta $500.000
					</p>
					<p class="buttonCard">
						<a href="" class="buttonCreditCard buttonCreditCardBlack" data-toggle="modal" data-target="#tarjetaBlackModal">Conoce más</a>
					</p>
				</div>
			</div>
		</div>
	</div>

<!--Requirements Section -->

	<div id="requirements">
		<div class="row requirementsContent">
			<div class="col-md-6 col-xs-12 contentRequirements ">
				<img src="<?php echo e(asset('/images/requirementsIcon.png')); ?>" class="img-responsive">
				<p class="titleRequirements">
					Requisitos
				</p>
				<p class="descriptionRequirements">
					<ul class="requirementsList">
						<li>Ser empleado o independiente con un tiempo mínimo de cuatro (4) meses.</li>
						<li>No presentar reportes negativos en las centrales de riesgo.</li>
						<li>Tener ingresos iguales o superior a 1 SMMLV.</li>
						<li>No haber cumplido los 70 años de edad.</li>
						<li>Si tiene entre 70 y 80 años debe ser pensionado.</li>
						<li>Presentar un buen historial de crédito en el sector financiero.</li>
						<li>Ser mayor de edad.</li>
					</ul>
				</p>
			</div>

			<div class="col-md-6 col-xs-12 contentRequirements requirementsLine">

				<img src="<?php echo e(asset('/images/howGetIcon.png')); ?>" class="img-responsive">

				<p class="titleRequirements">

					Como Tenerla

				</p>

				<p class="descriptionRequirements">

					<b>Estas interesado en obtenerla?	</b> <br>
					<br>	
					Solo debes ingresar los datos y un asesor se pondrá en contacto contigo, o si quieres ir a nuestras oficinas ubicadas en 48 ciudades del Pais, Cualquiera de nuestros asesores estará listo para atenderte. <br> <br>	<b>Te esperamos! </b>

				</p>

			</div>

		</div>

	</div>
	
<!-- Oportuya section -->
	<div id="oportuyaSection">
		<div class="oportuyaContent">
			<div class=" row oportuyaContentHeader">
				<p class="textOportuyaHeader oportuyaText">
					<b class="efectiveText">
						Solicita tu crédito en línea
					</b>
					
					
				</p>
				<div class="col-md-3 col-sm-3 oportuyaHeaderImage">
					<img src="<?php echo e(asset('/images/logoOportuya-inverso.png')); ?>" class="img-fluid">
				</div>
				<div class="col-sm-9 col-md-9 oportuyaTextResponsive">
					<p class="textOportuyaHeader">
						<b class="efectiveText">
							Solicita tu crédito en línea
						</b>
										
					</p>
				</div>
			</div>
			<div class="row oportuyaContentFeatures">
				<div class=" col-md-8">
					<div class="row">
						<div class="col-xs-12 col-12 contentFeatures">
								<div class="row contentListFeatures">
									<div class="col-md-4 text-center stepContainer steps">
										<img src="<?php echo e(asset('/images/iconPaso1.png')); ?>">
										<p>
											<span>Paso 1</span>	
										</p>										
										<p>Déjanos tus datos</p>
									</div>
									<div class="col-md-4 text-center stepContainer steps">
										<img src="<?php echo e(asset('/images/iconPaso2.png')); ?>">
										<p>
											<span>Paso 2</span>	
										</p>										
										<p>Llena tu solicitud de crédito</p>
									</div>
									<div class="col-md-4 text-center steps">
										<img src="<?php echo e(asset('/images/iconPaso3.png')); ?>">
										<p>
											<span>Paso 3</span>
										</p>
										<p>Empieza a disfrutar de los mejores descuentos</p>
									</div>
								</div>
								<div class=" row contentListFeaturesResponsive">
									<div class="col-12 col-md-12 col-lg-4 text-center stepContainer steps">
										<div class="row stepResponsive">
											<div class="col-2 col-md-2">
												<img src="<?php echo e(asset('/images/iconPaso1.png')); ?>">
											</div>
											<div class="col-2 col-md-3 text-left">
												
												<span>Paso 1</span>	
												
											</div>
											<div class="col-8 col-md-7 text-left">
												<p>Déjanos tus datos</p>
											</div>
										</div>									
									</div>
									<div class="col-12 col-md-12 col-lg-4 text-center stepContainer steps">
										<div class="row stepResponsive">
											<div class="col-2 col-md-2">
												<img src="<?php echo e(asset('/images/iconPaso2.png')); ?>">
											</div>
											<div class="col-2 col-md-3 text-left">
												
												<span>Paso 2</span>	
												
											</div>
											<div class="col-8 col-md-7 text-left">
												<p>Llena tu solicitud de crédito</p>
											</div>
										</div>		
									</div>
									<div class="col-12 col-md-12 col-lg-4 text-center steps">
										<div class="row stepResponsive">
											<div class="col-2 col-md-2">
												<img src="<?php echo e(asset('/images/iconPaso3.png')); ?>">
											</div>
											<div class="col-2 col-md-3 text-left">
												
												<span>Paso 3</span>	
												
											</div>
											<div class="col-8 col-md-7 text-left">
												<p>Empieza a disfrutar de los mejores descuentos</p>
											</div>
										</div>		
									</div>
								</div>
								<div class="row">
								</div>
							
						</div>
						
					</div>

					<div class="row buttonOportuyaSection buttonOportuya text-center">
						<a href="/step1" alt="Realizar Solicitud de Crédito" >
							¡Solicítala aquí!
						</a>
					</div>
					
					<div class="row buttonOportuyaSection responsiveButtonOportuya">
						<a href="/step1" alt="Realizar Solicitud de Crédito" >
							¡Solicita la tuya ahora!
						</a>
					</div>
				</div>
				<div class=" col-md-4 contentFeatures oportuyaContentImage">

					<img src="<?php echo e(asset('/images/modeloNew.png')); ?>" class="img-fluid">	

				</div>
			</div>
			
		</div>
	</div>

	<div id="servicesPoint">
		<div class="row">
			<div class="col-12 col-md-6 servicesPointContainer">
				<div class="serviceContainer">
					<img src="<?php echo e(asset('/images/iconPuntosServicio.png')); ?>">
					<p>48 Puntos de servicios para que puedas</p>
					<p>utilizar tus tarjetas Oportuya</p>
				</div>
			</div>
			<div class="col-12 col-md-6 servicesPointCard">
				<div class="serviceContainerCard">
					<img src="<?php echo e(asset('/images/tarjeta-de-credito_28.png')); ?>">	
					<p>Los mejores descuentos con </p>
					<p>nuestras tarjetas de crédito</p>				
				</div>
			</div>
		</div>
		
	</div>

	<div class="fixedButton">
		<div class="row">
			<div class="col-2">
				<img src="<?php echo e(asset('images/iconFlotante.png')); ?>">	
			</div>
			<div class="col-8">
				<p>
					<span>¡Te gustaría saber</span>
				</p>
				<p>
					<span> por qué pedimos </span>
				</p>
				<p>
					<span>tus datos!</span>	
				</p>
			</div>
			<div class="col-12">
				<a href="">Click aquí</a>	
			</div>		
		</div>
	</div>
<!-- oportuya Modal -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>