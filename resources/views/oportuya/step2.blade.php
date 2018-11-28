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
	<div id="step2" ng-app="appStep2" ng-controller="step2Ctrl" ng-init="leadInfo.identificationNumber = {{$identificactionNumber}}">
		<div class="row">
			<div class="col-12">
				<hr>
			</div>
			<div class="col-12 step2-containTile">
				<h2 class="text-center step2-titleAnalista"><strong>Hola!</strong> soy Fernanda tu analista digital</h2>
				<p class="text-center step2-textAnalista">listo para obtener tu crédito oportuya</p>
			</div>
		</div>
		<div class="step2-containerForm">
			<form id="step2Form" ng-submit="saveStep2()">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-sm-12 col-md-6 form-group">
					    <label for="dateDocumentExpedition">Fecha Expedición Documento</label>
					    <div class="input-group"
					         moment-picker="leadInfo.dateDocumentExpedition"
					         format="YYYY-MM-DD">
					        <input class="form-control"
					               ng-model="leadInfo.dateDocumentExpedition" id="dateDocumentExpedition" readonly="" placeholder="YYYY-MM-DD">
					        <span class="input-group-addon">
					            <i class="octicon octicon-calendar"></i>
					        </span>
					    </div>
					</div>
					<div class="col-sm-12 col-md-6 form-group">
					    <label for="cityExpedition">Ciudad Expedición Documento</label>
					    <select class="form-control" id="cityExpedition" ng-model="leadInfo.cityExpedition" ng-options="city.value as city.label for city in cities"></select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-4 form-group">
						<label for="housingType">Tipo de Vivienda</label>
						<select class="form-control" id="housingType" ng-model="leadInfo.housingType" ng-change="changeHousingType()" ng-options="type.value as type.label for type in housingTypes"></select>
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<label for="housingTime">Tiempo Vivienda</label>
						<input type="number" ng-model="leadInfo.housingTime" class="form-control" id="housingTime" />
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<label for="housingOwner">Propietario de la Vivienda</label>
						<input type="text" class="form-control" id="housingOwner" ng-model="leadInfo.housingOwner" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-6 form-group">
						<label for="addres">Dirección Residencia</label>
						<input type="text" class="form-control" ng-model="leadInfo.addres" id="addres" />
					</div>
					<div class="col-sm-12 col-md-6 form-group" ng-if="leadInfo.housingType == 'arriendo'">
						<label for="leaseValue">Valor de Arriendo</label>
						<input type="number" class="form-control" ng-model="leadInfo.leaseValue" id="leaseValue" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-6 form-group">
						<label for="housingTelephone">Teléfono Residencia</label>
						<input type="text" class="form-control" ng-model="leadInfo.housingTelephone" id="housingTelephone" />
					</div>
					<div class="col-sm-12 col-md-6 form-group">
						<label for="stratum">Estrato</label>
						<input type="number" class="form-control" ng-model="leadInfo.stratum" id="stratum" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label for="birthdate">Fecha de Nacimiento</label>
						<div class="input-group"
						     moment-picker="leadInfo.birthdate"
						     format="YYYY-MM-DD">
						    <input class="form-control"
						           ng-model="leadInfo.birthdate" id="birthdate" readonly="" placeholder="YYYY-MM-DD">
						    <span class="input-group-addon">
						        <i class="octicon octicon-calendar"></i>
						    </span>
						</div>
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<label for="gender">Género</label>
						<select class="form-control" id="gender" ng-model="leadInfo.gender" ng-options="gender.value as gender.label for gender in genders"></select>
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<label for="civilStatus">Estado Civil</label>
						<select class="form-control" id="civilStatus" ng-model="leadInfo.civilStatus" ng-options="civilType.value as civilType.label for civilType in civilTypes"></select>
					</div>
				</div>
				<div ng-if="leadInfo.civilStatus == 'casado' || leadInfo.civilStatus == 'union libre'">
					<div class="row">
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseName">Nombre Cónyuge</label>
							<input type="text" id="spouseName" ng-model="leadInfo.spouseName" class="form-control" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseIdentificationNumber">Número Identificación Cónyuge</label>
							<input type="text" id="spouseIdentificationNumber" ng-model="leadInfo.spouseIdentificationNumber" class="form-control">
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseTelephone">Número de Teléfono del Cónyuge</label>
							<input type="text" id="spouseTelephone" ng-model="leadInfo.spouseTelephone" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseJobName">Trabajo del Cónyuge</label>
							<input type="text" id="spouseJobName" ng-model="leadInfo.spouseJobName" class="form-control" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseProfession">Profesión del Cónyuge</label>
							<input type="text" id="spouseProfession" ng-model="leadInfo.spouseProfession" class="form-control" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseJob">Cargo Actual del Cónyuge</label>
							<input type="text" id="spouseJob" ng-model="leadInfo.spouseJob" class="form-control" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<label for="spouseSalary">Salrio del Cónyuge</label>
							<input type="number" id="spouseSalary" ng-model="leadInfo.spouseSalary" class="form-control" />
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="spouseEps">EPS del Cónyuge</label>
							<input type="text" id="spouseEps" ng-model="leadInfo.spouseEps" class="form-control" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center">
						<button type="submit" class="btn btn-primary">Continuar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="{{ asset('js/step2.js') }}"></script>
@endsection

@section('scriptsJs')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
@endsection