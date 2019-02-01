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
	<div id="step2" ng-app="appAdvanceStep2" ng-controller="advanceStep2Ctrl" ng-init="leadInfo.identificationNumber = {{$identificactionNumber}}" ng-cloak>
		<div class="row resetRow container-header-forms">
			<div class="form-container-logoHeader">
				<img src="{{ asset('images/formsLogoOportuya.png') }}" class="img-fluid" alt="Oportuya" />
			</div>
			<div class="col-12 conatiner-logoImg">
				<img ng-src="/@{{ analyst.img }}" class="img-fluid steps-imgAnalista" />
				<span class="steps-textStep"><strong>Solicitud de Avance Paso 2</strong> > (Información Personal)</span>
			</div>
		</div>
		<div class="row resetRow">
			<div class="col-12 step2-containTitle">
				<h2 class="text-center step2-titleAnalista"><strong>Hola! @{{ leadInfo.name + ' ' + leadInfo.lastName }}</strong> soy @{{ analyst.name }} tu analista digital</h2>
				<p class="text-center step2-textAnalista">En este momento te encuentras haciendo tu solicitud de avance crédito, por favor diligencia <br> todos los datos para que tu aprobación sea más fácil</p>
			</div>
			<div class="col-12">
				<div class="step3-containerForm">
					<img src="{{ asset('images/iconoStartProgreso.png') }}" alt="" class="img-fluid imgStartProgress">
					<div class="progreso">
						<div class="barra_vacia" style="width: 33.333333%;"></div>
						<div class="puntos punto_uno listo">
						</div>
						<span></span>
						<label>Cuéntanos sobre ti</label>
						<div class="puntos punto_dos listo">
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
					<img src="{{ asset('images/iconoEndProgreso.png') }}" alt="" class="img-fluid imgEndProgress">
				</div>
			</div>
		</div>
		<div class="step2-containerForm">
			<div class="row resetRow">
				<div class="forms-descStep">
					<strong>Cuéntanos sobre ti</strong><br>
					<span class="forms-descText">Ingresa tus datos personales</span>
					<img src="{{ asset('images/datosPersonales2.png') }}" class="img-fluid forms-descImg" />
					<span class="forms-descStepNum">2</span>
				</div>
			</div>
			<form id="step2Form" ng-submit="saveStep2()">
				{{ csrf_field() }}
				<div class="row resetRow">
					<div class="col-sm-12 col-md-6 form-group">
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
					<div class="col-sm-12 col-md-6 form-group">
						<label for="cityExpedition">Ciudad Expedición Documento* </label>
					    <select class="form-control inputsSteps inputSelect" id="cityExpedition" ng-model="leadInfo.cityExpedition" ng-options="city.label as city.label for city in cities" required></select>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-sm-12 col-md-4 form-group">
						<label for="housingType">Tipo de Vivienda*</label>
						<select class="form-control inputsSteps inputSelect" id="housingType" ng-model="leadInfo.housingType" ng-change="changeHousingType()" ng-options="type.value as type.label for type in housingTypes" required="">
						</select>
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<label for="housingTime">Antigüedad en la Vivienda (Meses)*</label>
						<input type="number" ng-model="leadInfo.housingTime" class="form-control inputsSteps inputText" id="housingTime" validation-pattern="number" required="" />
					</div>
					<div class="col-sm-12 col-md-4 form-group" ng-hide="leadInfo.housingType == 'PROPIA'">
						<label for="housingOwner">Propietario de la Vivienda</label>
						<input type="text" class="form-control inputsSteps inputText" id="housingOwner" validation-pattern="name" ng-model="leadInfo.housingOwner" />
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-sm-12 col-md-6 form-group">
						<label for="addres">Dirección Residencia*</label>
						<input type="text" class="form-control inputsSteps inputText" validation-pattern="text" ng-model="leadInfo.addres" id="addres" required="" />
					</div>
					<div class="col-sm-12 col-md-6 form-group" ng-show="leadInfo.housingType == 'ARRIENDO'">
						<label for="leaseValue">Valor de Arriendo</label>
						<input type="text" class="form-control inputsSteps inputText" ng-currency fraction="0" min="0" ng-model="leadInfo.leaseValue" id="leaseValue" />
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-sm-12 col-md-6 form-group">
						<label for="housingTelephone">Teléfono Residencia</label>
						<input type="text" class="form-control inputsSteps inputText" validation-pattern="telephone" ng-model="leadInfo.housingTelephone" id="housingTelephone" />
					</div>
					<div class="col-sm-12 col-md-6 form-group">
						<label for="stratum">Estrato</label>
						<input type="number" class="form-control inputsSteps inputText" ng-model="leadInfo.stratum" validation-pattern="number" id="stratum" />
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-sm-12 col-md-4">
						<label for="birthdate">Fecha de Nacimiento</label>
						<div class="input-group"
						     moment-picker="leadInfo.birthdate"
						     format="YYYY-MM-DD">
						    <input class="form-control inputsSteps inputText"
						           ng-model="leadInfo.birthdate" id="birthdate" readonly="" placeholder="Año/Mes/Día">
						    <span class="input-group-addon">
						        <i class="octicon octicon-calendar"></i>
						    </span>
						</div>
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<label for="gender">Género*</label>
						<select class="form-control inputsSteps inputSelect" id="gender" ng-model="leadInfo.gender" ng-options="gender.value as gender.label for gender in genders" required="">
						</select>
					</div>
					<div class="col-sm-12 col-md-4 form-group">
						<label for="civilStatus">Estado Civil*</label>
						<select class="form-control inputsSteps inputSelect" id="civilStatus" ng-model="leadInfo.civilStatus" ng-options="civilType.value as civilType.label for civilType in civilTypes" required="">
						</select>
					</div>
				</div>
				<div ng-if="false">
				{{-- <div ng-show="leadInfo.civilStatus == 'CASADO' || leadInfo.civilStatus == 'UNION LIBRE'"> --}}
					<div class="row resetRow">
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseName">Nombre Cónyuge</label>
							<input type="text" id="spouseName" validation-pattern="name" ng-model="leadInfo.spouseName" class="form-control inputsSteps inputText" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseIdentificationNumber">Número Identificación Cónyuge</label>
							<input type="number" id="spouseIdentificationNumber" validation-pattern="number" ng-model="leadInfo.spouseIdentificationNumber" class="form-control inputsSteps inputText">
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseTelephone">Número de Teléfono del Cónyuge</label>
							<input type="text" id="spouseTelephone" validation-pattern="telephone" ng-model="leadInfo.spouseTelephone" class="form-control inputsSteps inputText">
						</div>
					</div>
					<div class="row resetRow">
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseJobName">Trabajo del Cónyuge</label>
							<input type="text" id="spouseJobName" validation-pattern="textAndNumber" ng-model="leadInfo.spouseJobName" class="form-control inputsSteps inputText" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseProfession">Profesión del Cónyuge</label>
							<input type="text" id="spouseProfession" validation-pattern="text" ng-model="leadInfo.spouseProfession" class="form-control inputsSteps inputText" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="spouseJob">Cargo Actual del Cónyuge</label>
							<input type="text" id="spouseJob" validation-pattern="text" ng-model="leadInfo.spouseJob" class="form-control inputsSteps inputText" />
						</div>
					</div>
					<div class="row resetRow">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="spouseSalary">Salario del Cónyuge</label>
							<input type="number" id="spouseSalary" validation-pattern="number" ng-model="leadInfo.spouseSalary" class="form-control inputsSteps inputText" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="spouseEps">EPS del Cónyuge</label>
							<input type="text" id="spouseEps" validation-pattern="textOnly" ng-model="leadInfo.spouseEps" class="form-control inputsSteps inputText" />
						</div>
					</div>
				</div>
				<div class="row resetRow">
					<div class="col-12 text-center">
						<button type="submit" class="btn btn-primary btnStep">Continuar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('scriptsJs')
	<script type="text/javascript" src="{{ asset('js/advanceStep2.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
	<script src="https://rawgit.com/aguirrel/ng-currency/latest/dist/ng-currency.js"></script>
@endsection