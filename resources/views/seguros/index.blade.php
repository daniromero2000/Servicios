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

@section('content')
<style>
.content{
	background-color: #0FAAE0;
	height: 100%;
	margin: auto;
	width: 100%;
}
.content-1{
	background-color:#103A9E;
	width: 90%;
	height: 302px;
	margin-top: 3%;
	margin-left: 5%;
	margin-right: 5%;
	border-radius: 50px 50px 0px 0px;
}
.img1{
	max-width: 100%;
	height: auto;
}
.content-text1{
	text-align: center;
	color: white;
	font-size: 40px;
	font-weight: bold;
}
.text-soat{
	color: #FDBF3C;
}
.content-2{
	width: 90%;
	height: 330px;
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
.imgproduct1{
	width: 100%;
}
.imgproduct2{
	width: 100%;
}
.imgproduct3{
	width: 100%;
}
.text-product1{
	font-size: 20px;
}
.text-products{
	font-size: 20px;
	color: white;
	text-align: center;
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
	background-color:#E13236;
	color: white;
	font-size: 15px;
	font-weight: bold;
	padding: 5px 15px;
	border-radius: 10px;
}
a:hover{
	text-decoration: none;
	color: white;
}
</style>
<div id="container">
	<div class="row content">
		<div class="row content-imgHeader" >
			<div class="col-12 col-sm-12 content-img d-flex align-items-center justify-content-center">
				<span class="text-header">¡Lleva tu SOAT a crédito!</span>
			</div>
		</div>
		<div class="row content-1">
			<div class="col-12 col-sm-6 d-flex align-items-center justify-content-center content-text1">
				<span class="">¡Adquiere el <span class="text-soat">SOAT</span><br>para tu vehículo <br> a CRÉDITO!</span>
			</div>
			<div class="col-12 col-sm-6">
				<img src="{{ asset('images/seguros/img1.png')}}" class="img1">
			</div>
		</div>
		<div class="row content-2">
			<div class="col-12 col-md-4 col-sm-4 resetCol">
				<div class="content-product">
					<img src="{{ asset('images/seguros/img2.png')}}" class="imgproduct1">
					<div>
						<a class="btn-product" href="">Quiero mi SOAT a crédito</a>
					</div>
					<h1 class="text-products">Automóviles</h1>
				</div>
			</div>
			<div class="col-12 col-md-4 col-sm-4 restCol">
				<div class="content-product">
					<img src="{{ asset('images/seguros/img3.png')}}" class="imgproduct2">
					<div>
						<a class="btn-product" href="">Quiero mi SOAT a crédito</a>
					</div>
					<h1 class="text-products">Motos</h1>
				</div>
			</div>
			<div class="col-12 col-md-4 col-sm-4 resetCol">
				<div class="content-product">
					<img src="{{ asset('images/seguros/img4.png')}}" class="imgproduct3">
					<div>
						<a class="btn-product" href="">Quiero mi SOAT a crédito</a>
					</div>
					<h1 class="text-products">Carga Pesada</h1>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection