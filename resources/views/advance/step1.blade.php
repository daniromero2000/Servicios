@extends('layouts.steps')

@section('title', 'Avance en efectivo')

@section('metaTags')
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
@endsection()

@section('content')
	 {!! NoCaptcha::renderJs() !!}
	<div id="step1" ng-app="appAdvanceStep1" ng-controller="advanceStep1Ctrl">
		<div class="row resetRow container-header-forms">
			<div class="form-container-logoHeader form-container-logoHeader-avances">
				<img src="{{ asset('images/logosAvancesNew.png') }}" class="img-fluid" alt="Oportuya" />
			</div>
			<div class="col-12 conatiner-logoImg">
				<img src="/{{ $digitalAnalyst['img'] }}" alt="{{ $digitalAnalyst['name'] }}" class="img-fluid steps-imgAnalista" />
				<span class="steps-textStep"><strong>Solicitud de Avance Paso 1</strong> > (Cuéntanos Sobre Ti)</span>
			</div>
		</div>
		<div class="row resetRow">
			<div class="col-12 step2-containTitle">
				<h2 class="text-center step2-titleAnalista"><strong>Hola!</strong> soy {{ $digitalAnalyst['name'] }} tu analista digital</h2>
				<p class="text-center step2-textAnalista">En este momento te encuentras haciendo tu solicitud de avance, por favor diligencia <br> todos los datos para que tu aprobación sea más fácil</p>
				<h3 class="forms-text-analyst forms-text-analyst-avances text-center">Solo te tomará unos minutos solicitar tu Avance</h3>
			</div>
			<div class="col-12">
				<div class="step3-containerForm">
					<img src="{{ asset('images/iconoStartProgreso.png') }}" alt="" class="img-fluid imgStartProgress" />
					<div class="progreso">
						<div class="barra_vacia" style="width: 0;"></div>
						<div class="puntos puntos-avances punto_uno listo">
						</div>
						<span></span>
						<label>Cuéntanos sobre ti</label>
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
					<img src="{{ asset('images/iconoEndProgreso.png') }}" alt="" class="img-fluid imgEndProgress" />
				</div>
			</div>
		</div>
		<div class="step1-containerForm">
			<div class="row resetRow">
				<div class="forms-descStep forms-descStep-avances">
					<strong>Información básica</strong><br>
					<span class="forms-descText">Ingresa tus datos personales</span>
					<img src="{{ asset('images/datosPersonales.png') }}" class="img-fluid forms-descImg" />
					<span class="forms-descStepNum">1</span>
				</div>
			</div>
			<form role=form id="saveLeadOportuya" ng-submit="confirmnumCel()">
				<div class="row resetRow">
					<div class="col-12 col-sm-6 form-group">
						<label for="typeDocument">Tipo de documento*</label>
						<select class="form-control inputsSteps inputSelect" ng-model="leadInfo.typeDocument" id="typeDocument" required="" ng-options="type.value as type.label for type in typesDocuments">
						</select>
					</div>
					<div class="col-12 col-sm-6 form-group">
						<label for="identificationNumber">Número de identificación*</label>
						<input class="form-control inputsSteps inputText" type="text" validation-pattern="number" ng-model="leadInfo.identificationNumber" id="identificationNumber" required="" ng-blur="getNumCel()" />
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-sm-12 col-md-6 form-group">
						<label for="name" class="control-label">Nombres*</label>
						<input type="text" ng-model="leadInfo.name" validation-pattern="name" class="form-control inputsSteps inputText" id="name" required="true"  />
					</div>
					<div class="col-sm-12 col-md-6 form-group">
						<label for="lastName" class="control-label">Apellidos*</label>
						<input type="text" ng-model="leadInfo.lastName" validation-pattern="name" class="form-control inputsSteps inputText" id="lastName" required="true"  />
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-sm-12 col-md-6 form-group">
						<label for="email" class="control-label">Correo electrónico*</label>
						<input type="email" ng-model="leadInfo.email" ng-blur="validateEmail()" validation-pattern="email" class="form-control inputsSteps inputText" id="email" required="true"  />
					</div>
					<div class="col-sm-12 col-md-6 form-group">
						<label for="email" class="control-label">Confirmar Correo electrónico*</label>
						<input type="email" ng-model="leadInfo.emailConfirm" ng-blur="validateEmail()" validation-pattern="email" class="form-control inputsSteps inputText" id="email" required="true"  />
					</div>
					<div ng-show="emailValidate" class="col-12">
						<p class="alert alert-danger">
							Los correos no coinciden.
						</p>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="telephone" class="control-label">Celular*</label>
							<input ng-hide="leadInfo.CEL_VAL" type="text" ng-model="leadInfo.telephone" validation-pattern="telephone" class="form-control inputsSteps inputText" id="telephone" required="true" ng-disabled="leadInfo.CEL_VAL" />
							<input ng-show="leadInfo.CEL_VAL" ng-model="telephone" ng-disabled="true" type="text" readonly class="form-control inputsSteps inputText">
						</div>
						<div class="alert alert-warning" ng-show="leadInfo.CEL_VAL">
							Si deseas cambiar el número de celular, por favor comunícate con la línea de atención al cliente 01 8000 17787
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<label for="occupation">Ocupación*</label>
						<select class="form-control inputsSteps inputSelect" ng-model="leadInfo.occupation" required=""   ng-options="occu.value as occu.label for occu in occupations">
						</select>
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
					**Válido solo para ciudades que se desplieguen en la casilla.
				</p>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit" id="button1">
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

		<div class="modal fade hide" data-backdrop="static" data-keyboard="false" id="confirmNumCel" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modalCode">
				<div class="modal-content">
					<div class="modal-body" style="padding: 10px">
						<div class="row">
							<div class="col-12 form-group">
								<label for="">Número de Celular</label>
								<input ng-hide="leadInfo.CEL_VAL" type="text" ng-model="leadInfo.telephone" validation-pattern="telephone" class="form-control inputsSteps inputText" id="telephone" required="true" ng-disabled="leadInfo.CEL_VAL" />
								<input ng-show="leadInfo.CEL_VAL" ng-model="telephone" ng-disabled="true" type="text" readonly class="form-control inputsSteps inputText">
								<div class="alert alert-warning" ng-show="leadInfo.CEL_VAL">
									Si deseas cambiar el número de celular por favor comunícate con la línea de atención al cliente 01800017787
								</div>
							</div>
							<div class="col-12 text-center form-group">
								<button class="btn btn-primary " ng-click="getCodeVerification()">Enviar Código</button>
								<button type="button" ng-click="cerrar()" class="btn btn-danger">Cancelar</button>
							</div>
							<div class="col text-center">
								<p class="textCodeVerificacion">
									*Enviaremos un código de verificación a tu número celular
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div class="modal fade hide" data-backdrop="static" data-keyboard="false" id="confirmCodeVerification" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modalCode">
				<div class="modal-content">
					<div class="modal-body" style="padding: 10px">
						<form ng-submit="verificationCode()">
							<div class="row">
								<div class="col-12 form-group">
									<label for="">Código de Verificacion</label>
									<input type="text" ng-model="code.code" class="form-control" />
								</div>
								<div class="col-12 text-center">
									<button class="btn btn-primary form-group">Confirmar Código</button>
								</div>
								<div class="col-12 text-center" ng-show="showAlertCode">
									<div class="alert alert-danger" role="alert">
										Código erróneo, por favor verifícalo
									</div>
								</div>
								<div class="col-12 text-center" ng-show="showWarningCode">
									<div class="alert alert-warning" role="alert">
										El código ya expiró, <span class="renewCode" ng-click="getCodeVerification(true)">clic aquí</span> para generar un nuevo código
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal modalCardExist fade hide" data-backdrop="static" data-keyboard="false" id="cardExist" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content modalCardContent">
					<div class="modal-body modalStepsBody" style="padding: 0">
						<div class="row resetRow">
							<div class="col-12 text-center containerLogoModalStep">
								<img src="{{ asset('images/logoOportuyaModalStep.png') }}" alt="" class="img-fluid">
							</div>
						</div>
						<div class="row resetRow">
							<div class="col-12">
								<p class="textModal text-center">
									<strong>Gracias</strong> por contar con nosotros
								</p>
								<br>
								<br>
								<div class="row">
									<div class="offset-5 col-7">
										<p>
											Actualmente ya cuentas <br>
											con un Avance.
											<br>
											Te invitamos a que la utilices en <br>
											cualquiera de nuestros puntos de venta! <br>
											<br>Para más información comunicate  <br>
											a la línea <strong>01 8000 11 77 87</strong>
										</p>
									<div class="text-center">
										<a class="btn btn-danger buttonBackCardExist" href="/">Regresar</a>
									</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row resetRow containerFormModal">
							<div class="col-sm-7 offset-sm-5">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scriptsJs')
	<script type="text/javascript" src="{{ asset('js/advanceStep1.js') }}"></script>
	<script>
		document.getElementById("button1").disabled = true;
		function enableBtn(){
			document.getElementById("button1").disabled = false;
		}
	</script>
@endsection