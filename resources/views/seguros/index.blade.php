@extends('layouts.app')

@section('title', 'Seguros')

@section('metaTags')
@endsection()
@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/seguros/app.css') }}">

@endsection
@section('content')
{{-- <div id="content-landing">
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
</div> --}}


<div class="row row-reset mt-4">
	<div class="col-12 col-reset">
		<div class="container-first-sector">
			<div>
				<img class="img-fluid" src="{{ asset('images/seguros/seguros oportunidades.png')}}"
					style="width: 100%;">
			</div>
			<div class="container-first-sector-text text-center">
				<h4 class="title-first-sector">Pensar en ti, es pensar en cuidar tu patrimonio</h4>
				<div>
					<img class="logo-fist-sector" src="{{ asset('images/seguros/linelogo.png')}}" alt="">
				</div>
				<p class="text-center text-first-sector">Te damos <span class="first-span-first-sector">crédito</span>
					para tu <span class="second-span-first-sector">SOAT</span>
					<br> hasta <span class="third-span-first-sector">11
						meses</span>
					de plazo</p>
				<div class="text-center mt-4">
					<a href="" class="btn btn-first-sector mt-1">Pregunta Aquí</a>

				</div>
			</div>
		</div>
	</div>
	<div class="col-12">
		<div>
			<img class="img-fluid" src="{{ asset('images/seguros/seguros oportunidades2.png')}}" style="width: 100%;">
		</div>
		<div class="container-second-sector-text text-left">
			<h4 class="title-second-sector">Solicita Tu <br> <span style="color: #0F399E;"> <span
						style="font-weight: 500;">Crédito</span>
					para</span> <br> <span class="first-span-second-sector">SOAT</span></h4>
			<div class="text-center content-button-second-sector">
				<a href="" class="btn btn-second-sector mt-1">Solicita Aquí</a>
			</div>
		</div>
	</div>
	<div class="col-12">
		<div class="row">
			<div class="col-12 col-lg-6">
				<img class="img-fluid" src="{{ asset('images/seguros/texto_banner_formulario.jpg')}}"
					style="width: 100%;">
			</div>
			<div class="col-12 col-lg-6 img-fondo">
				<div>
					<img class="img-fluid img-bacgraund" src="{{ asset('images/seguros/seguros oportunidades3.png')}}"
						style="width: 100%;">
				</div>
				<div class="container-third-sector-text ">
					<h4 class="title-third-sector">Déjanos tus <span style="
						color: #103a9ede;
					"> Datos</span></h4>
					<form>
						<div class="row">
							<div class="col-6 col-xl-12">
								<div class="form-group">
									<div class="row">
										<div class="col-12 col-xl-5"><label class="title-form-third-sector"
												for="exampleInputEmail1">Nombre</label></div>
										<div class="col-12 col-xl-7">
											<input class="form-control input-form-third-sector" id="exampleInputEmail1"
												aria-describedby="emailHelp">
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-xl-12">
								<div class="form-group">
									<div class="row">
										<div class="col-12 col-xl-5"><label class="title-form-third-sector"
												for="exampleInputEmail1">Email</label></div>
										<div class="col-12 col-xl-7"><input class="form-control input-form-third-sector"
												id="exampleInputEmail1" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-xl-12">
								<div class="form-group">
									<div class="row">
										<div class="col-12 col-xl-5"><label class="title-form-third-sector"
												for="exampleInputEmail1">Tipo
												de Vehículo</label></div>
										<div class="col-12 col-xl-7"><input class="form-control input-form-third-sector"
												id="exampleInputEmail1" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-xl-12">
								<div class="form-group">
									<div class="row">
										<div class="col-12 col-xl-5"><label class="title-form-third-sector"
												for="exampleInputEmail1">Telefono</label></div>
										<div class="col-12 col-xl-7"><input class="form-control input-form-third-sector"
												id="exampleInputEmail1" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
							</div>

						</div>



						<div class="text-center">
							<button type="submit" class="btn btn-third-sector">Enviar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12">

	</div>
</div>
@endsection