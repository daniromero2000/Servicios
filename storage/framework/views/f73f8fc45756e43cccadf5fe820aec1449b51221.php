<?php $__env->startSection('title', 'Tarjeta de Crédito Oportuya'); ?>

<?php $__env->startSection('content'); ?>
	
<!-- Slider Section Oportuya Page -->

	<div id="oportuyaSlider">
		<?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="containImg">
				<img src="images/<?php echo e($slider['img']); ?>" class="img-fluid img-responsive" title="<?php echo e($slider['title']); ?>" />
				
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
							<a href="">
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
					<img src="<?php echo e(asset('images/tarjetaGray.png')); ?>" class="img-fluid">
					<h1 class="titleContentCard">
						<span>Tarjeta de crédito gray<i class="fa fa-check-square-o checkIcon"></i></span>  
					</h1>
					<p class="descriptionContentCard">
						Con tu tarjeta oportuya tienes avance de efectivo hasta $500.000
					</p>
					<p class="buttonCard">
						<a href="" class="buttonCreditCard" data-toggle="modal" data-target="#tarjetaGrayModal">Conoce más</a>
					</p>
				</div>
				<div class="col-lg-4 col-md-12 col-xs-12 col-sm-12 contentCreditcards beforeLine">
					<img src="<?php echo e(asset('images/tarjetaBlue.png')); ?>" class="img-fluid">
					<h1 class="titleContentCard">
						<span>Tarjeta de crédito Blue<i class="fa fa-check-square-o checkIcon"></i></span>  
					</h1>
					<p class="descriptionContentCard">
						¿Aún no la tienes? ¡Pidela ya!
					</p>
					<p  class="buttonCard">
						<a href="" class="buttonCreditCard" data-toggle="modal" data-target="#tarjetaBlueModal">Conoce más</a>
					</p>
				</div>
				<div class="col-lg-4 col-md-12 col-xs-12 col-sm-12 contentCreditcards">
					<img src="<?php echo e(asset('images/tarjetaBlack.png')); ?>" class="img-fluid">
					<h1 class="titleContentCard">
						<span>Tarjeta de crédito Black<i class="fa fa-check-square-o checkIcon"></i></span>  
					</h1>
					<p class="descriptionContentCard">
						Ofertas especiales permanentes
					</p>
					<p class="buttonCard">
						<a href="" class="buttonCreditCard" data-toggle="modal" data-target="#tarjetaBlackModal">Conoce más</a>
					</p>
				</div>
			</div>
		</div>
	</div>

<!-- tarjeta Gray Modal -->

<div class="modal fade hide" id="tarjetaGrayModal" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<div class="modal-header">
				<h4>Tarjeta Oportuya Gray</h4>
			</div>

			<div class="modal-body">
				
				<form role=form method="POST" action="<?php echo e(route('oportuya.store')); ?>">
					<?php echo e(csrf_field()); ?>

					<input type="hidden" name="typeProduct" value="Gray">
					<div class="form-group">
						<label for="name" class="control-label">Nombres</label>
						<input type="text" name="name" class="form-control" id="name" />
					</div>
					<div class="form-group">
						<label for="lastName" class="control-label">Apellidos</label>
						<input type="text" name="lastName" class="form-control" id="lastName" />
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Correo electronico</label>
						<input type="email" name="email" class="form-control" id="email" />
					</div>
					<div class="form-group">
						<label for="telephone class="control-label">Teléfono</label>
						<input type="tel" name="telephone" class="form-control" id="telephone" />
					</div>
					<div class="form-group">
						<label for="ciudad class="control-label">Ciudad</label>
						<input type="text" name="city" class="form-control" id="ciudad" />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							Guardar
						</button>
						<button type="button" class=" btn btn-danger" data-dismiss="modal" aria-label="Close">
							Cerrar
						</button>
					</div>
				</form>

			</div>

		</div>

	</div>
	
</div>


<!-- tarjeta Blue Modal -->
	
<div class="modal fade hide" id="tarjetaBlueModal" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<div class="modal-header">
				<h4>Tarjeta Oportuya Blue</h4>
			</div>

			<div class="modal-body">
				
				<form role=form method="POST" action="<?php echo e(route('oportuya.store')); ?>">
					<?php echo e(csrf_field()); ?>

					<input type="hidden" name="typeProduct" value="Blue">
					<div class="form-group">
						<label for="name" class="control-label">Nombres</label>
						<input type="text" name="name" class="form-control" id="name" />
					</div>
					<div class="form-group">
						<label for="lastName" class="control-label">Apellidos</label>
						<input type="text" name="lastName" class="form-control" id="lastName" />
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Correo electronico</label>
						<input type="email" name="email" class="form-control" id="email" />
					</div>
					<div class="form-group">
						<label for="telephone class="control-label">Teléfono</label>
						<input type="tel" name="telephone" class="form-control" id="telephone" />
					</div>
					<div class="form-group">
						<label for="ciudad class="control-label">Ciudad</label>
						<input type="text" name="city" class="form-control" id="ciudad" />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							Guardar
						</button>
						<button type="button" class=" btn btn-danger" data-dismiss="modal" aria-label="Close">
							Cerrar
						</button>
					</div>
				</form>

			</div>

		</div>

	</div>
	
</div>

<!-- tarjeta Black Modal -->
	
<div class="modal fade hide" id="tarjetaBlackModal" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<div class="modal-header">
				<h4>Tarjeta Oportuya Black</h4>
			</div>

			<div class="modal-body">
				
				<form role=form method="POST" action="<?php echo e(route('oportuya.store')); ?>">
					<?php echo e(csrf_field()); ?>

					<input type="hidden" name="typeProduct" value="Black">
					<div class="form-group">
						<label for="name" class="control-label">Nombres</label>
						<input type="text" name="name" class="form-control" id="name" />
					</div>
					<div class="form-group">
						<label for="lastName" class="control-label">Apellidos</label>
						<input type="text" name="lastName" class="form-control" id="lastName" />
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Correo electronico</label>
						<input type="email" name="email" class="form-control" id="email" />
					</div>
					<div class="form-group">
						<label for="telephone class="control-label">Teléfono</label>
						<input type="tel" name="telephone" class="form-control" id="telephone" />
					</div>
					<div class="form-group">
						<label for="ciudad class="control-label">Ciudad</label>
						<input type="text" name="city" class="form-control" id="ciudad" />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							Guardar
						</button>
						<button type="button" class=" btn btn-danger" data-dismiss="modal" aria-label="Close">
							Cerrar
						</button>
					</div>
				</form>

			</div>

		</div>

	</div>
	
</div>


<!--Requirements Section -->

	<div id="requirements">
		<div class="row requirementsContent">
			<div class="col-md-6 col-xs-12 contentRequirements ">
				<img src="<?php echo e(asset('images/requirementsIcon.png')); ?>" class="img-responsive">
				<p class="titleRequirements">
					Requisitos
				</p>
				<p class="descriptionRequirements">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras pellentesque dapibus tellus non viverra. Integer nec orci at urna feugiat fringilla scelerisque a mauris. Fusce ac metus ultrices, tristique leo sit amet, ornare nulla. Suspendisse feugiat justo ligula, at laoreet felis fringilla at. Ut elementum tortor ac tortor dictum ullamcorper. Vestibulum faucibus quam ut tortor eleifend aliquet. Vivamus a nulla at libero imperdiet suscipit eu in tortor
				</p>
				<p>
					<a href="" class="buttonRequirements" data-toggle="modal" data-target="#requirementsModal">
						Conoce más
					</a>
				</p>
			</div>
			<div class="col-md-6 col-xs-12 contentRequirements requirementsLine">
				<img src="<?php echo e(asset('images/howGetIcon.png')); ?>" class="img-responsive">
				<p class="titleRequirements">
					Como Tenerla
				</p>
				<p class="descriptionRequirements">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras pellentesque dapibus tellus non viverra. Integer nec orci at urna feugiat fringilla scelerisque a mauris. Fusce ac metus ultrices, tristique leo sit amet, ornare nulla. Suspendisse feugiat justo ligula, at laoreet felis fringilla at. Ut elementum tortor ac tortor dictum ullamcorper. Vestibulum faucibus quam ut tortor eleifend aliquet. Vivamus a nulla at libero imperdiet suscipit eu in tortor
				</p>
				<p>
					<a href="" class="buttonRequirements" data-toggle="modal" data-target="#requirementsModal">
						Conoce más
					</a>
				</p>
			</div>
		</div>
	</div>

<!-- Requirements Modal -->
	
<div class="modal fade hide" id="requirementsModal" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<div class="modal-header">
				<h4>Tarjeta Oportuya Gray</h4>
			</div>

			<div class="modal-body">
				
				<form role=form method="POST" action="<?php echo e(route('oportuya.store')); ?>">
					<?php echo e(csrf_field()); ?>

					<input type="hidden" name="typeProduct" value="Gray">
					<div class="form-group">
						<label for="name" class="control-label">Nombres</label>
						<input type="text" name="name" class="form-control" id="name" />
					</div>
					<div class="form-group">
						<label for="lastName" class="control-label">Apellidos</label>
						<input type="text" name="lastName" class="form-control" id="lastName" />
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Correo electronico</label>
						<input type="email" name="email" class="form-control" id="email" />
					</div>
					<div class="form-group">
						<label for="telephone class="control-label">Teléfono</label>
						<input type="tel" name="telephone" class="form-control" id="telephone" />
					</div>
					<div class="form-group">
						<label for="ciudad class="control-label">Ciudad</label>
						<input type="text" name="city" class="form-control" id="ciudad" />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							Guardar
						</button>
						<button type="button" class=" btn btn-danger" data-dismiss="modal" aria-label="Close">
							Cerrar
						</button>
					</div>
				</form>

			</div>

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
					<img src="<?php echo e(asset('images/tarjetaOportuyaLogo.png')); ?>" class="img-fluid">

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
						
						<div class="col-xl-10 contentFeatures">
							<div>
								<p class="featuresfirstText">El crédito para lo que más te guste</p>
								
								<p>Además tiene:</p>
								
								<div class="row contentListFeatures">
									<div class="col-md-6">
										<ul class="list-group">
											<li >Descuentos especiales en 
												<br>
												compra de electrodomésticos
											</li>
											<li >
												Crédito en establecimientos
												<br>
												con convenio oportuya
											</li>
											<li >
												Crédito sin codeudor
											</li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul class="list-group">
											<li >
												Cupo rotativo en productos y avances
											</li>
											<li >
												Promociones permanentes
											</li>
											<li >
												Historial crediticio
											</li>
										</ul>
									</div>
								</div>
								<div class=" row contentListFeaturesResponsive">
									<ul>	
										<li >Descuentos especiales en 
												<br>
												compra de electrodomésticos
											</li>
											<li >
												Crédito en establecimientos
												<br>
												con convenio oportuya
											</li>
											<li >
												Crédito sin codeudor
											</li>
											<li >
												Cupo rotativo en productos y avances
											</li>
											<li >
												Promociones permanentes
											</li>
											<li >
												Historial crediticio
											</li>
									</ul>
								</div>
								<div class="row">
									
								</div>
							</div>
						</div>

						<div class="col-xl-2">
							
						</div>

					</div>

					<div class="row soatImageContainer">
						<div class="col-md-9">
							<img src="<?php echo e(asset('images/oportuyaSoat.png')); ?>" class="img-fluid">
						</div>
						<div class="col-md-3">
							
						</div>
					</div>

					<div class="row buttonOportuyaSection responsiveButtonOportuya">
						<a href="#">
							¡solicite la suya ahora!
						</a>
					</div>

					


				</div>


				<div class=" col-md-4 contentFeatures oportuyaContentImage">
					<img src="<?php echo e(asset('images/oportuyaModelo.png')); ?>" class="img-fluid">	
				</div>
				
			</div>
			<div class="row buttonOportuyaSection buttonOportuya">
				<a href="" data-toggle="modal" data-target="#oportuyaModal">
					¡solicite la suya ahora!
				</a>
			</div>
		</div>		
	</div>



<!-- oportuya Modal -->
	
<div class="modal fade hide" id="oportuyaModal" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<div class="modal-header">
				<h4>Tarjeta Oportuya Gray</h4>
			</div>

			<div class="modal-body">
				
				<form role=form method="POST" action="<?php echo e(route('oportuya.store')); ?>">
					<?php echo e(csrf_field()); ?>

					<input type="hidden" name="typeProduct" value="Gray">
					<div class="form-group">
						<label for="name" class="control-label">Nombres</label>
						<input type="text" name="name" class="form-control" id="name" />
					</div>
					<div class="form-group">
						<label for="lastName" class="control-label">Apellidos</label>
						<input type="text" name="lastName" class="form-control" id="lastName" />
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Correo electronico</label>
						<input type="email" name="email" class="form-control" id="email" />
					</div>
					<div class="form-group">
						<label for="telephone class="control-label">Teléfono</label>
						<input type="tel" name="telephone" class="form-control" id="telephone" />
					</div>
					<div class="form-group">
						<label for="ciudad class="control-label">Ciudad</label>
						<input type="text" name="city" class="form-control" id="ciudad" />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							Guardar
						</button>
						<button type="button" class=" btn btn-danger" data-dismiss="modal" aria-label="Close">
							Cerrar
						</button>
					</div>
				</form>

			</div>

		</div>

	</div>
	
</div>


<!-- Offers section -->

	<div id="offers">
		
		<div class="offers">	

			<div class="row">
				<div class="offersTitle">
					<p>	Aprovecha las super ofertas</p>	
				</div>			
			</div>

			<div class="row offersDescription">	

				<div class="col-md-12 col-lg-6">	
					<div class="offersContent">	
						<div class="offersImageContent">
							<div class="imageOffer">
								<img src="<?php echo e(asset('images/aprovechaTelevisor.png')); ?>" class="img-fluid">
							</div>
							<br>
							<div class="offersPrice1">
								<img src="<?php echo e(asset('images/aprovechaFondoPrecio.png')); ?>" class="img-fluid">
								<span>$900.000</span>
							</div>
							<br>
							<div>
								<p>Televisor LG 43 pulgadas 43lk5700 Fhd Smart-Internet +</p>
								<p>Microcomponente LG $2.409.900$1.199.900</p>
							</div>
							<p class="buttonOffers">
								<a href="#">
									Comprar a crédito
								</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-lg-6">	
					<div class="offersContent">	
						<div class="offersImageContent">
							<div class="imageOffer">
								<img src="<?php echo e(asset('images/aprovechaCelular.png')); ?>" class="img-fluid">	
							</div>							
							<br>
							<div class="offersPrice2">
								<img src="<?php echo e(asset('images/aprovechaFondoPrecio.png')); ?>" class="img-fluid">
								<span>$999.000</span>
							</div>
							<br>
							<div>
								<p>Celular Q6 Prime LGM700F.ACOLPL</p>
								<p>LG $899.900$519.900</p>
							</div>
							<p class="buttonOffers">
								<a href="#">
									Comprar a crédito
								</a>
							</p>
						</div>
					</div>
				</div>

			</div>	

		</div>	
		
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>