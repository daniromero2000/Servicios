@extends('layouts.app')
@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/seguros/app.css') }}">

@endsection
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-781153823"></script>
<script>
	window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','AW-781153823',{'page_title':'Seguros ThankYouPage','page_path':'/SG_gracias_FRM'});
</script>
@section('content')
<div class="row resetRow">
	<div class="col-12 text-center resetCol thankContainer">
		<div class="containerThankPage">
			<img src="{{ asset('images/imageThankPage.jpg')}}" class="img-fluid">
			<a href="/seguros" class="btn btn-primary button-return">Volver</a>
		</div>
		<div class=" dialogThakPage" id="thankPageInsurances">
			<img src="{{ asset('images/dialogThankPage.png')}}" class="img-fluid">
			<p> Gracias por contactarte con nosotros, un asesor se comunicará pronto contigo para darte más
				información.
			</p>
		</div>
	</div>
</div>
@endsection()