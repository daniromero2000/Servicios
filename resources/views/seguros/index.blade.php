@extends('layouts.app')

@section('title', 'Seguros')

@section('metaTags')
	{{-- <meta name="description" content="">
	<meta name="keywords" content="">
	<meta property="og:title" content="" />
	<meta property="og:url" content="" />
	<meta property="og:type" content="" />
	<meta property="og:image" content="" />
	<meta property="og:description" content=""> --}}
@endsection()
@section('linkStyleSheets')
	
<style>
#content-landing{
	background-color: white;
	height: 100%;
	margin: auto;
	width: 100%;
}
.content-1{
	background-color:#103A9E;
	width: 89%;
	height: 100%;
	margin-top: 3%;
	margin-left: 5%;
	margin-right: 5%;
	border-radius: 58px 58px 0px 0px;
}
.img1{
	max-width: 100%;
	height: auto;
}
.content-text1{
	text-align: center;
	color: white;
	font-size: 320%;
	font-weight: bold;
}
.text-soat{
	color: #FDBF3C;
}
.content-2{
	width: 90%;
	height: 100%;
	margin-top: 1%;
	margin-left: 5%;
	margin-right: 5%;
	margin-bottom: 1%;
}
.content-product{
	background-color: #103A9E;
	height: auto;
	border-radius: 0px 0px 30px 30px;
	text-align: center;
}
.imgproduct{
	width: 100%;
	height: 280px;
}
.text-product1{
	font-size: 20px;
}
.text-products{
	font-size: 20px;
	color: white;
	text-align: center;
	padding: 8%;
	font-weight: bold;
}
.content-imgHeader{
	background-color: white;
	width: 100%;
	margin: auto;
	height: 80px;
}
.text-header{
	color: #09329B;
	font-size: 25px;
	font-weight: bold;
}
.btn-product{
	background-color: #E13236;
	color: white;
	font-size: 100%;
	font-weight: bold;
	padding: 2% 4%;
	border-radius: 10px;
}
a:hover{
	text-decoration: none;
	color: white;
}
.pd-img{
	padding: 0%;
}
.content-btn{
	margin-top: 3%;
}
.content-textProduct{
	margin-top: -13%;
    padding: 1%;	
}
.resetCol1{
	padding: 0px 10px 0px 0px;
}
.resetCol2{
	padding: 0px 10px 0px 0px;
}
.resetCol3{
	padding:0px;
}
.content-wpp{
	text-align: right;
}
.img-wpp{
	width: 20%;
	padding-bottom: 2%;
}
.img-ajust{
	width: 100%;
	height: 100%;
}
@media (max-width: 840px) {
.img-wpp{
	width: 50%;
	padding-bottom: 2%;
}
}
</style>
@endsection
@section('content')
<div id="content-landing">
	<div id="header-seguros">
		<div class="row content-imgHeader" >
			<div class="col-12 col-sm-12 content-img d-flex align-items-center justify-content-center">
				<span class="text-header">¡Lleva tu SOAT a crédito!</span>
			</div>
		</div>
		<div class="row content-1">
			<div class="col-12 col-md-6 d-flex align-items-center justify-content-center content-text1">
				<span class="">¡Adquiere el <span class="text-soat">SOAT</span><br>para tu vehículo <br> a CRÉDITO!</span>
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
@endsection