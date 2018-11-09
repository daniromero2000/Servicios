@extends('layouts.app')
@section('content')

    <div class="containerleads container">
        <br>
        @if (Session::get('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
    ------------------------------------------------------------------------------------------------------------------------------------------------------
	<div class="row tituloLeads">
		<div class="col-12">
			<h3>Consulta de Leads </h3>
		</div>
	</div>

    <script src="{{ asset('/appCanalDigital/app.js') }}"></script>
    <script src="{{ asset('/appCanalDigital/services/myService.js') }}"></script>
    <script src="{{ asset('/appCanalDigital/controllers/leadsController.js') }}"></script>
@stop