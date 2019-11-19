@extends('layouts.steps')
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-781153823"></script>
<script>
	window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','AW-781153823',{'page_title':'Oportuya Paso1','page_path':'/step1'});
</script>
@section('eventTag')
	<!-- Event snippet for Generación de Crédito conversion page --> <script> gtag('event', 'conversion', { 'send_to': 'AW-781153823/2Ee7CKT9l5sBEJ_svfQC', 'value': 200.0, 'currency': 'COP' }); </script>
@endsection
@section('title', 'Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta.')

@section('linkStyleSheets')
    <link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection

@section('content')
	 {!! NoCaptcha::renderJs() !!}
	<div id="step1" ng-app="appStep1" ng-controller="step1Ctrl">
		<div class="row resetRow container-header-forms">
			<div class="form-container-logoHeader">
				<img src="{{ asset('images/formsLogoOportuya.png') }}" class="img-fluid" alt="Oportuya" />
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
				<p class="text-center "><a data-toggle="modal" href="#oportuyaBeneficiosModal"> Obtén más información sobre los beneficios y condiciones de tu tarjeta </a></p>
				<h3 class="forms-text-analyst text-center">Solo te tomará unos minutos solicitar tu tarjeta Oportuya</h3>
			</div>
			<div class="col-12">
				<div class="step3-containerForm">
					<img src="{{ asset('images/iconoStartProgreso.png') }}" alt="" class="img-fluid imgStartProgress" />
					<div class="progreso">
						<div class="barra_vacia" style="width: 0;"></div>
						<div class="puntos punto_uno listo">
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
				<div class="forms-descStep">
					<strong>Información básica</strong><br>
					<span class="forms-descText">Ingresa tus datos personales</span>
					<img src="{{ asset('images/datosPersonales.png') }}" class="img-fluid forms-descImg" />
					<span class="forms-descStepNum">1</span>
				</div>
			</div>
			<form role=form id="saveLeadOportuya" ng-submit="confirmnumCel()">
				<div class="row resetRow">
					<div class="col-12 col-sm-4 form-group">
						<label for="typeDocument">Tipo de documento*</label>
						<select class="form-control inputsSteps inputSelect" ng-model="leadInfo.typeDocument" id="typeDocument" required="" ng-options="type.value as type.label for type in typesDocuments">
						</select>
					</div>
					<div class="col-12 col-sm-4 form-group">
						<label for="identificationNumber">Número de identificación*</label>
						<input class="form-control inputsSteps inputText" type="text" validation-pattern="number" ng-model="leadInfo.identificationNumber" id="identificationNumber" required="" ng-blur="getNumCel()" />
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<label for="dateDocumentExpedition">Fecha Expedición Documento*</label>
					    <div class="input-group"
					         moment-picker="leadInfo.dateDocumentExpedition"
					         format="YYYY-MM-DD">
					        <input class="form-control inputsSteps inputText"
					               ng-model="leadInfo.dateDocumentExpedition" id="dateDocumentExpedition" readonly="" required="" placeholder="Año/Mes/Día">
					        <span class="input-group-addon">
					            <i class="octicon octicon-calendar"></i>
					        </span>
					    </div>
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
						<input type="text" ng-model="leadInfo.email" ng-blur="validateEmail()" validation-pattern="email" class="form-control inputsSteps inputText" id="email" required="true"  />
					</div>
					<div class="col-sm-12 col-md-6 form-group">
						<label for="emailConfirm" class="control-label">Confirmar Correo electrónico*</label>
						<input type="text" ng-model="leadInfo.emailConfirm" ng-blur="validateEmail()" validation-pattern="email" class="form-control inputsSteps inputText" id="emailConfirm" required="true"  />
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
							Si deseas cambiar el número de celular por favor comunícate con la línea de atención al cliente 018000117787
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<label for="occupation">Ocupación*</label>
						<select id="occupation" class="form-control inputsSteps inputSelect" ng-model="leadInfo.occupation" required=""   ng-options="occu.value as occu.label for occu in occupations">
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
				@if(!(Auth::guard('assessor')->check()))
				{!! NoCaptcha::display(['data-callback' => 'enableBtn']) !!}
				@endif
				<div class="form-group">
					<input type="checkbox" ng-model="leadInfo.termsAndConditions" id="termsAndConditions" value="1" required>
					<label for="termsAndConditions" style="font-size: 13px; font-style: italic;">
						Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
					</label>
				</div>
				<p class="textCityForm">
					**Válido solo para ciudades que se desplieguen en la casilla.
				</p>
				<div class="row" ng-show="showWarningErrorData">
					<div class="col-12">
						<p class="alert alert-danger">
							Lo sentimos, los datos no coinciden, por favor verifícalos
						</p>
					</div>
				</div>
				<div class="form-group text-center">
					@if(!(Auth::guard('assessor')->check()))
					<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit" id="button1">
						Siguiente
					</button>
					@else
					<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
						Siguiente
					</button>
					@endif

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
								Procesando Solicitud...<br>
								<span style="font-size: 15px; font-style:italic; font-weight:normal">*No te desesperes, se están realizando las consultas necesarias, esto puede tomar un tiempo de aproximadamente 2 minutos</span>
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
									Si deseas cambiar el número de celular, por favor comunícate con la línea de atención al cliente 018000117787
								</div>
							</div>
							<div class="col-12 text-center form-group">
								<button class="btn btn-primary" ng-click="getCodeVerification()">Enviar Código</button>
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
									<label for="">Código de Verificación</label>
									<input type="text" ng-model="code.code" class="form-control" />
								</div>
								<div class="col-12 text-center form-group">
									<button type="submit" class="btn btn-primary">Confirmar Código</button>
									<button type="button" ng-show="reNewToken" class="btn btn-warning" ng-click="getCodeVerification(true)">Generar Nuevo Código</button>
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
										con una tarjeta <strong> Oportuya.</strong>
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
		<div class="modal modalFormulario fade hide" id="oportuyaBeneficiosModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body oportuyaModal-body">
						<h4 class="text-center">
							Conoce la manera más fácil de tener todos <hr>
							los beneficios de nuestros clientes.
						</h4>
						<br>
						<br>
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="row border-top min-height-modal-item">
									<div class="col-2 text-center">
										<img src="{{asset('images/icon-accede-oportuya.png')}}" alt="" class="img-fluid">
									</div>
									<div class="col-10">
										Accede con facilidad a una gran variedad  de electrodomésticos para tu hogar.
									</div>
								</div>
								<div class="row border-top">
									<div class="col-2 text-center">
										<img src="{{asset('images/icon-cupo-oportuya.png')}}" alt="" class="img-fluid">
									</div>
									<div class="col-10">
										Un cupo de avances para que utilices cuando más lo necesites (Hasta $500.000)
									</div>
								</div>
								<div class="row border-top border-bottom">
									<div class="col-2 text-center">
										<img src="{{asset('images/icon-rotativo-oportuya.png')}}" alt="" class="img-fluid">
									</div>
									<div class="col-10">
										El cupo de crédito con nuestra tarjeta es rotativo.
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="row border-top min-height-modal-item">
									<div class="col-2 text-center">
										<img src="{{asset('images/icon-descuentos-oportuya.png')}}" alt="" class="img-fluid">
									</div>
									<div class="col-10">
										Tienes acceso a los súper descuentos que lanzamos cada semana con los mejores precios por ser cliente Oportuya.
									</div>
								</div>
								<div class="row border-top border-bottom">
									<div class="col-2 text-center">
										<img src="{{asset('images/icon-seguros-oportuya.png')}}" alt="" class="img-fluid">
									</div>
									<div class="col-10">
										Descuentos en SOAT y otros seguros para que estés protegido siempre.
									</div>
								</div>
							</div>
						</div>
						<br>
						<h5 class="text-center">
							Antes de iniciar con los pasos queremos que sepas que <br> tenemos muchas oportunidades de crédito para ti.
						</h5>
						<br>
						<div class="row content-pasos-oportuya">
							<div class="col-12 border-bottom pasos-oportuya">
								<div class="row">
									<div class="col-md-1 col-2 text-center paso-oportuya-numero"> <span>1</span></div>
									<div class="col-md-8 col-10 paso-oportuya-vertica-centrar"> <p> Ingresa nuestra solicitud de crédito para comenzar </p></div>
									<div class="col-md-3 col-12 text-center">
									<a href="/step1"><img src="{{asset('images/icon-ingresar-modal.png')}}" alt="" class="img-fluid"></a>
									</div>
								</div>
							</div>
							<div class="col-12 border-bottom pasos-oportuya">
								<div class="row">
									<div class="col-2 col-md-1 text-center paso-oportuya-numero"> <span>2</span></div>
									<div class="col-10 col-md-8"> <p>Deja tus datos completos según la solicitud de crédito
														que estés diligenciando.De la calidad de la información
														dependerá la velocidad en el resultado.
														Además recuerda que todos los datos son verificados.</p>
									</div>
									<div class="col-12 col-md-3 text-center">
										<a href="/step1"><img src="{{asset('images/icon-datos-oportuya.png')}}" alt="" class="img-fluid"></a>
									</div>
								</div>
							</div>
							<div class="col-12 border-bottom pasos-oportuya">
								<div class="row">
									<div class="col-md-1 col-2 text-center paso-oportuya-numero"> <span>3</span></div>
									<div class="col-md-8 col-10"> <p>En el intermedio del proceso recibirás un token de
														confirmación para verificar la existencia de tu número
														telefónico;no lo elimines, el proceso te lo exigirá para
														continuar con tu solicitud.</p>
									</div>
									<div class="col-md-3 col-12	 text-center">
										<img src="{{asset('images/icon-token-oportuya.png')}}" alt="" class="img-fluid">
									</div>
								</div>
							</div>
							<div class="col-12 pasos-oportuya">
								<div class="row">
									<div class="col-md-1 col-2 text-center paso-oportuya-numero"> <span>4</span></div>
									<div class="col-md-8 col-10 padding-top-30"> <p>Una vez haya sido aprobada tu solicitud de crédito.
														un asesor se comunicará contigo para finalizar el proceso.
														</p>
									</div>
									<div class="col-md-3 col-12 text-center asesor-img-modal">
										<img src="{{asset('images/icon-asesor-oportuya.png')}}" alt="" class="img-fluid">
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row footer-modal-oportuya">
							<div class="col-md-7 bg-oportuya-modal-footer">
							</div>
							<div class="col-md-5 bg-oportuya-modal-footer">
								<p>Avances  aplica para las tres tarjetas <br>
								Black, Blue y Gray: <br>
								<span>Blue y Black:</span>hasta $500.000<br>
								<span>Gray:</span>hasta $200.000
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection

@section('scriptsJs')
	<script type="text/javascript" src="{{ asset('js/step1.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/humanize-duration/3.17.0/humanize-duration.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
	<script>
		document.getElementById("button1").disabled = true;
		function enableBtn(){
			document.getElementById("button1").disabled = false;
		}
	</script>
@endsection