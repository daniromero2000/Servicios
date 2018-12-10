@extends('layouts.steps')

@section('title', 'Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta.')

@section('metaTags')
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
@endsection()

@section('content')
	
	<div id="step1">
		<div class="row resetRow">
			<div class="col-12 conatiner-logoImg">
				<img src="{{ asset('images/logoOportuya.png') }}" class="img-fluid" alt="Oportuya" />
				<!--<img src="/" class="img-fluid steps-imgAnalista" />-->
				<span class="steps-textStep"><strong>Solicitud de Crédito Paso 1</strong> > (Información Personal)</span>
			</div>
			
		</div>
		<div class="step1-containerForm">
			
			<form role=form method="POST" id="saveLeadOportuya" action="{{ route('oportuyaV2.store') }}">
				{{ csrf_field() }}
				<input type="hidden" name="step" value="1">
				<input type="hidden" name="channel" value="1">
				<input type="hidden" name="typeService" value="terjeta de crédito Oportuya">
				<div class="row">
					<div class="col-sm-12 col-md-6 form-group">
						<label for="name" class="control-label">Nombres</label>
						<input type="text" name="name" validation-pattern="name" class="form-control inputsSteps inputText" id="name" required="true"/>
					</div>
					<div class="col-sm-12 col-md-6 form-group">
						<label for="lastName" class="control-label">Apellidos</label>
						<input type="text" name="lastName" validation-pattern="name" class="form-control inputsSteps inputText" id="lastName" required="true"/>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label">Correo electronico</label>
					<input type="email" name="email" validation-pattern="email" class="form-control inputsSteps inputText" id="email" required="true"/>
				</div>
				<div class="row">
					<div class="col-12 col-sm-6">
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono</label>
							<input type="text" name="telephone" validation-pattern="telephone" class="form-control inputsSteps inputText" id="telephone" required="true"/>
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<label for="occupation">Ocupación</label>
						<select class="form-control inputsSteps inputSelect" name="occupation" required="">
							<option value="EMPLEADO">Empleado</option>
							<option value="SOLDADO-MILITAR-POLICÍA">Soldado - Militar - Policía</option>
							<option value="PRESTACIÓN DE SERVICIOS">Prestación de Servicios</option>
							<option value="INDEPENDIENTE CERTIFICADO">Independiente Certificado</option>
							<option value="NO CERTIFICADO">No Certificado</option>
							<option value="RENTISTA">Rentista</option>
							<option value="PENSIONADO">Pensionado</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-6 form-group">
						<label for="typeDocument">Tipo de documento</label>
						<select class="form-control inputsSteps inputSelect" name="typeDocument" id="typeDocument" required="">
							<option value="1">Cédula de ciudadanía</option>
							<option value="2">Cédula de extranjería</option>
						</select>
					</div>
					<div class="col-12 col-sm-6 form-group">
						<label for="identificationNumber">Número de identificación</label>
						<input class="form-control inputsSteps inputText" type="text" validation-pattern="number" name="identificationNumber" id="identificationNumber" required="" />
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label for="city" class="control-label">Ciudad</label>
							<select name="city" id="city" class="form-control inputsSteps inputSelect" required="">
								@foreach($cities as $city)
									<option value="{{ $city['value'] }}">{{ $city['label'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
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
				<div class="form-group text-center">
					<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
						Siguiente
					</button>
					<a href="/oportuya" class=" btn btn-danger buttonFormModal" data-dismiss="modal" aria-label="Close">
						Volver
					</a>
				</div>
			</form>
		</div>
	</div>

@endsection