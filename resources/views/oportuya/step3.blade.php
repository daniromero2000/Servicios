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
		<div class="row">
			<div class="col-12">
				<hr>
			</div>
			<div class="col-12 step2-containTile">
				<h2 class="text-center step2-titleAnalista"><strong>Hola!</strong> soy Fernanda tu analista digital</h2>
				<p class="text-center step2-textAnalista">listo para obtener tu crédito oportuya</p>
			</div>
		</div>
		<div class="step3-containerForm">
			<div>
				<form ng-submit="saveStep3()" id="formEmpleado" ng-if="dataLead.occupation == 'Empleado'">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-12 col-md-8 form-group">
							<label for="nit">Nit (sin número de verificación)</label>
							<input type="text" class="form-control" id="nit" validation-pattern="number" ng-model="leadInfo.nit" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="indicative">Indicativo</label>
							<input type="number" class="form-control" id="indicative" validation-pattern="number" ng-model="leadInfo.indicative" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="companyName">Nombre de la empresa</label>
							<input type="text" class="form-control" id="companyName" validation-pattern="text" ng-model="leadInfo.companyName">
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="companyAddres">Dirección de la empresa</label>
							<input type="text" class="form-control" id="companyAddres" validation-pattern="text" ng-model="leadInfo.companyAddres">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="companyTelephone">Teléfono de la empresa</label>
							<input type="text" id="companyTelephone" ng-model="leadInfo.companyTelephone" validation-pattern="telephone" class="form-control">
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="companyTelephone2">Teléfono 2 de la empresa</label>
							<input type="text" id="companyTelephone2" ng-model="leadInfo.companyTelephone2" validation-pattern="telephone" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-4 form-group">
							<label for="eps">EPS</label>
							<input type="text" id="eps" ng-model="leadInfo.eps" validation-pattern="textOnly" class="form-control">
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="companyPosition">Cargo</label>
							<input type="text" id="companyPosition" ng-model="leadInfo.companyPosition" validation-pattern="textOnly" class="form-control">
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="admissionDate">Fecha de ingreso</label>
							<div class="input-group"
							     moment-picker="leadInfo.admissionDate"
							     format="YYYY-MM-DD">
							    <input class="form-control"
							           ng-model="leadInfo.admissionDate" id="admissionDate" readonly="" placeholder="YYYY-MM-DD">
							    <span class="input-group-addon">
							        <i class="octicon octicon-calendar"></i>
							    </span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="antiquity">Atigüedad</label>
							<input type="number" id="antiquity" ng-model="leadInfo.antiquity" validation-pattern="number" class="form-control" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="salary">Salario</label>
							<input type="number" id="salary" ng-model="leadInfo.salary" validation-pattern="number" class="form-control" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="typeContract">Tipo de contrato</label>
							<select class="form-control" id="typeContract" ng-model="leadInfo.typeContract" validation-pattern="textOnly" ng-options="type.value as type.label for type in typesContracts"></select>
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="otherRevenue">Otros ingresos</label>
							<input type="text" id="otherRevenue" ng-model="leadInfo.otherRevenue" validation-pattern="number" class="form-control" />
						</div>
					</div>
					<div class="row">
						<div class="col-12 text-center form-group">
							<button class="btn btn-primary">Siguiente</button>
						</div>
					</div>
				</form>
			</div>
			<div>
				<form ng-submit="saveStep3()" id="formIdependiente" ng-if="dataLead.occupation == 'Independiente'">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="camaraComercio">Cámara de comercio</label>
							<select id="camaraComercio" ng-model="leadInfo.camaraComercio" class="form-control" ng-options="type.value as type.label for type in typesCamaraComercio"></select>
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="nit">Nit (sin número de verificación)</label>
							<input type="text" id="nit" ng-model="leadInfo.nit" validation-pattern="number" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="companyName">Nombre de la empresa</label>
							<input type="text" class="form-control" id="companyName" validation-pattern="text" ng-model="leadInfo.companyName">
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="whatSell">Que Vendes o Comercializas?</label>
							<input type="text" class="form-control" id="whatSell" validation-pattern="text" ng-model="leadInfo.whatSell">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="eps">EPS</label>
							<input type="text" id="eps" ng-model="leadInfo.eps" validation-pattern="textOnly" class="form-control">
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="dateCreationCompany">Fecha de constitución</label>
							<div class="input-group"
							     moment-picker="leadInfo.dateCreationCompany"
							     format="YYYY-MM">
							    <input class="form-control"
							           ng-model="leadInfo.dateCreationCompany" id="dateCreationCompany" readonly="" placeholder="YYYY-MM">
							    <span class="input-group-addon">
							        <i class="octicon octicon-calendar"></i>
							    </span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="antiquity">Atigüedad</label>
							<input type="number" id="antiquity" ng-model="leadInfo.antiquity" validation-pattern="number" class="form-control" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="salary">Salario</label>
							<input type="number" id="salary" ng-model="leadInfo.salary" validation-pattern="number" class="form-control" />
						</div>
					</div>
					<div class="row">
						<div class="col-12 text-center form-group">
							<button class="btn btn-primary">Siguiente</button>
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
							<label for="companyName">Nombre de la empresa</label>
							<input type="text" class="form-control" id="companyName" validation-pattern="text" ng-model="leadInfo.companyName">
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="dateCreationCompany">Fecha de pensión</label>
							<div class="input-group"
							     moment-picker="leadInfo.dateCreationCompany"
							     format="YYYY-MM">
							    <input class="form-control"
							           ng-model="leadInfo.dateCreationCompany" id="dateCreationCompany" readonly="" placeholder="YYYY-MM">
							    <span class="input-group-addon">
							        <i class="octicon octicon-calendar"></i>
							    </span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="antiquity">Atigüedad</label>
							<input type="number" id="antiquity" ng-model="leadInfo.antiquity" validation-pattern="number" class="form-control" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="salary">Salario</label>
							<input type="number" id="salary" ng-model="leadInfo.salary" validation-pattern="number" class="form-control" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="eps">EPS</label>
							<input type="text" id="eps" ng-model="leadInfo.eps" validation-pattern="textOnly" class="form-control">
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="admissionDate">Banco</label>
							<select ng-model="leadInfo.bankSavingsAccount" class="form-control" ng-options="bank.value as bank.label for bank in banks"></select>
						</div>
					</div>
					<div class="row">
						<div class="col-12 text-center form-group">
							<button class="btn btn-primary">Siguiente</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{ asset('js/step3.js') }}"></script>
@endsection

@section('scriptsJs')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
@endsection