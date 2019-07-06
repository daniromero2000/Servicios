@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row text-center assessorHeader">
			<h3>
				{{Auth::guard('assessor')->user()->NOMBRE}}
			</h3>
		</div>
		<div class="row">
			<div class="col-12 col-sm-4	assessorModule text-center">
				<p>
					<a href="{{route('step1Oportuya')}}">Crédito Oportuya </a>
				</p>
			</div>
			<div class="col-12 col-sm-4 assessorModule text-center">
				<p>
					<a href="{{route('assessorsVentaContado')}}">Venta Contado</a>
				</p>
			</div>
			<div class="col-12 col-sm-4	assessorModule text-center">
				<p>
					<a href="{{route('step1Avance')}}">Avances </a>
				</p>
			</div>
		</div>
	</div>
@endsection