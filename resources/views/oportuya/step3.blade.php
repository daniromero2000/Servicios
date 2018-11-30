@extends('layouts.steps')

@section('title', 'Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta.')

@section('linkStyleSheets')
    <link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection

@section('metaTags')
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
@endsection()

@section('content')
	<div id="step3" ng-app="appStep3" ng-controller="step3Ctrl" ng-init="leadInfo.identificationNumber = {{$identificactionNumber}}">
		<div class="row resetRow">
			<div class="col-12 conatiner-logoImg">
				<img src="{{ asset('images/logoOportuya.png') }}" class="img-fluid" alt="Oportuya" />
				<img ng-src="/@{{ analyst.img }}" ng-alt="@{{ analyst.name }}" class="img-fluid steps-imgAnalista" />
				<span class="steps-textStep"><strong>Solicitud de Crédito Paso2</strong> > (Información Laboral)</span>
			</div>
			<div class="col-12 step2-containTitle">
				<h2 class="text-center step2-titleAnalista"><strong>Hola! @{{ dataLead.name + ' ' + dataLead.lastName }}</strong> soy @{{ analyst.name }} tu analista digital</h2>
				<p class="text-center step2-textAnalista">Cuéntanos más sobre tu información laboral</p>
			</div>
		</div>
		<div class="step3-containerForm">
			<div>
				<form ng-submit="saveStep3()" id="formEmpleado" ng-if="dataLead.occupation == 'Empleado'">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-12 col-md-8 form-group">
							<input type="text" class="form-control inputsSteps inputText" id="nit" validation-pattern="number" ng-model="leadInfo.nit" placeholder="Nit (sin número de verificación)" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<input type="number" class="form-control inputsSteps inputText" id="indicative" validation-pattern="number" ng-model="leadInfo.indicative" placeholder="Indicativo" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" class="form-control inputsSteps inputText" id="companyName" validation-pattern="text" ng-model="leadInfo.companyName" placeholder="Nombre de la empresa">
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" class="form-control inputsSteps inputText" id="companyAddres" validation-pattern="text" ng-model="leadInfo.companyAddres" placeholder="Dirección de la empresa">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" id="companyTelephone" ng-model="leadInfo.companyTelephone" validation-pattern="telephone" class="form-control inputsSteps inputText" placeholder="Teléfono de la empresa">
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" id="companyTelephone2" ng-model="leadInfo.companyTelephone2" validation-pattern="telephone" class="form-control inputsSteps inputText" placeholder="Teléfono 2 de la empresa">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-4 form-group">
							<input type="text" id="eps" ng-model="leadInfo.eps" validation-pattern="textOnly" class="form-control inputsSteps inputText" placeholder="EPS">
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<input type="text" id="companyPosition" ng-model="leadInfo.companyPosition" validation-pattern="textOnly" class="form-control inputsSteps inputText" placeholder="Cargo">
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<div class="input-group"
							     moment-picker="leadInfo.admissionDate"
							     format="YYYY-MM-DD">
							    <input class="form-control inputsSteps inputText"
							           ng-model="leadInfo.admissionDate" id="admissionDate" readonly="" placeholder="Fecha de ingreso (Año/Mes/Día)">
							    <span class="input-group-addon">
							        <i class="octicon octicon-calendar"></i>
							    </span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<input type="number" id="antiquity" ng-model="leadInfo.antiquity" validation-pattern="number" class="form-control inputsSteps inputText" placeholder="Atigüedad" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<input type="number" id="salary" ng-model="leadInfo.salary" validation-pattern="number" class="form-control inputsSteps inputText" placeholder="Salario" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<select class="form-control inputsSteps inputSelect" id="typeContract" ng-model="leadInfo.typeContract" validation-pattern="textOnly" ng-options="type.value as type.label for type in typesContracts">
								<option value="" disabled="" hidden>Tipo de contrato</option>
							</select>
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" id="otherRevenue" ng-model="leadInfo.otherRevenue" validation-pattern="number" class="form-control inputsSteps inputText" placeholder="Otros ingresos" />
						</div>
					</div>
					<div class="row">
						<div class="col-12 text-center form-group">
							<button class="btn btn-primary btnStep">Siguiente</button>
						</div>
					</div>
				</form>
			</div>
			<div>
				<form ng-submit="saveStep3()" id="formIdependiente" ng-if="dataLead.occupation == 'Independiente'">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<select id="camaraComercio" ng-model="leadInfo.camaraComercio" class="form-control inputsSteps inputSelect" ng-options="type.value as type.label for type in typesCamaraComercio">
								<option value="" disabled="" hidden>Cámara de comercio</option>
							</select>
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" id="nit" ng-model="leadInfo.nit" validation-pattern="number" class="form-control inputsSteps inputText" placeholder="Nit (sin número de verificación)">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" class="form-control inputsSteps inputText" id="companyName" validation-pattern="text" ng-model="leadInfo.companyName" placeholder="Nombre de la empresa">
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" class="form-control inputsSteps inputText" id="whatSell" validation-pattern="text" ng-model="leadInfo.whatSell" placeholder="Qué Vendes o Comercializas?">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" id="eps" ng-model="leadInfo.eps" validation-pattern="textOnly" class="form-control inputsSteps inputText" placeholder="EPS">
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<div class="input-group"
							     moment-picker="leadInfo.dateCreationCompany"
							     format="YYYY-MM">
							    <input class="form-control inputsSteps inputText"
							           ng-model="leadInfo.dateCreationCompany" id="dateCreationCompany" readonly="" placeholder="Fecha de constitución (Año/Mes)">
							    <span class="input-group-addon">
							        <i class="octicon octicon-calendar"></i>
							    </span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<input type="number" id="antiquity" ng-model="leadInfo.antiquity" validation-pattern="number" class="form-control inputsSteps inputText" placeholder="Atigüedad" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<input type="number" id="salary" ng-model="leadInfo.salary" validation-pattern="number" class="form-control inputsSteps inputText" placeholder="Salario" />
						</div>
					</div>
					<div class="row">
						<div class="col-12 text-center form-group">
							<button class="btn btn-primary btnStep">Siguiente</button>
						</div>
					</div>
				</form>
			</div>
			<div>
				<form ng-submit="saveStep3()" id="formPensionado" ng-if="dataLead.occupation == 'Pensionado' || dataLead.occupation == 'Fuerzas armadas' || dataLead.occupation == 'Do
				cente'">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" class="form-control inputsSteps inputText" id="companyName" validation-pattern="text" ng-model="leadInfo.companyName" placeholder="Nombre de la empresa">
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<div class="input-group"
							     moment-picker="leadInfo.dateCreationCompany"
							     format="YYYY-MM">
							    <input class="form-control inputsSteps inputText"
							           ng-model="leadInfo.dateCreationCompany" id="dateCreationCompany" readonly="" placeholder="Fecha de pensión (Año/Mes)">
							    <span class="input-group-addon">
							        <i class="octicon octicon-calendar"></i>
							    </span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<input type="number" id="antiquity" ng-model="leadInfo.antiquity" validation-pattern="number" class="form-control inputsSteps inputText" placeholder="Atigüedad" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<input type="number" id="salary" ng-model="leadInfo.salary" validation-pattern="number" class="form-control inputsSteps inputText" placeholder="Salario" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" id="eps" ng-model="leadInfo.eps" validation-pattern="textOnly" class="form-control inputsSteps inputText" placeholder="EPS" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<select ng-model="leadInfo.bankSavingsAccount" class="form-control inputsSteps inputSelect" ng-options="bank.value as bank.label for bank in banks">
								<option value="" disabled="" hidden>Banco</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-12 text-center form-group">
							<button class="btn btn-primary btnStep">Siguiente</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="modal modalSteps fade hide" data-backdrop="static" data-keyboard="false" id="congratulations" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content modalStepsContent">
					<div class="modal-body modalStepsBody" style="padding: 0">
						<div class="row resetRow">
							<div class="col-12 text-center containerLogoModalStep">
								<img src="{{ asset('images/logoOportuyaModalStep.png') }}" alt="" class="img-fluid">
							</div>
						</div>
						<div class="row resetRow">
							<div class="col-12">
								<p class="textModal text-center">
									<strong>Felicitaciones</strong> tu solicitud ha sido pre aprobada <br> un analista se pondrá en contacto contigo <br> para continuar el proceso
								</p>
							</div>
						</div>
						<div class="row resetRow containerFormModal">
							<div class="col-sm-7 offset-sm-5">
								<form ng-submit="sendComment()">
									<div class="form-group">
										<input type="text" ng-model="comment.availability" placeholder="A que hora te podemos llamar" class="form-control">
									</div>
									<div class="form-group">
										<textarea ng-model="comment.comment" class="form-control" rows="10" placeholder="Algún comentario adicional"></textarea>
									</div>
									<div class="row">
										<div class="col-12 text-center">
											<button type="submit" class="btn btn-primary btnStep">Enviar</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{ asset('js/step3.js') }}"></script>
@endsection

@section('scriptsJs')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
@endsection