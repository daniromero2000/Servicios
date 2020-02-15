@extends('layouts.app')

@section('title', 'Seguros')

@section('metaTags')
@endsection()
@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/seguros/app.css') }}">

@endsection
@section('content')
<div id="content-landing">
	<div id="header-seguros">
		<div class="row content-imgHeader">
			<div class="col-12 col-sm-12 content-img d-flex align-items-center justify-content-center">
				<span class="text-header">¡Lleva tu SOAT a crédito!</span>
			</div>
		</div>
		<div class="row content-1">
			<div class="col-12 col-md-6 d-flex align-items-center justify-content-center content-text1">
				<span class="">¡Adquiere el <span class="text-soat">SOAT</span><br>para tu vehículo <br> a
					CRÉDITO!</span>
			</div>
			<div class="col-12 col-md-6 pd-img">
				<div>
					<img src="{{ asset('images/seguros/img1.png')}}" class="img1">
				</div>
			</div>
		</div>
	</div>
	<div id="imagenes">
		<div class="row content-2">
			<div class="col-12 col-md-4 col-sm-4 resetCol1">
				<div class="content-product">
					<div>
						<img class="img-ajust" src="{{ asset('images/seguros/img2.png')}}" class="imgproduct">
						<div class="content-textProduct">
							<a class="btn-product" href="/seguros/credito">Quiero mi SOAT a crédito</a>
						</div>
					</div>
					<div class="content-btn">
						<h1 class="text-products">Automóviles</h1>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-4 col-sm-4 resetCol1">
				<div class="content-product">
					<div>
						<img class="img-ajust" src="{{ asset('images/seguros/img3.png')}}" class="imgproduct">
						<div class="content-textProduct">
							<a class="btn-product" href="/seguros/credito">Quiero mi SOAT a crédito</a>
						</div>
					</div>
					<div class="content-btn">
						<h1 class="text-products">Motos</h1>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-4 col-sm-4 resetCol1">
				<div class="content-product">
					<div>
						<img class="img-ajust" src="{{ asset('images/seguros/img4.png')}}" class="imgproduct">
						<div class="content-textProduct">
							<a class="btn-product" href="/seguros/credito">Quiero mi SOAT a crédito</a>
						</div>
					</div>
					<div class="content-btn">
						<h1 class="text-products">Carga Pesada</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="row resetRow">
			<div class="col-12 col-md-12 content-wpp">
				<a href="https://api.whatsapp.com/send?phone=573138701355&text=Quiero más información, sobre el crédito fácil de SOAT."
					target="_blank"><img class="img-wpp" src="{{ asset('images/assets/botonWP.png') }}" alt="">
				</a>
			</div>
		</div>
	</div>
</div>

{{-- 
<div class="row row-reset mt-4">
	<div class="col-12 col-reset">
		<div class="container-first-sector">
			<div>
				<img class="img-fluid" src="{{ asset('images/seguros/seguros oportunidades.png')}}" class="imgproduct">
</div>
<div class="container-first-sector-text">
	<h4 class="title-first-sector">Pensar en ti, es pensar en cuidar tu patrimonio</h4>
	<br>
	<p class="text-center text-first-sector mt-4">Te damos <span class="first-span-first-sector">crédito</span> para tu
		<span class="second-span-first-sector">SOAT</span>
		<br> hasta <span class="third-span-first-sector">11
			meses</span>
		de plazo</p>
	<div class="text-center mt-4">
		<a href="" class="btn btn-first-sector mt-2">Pregunta Aquí</a>

	</div>
</div>
</div>
</div>
<div class="col-12">

</div>
<div class="col-12">

</div>
<div class="col-12">

</div>
</div> --}}
@endsection