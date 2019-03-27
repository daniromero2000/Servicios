@extends('layouts.app')

@section('title', 'Crédito de Libranzas para pensionados, docentes y militares.')

@section('metaTags')
	<link rel="canonical" href="https://www.serviciosoportunidades.com/libranza" />
	<meta name="description" content="El Crédito de libranza con el que podrás disfrutar de todas nuestras opciones, compra electrodomésticos, viaja, adquiere tu moto, compra tu cartera o remodela tu casa; sin costos ocultos y con el descuento a tu nomina.">
	<meta name="keywords" content="Libranzas, credito para docentes, crédito para docentes, credito de libranzas, crédito de libranzas, pensionados, crédito para pensionados, credito para pensionados, prestamos para pensionados, préstamos para pensionados, libre inversión, libre inversion, crédito de libre inversión para pensionados, credito de libre inversion para pensionados, prestamos para jubilados, préstamos para jubilados, prestamos a pensionados, préstamos a pensionados, crédito fácil para pensionados, credito facil para pensionados, prestamos para profesores, préstamos para profesores, profesores, prestamo a pensionados y jubilados, préstamo a pensionados y jubilados, crédito para militares, credito para militares, crédito para policías, credito para policias, crédito para casas, credito para casas, pensionados de la policia, pensionados de la policía, pensionados militares, pensionados por la policia, pensionados por la policía, pensionados por las fuerzas armadas, jubilados de casur, jubilados policía, jubilados policia.">
	<meta property="og:title" content="Crédito de Libranzas para pensionados, docentes y militares." />
	<meta property="og:url" content="https://www.serviciosoportunidades.com/libranza" />
	<meta property="og:type" content="Website" />
	<meta property="og:image" content="{{ asset('images/LibranzasPortadaOg.png') }}" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />
	<meta property="og:description" content="El Crédito de libranza con el que podrás disfrutar de todas nuestras opciones, compra electrodomésticos, viaja, adquiere tu moto, compra tu cartera o remodela tu casa; sin costos ocultos y con el descuento a tu nomina.">
@endsection()

@section('content')
@if (Session::get('success'))
		<div class="alert alert-success">
			<p>{{ Session::get('success') }}</p>
		</div>
	@endif
        

<div id="sliderPrincipalLibranza">
        <div class="containImg">
            <!--<img src="/images/sombra.png" alt="Sombra" class="img-fluid sombraSliderPrincipal">-->
            <img src="/images/creo_oportunidades_slider.jpg" class="img-fluid img-responsive" title="Libranza">
            <div class="sliderPrincipal-containTextLeft">
               <!-- <p class="sliderPrincipalLibranza-text">
                    {{-- @php
                        echo $slider['description'];
                    @endphp --}}
                    Te damos <strong>más</strong> que <strong>Crédito,</strong>  te damos la <br><strong>Oportunidad</strong> de vivir viajando
                </p>-->

                {{-- <a href="#formularioSimulador" class="sliderPrincipalLibranza-button">@php echo $slider['textButton']; @endphp</a> --}}
                <!--<a href="#formularioSimulador" class="sliderPrincipalLibranza-button" tabindex="0">Solicítalo ya</a>-->
            </div>
        </div>
        <!--<div class="containImg">
            <img src="/images/sombra.png" alt="Sombra" class="img-fluid sombraSliderPrincipal">
            <img src="/images/creditoLibranzaDocentes.jpg" class="img-fluid img-responsive" title="Libranza">
            <div class="sliderPrincipal-containTextLeft">
                <h2 class="sliderPrincipal-titleSlider">Crédito para<strong> Docentes</strong></h2>
                <p class="sliderPrincipalLibranza-text">
                    {{-- @php
                        echo $slider['description'];
                    @endphp --}}
                    Lo hacemos a tu medida, <br> crédito de <strong>libranzas para docentes</strong>
                </p>

                {{-- <a href="#formularioSimulador" class="sliderPrincipalLibranza-button">@php echo $slider['textButton']; @endphp</a> --}}
                <a href="#formularioSimulador" class="sliderPrincipalLibranza-button" tabindex="0">Solicítalo ya</a>
            </div>
        </div>
        <div class="containImg">
            <img src="/images/sombraV2.png" alt="Sombra" class="img-fluid sombraSliderPrincipal">
            <img src="/images/creditoLibranzaSuenos.jpg" class="img-fluid img-responsive" title="Libranza">
            <div class="sliderPrincipal-containTextRigth">
                <p class="sliderPrincipalLibranza-text">
                    {{-- @php
                        echo $slider['description'];
                    @endphp --}}
                    ¿Soñando con remodelar tu casa? <br> hazlo realidad con nuestro <strong>crédito de libranza</strong>
                </p>

                {{-- <a href="#formularioSimulador" class="sliderPrincipalLibranza-button">@php echo $slider['textButton']; @endphp</a> --}}
                <a href="#formularioSimulador" class="sliderPrincipalLibranza-button" tabindex="0">Solicítalo ya</a>
            </div>
        </div>
{{-- 	@foreach($images as $slider)
    @endforeach --}}-->
</div>

<br> 
<div id="creditoLibranza">
    <div class="containerCreditoLibranza">
        <h2 class="creditoLibranza-title text-center">Todo lo que puedes hacer con <br> nuestro <strong>crédito de libranza</strong></h2>
        <div class="row" id="creditoLibranza-slider">
            <div class="col-md-12 col-lg-4 container-creditoLibranzaCards">
                <div class="creditoLibranza-contianerTexto creditoLibranza-textoAdvance creditoLibranza-electrodomesticos">
                    <img src="{{ asset('images/libranza-creditoElectrodomestico.png') }}" alt="Crédito para electrodomésticos" class="img-fluid creditoLibranza-img">
                    <div class="containerText-creditoLibranzaCards">
                        <h3 class="creditoLibranza-titleText">Crédito para <br> electrodomésticos</h3>
                        <p class="creditoLibranza-text">
                            A través de nuestras tiendas Oportunidades a nivel nacional, Te financiamos hasta por 60 meses en el electrodoméstico que tanto quieres. <br>
                            <strong>¡Compralo a crédito!</strong>
                        </p>
                    </div>
                    <div class="row" style="padding-bottom: 15px;">
                        <div class="col-12 text-center">
                            <a href="https://api.whatsapp.com/send?phone=573105216830&text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza%20para%20un%20electrodoméstico" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-md-12 col-lg-4 container-creditoLibranzaCards">
                <div class="creditoLibranza-contianerTexto creditoLibranza-motos">
                    <img src="{{ asset('images/libranza-creditoMotos.png') }}" alt="Crédito para motos" class="img-fluid creditoLibranza-img">
                    <div class="containerText-creditoLibranzaCards">
                        <h3 class="creditoLibranza-titleText">Crédito <br> para motos</h3>
                        <p class="creditoLibranza-text">
                            Accede a la moto que quieres a través de nuestras líneas de crédito que se adaptan a tus posibilidades de pago. te damos hasta 108 meses para que te la lleves. <br>
                            <strong>¡Compra tu moto a crédito!</strong>
                        </p>
                    </div>
                    <div class="row" style="padding-bottom: 15px;">
                        <div class="col-12 text-center">
                            <a href="https://api.whatsapp.com/send?phone=573105216830&text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza%20para%20una%20moto" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
           <div class="col-md-12 col-lg-4 container-creditoLibranzaCards">
                <div class="creditoLibranza-contianerTexto creditoLibranza-viajes">
                    <img src="{{ asset('images/libranza-creditoViajes.png') }}" alt="Crédito para viajes" class="img-fluid creditoLibranza-img">
                    <div class="containerText-creditoLibranzaCards">
                        <h3 class="creditoLibranza-titleText">Crédito <br> para viajes</h3>
                        <p class="creditoLibranza-text">
                            Ahora puedes viajar por el mundo financiando tus paquetes turísticos nacionales hasta por 24 meses e internacionales hasta por 48 meses. <br>
                            <strong>¡Viaja Ahora!</strong>
                        </p>
                    </div>
                    <div class="row" style="padding-bottom: 15px;">
                        <div class="col-12 text-center">
                            <a href="https://api.whatsapp.com/send?phone=573105216830&text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza%20para%20un%20viaje" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 container-creditoLibranzaCards">
                <div class="creditoLibranza-contianerTexto creditoLibranza-libreInversion">
                    <img src="{{ asset('images/libranza-libreInversion.png') }}" alt="Crédito Libre Inversión" class="img-fluid creditoLibranza-img">
                    <div class="containerText-creditoLibranzaCards">
                        <h3 class="creditoLibranza-titleText">Crédito <br> libre inversión</h3>
                        <p class="creditoLibranza-text">
                            Es un préstamo de Libre Destino que se aprueba a personas naturales, vinculadas a entidades con las cuales existen convenios previamente establecido con LAGOBO y cuyas cuotas se descuentan mensualmente del pago de nómina.
                        </p>
                    </div>
                    <div class="row" style="padding-bottom: 15px;">
                        <div class="col-12 text-center">
                            <a href="https://api.whatsapp.com/send?phone=573105216830&text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza%20libre%20inversión" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 container-creditoLibranzaCards">
                <div class="creditoLibranza-contianerTexto creditoLibranza-motos">
                    <img src="{{ asset('images/libranza-compraCartera.png') }}" alt="Compra de cartera" class="img-fluid creditoLibranza-img">
                    <div class="containerText-creditoLibranzaCards">
                        <h3 class="creditoLibranza-titleText">Compra <br> de cartera</h3>
                        <p class="creditoLibranza-text">
                            Sabemos lo importante administrar mejor tu dinero. Por eso, te ofrecemos unificar tus deudas que presentas con otras entidades en un solo crédito con Tasa y Plazo Fijo para mejorar tu flujo de caja.
                        </p>
                    </div>
                    <div class="row" style="padding-bottom: 15px;">
                        <div class="col-12 text-center">
                            <a href="https://api.whatsapp.com/send?phone=573105216830&text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza%20por%20medio%20de%20compra%20de%20cartera" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div ng-app="appLibranzaLiquidador" ng-controller="libranzaLiquidadorCtrl" ng-cloak>

    <ng-view></ng-view>       
</div>

<script src="{{ asset('js/appLibranzaPublic/app.js') }}"></script>
<script src="{{ asset('js/appLibranzaPublic/services/myService.js') }}"></script>
<script src="{{ asset('js/appLibranzaPublic/controllers/libranza.js') }}"></script>
<script src="{{ asset('js/appLibranzaPublic/controllers/libranza.js') }}"></script>
<script> src="{{asset('js/bower_components/angular-slick-carousel/dist/slick.js') }}"</script>
@stop
