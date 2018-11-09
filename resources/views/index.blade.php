@extends('layouts.app')

@section('title', 'Servicios Financieros Oportunidades - Crédito para todo')



@section('metaTags')
	<meta name="description" content="Tenemos el crédito para todo lo que necesitas, electrodomésticos, crédito moto, crédito viajes, tarjeta de crédito , libranzas y seguros; encuentra todo en un mismo lugar y siempre con los mejores precios.">
	<meta name="keywords" content="Credito, Crédito, solicitar credito de libranzas, solicitar crédito de libranzas, credito para motos, crédito para motos, credito para viajes, crédito para viajes, viajes, tarjeta de credito, tarjeta de crédito, prestamos, préstamos, préstamos con tarjeta, prestamos con tarjeta, credito libre inversion, crédito libre inversión, credito pensionados, crédito pensionados, motos a credito, motos a crédito, viajes a credito, viajes a crédito, electrodomesticos a credito, electrodomésticos a crédito, venta de electrodomesticos, venta de electrodomésticos, solicitar tarjeta de credito, solicitar tarjeta de crédito, credito en linea, crédito en línea, televisores a credito,televisores a crédito, lavadoras a credito, lavadoras a crédito, equipos de sonido a credito, equipos de sonido a crédito,  credito para todo, crédito para todo, pensionados, docentes, credito para docentes, crédito para docentes, militares, credito para militares, crédito para militares, crédito militares activos, credito militares activos.">
	<meta property="og:title" content="Servicios Financieros Oportunidades - Crédito para todo" />
	<meta property="og:url" content="www.serviciosoportunidades.com/" />
	<meta property="og:type" content="Website" />
	<meta property="og:image" content="{{ asset('images/OportunidadesservicioPortadaOg.png') }}" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />
	<meta property="og:description" content="Tenemos el crédito para todo lo que necesitas, electrodomésticos, crédito moto, crédito viajes, tarjeta de crédito , libranzas y seguros; encuentra todo en un mismo lugar y siempre con los mejores precios.">
@endsection()


@section('content')
	<div id="sliderPrincipal">
		@foreach($sliderPrincipal as $slider)
			<div class="containImg">
				<img src="/images/sombra.png" alt="Sombra" class="img-fluid sombraSliderPrincipal">
				<img src="/images/{{ $slider['img'] }}" class="img-fluid" title="{{ $slider['title'] }}" />
				@if($slider['position_text'] == 'bottom')
					<div class="sliderPrincipal-containTextBottom">
						@php
							echo $slider['texto'];
						@endphp
						<a href="{{ $slider['enlace'] }}" class="sliderPrincipal-button" style="background: {{$slider['color']}}">@php echo $slider['textoBoton'] @endphp</a>
					</div>
				@else
					<div class="sliderPrincipal-containTextLeft">
						@php
							echo $slider['texto'];
						@endphp
						<a href="{{ $slider['enlace'] }}" class="sliderPrincipal-button" style="background: {{$slider['color']}}">@php echo $slider['textoBoton'] @endphp</a>
					</div>
				@endif
			</div>
		@endforeach
	</div>

	<div id="conoce">
		<h2 class="conoce-title">Conoce todos los servicios <br> que tenemos para ti</h2>
		<div class="row resetRow">
			<div class="col-sm-8 offset-sm-3 col-lg-4 offset-lg-2 col-xl-2 offset-xl-1 conoce-containTarjeta text-center">
				<div class="conoce-TarjetaOportuya">
					<h3 class="conoce-titleTarjeta">Tarjeta de <strong>crédito Oportuya</strong></h3>
					<img src="/images/servicios_CreditoOportuyaIcon.png" class="img-fluid conoce-tarjetasImg" alt="">
					<p class="conoce-tarjetasTexto">
						Electrodomésticos, 
						avances en efectivo 
						y muchas cosas más
					</p>
				</div>
				<div class="conoce-containButton">
					<a href="/oportuya" class="conoce-button button-oportuya">Conoce más</a>
				</div>
				<img src="/images/conoce-oportuyaImagen.png" alt="Conoce nuestra tarjeta OportuYa" class="img-fluid" />
			</div>

			<div class="col-sm-8 offset-sm-3 col-lg-4 offset-lg-0 col-xl-2 offset-xl-0 conoce-containTarjeta text-center">
				<div class="conoce-creditoMotos">
					<h3 class="conoce-titleTarjetaMotos">Crédito <strong>motos</strong></h3>
					<img src="/images/servicios_motosIcon.png" class="img-fluid conoce-tarjetasImg" alt="">
					<p class="conoce-tarjetasTexto">
						Te damos crédito 
						para que pongas 
						a rodar tus aventuras
					</p>
				</div>
				<div class="conoce-containButton">
					<a href="/motos" class="conoce-button button-creditoMotos">Conoce más</a>
				</div>
				<img src="/images/conoce-motoImagen.png" alt="Conoce nuestros créditos para motos" class="img-fluid" />
			</div>

			<div class="col-sm-8 offset-sm-3 col-lg-4 offset-lg-2 col-xl-2 offset-xl-0 conoce-containTarjeta text-center">
				<div class="conoce-creditoLibranza">
					<h3 class="conoce-titleTarjetaMotos">Crédito <strong>libranza</strong></h3>
					<img src="/images/servicios_libranzaIcon.png" class="img-fluid conoce-tarjetasImg" alt="">
					<p class="conoce-tarjetasTexto">
						¡Porque es momento
						de disfrutar la vida!
					</p>
				</div>

				<div class="conoce-containButton">
					<a href="/libranza" class="conoce-button button-creditoLibranza">Conoce más</a>
				</div>
				<img src="/images/conoce-libranzaImagen.png" alt="Conoce nuestros créditos de libranza" class="img-fluid" />
			</div>

			<div class="col-sm-8 offset-sm-3 col-lg-4 offset-lg-0 col-xl-2 offset-xl-0 conoce-containTarjeta text-center">
				<div class="conoce-seguros">
					<h3 class="conoce-titleTarjetaSeguros"><strong>Seguros</strong></h3>
					<img src="/images/servicios_segurosIcon.png" class="img-fluid conoce-tarjetasImg" alt="">
					<p class="conoce-tarjetasTexto">
						Asegura tu patrimonio
						y el bienestar de 
						quienes están 
						a t​u lado.​​​​​​
					</p>
				</div>

				<div class="conoce-containButton">
					<a href="/seguros" class="conoce-button button-seguros">Conoce más</a>
				</div>
				<img src="/images/conoce-segurosImagen.png" alt="Conoce nuestro servicio de seguros" class="img-fluid" />
			</div>

			<div class="col-sm-8 offset-sm-3 col-lg-4 offset-lg-0 col-xl-2 offset-xl-0 conoce-containTarjeta tarjetaLAst text-center">
				<div class="conoce-viajes">
					<h3 class="conoce-titleTarjetaSeguros"><strong>Viajes</strong></h3>
					<img src="/images/servicios_viajesIcon.png" class="img-fluid conoce-tarjetasImg" alt="">
					<p class="conoce-tarjetasTexto">
						No te pierdas el viaje de tus sueños, te damos crédito para viajar.
					</p>
				</div>
				<div class="conoce-containButton">
					<a href="/viajes" class="conoce-button button-viajes">Conoce más</a>
				</div>
				<img src="/images/conoce-viajesImagen.png" alt="Conoce nuestro servicio de viajes" class="img-fluid" />
			</div>
		</div>
	</div>

	<div id="video">
		<h3 class="video-title">En Oportunidades tenemos todo para ti</h3>
		<div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-4 video-containText text-left">
			<p>
				<img src="/images/video-ubicacionIcon.png" alt=Ubicación" class="img-fluid video-img">
				<span class="video-text">46 Almacenes respaldan tu compra.</span>
			</p>
			<p>
				<img src="/images/video-antiguedadIcon.png" alt="49 años de servicio" class="img-fluid video-img">
				<span class="video-text">49 años de servicio.</span>
			</p>
			<p>
				<img src="/images/video-electrodomesticosIcon.png" alt="Líder en electrodomésticos" class="img-fluid video-img">
				<span class="video-text">Líder en electrodomésticos.</span>
			</p>
			<p>
				<img src="/images/video-descuentosIcon.png" alt="Los mejores descuentos" class="img-fluid video-img">
				<span class="video-text">Los mejores descuentos.</span>
			</p>
		</div>
		<img src="/images/video-botonPlay.png" alt="Ver Vídeo" class="img-fluid video-botonPlay" />
	</div>

	<div id="convenios">
		<div class="containerConvenios">
			<h3 class="convenios-title text-center">Conoce nuestros <strong>Convenios</strong></h3>
{{-- 			<p class="convenios-text text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat.</p> --}}
			<div class="row resetRow">
				<div class="col-12 col-md-12 col-lg-4 text-center resetCol convenios-containInfo">
					<img src="/images/convenios-credibilidadIcon.png" alt="Credibilidad" class="img-fluid" />
					<h3 class="convenios-titleInfo">Credibilidad</h3>
					<p class="convenios-textInfo">49 Años trabajando para llevar las mejores Oportunidades a nuestros clientes.</p>
					<a href="" class="convenios-button">Ver más</a>
				</div>
				<div class="col-12 col-md-12 col-lg-4 text-center resetCol convenios-containInfo">
					<img src="/images/convenios-confianzaIcon.png" alt="Confianza" class="img-fluid" />
					<h3 class="convenios-titleInfo">Confianza</h3>
					<p class="convenios-textInfo">Confiamos en nuestros clientes, por eso te ofrecemos crédito para todo.</p>
					<a href="" class="convenios-button">Ver más</a>
				</div>
				<div class="col-12 col-md-12 col-lg-4 text-center resetCol convenios-containInfo">
					<img src="/images/convenios-puntosServicioIcon.png" alt="Puntos de Servicio" class="img-fluid" />
					<h3 class="convenios-titleInfo">Puntos de servicio</h3>
					<p class="convenios-textInfo">Tenemos 48 Puntos de servicio a tu disposición, donde encontrarás todo lo que tenemos para ti.</p>
					<a href="" class="convenios-button">Ver más</a>
				</div>
			</div>
		</div>
	</div>

@endsection