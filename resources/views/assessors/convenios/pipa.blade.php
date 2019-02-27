@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row text-center assessorHeader">
			<h3>
				
				 	{{Auth::guard('assessor')->user()->NOMBRE}}
				
			</h3>
		</div>
		<div class="row">
			<h1>Convenio la pipa</h1>		
		</div>
	</div>
@endsection
