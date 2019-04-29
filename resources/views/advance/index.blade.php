@extends('layouts.app')

@section('title', 'Avances')

@section('metaTags')
	{{-- <meta name="description" content="">
	<meta name="keywords" content="">
	<meta property="og:title" content="" />
	<meta property="og:url" content="" />
	<meta property="og:type" content="" />
	<meta property="og:image" content="" />
	<meta property="og:description" content=""> --}}
@endsection()
@section('content')
<div id="oportuyaSlider">
	@foreach($images as $slider)
		<div class="containImg">
			<img src="/images/{{ $slider['img'] }}" class="img-fluid img-responsive" title="{{ $slider['title'] }}" />
			<div class="avanceSliderContent text-center">
				<div class="avanceSliderTitle">
						@php
							$titleChunk=explode("-",$slider['title'],2);								
							$chunkOne= @$titleChunk[0];
							$chunkTwo= @$titleChunk[1];
							$chunkOneExplode= explode("_", $chunkOne,2);
							$chunkTwoExplode= explode("_",$chunkTwo,2);
							$chunkExplodeOne=@$chunkOneExplode[0];
							$chunkExplodeTwo=@$chunkOneExplode[1];
							$chunkExplodeThree=@$chunkTwoExplode[0];
							$chunkExplodeFour=@$chunkTwoExplode[1];
						@endphp
					<p>
						@php
							echo $chunkExplodeOne.' <span class="textTitleSliderPink">'.$chunkExplodeTwo.'</span>';
						@endphp							
					</p>
					<p>
						@php
							echo $chunkExplodeThree.' <span class="textTitleSliderBlue">'.$chunkExplodeFour.'</span>';
						@endphp							
					</p>
				</div>
				<br>
				<br>
				<div class="avanceSliderButton">
					<p>
						<a href="/avance/step1" alt="Realizar Solicitud de Crédito">
							@php
								echo $slider['textButton'];
							@endphp
						</a>
					</p>
				</div>
			</div>
		</div>
	@endforeach
</div>
<div id="requisitos-avances">
	<div class="container text-center">
		<h3><span>Confiamos en ti</span>, te prestamos <br> efectivo con estos requisitos.	</h3>
	</div>
</div>
<div id="requisitos-avaces-iconos">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-4 col-md-4 text-center">
				<div class="container-avances-iconos">
					<img src="{{asset('images/18masIcon.jpg')}}" alt="" class="img-fluid">
					<br>
					<span>Ser mayor <br> de edad</span>
				</div>
			</div>
			<div class="col-12 col-sm-4 col-md-4 text-center">
				<div class="container-avances-iconos">
					<img src="{{asset('images/cell-icon-avances.jpg')}}" alt="" class="img-fluid">
					<br>
					<span>Tener número de<br> celular propio</span>
				</div>
			</div>
			<div class="col-12 col-sm-4 col-md-4 text-center">
				<div class="container-avances-iconos">
					<img src="{{asset('images/ahorroIcon-avances.jpg')}}" alt="" class="img-fluid">
					<br>
					<span>Ingresos <br> verificables</span>
				</div>
			</div>
		</div>	
	</div>
</div>
<div id="obtener-avance">
	<img src="{{asset('images/banner2-avances.jpg')}}" alt="" class="img-fluid">
	<div class="obtener-avance-texto">
		<p>Obtén tu <span>avance</span> en efectivo</p>
		<p>en menos de <span>15 minutos.</span></p>
		<br>
		<a href="https://api.whatsapp.com/send?phone=573115195753&text=Estoy%20interesado%20en%20obtener%20informaci%C3%B3n%20acerca%20de%20Avances%20Oportunidades." target="_blank">Escribenos por Whatsapp <i class="fab fa-whatsapp"></i></a>
	</div>
</div>
<div id="credito-online">
	<img src="{{asset('images/banner3-top-avances.jpg')}}" alt="" class="img-fluid">
	<div class="container text-center credito-online-texto">
		<div>
			<h3><span>Crédito Online</span>, desde la  <br> comodidad de tu casa.	</h3>
		</div>	
	</div>
	<div class="credito-online-boton">
		<p class="textTarjeta">
			<i>*Tarjeta Oportuya NO VIGILADA por la SUPERINTENDENCIA FINANCIERA de Colombia</i>
		</p>
		<div>
			<a href="/avance/step1">Click para Crédito</a>
		</div>
	</div>
</div>
<div id="newsletter-avance">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-6">
				<h3>
					SÉ EL PRIMERO EN RECIBIR NUESTRAS <br> OFERTAS Y LANZAMIENTOS
				</h3>
			</div>
			<div class="col-12 col-sm-12 col-md-6">
				<div class="newsletter-avance-input">
					<form action="{{route('newsletter.store')}}" method="POST">
						{{ csrf_field() }}
						<div class="row">
								<div class="col-10">
									<input type="email" name="email" class="form-control" placeholder="Ingresa tu correo electrónico">	
								</div>
								<div class="col-2">
									<div class="input-group-prepend">
										<button class="btn btn-newsletter-avances"><i class="fas fa-paper-plane"></i></button>
									</div>
								</div>
								<div class="form-group">
									<input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1" required>
									<label for="termsAndConditions" style="font-size: 10px; font-style: italic;">
										Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
									</label>
								</div>
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection