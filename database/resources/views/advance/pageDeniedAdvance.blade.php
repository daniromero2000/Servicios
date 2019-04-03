@extends('layouts.app')

@section('content')
	<div class="row resetRow">
		<div class="col-12 text-center resetCol thankContainer">
			<div class="containerThankPage">	
				<img src="{{ asset('images/imageThankPage.jpg')}}" class="img-fluid">
			</div>
			<div class="dialogThakPage">	
				<img src="{{ asset('images/dialogThankPage.png')}}" class="img-fluid">
				<p>	Tu solicitud de Avance no ha sido aprobada, un asesor de crédito hará una verificación y se comunicará contigo.</p>
			</div>
		</div>
	</div>
@endsection()