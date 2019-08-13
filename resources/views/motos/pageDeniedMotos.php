@extends('layouts.app')

@section('content')
	<div class="row resetRow">
		<div class="col-12 text-center resetCol thankContainer">
			<div class="containerThankPage">	
				<img src="{{ asset('images/imageThankPage.jpg')}}" class="img-fluid">
			</div>
			<div class="dialogThakPage">	
				<img src="{{ asset('images/dialogThankPage.png')}}" class="img-fluid">
				<p>Estimado usuario, por políticas internas de la organización no es posible continuar con el proceso de crédito en Almacenes Oportunidades.</p>
			</div>
		</div>
	</div>
@endsection()