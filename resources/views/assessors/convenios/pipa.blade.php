@extends('layouts.app')
@section('content')
	<div class="row resetRow container-header-forms">
		<div class="form-container-logoHeader form-container-logoHeader-avances">
			<img src="/images/logoPipa.png" class="img-fluid" alt="Oportuya" width='138px'>
		</div>
	</div>
	<div class="container">
		<div class="row text-center assessorHeader">
			<h3>
				
				 	{{Auth::guard('assessor')->user()->NOMBRE}}
				
			</h3>
		</div>
		<div class="row">
			<div class="col-12 assessorModule text-center">
				<p class="text-center">
					<a href="{{route('step1Oportuya')}}">Crédito Oportuya </a>
				</p>	
			</div>
		</div>
	</div>
@endsection
