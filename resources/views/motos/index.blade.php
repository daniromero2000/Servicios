@extends('layouts.app')

@section('title', 'Crédito para Motos')

@section('metaTags')
	{{-- <meta name="description" content="">
	<meta name="keywords" content="">
	<meta property="og:title" content="" />
	<meta property="og:url" content="" />
	<meta property="og:type" content="" />
	<meta property="og:image" content="" />
	<meta property="og:description" content=""> --}}
@endsection()
@section('content')
	<div id="construccion">
		<div class="container">
			<h2 class="creditoLibranza-title text-center">Esta sección está actualmente en construcción</h2>
			<p class="text-center">Si te interesa conocer más sobre nuestros créditos para motos, déjanos tus datos y un asesor se pondrá en contacto</p>
			<div class="modalFormulario-body" style="margin: auto;">
				<div class="modal-containerFormulario">
					<h3 class="modal-titleForm titleForm-motos">Motos</h3>
					<form role=form method="POST" id="saveLeadmotos" action="{{ route('motos.store') }}">
						{{ csrf_field() }}
						<input type="hidden" name="typeProduct" value="Motos">
						<input type="hidden" name="typeService" value="Motos">
						<input type="hidden" name="channel" value="1">
						<div class="form-group">
							<label for="name" class="control-label">Nombres</label>
							<input type="text" name="name" id="name" class="form-control" required="true"  />
						</div>
						<div class="form-group">
							<label for="lastName" class="control-label">Apellidos</label>
							<input type="text" name="lastName" id="lastName" class="form-control" required="true"/>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Correo electrónico</label>
							<input type="email" name="email" id="mail" class="form-control" required="true"/>
						</div>
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono</label>
							<input type="text" name="telephone" id="telephone" class="form-control"required="true"/>
						</div>
						<div class="form-group">
							<label for="ciudad class="control-label">Ciudad</label>
							<select name="city" id="city" class="form-control" >
								@foreach($cities as $city)
									<option value="{{ $city['value'] }}">{{ $city['label'] }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1" required>
							<label for="termsAndConditions" style="font-size: 13px; font-style: italic;">
								Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
							</label>
						</div>
						<p class="textCityForm">
							*Válido solo para ciudades que se desplieguen en la casilla.
						</p>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
								Guardar
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection