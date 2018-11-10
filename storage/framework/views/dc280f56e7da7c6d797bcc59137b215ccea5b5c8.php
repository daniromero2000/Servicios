<?php $__env->startSection('title', 'Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta.'); ?>

<?php $__env->startSection('metaTags'); ?>
	<meta name="description" content="Tarjeta Oportuya, nuestro cupo de tarjeta de crédito con el que podrás obtener todos los beneficios de ser un cliente Oportunidades.">
	<meta name="keywords" content="Tarjeta de credito, Tarjeta de crédito, solicitar tarjeta de credito, solicitar tarjeta de crédito, tarjeta de credito online, tarjeta de crédito online, su tarjeta de crédito, su tarjeta de credito, como sacar una tarjeta de credito, como sacar una tarjeta de crédito, como tramitar una tarjeta de credito, como tramitar una tarjeta de crédito, requisitos para tarjeta de crédito, requisitos para tarjeta de credito, obtén una tarjeta de credito, obtén una tarjeta de crédito, requisitos tarjeta de credito, requisitos tarjeta de crédito, quiero una tarjeta de credito, quiero una tarjeta de crédito, tarjeta oportunidades, oportunidades, tarjeta con credito para compras, tarjeta con crédito para compras, credito en tarjeta, crédito en tarjeta.">
	<meta property="og:title" content="Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta." />
	<meta property="og:url" content="www.serviciosoportunidades.com/oportuya" />
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
							<a href="" data-toggle="modal" data-target="#oportuyaModal">
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
						<span>Tarjeta de crédito gray<i class="fa fa-check-square-o checkIcon"></i></span>  
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
					Solo debes ingresar los datos y te llamaremos en menos de 2 horas, o si quieres ir a nuestras oficinas ubicadas en 48 ciudades del Pais, Cualquiera de nuestros asesores estará listo para atenderte. <br> <br>	<b>Te esperamos! </b>

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
						Avance en efectivo hasta por : <span>$ 500.000</span>
					</b>
					<br>
					<b class="salePoint">
						En cualquier punto de venta Oportunidades del país 
					</b>
					<br>
					<span>
						*Aplica para tarjetas azul y negra
					</span>
				</p>
				<div class="col-md-3 col-sm-3 oportuyaHeaderImage">
					<img src="<?php echo e(asset('/images/tarjetaOportuyaLogo.png')); ?>" class="img-fluid">
				</div>
				<div class="col-sm-9 col-md-9 oportuyaTextResponsive">
					<p class="textOportuyaHeader">
						<b class="efectiveText">
							Avance en efectivo hasta por : <span>$ 500.000</span>
						</b>
						<br>
						<b class="salePoint">
							En cualquier punto de venta Oportunidades del país 	
						</b>					
						<br>
						<span>
							*Aplica para tarjetas azul y negra	
						</span>					
					</p>
				</div>
			</div>
			<div class="row oportuyaContentFeatures">
				<div class=" col-md-8">
					<div class="row">
						<div class="col-xs-12 col-12 contentFeatures">
							<div>
								<div class="row">
									<div class="col-lg-6 bestPricesImg">
										<img src="<?php echo e(asset('/images/mejoresPreciosOportuya.jpeg')); ?>" class="img-fluid">
									</div>
									<div class="col-sm-12 col-lg-6">
										<p class="featuresfirstText text-center">El crédito para lo que más te guste</p>		
									</div>
								</div>
								
								<p>Además tiene:</p>
								<div class="row contentListFeatures">
									<div class="col-md-6">
										<ul class="list-group">
											<li >
												Promociones permanentes.
											</li>
											<li >
												Crédito sin codeudor.
											</li>
											<li >Descuentos especiales en 
												<br>
												compra de electrodomésticos.
											</li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul class="list-group">
											<li >
												Cupo rotativo en productos y avances.
											</li>
											<li >
												Historial crediticio.
											</li>
											<li >
												Crédito en establecimientos
												<br>
												con convenio oportuya.
											</li>
										</ul>
									</div>
								</div>
								<div class=" row contentListFeaturesResponsive">
									<ul>
										<li >
											Descuentos especiales en 
											<br>
											compra de electrodomésticos.
										</li>
										<li >
											Crédito en establecimientos
											<br>
											con convenio oportuya.
										</li>
										<li >
											Crédito sin codeudor.
										</li>
										<li >
											Cupo rotativo en productos y avances.
										</li>
										<li >
											Promociones permanentes.
										</li>
										<li >
											Historial crediticio.
										</li>
									</ul>
								</div>
								<div class="row">
								</div>
							</div>
						</div>
						
					</div>
					<div class="row soatImageContainer">
						<div class="col-md-9">
							
						</div>
						<div class="col-md-3">
						</div>
					</div>
					<div class="row buttonOportuyaSection responsiveButtonOportuya">
						<a href="" data-toggle="modal" data-target="#oportuyaModal">
							¡Solicita la tuya ahora!
						</a>
					</div>
				</div>
				<div class=" col-md-4 contentFeatures oportuyaContentImage">

					<img src="<?php echo e(asset('/images/oportuyaModeloV2.png')); ?>" class="img-fluid">	

				</div>
			</div>
			<div class="row buttonOportuyaSection buttonOportuya">
				<a href="" data-toggle="modal" data-target="#oportuyaModal">
					¡Solicita la tuya ahora!
				</a>
			</div>
		</div>
	</div>
<!-- oportuya Modal -->

<div class="modal modalFormulario fade hide" id="oportuyaModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body modalFormulario-body">
				<div class="modal-containerFormulario">
					<h3 class="modal-titleForm titleForm-oportuya">
						Tarjeta de Crédito Oportuya
					</h3>
					<form role=form method="POST" id="saveLeadOportuya" action="<?php echo e(route('oportuya.store')); ?>">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="state" value="0">
						<input type="hidden" name="channel" value="1">
						<input type="hidden" name="typeService" value="terjeta de crédito Oportuya">

						<div class="form-group">
							<label for="name" class="control-label">Nombres</label>
							<input type="text" name="name" class="form-control" id="name" required="true"/>
						</div>
						<div class="form-group">
							<label for="lastName" class="control-label">Apellidos</label>
							<input type="text" name="lastName" class="form-control" id="lastName" required="true"/>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Correo electronico</label>
							<input type="email" name="email" class="form-control" id="email" required="true"/>
						</div>
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono</label>
							<input type="text" name="telephone" class="form-control" id="telephone" required="true"/>
						</div>

						<div class="row">
							
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tipo de tarjeta que te interesa</label>
									<select class="form-control"  id="typeProduct" name="typeProduct" required="true">
										<option value="tarjeta Gray">GRAY</option>
										<option value="tarjeta Blue">BLUE</option>
										<option value="tarjeta Black">BLACK</option>
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

<!-- Offers section -->

<?php

$arraySliderOffer=[
	
	[
		'nameProduct'=>'Lavadora WA17J6730LV Activ DualWash 17 kg carga ',
		'img'=>'lavaderoWA17J6730LV.png',
		'type'=>'Lavadora',
		'imgBackground'=>'aprovechaFondoPrecio.png',
		'price'=>'$1.499.900',
		'description'=>'<p>Lavadora WA17J6730LV Activ DualWash</p>
					    <p>Capacidad de 17 Kg. carga - Automatica - Control dígital</p>',
		'buttonText'=>'Comprar a crédito',
		'buttonLink'=>'#'
	],
	[
		'nameProduct'=>'Galaxy J7 Neo Samsung',
		'img'=>'celularSamsung_J7NEO.png',
		'type'=>'celular',
		'imgBackground'=>'aprovechaFondoPrecio.png',
		'price'=>'$429.900',
		'description'=>'<p>Celular Galaxy J7 Neo Samsung</p>
					    <p>Pantalla de 5.5 Pulgadas - RAM 2 GB - Cámara principal de 13 Mp</p>',
		'buttonText'=>'Comprar a crédito',
		'buttonLink'=>'#'
	],
	[
		'nameProduct'=>'Televisor Samsung E310LT',
		'img'=>'televisorLG_E310LT.png',
		'imgBackground'=>'aprovechaFondoPrecio.png',
		'type'=>'televisor',
		'price'=>'$599.900',
		'description'=>'<p>Televisor 28" E310LT Led Samsung</p>
					    <p>1.366x768 - HD - HDMI:2 - Sí TDT</p>',
		'buttonText'=>'Comprar a crédito',
		'buttonLink'=>'#'
	]
];

?>
<div id="offers">
		<div class="offers">
			<div class="row">
				<div class="offersTitle">
					<p>	Aprovecha las super ofertas</p>	
				</div>			
			</div>
			<div class="row offersDescription sliderOffer">	
				<?php $__currentLoopData = $arraySliderOffer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer => $arrayOffer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-md-12 col-lg-6">
						<div class="offersContent">	
							<div class="offersImageContent">
								<div class="imageOffer">
									<img src="/images/<?php echo e($arrayOffer['img']); ?>" class="img-fluid">
								</div>
								<br>
								<?php
									$typeProduct=($arrayOffer['type']=='televisor')?1:2;
								?>
								<div class="offersPrice<?php echo $typeProduct; ?>">
									<img src="/images/<?php echo e($arrayOffer['imgBackground']); ?>" class="img-fluid">
									<span><?php echo e($arrayOffer['price']); ?></span>
								</div>
								<br>
								<div>
									<?php
										echo $arrayOffer['description'];
									?>
								</div>
								<p class="buttonOffers">
									<a href="" data-toggle="modal" data-target="#offerProduct<?php echo e($offer); ?>">
										<?php echo e($arrayOffer['buttonText']); ?>

									</a>
								</p>
							</div>
						</div>
					</div>

				



				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


			</div>	

			<?php $__currentLoopData = $arraySliderOffer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offerItem => $arrayOfferItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					 <div class="modal modalFormulario fade hide" id="offerProduct<?php echo e($offerItem); ?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body modalFormulario-body">
				<div class="modal-containerFormulario">
					<h3 class="modal-titleForm titleForm-oportuya">
						Aprovecha nuestras ofertas
					</h3>
					<form role=form method="POST" id="saveLeadOportuya" action="<?php echo e(route('oportuya.store')); ?>">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="typeService" value="oportuya">
						<input type="hidden" name="typeProduct" value="<?php echo e($arrayOfferItem['nameProduct']); ?>">
						<div class="form-group">
							<label for="name" class="control-label">Nombres</label>
							<input type="text" name="name" class="form-control" id="name" required="true"/>
						</div>
						<div class="form-group">
							<label for="lastName" class="control-label">Apellidos</label>
							<input type="text" name="lastName" class="form-control" id="lastName" required="true"/>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Correo electronico</label>
							<input type="email" name="email" class="form-control" id="email" required="true"/>
						</div>
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono</label>
							<input type="text" name="telephone" class="form-control" id="telephone" required="true"/>
						</div>
						<div class="form-group">
							<label for="city class="control-label">Ciudad</label>
							<select name="city" id="city" class="form-control" >
								<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($city['value']); ?>"><?php echo e($city['label']); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group text-right">
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
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>	
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>