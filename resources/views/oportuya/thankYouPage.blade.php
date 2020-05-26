@extends('layouts.app')
@include('layouts.front.layouts.conversionPage')
@section('content')
<div class="row resetRow">
	<div class="col-12 text-center resetCol thankContainer">
		<div class="containerThankPage">
			<img src="{{ asset('images/imageThankPage.jpg')}}" class="img-fluid">
		</div>
		<div class="dialogThakPage">
			<img src="{{ asset('images/dialogThankPage.png')}}" class="img-fluid">
			<p> Gracias, un asesor de crédito se comunicará contigo para coordinar la entrega del producto.</p>
		</div>
	</div>
</div>
@endsection()