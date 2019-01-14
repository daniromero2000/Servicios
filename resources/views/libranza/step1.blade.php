@extends('layouts.stepsLibranza')

@section('title', 'Crédito libraza')

@section('metaTags')
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
@endsection()

@section('content')
	 {!! NoCaptcha::renderJs() !!}
	<div id="step1">
		<div class="row resetRow container-header-forms  container-libranza-forms">
			<div class="form-container-logoHeader form-container-logoLibranza">
				<img src="{{ asset('images/logo_Creo.png') }}" class="img-fluid libranzaSteplogo" alt="Oportuya" />
			</div>
			<div class="col-12 conatiner-logoImg">
				<img src="/{{ $digitalAnalyst['img'] }}" alt="{{ $digitalAnalyst['name'] }}" class="img-fluid steps-imgAnalista" />
				<span class="steps-textStep"><strong>Solicitud de Crédito Paso 1</strong> > (Cuéntanos Sobre Ti)</span>
			</div>
		</div>
		<div class="row resetRow">
			<div class="col-12 step2-containTitle">
				<h2 class="text-center step2-titleAnalista"><strong>Hola!</strong> soy {{ $digitalAnalyst['name'] }} tu analista digital</h2>
				<p class="text-center step2-textAnalista">En este momento te encuentras haciendo tu solicitud de crédito, por favor diligencia <br> todos los datos para que tu aprobación sea más fácil</p>
				<h3 class="forms-text-analyst text-analyst-libranza text-center">Solo te tomará unos minutos solicitar tu tarjeta Oportuya</h3>
			</div>
			<div class="col-12">
				<div class="step3-containerForm">
					<img src="{{ asset('images/iconoStartProgreso2.png') }}" alt="" class="img-fluid imgStartProgress" />
					<div class="progreso">
						<div class="barra_vacia barra_vacia_libranza" style="width: 0;"></div>
						<div class="puntos punto_uno listo punto_listo_libranza">
						</div>
						<span></span>
						<label>Cuentanos sobre ti</label>
						<div class="puntos punto_dos">
						</div>
						<span></span>
						<label>Información Personal</label>
						<div class="puntos punto_tres">
						</div>
						<span></span>
						<label>Información Laboral</label>
						<div class="puntos punto_cuatro">
						</div>
						<span></span>
						<label>Confirmación</label>
					</div>
					<img src="{{ asset('images/iconoEndProgreso2.png') }}" alt="" class="img-fluid imgEndProgress" />
				</div>
			</div>
		</div>
		<div class="step1-containerForm">
			<div class="row resetRow">
				<div class="forms-descStep forms-descStepLibranza">
					<strong>Información básica</strong><br>
					<span class="forms-descText">Ingresa tus datos personales</span>
					<img src="{{ asset('images/datosPersonales.png') }}" class="img-fluid forms-descImg" />
					<span class="forms-descStepNum">1</span>
				</div>
			</div>
			<form role=form method="POST" id="saveLeadOportuya" action="{{ route('libranzaV2.store') }}">
				{{ csrf_field() }}
				<input type="hidden" name="step" value="1">
				<input type="hidden" name="channel" value="1">
				<input type="hidden" name="typeService" value="Libranza">
				<div class="row resetRow">
					<div class="col-sm-12 col-md-6 form-group">
						<label for="name" class="control-label">Nombres*</label>
						<input type="text" name="name" validation-pattern="name" class="form-control inputsSteps inputText" id="name" required="true"/>
					</div>
					<div class="col-sm-12 col-md-6 form-group">
						<label for="lastName" class="control-label">Apellidos*</label>
						<input type="text" name="lastName" validation-pattern="name" class="form-control inputsSteps inputText" id="lastName" required="true"/>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-sm-12 form-group">
						<label for="email" class="control-label">Correo electronico*</label>
						<input type="email" name="email" validation-pattern="email" class="form-control inputsSteps inputText" id="email" required="true"/>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-12 col-sm-6">
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono*</label>
							<input type="text" name="telephone" validation-pattern="telephone" class="form-control inputsSteps inputText" id="telephone" required="true"/>
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<label for="occupation">Ocupación*</label>
						<select class="form-control inputsSteps inputSelect" name="occupation" required="">
							<option value="">Seleccione...</option>
							<option value="EMPLEADO">Empleado</option>
							<option value="SOLDADO-MILITAR-POLICÍA">Soldado - Militar - Policía</option>
							<option value="PRESTACIÓN DE SERVICIOS">Prestación de Servicios</option>
							<option value="INDEPENDIENTE CERTIFICADO">Independiente Certificado</option>
							<option value="NO CERTIFICADO">No Certificado</option>
							<option value="RENTISTA">Administrador de bienes propios</option>
							<option value="PENSIONADO">Pensionado</option>
						</select>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-12 col-sm-6 form-group">
						<label for="typeDocument">Tipo de documento*</label>
						<select class="form-control inputsSteps inputSelect" name="typeDocument" id="typeDocument" required="">
							<option value="">Seleccione...</option>
							<option value="1">Cédula de ciudadanía</option>
							<option value="2">NIT</option>
							<option value="3">Cédula de extranjería</option>
							<option value="4">Tarjeta de Identidad</option>
							<option value="5">Pasaporte</option>
							<option value="6">Tarjeta seguro social extranjero</option>
							<option value="7">Sociedad extranjera sin NIT en Colombia</option>
							<option value="8">Fidecoismo</option>
							<option value="9">Registro Civil</option>
							<option value="10">Carnet Diplomático</option>
						</select>
					</div>
					<div class="col-12 col-sm-6 form-group">
						<label for="identificationNumber">Número de identificación*</label>
						<input class="form-control inputsSteps inputText" type="text" validation-pattern="number" name="identificationNumber" id="identificationNumber" required="" />
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-12">
						<div class="form-group">
							<label for="city" class="control-label">Ciudad**</label>
							<select name="city" id="city" class="form-control inputsSteps inputSelect" required="">
								<option value="">Seleccione...</option>
								@foreach($cities as $city)
									<option value="{{ $city['value'] }}">{{ $city['label'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				{!! NoCaptcha::display(['data-callback' => 'enableBtn']) !!}
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
					<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit btnStepLibranzaStep1" id="button1">
						Siguiente
					</button>
					<a href="/oportuya" class=" btn btn-danger buttonFormModal" data-dismiss="modal" aria-label="Close">
						Volver
					</a>
				</div>
			</form>
		</div>
		<div class="modal modalSteps fade hide" data-backdrop="static" data-keyboard="false" id="proccess" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modalPrincipal" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="text-center" style="padding: 50px;">
							<img src="{{ asset('images/gif-load.gif') }}" alt="">
							<p class="text-procces">
								Procesando Solicitud...
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scriptsJs')
	<script>
		document.getElementById("button1").disabled = true;
		function enableBtn(){
			document.getElementById("button1").disabled = false;
		}

		$( "#saveLeadOportuya").submit(function( event ) {
			$('#proccess').modal('show');
		});
	</script>
@endsection