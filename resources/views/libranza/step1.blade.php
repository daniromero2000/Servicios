@extends('layouts.stepsLibranza')

@section('title', 'Crédito libraza')

@section('metaTags')
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
@endsection()

@section('content')
	 {!! NoCaptcha::renderJs() !!}
	<div id="step1" ng-app="appLibranzaStep1" ng-controller="libranzaStep1Ctrl">
		<div class="row resetRow container-header-forms  container-libranza-forms">
			<div class="form-container-logoHeader form-container-logoLibranza">
				<a href="/">
				<img src="{{ asset('images/logo_Creo.png') }}" class="img-fluid libranzaSteplogo" alt="Oportuya" />
				</a>
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
				<h3 class="forms-text-analyst text-analyst-libranza text-center">Solo te tomará unos minutos solicitar tu crédito</h3>
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
			<form role=form id="saveLeadOportuya" ng-submit="saveStep1()">
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
					<label for="email" class="control-label">Correo electrónico*</label>
						<input type="email" ng-model="leadInfo.email"  validation-pattern="email" class="form-control inputsSteps inputText" id="email" required="true"  />
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-12 col-sm-6">
						<div class="form-group">
						<label for="telephone" class="control-label">Celular*</label>
							<input type="text" ng-model="leadInfo.telephone" validation-pattern="telephone" class="form-control inputsSteps inputText" id="telephone" required="true"  />
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<label for="occupation">Ocupación*</label>
						<select class="form-control inputsSteps inputSelect" ng-model="leadInfo.occupation" required=""   ng-options="occu.value as occu.label for occu in occupations">
						</select>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-12 col-sm-6 form-group">
						<label for="typeDocument">Tipo de documento*</label>
						<select class="form-control inputsSteps inputSelect" ng-model="leadInfo.typeDocument" id="typeDocument" required="" ng-options="type.value as type.label for type in typesDocuments">
						</select>
					</div>
					<div class="col-12 col-sm-6 form-group">
						<label for="identificationNumber">Número de identificación*</label>
						<input class="form-control inputsSteps inputText" type="text" validation-pattern="number" ng-model="leadInfo.identificationNumber" id="identificationNumber" required="" />
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-12">
						<div class="form-group">
							<label for="city" class="control-label">Ciudad**</label>
							<select ng-model="leadInfo.city" id="city" class="form-control inputsSteps inputSelect" required="" ng-options="city.value as city.label for city in cities"  >
								
							</select>
						</div>
					</div>
				</div>
				{!! NoCaptcha::display(['data-callback' => 'enableBtn']) !!}
				<div class="form-group">
					<input type="checkbox" ng-model="leadInfo.termsAndConditions" id="termsAndConditions" value="1" required>
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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/humanize-duration/3.17.0/humanize-duration.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script type="text/javascript" src="{{ asset('js/libranzaStep1.js') }}"></script>
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