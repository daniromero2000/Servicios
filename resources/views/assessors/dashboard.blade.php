@extends('layouts.app')
@section('content')
	<div class="container">
		
		<div class="row">
			<p>
				<a href="{{route('step1Assessor')}}">Crédito Oportuya </a>
			</p>

			@php

			//dd(Auth::user());

			@endphp
		</div>
	</div>
@endsection
