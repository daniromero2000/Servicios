@extends('layouts.app')

@section('content')
	<div class="row resetRow">
		<div class="col-12 text-center resetCol thankContainer">
			<div class="containerThankPage">	
				<img src="{{ asset('images/imageThankPage.jpg')}}" class="img-fluid">
			</div>
			<div class="dialogThakPage">	
				<img src="{{ asset('images/dialogThankPage.png')}}" class="img-fluid">
				<p>	Gracias por contactarte con nosotros, un asesor de Viajes se comunicará contigo para darte más información en un máximo de 12 horas.</p>
			</div>
		</div>
	</div>
@endsection()