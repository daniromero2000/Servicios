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
		<div class="row resetRow">
			<div class="col-12 conatiner-logoImg">
				<img src="{{ asset('images/logoOportuya.png') }}" class="img-fluid" alt="Oportuya" />
				<img ng-src="/@{{ analyst.img }}" ng-alt="@{{ analyst.name }}" class="img-fluid steps-imgAnalista" />
				<span class="steps-textStep"><strong>Solicitud de Crédito Paso1</strong> > (Información Personal)</span>
			</div>
			<div class="col-12 step2-containTitle">
				<h2 class="text-center step2-titleAnalista"><strong>Hola! @{{ lead.name + ' ' + lead.lastName }}</strong> soy @{{ analyst.name }} tu analista digital</h2>
				<p class="text-center step2-textAnalista">En este momento te encuentras haciendo tu solicitud de crédito, por favor diligencia <br> todos los datos para que tu aprobación sea más fácil</p>
			</div>
		</div>
		<div class="step2-containerForm">
			<form id="step2Form" ng-submit="saveStep2()">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-sm-12 col-md-6 form-group">
					    <div class="input-group"
					         moment-picker="leadInfo.dateDocumentExpedition"
					         format="YYYY-MM-DD">
					        <input class="form-control inputsSteps inputText"
					               ng-model="leadInfo.dateDocumentExpedition" id="dateDocumentExpedition" readonly="" required="" placeholder="Fecha Expedición Documento (Año/Mes/Día">
					        <span class="input-group-addon">
					            <i class="octicon octicon-calendar"></i>
					        </span>
					    </div>
					</div>
					<div class="col-sm-12 col-md-6 form-group">
					    <select class="form-control inputsSteps inputSelect" id="cityExpedition" ng-model="leadInfo.cityExpedition" ng-options="city.value as city.label for city in cities" required>
					    	 <option value="" disabled="" hidden>Ciudad Expedición Documento</option>
					    </select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-4 form-group">
						<select class="form-control inputsSteps inputSelect" id="housingType" ng-model="leadInfo.housingType" ng-change="changeHousingType()" ng-options="type.value as type.label for type in housingTypes" required="">
							<option value="" disabled="" hidden>Tipo de Vivienda</option>
						</select>
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<input type="number" ng-model="leadInfo.housingTime" class="form-control inputsSteps inputText" id="housingTime" validation-pattern="number" placeholder="Antigüedad en la Vivienda (Meses)" required="" />
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<input type="text" class="form-control inputsSteps inputText" id="housingOwner" validation-pattern="name" ng-model="leadInfo.housingOwner" placeholder="Propietario de la Vivienda" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-6 form-group">
						<input type="text" class="form-control inputsSteps inputText" validation-pattern="text" ng-model="leadInfo.addres" id="addres" placeholder="Dirección Residencia" required="" />
					</div>
					<div class="col-sm-12 col-md-6 form-group" ng-show="leadInfo.housingType == 'ARRIENDO'">
						<input type="number" class="form-control inputsSteps inputText" validation-pattern="number" ng-model="leadInfo.leaseValue" id="leaseValue" placeholder="Valor de Arriendo" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-6 form-group">
						<input type="text" class="form-control inputsSteps inputText" validation-pattern="telephone" ng-model="leadInfo.housingTelephone" id="housingTelephone" placeholder="Teléfono Residencia" />
					</div>
					<div class="col-sm-12 col-md-6 form-group">
						<input type="number" class="form-control inputsSteps inputText" ng-model="leadInfo.stratum" validation-pattern="number" id="stratum" placeholder="Estrato" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<div class="input-group"
						     moment-picker="leadInfo.birthdate"
						     format="YYYY-MM-DD">
						    <input class="form-control inputsSteps inputText"
						           ng-model="leadInfo.birthdate" id="birthdate" readonly="" placeholder="Fecha de Nacimiento (Año/Mes/Día)">
						    <span class="input-group-addon">
						        <i class="octicon octicon-calendar"></i>
						    </span>
						</div>
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<select class="form-control inputsSteps inputSelect" id="gender" ng-model="leadInfo.gender" ng-options="gender.value as gender.label for gender in genders" required="">
							<option value="" disabled="" hidden>Género</option>
						</select>
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<select class="form-control inputsSteps inputSelect" id="civilStatus" ng-model="leadInfo.civilStatus" ng-options="civilType.value as civilType.label for civilType in civilTypes" required="">
							<option value="" disabled="" hidden>Estado Civil</option>
						</select>
					</div>
				</div>
				<div ng-show="false">
				{{-- <div ng-show="leadInfo.civilStatus == 'CASADO' || leadInfo.civilStatus == 'UNION LIBRE'"> --}}
					<div class="row">
						<div class="col-sm-12 col-md-4 form-group">
							<input type="text" id="spouseName" validation-pattern="name" ng-model="leadInfo.spouseName" class="form-control inputsSteps inputText" placeholder="Nombre Cónyuge" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<input type="number" id="spouseIdentificationNumber" validation-pattern="number" ng-model="leadInfo.spouseIdentificationNumber" class="form-control inputsSteps inputText" placeholder="Número Identificación Cónyuge">
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<input type="text" id="spouseTelephone" validation-pattern="telephone" ng-model="leadInfo.spouseTelephone" class="form-control inputsSteps inputText" placeholder="Número de Teléfono del Cónyuge">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-4 form-group">
							<input type="text" id="spouseJobName" validation-pattern="textAndNumber" ng-model="leadInfo.spouseJobName" class="form-control inputsSteps inputText" placeholder="Trabajo del Cónyuge" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<input type="text" id="spouseProfession" validation-pattern="text" ng-model="leadInfo.spouseProfession" class="form-control inputsSteps inputText" placeholder="Profesión del Cónyuge" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<input type="text" id="spouseJob" validation-pattern="text" ng-model="leadInfo.spouseJob" class="form-control inputsSteps inputText" placeholder="Cargo Actual del Cónyuge" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 form-group">
							<input type="number" id="spouseSalary" validation-pattern="number" ng-model="leadInfo.spouseSalary" class="form-control inputsSteps inputText" placeholder="Salario del Cónyuge" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<input type="text" id="spouseEps" validation-pattern="textOnly" ng-model="leadInfo.spouseEps" class="form-control inputsSteps inputText" placeholder="EPS del Cónyuge" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center">
						<button type="submit" class="btn btn-primary btnStep">Continuar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('scriptsJs')
	<script type="text/javascript" src="{{ asset('js/step2.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
@endsection