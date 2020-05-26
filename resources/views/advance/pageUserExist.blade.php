@extends('layouts.app')
@include('layouts.front.layouts.googleAds')
@section('content')
<div class="row resetRow">
	<div class="col-12 text-center resetCol thankContainer">
		<div class="containerThankPage">
			<img src="{{ asset('images/imageThankPage.jpg')}}" class="img-fluid">
		</div>
		<div class="dialogThakPage">
			<img src="{{ asset('images/dialogThankPage.png')}}" class="img-fluid">
			<p> Actualmente ya cuentas con una solicitud que está siendo procesada.</p>
		</div>
	</div>
</div>
@endsection()