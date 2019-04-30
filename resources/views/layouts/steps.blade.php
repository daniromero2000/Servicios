<!DOCTYPE html>
<html>
	<head>
		<!-- Global site tag (gtag.js) - Google Ads: 781153823 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-781153823"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-781153823'); </script> 
		@yield('eventTag')
		<title>@yield('title')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		@yield('metaTags')
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		@yield('linkStyleSheets')
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/app2.css') }}">
		<link rel="stylesheet" href="{{ asset('css/slick-theme.css')}}">
		<link rel="stylesheet" href="{{ asset('css/slick.css')}}">
		<link href="{{ asset('editor/contentbuilder/codemirror/lib/codemirror.css')}}" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>
		<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<link href="{{ asset('editor/contentbuilder/contentbuilder.css')}}" rel="stylesheet" type="text/css" /> 
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel='shortcut icon' type='image/x-icon' href='{{ asset('images/oportunidadesServicios.ico') }}' />
	</head>
	</head>
	<body>
		<div id="container">
			@yield('content')
		</div>
		<div id="footerSteps">
			<div class="step3-containerForm">
				<h2 class="footerSteps-title text-center">Tarjeta de crédito Oportuya</h2>
				<div class="row resetRow">
					<div class="col-sm-12 col-md-6 footerSteps-containerItem">
						<img src="{{ asset('images/formsIcon1.png') }}" alt="" class="img-fluid footerSteps-img">
						<p class="footerSteps-text">Sin cuota de manejo por un año</p>
					</div>
					<div class="col-sm-12 col-md-6 footerSteps-containerItem">
						<img src="{{ asset('images/formsIcon4.png') }}" alt="" class="img-fluid footerSteps-img">
						<p class="footerSteps-text">Solicitud 100% digital <br> <span>Sin papeles físicos y con firma digital</span></p>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-sm-12 col-md-6 footerSteps-containerItem">
						<img src="{{ asset('images/formsIcon2.png') }}" alt="" class="img-fluid footerSteps-img">
						<p class="footerSteps-text">20% de descuento en tasa de interés <br> <span>Para todas las compras que realices</span></p>
					</div>
					<div class="col-sm-12 col-md-6 footerSteps-containerItem">
						<img src="{{ asset('images/formsIcon5.png') }}" alt="" class="img-fluid footerSteps-img">
						<p class="footerSteps-text">Intantanea <br> <span>Tienes tu tarjeta en pocas horas</span></p>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-sm-12 col-md-6 footerSteps-containerItem">
						<img src="{{ asset('images/formsIcon3.png') }}" alt="" class="img-fluid footerSteps-img">
						<p class="footerSteps-text">Te devolvemos $30.000 pesos <br> <span>Si tu promera compra es igual o superior a $200.000.</span></p>
					</div>
					<div class="col-sm-12 col-md-6 footerSteps-containerItem">
						<img src="{{ asset('images/formsIcon6.png') }}" alt="" class="img-fluid footerSteps-img">
						<p class="footerSteps-text">Plan Kilómetros <br> <span>Te devolvemos el 1% del valor de tus compras en dinero</span></p>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="{{asset('js/validateV2.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
		@yield('scriptsJs')
	</body>
</html>