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

@section('linkStyleSheets')
    <link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection

@section('content')
	@if (Session::get('success'))
		<div class="alert alert-success">
			<p>{{ Session::get('success') }}</p>
		</div>
	@endif

<div ng-app="appLibranzaLiquidador" ng-controller="libranzaLiquidadorCtrl" ng-cloak>
    <ng-view></ng-view>       
</div>

<script src="{{ asset('js/appLibranzaPublic/app.js') }}"></script>
<script src="{{ asset('js/appLibranzaPublic/services/myService.js') }}"></script>
<script src="{{ asset('js/appLibranzaPublic/controllers/libranza.js') }}"></script>
<script> src="{{asset('js/bower_components/angular-slick-carousel/dist/slick.js') }}"</script>
<script src="https://rawgit.com/rzajac/angularjs-slider/master/dist/rzslider.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.14.3/ui-bootstrap-tpls.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ng-currency/1.2.7/ng-currency.min.js"></script>
@stop
