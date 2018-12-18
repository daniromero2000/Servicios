@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row text-center assessorHeader">
			<h3>
				 {{Auth::user()->NOMBRE}}
			</h3>
		</div>
		<div class="row">
			<div class="col-6 assessorModule text-center">
				<p>
					<a href="{{route('step1Assessor')}}">Crédito Oportuya </a>
				</p>	
			</div>
			<div class="col-6 assessorModule text-center">
				<p>
					<a href="{{route('step1Assessor')}}">Clientes </a>
				</p>	
			</div>			
		</div>
	</div>
@endsection
