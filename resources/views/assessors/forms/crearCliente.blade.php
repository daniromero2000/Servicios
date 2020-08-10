@extends('layouts.admin.app')

@section('metaTags')
<meta name="googlebot" content="noindex">
<meta name="robots" content="noindex">
@endsection()

@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/assessor/forms/ventaContado.css') }}">
<link rel="stylesheet" href="{{ asset('css/assessor/forms/creacionCliente.css') }}">
<link rel="stylesheet"
    href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection

@section('content')
<div class="container" ng-app="asessorVentaContadoApp" ng-controller="asessorVentaContadoCtrl" ng-cloak>
    <div class="row">
        <div class="col-12 text-center">
            <p class="ventaContado-text">
                <i>* Recuerde que el correcto diligenciamiento de este formulario agilizará el proceso de facturación de
                    la cajera con Apoteosys.</i>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 offset-sm-3">
            <label class="ventaContado-label" for="tipoCliente">Tipo de Cliente*</label>
            <select class="form-control" id="tipoCliente" ng-model="tipoCliente" ng-change="resetInfoLead()">
                <option value="CREDITO">Crédito</option>
                <option value="CONTADO">Contado</option>
            </select>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12 content-top">
                </div>
            </div>
            <div ng-show="tipoCliente == 'CREDITO'">
                <form ng-submit="validateStep1()" name="clienteCredito" id="addCustomerStep1" ng-show="step == 1"
                    class="crearCliente-form">
                    <div class="row container-form">
                        <div class="col-12 type-client">
                            <div class="forms-descStep forms-descStep-avances">
                                <strong>Información principal</strong><br>
                                <span class="forms-descText">Ingresa los datos principales para hacer el análisis</span>
                                <img src="{{ asset('images/datosPersonales.png') }}" class="img-fluid forms-descImg">
                                <span class="forms-descStepNum">1</span>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="labels" for="tipodoc">Tipo de documento*</label>
                                    <select class="inputs form-control select2bs4" ng-model="lead.TIPO_DOC" id="tipodoc"
                                        ng-options="type.value as type.label for type in typesDocuments"></select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="labels" for="CEDULA">Número de documento*</label>
                                    <input class="inputs" validation-pattern="IdentificationNumber"
                                        ng-blur="getValidationLead()" type="text" ng-model="lead.CEDULA" id="CEDULA"
                                        required />
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="labels" for="FEC_EXP">Fecha expedición documento*</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" validation-pattern="date"
                                            data-inputmask-alias="datetime" ng-model="lead.FEC_EXP" id="FEC_EXP"
                                            data-inputmask-inputformat="yyyy-mm-dd" required data-mask>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="labels" for="FEC_NAC">Fecha de nacimiento*</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" validation-pattern="date"
                                            data-inputmask-alias="datetime" ng-model="lead.FEC_NAC" id="FEC_NAC"
                                            data-inputmask-inputformat="yyyy-mm-dd" required data-mask>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="labels" for="nombres">Nombres*</label>
                                    <input class="inputs" id="nombres" validation-pattern="name" ng-model="lead.NOMBRES"
                                        type="text" required />
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="labels" for="lastName">Apellidos*</label>
                                    <input class="inputs" id="lastName" validation-pattern="name" type="text"
                                        ng-model="lead.APELLIDOS" required />
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="labels" for="email">Correo electrónico</label>
                                    <input class="inputs" id="email" type="text" validation-pattern="email"
                                        ng-model="lead.EMAIL" />
                                </div>
                                <div class="col-12 col-md-3">
                                    <div ng-hide="lead.CEL_VAL">
                                        <label class="ventaContado-label">Celular*</label>
                                        <input class="inputs" ng-blur="checkIfExistNum()" ng-model="lead.CELULAR"
                                            validation-pattern="telephone" required />
                                        <div class="alert alert-danger" role="alert" ng-show="showAlertCel"
                                            style="margin-top: 10px;">
                                            Debe digitar un número de celular
                                        </div>
                                    </div>
                                    <div ng-show="lead.CEL_VAL">
                                        <label class="ventaContado-label">Celular*</label>
                                        <input class="inputs" ng-model="CELULAR" readonly ng-disabled="true" />
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-4">
                                    <label class="ventaContado-label" for="ciud_ubi">Ciudad de sucursal*</label>
                                    <select class="inputs form-control select2bs4" ng-model="lead.CIUD_UBI"
                                        id="ciud_ubi" ng-options="city.value as city.label for city in citiesUbi"
                                        ng-required="true"></select>
                                    <div class="alert alert-danger" role="alert" ng-show="showAlertCiudUbi"
                                        style="margin-top: 10px;">
                                        Debe seleccionar una ciudad
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="ventaContado-label labels" for="actividad">Ocupación*</label>
                                    <select class="inputs form-control select2bs4" ng-model="lead.ACTIVIDAD"
                                        id="actividad"
                                        ng-options="actividad.value as actividad.label for actividad in occupations"></select>
                                </div>
                                <div class="col-12 col-md-4"
                                    ng-show="lead.ACTIVIDAD == 'EMPLEADO' || lead.ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA' || lead.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'">
                                    <label class="ventaContado-label labels" for="FEC_ING">Fecha de ingreso*</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask-alias="datetime"
                                            ng-model="lead.FEC_ING" id="FEC_ING" data-inputmask-inputformat="yyyy-mm"
                                            data-mask>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4" ng-show="lead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO'">
                                    <label class="ventaContado-label labels" for="FEC_CONST">¿Desde qué año desempeña la
                                        actividad?</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask-alias="datetime"
                                            ng-model="lead.FEC_CONST" id="FEC_CONST"
                                            data-inputmask-inputformat="yyyy-mm" data-mask>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4"
                                    ng-show="lead.ACTIVIDAD == 'NO CERTIFICADO' || lead.ACTIVIDAD == 'RENTISTA'">
                                    <label class="ventaContado-label labels" for="dateCreationCompany">¿Desde qué año
                                        desempeña la actividad?</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask-alias="datetime"
                                            ng-model="lead.FEC_CONST" id="dateCreationCompany"
                                            data-inputmask-inputformat="yyyy-mm" data-mask>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4" ng-show="lead.ACTIVIDAD == 'PENSIONADO'">
                                    <label for="FEC_CONSTpensionado" class="ventaContado-label labels">Fecha de
                                        pensión*</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask-alias="datetime"
                                            ng-model="lead.FEC_CONST" id="FEC_CONSTpensionado"
                                            data-inputmask-inputformat="yyyy-mm" data-mask>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary"
                                ng-disabled="disabledButton">Continuar</button>
                        </div>
                        <div class="col-12 text-center mt-2">
                            <p class="ventaContado-text">
                                <i><a href="/change-customer-data" class="ventaContado-changeDataCustomer"
                                        target="_blank">Click aquí</a> si desea actualizar los datos del cliente</i>
                            </p>
                        </div>
                    </div>
                </form>
                <form ng-submit="validateStep2()" name="clienteCreditoPaso2" ng-show="step == 2"
                    class="crearCliente-form">
                    <div class="row container-form">
                        <div class="col-12 type-client">
                            <div class="forms-descStep forms-descStep-avances">
                                <strong>Información básica</strong><br>
                                <span class="forms-descText">Ingresa los datos personales</span>
                                <img src="{{ asset('images/datosPersonales.png') }}" class="img-fluid forms-descImg">
                                <span class="forms-descStepNum">2</span>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="labels" for="tipodoc">Tipo de documento*</label>
                                    <select ng-disabled="true" class="inputs form-control" ng-model="lead.TIPO_DOC"
                                        id="tipodoc"
                                        ng-options="type.value as type.label for type in typesDocuments"></select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="labels" for="CEDULA">Número de documento*</label>
                                    <input readonly class="inputs" validation-pattern="IdentificationNumber"
                                        ng-blur="getValidationLead()" type="text" ng-model="lead.CEDULA" id="CEDULA"
                                        required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="labels" for="FEC_EXP">Fecha expedición documento*</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask-alias="datetime"
                                            ng-model="lead.FEC_EXP" id="FEC_EXP" ng-disabled="true" required
                                            data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="CIUD_EXP" class="labels">Ciudad de expedición</label>
                                    <select class="form-control inputs select2bs4" ng-model="lead.CIUD_EXP"
                                        id="CIUD_EXP" ng-options="city.value as city.label for city in cities"
                                        required></select>
                                    <div class="alert alert-danger" role="alert" ng-show="showAlertCiudExp"
                                        style="margin-top: 10px;">
                                        Debe seleccionar una ciudad
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label for="nombres2" class="labels">Nombres*</label>
                                    <input type="text" id="nombres2" ng-model="lead.NOMBRES" class="form-control inputs"
                                        required="" />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label for="apellidos2" class="labels">Apellidos*</label>
                                    <input type="text" id="apellidos2" ng-model="lead.APELLIDOS"
                                        class="form-control inputs" required="" />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label for="sexo" class="labels">Género</label>
                                    <select class="form-control inputs select2bs4" ng-model="lead.SEXO" id="sexo"
                                        ng-options="gender.value as gender.label for gender in genders"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="labels" for="FEC_NAC">Fecha de nacimiento*</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" ng-disabled="true" class="form-control"
                                            validation-pattern="date" data-inputmask-alias="datetime"
                                            ng-model="lead.FEC_NAC" id="FEC_NAC" required
                                            data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="CIUD_NAC" class="labels">Ciudad de nacimiento</label>
                                    <select class="form-control inputs select2bs4" ng-model="lead.CIUD_NAC"
                                        id="CIUD_NAC" ng-options="city.label as city.label for city in cities"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label for="ESTUDIOS" class="labels">Nivel de estudios</label>
                                    <select id="ESTUDIOS" class="inputs form-control select2bs4"
                                        ng-model="lead.ESTUDIOS"
                                        ng-options="scolarity.value as scolarity.label for scolarity in scolarities"></select>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <label for="PROFESION" class="labels">Profesión</label>
                                    <select id="PROFESION" class="inputs form-control select2bs4"
                                        ng-model="lead.PROFESION"
                                        ng-options="profession.NOMBRE as profession.NOMBRE for profession in professions"></select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label for="PERSONAS" class="labels">Personas a cargo</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.PERSONAS"
                                        id="personas" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label for="" class="labels">Posee vehículo</label>
                                    <select ng-model="lead.POSEEVEH" class="form-control inputs select2bs4"
                                        id="POSEEVEH">
                                        <option value="S">Si</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6" ng-show="lead.POSEEVEH == 'S'">
                                    <label for="PLACA" class="labels">Placa</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.PLACA" id="PLACA" />
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-sm-12">
                                    <label for="ESTADOCIVIL" class="labels">Estado civil</label>
                                    <select class="inputs form-control select2bs4" ng-model="lead.ESTADOCIVIL"
                                        id="ESTADOCIVIL"
                                        ng-options="civilType.value as civilType.label for civilType in civilTypes">
                                    </select>
                                </div>
                            </div>
                            <div ng-show="lead.ESTADOCIVIL == 'CASADO' || lead.ESTADOCIVIL == 'UNION LIBRE'">
                                <div class="col-12">
                                    <h6 class="ventaContado-subTitle">Datos del cónyuge</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <label for="CEDULA_C" class="labels">Número de cédula del cónyuge</label>
                                        <input type="text" class="inputs form-control" ng-model="lead.CEDULA_C"
                                            id="CEDULA_C" />
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label for="NOMBRE_CONYU" class="labels">Nombre del cónyuge</label>
                                        <input type="text" class="inputs form-control" ng-model="lead.NOMBRE_CONYU"
                                            id="NOMBRE_CONYU" />
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label for="CELULAR_CONYU" class="labels">Celular del cónyuge</label>
                                        <input type="text" class="inputs form-control" ng-model="lead.CELULAR_CONYU"
                                            id="CELULAR_CONYU" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <label for="TRABAJO_CONYU" class="labels">¿Trabaja en?</label>
                                        <input type="text" class="inputs form-control" ng-model="lead.TRABAJO_CONYU"
                                            id="TRABAJO_CONYU" />
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label for="PROFESION_CONYU" class="labels">Profesión u ocupación del
                                            cónyuge</label>
                                        <input type="text" class="inputs form-control" ng-model="lead.PROFESION_CONYU"
                                            id="PROFESION_CONYU" />
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label for="CARGO_CONYU" class="labels">Cargo actual del cónyuge</label>
                                        <input type="text" class="inputs form-control" ng-model="lead.CARGO_CONYU"
                                            id="CARGO_CONYU" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-sm-6">
                                        <label for="SALARIO_CONYU" class="labels">Ingresos del cónyuge</label>
                                        <input type="text" class="inputs form-control" ng-model="lead.SALARIO_CONYU"
                                            id="SALARIO_CONYU" />
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label for="EPS_CONYU" class="labels">Eps del cónyuge</label>
                                        <input type="text" class="inputs form-control" ng-model="lead.EPS_CONYU"
                                            id="EPS_CONYU" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary" ng-disabled="disabledButtonStep2"
                                        type="submit">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form ng-submit="addCliente('CREDITO')" ng-show="step == 3" class="crearCliente-form">
                    <div class="row container-form">
                        <div class="col-12 type-client">
                            <div class="forms-descStep forms-descStep-avances">
                                <strong>Información básica</strong><br>
                                <span class="forms-descText">Ingresa los datos de ubicación</span>
                                <img src="{{ asset('images/datosPersonales.png') }}" class="img-fluid forms-descImg">
                                <span class="forms-descStepNum">3</span>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="ventaContado-label" for="ciud_ubi2">Ciudad de sucursal*</label>
                                    <select ng-disabled="true" class="inputs form-control" ng-model="lead.CIUD_UBI"
                                        id="ciud_ubi2"
                                        ng-options="city.value as city.label for city in citiesUbi"></select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="TIPOV" class="labels">Tipo de vivienda</label>
                                    <select class="inputs form-control select2bs4" ng-model="lead.TIPOV" id="TIPOV"
                                        ng-options="housingType.value as housingType.label for housingType in housingTypes"></select>
                                </div>
                            </div>
                            <div class="row" ng-show="lead.TIPOV == 'ARRIENDO'">
                                <div class="col-12 col-sm-4">
                                    <label for="PROPIETARIO" class="labels">Propietario de la vivienda</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.PROPIETARIO"
                                        id="PROPIETARIO" />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label for="TEL_PROP" class="labels">Teléfono del propietario</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.TEL_PROP"
                                        id="TEL_PROP" />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label for="VRARRIENDO" class="labels">Valor del arriendo ($)</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.VRARRIENDO"
                                        id="VRARRIENDO" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label for="DIRECCION" class="labels">Dirección</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.DIRECCION"
                                        id="DIRECCION" />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="ESTRATO" class="labels">Estrato</label>
                                    <select class="form-control inputs select2bs4" ng-model="lead.ESTRATO" id="ESTRATO"
                                        ng-options="strat.value as strat.label for strat in stratum"></select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-sm-4">
                                    <label for="TELFIJO" class="labels">Teléfono fijo</label>
                                    <input type="text" class="form-control inputs" ng-model="lead.TELFIJO"
                                        id="TELFIJO" />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div ng-hide="lead.CEL_VAL">
                                        <label class="ventaContado-label">Celular</label>
                                        <input class="inputs" ng-blur="checkIfExistNum()" ng-model="lead.CELULAR"
                                            validation-pattern="telephone" required />
                                    </div>
                                    <div ng-show="lead.CEL_VAL">
                                        <label class="ventaContado-label">Celular</label>
                                        <input class="inputs" ng-model="CELULAR" readonly ng-disabled="true" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label for="EMAIL" class="labels">Correo electrónico</label>
                                    <input type="text" class="form-control inputs" ng-model="lead.EMAIL" id="EMAIL" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-secondary" ng-click="step=step-1"><i
                                            class="fas fa-arrow-circle-left arrowReturnBack"></i> Regresar</button>
                                    <button class="btn btn-primary" type="submit">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form ng-submit="validateStep4()" ng-show="step == 4" class="crearCliente-form">
                    <div class="row container-form">
                        <div class="col-12 type-client">
                            <div class="forms-descStep forms-descStep-avances">
                                <strong>Información básica</strong><br>
                                <span class="forms-descText">Ingresa la información financiera</span>
                                <img src="{{ asset('images/datosPersonales.png') }}" class="img-fluid forms-descImg">
                                <span class="forms-descStepNum">4</span>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="ventaContado-label labels" for="actividad">Ocupación</label>
                                    <select ng-disabled="true" class="inputs form-control" ng-model="lead.ACTIVIDAD"
                                        id="actividad"
                                        ng-options="actividad.value as actividad.label for actividad in occupations"></select>
                                </div>
                            </div>
                            <div
                                ng-if="lead.ACTIVIDAD == 'EMPLEADO' || lead.ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA' || lead.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="labels" for="empresaNombre">Nombre de la empresa*</label>
                                        <input class="inputs" type="text" id="empresaNombre" ng-model="lead.RAZON_SOC"
                                            required />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="labels" for="dirEmpresa">Dirección de la empresa*</label>
                                        <input class="inputs" type="text" id="dirEmpresa" ng-model="lead.DIR_EMP"
                                            required />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="labels" for="telEmpresa">Teléfono de la empresa*</label>
                                        <input class="inputs" id="telEmpresa" type="text" ng-model="lead.TEL_EMP"
                                            required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="labels" for="eps">E.P.S*</label>
                                        <input class="inputs" id="eps" type="text" ng-model="lead.ACT_ECO" required />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="labels" for="cargo">Cargo*</label>
                                        <input class="inputs" id="cargo" type="text" ng-model="lead.CARGO" required />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="labels" for="FEC_ING">Fecha de ingreso*</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                ng-model="lead.FEC_ING" id="FEC_ING" ng-disabled="true"
                                                data-inputmask-inputformat="yyyy-mm" data-mask>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label class="ventaContado-label labels" for="tipoCont">Tipo de
                                            contrato*</label>
                                        <select class="inputs form-control select2bs4" ng-model="lead.TIPO_CONT"
                                            id="tipoCont"
                                            ng-options="typeContract.value as typeContract.label for typeContract in typesContracts"></select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="labels" for="salario">Salario*</label>
                                        <input class="inputs" id="salario" ng-currency fraction="0" type="text"
                                            ng-model="lead.SUELDO" required />
                                        <div class="alert alert-danger" role="alert" ng-show="showAlertSalary"
                                            style="margin-top: 10px;">
                                            El salario no puede ser menor a $100.000
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                ng-if="lead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || lead.ACTIVIDAD == 'NO CERTIFICADO' || lead.ACTIVIDAD == 'RENTISTA'">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="ventaContado-label" for="CAMARAC">Cámara de comercio</label>
                                        <select class="form-control select2bs4 inputs" ng-model="lead.CAMARAC"
                                            id="CAMARAC">
                                            <option value="SI">Si</option>
                                            <option value="NO">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label class="ventaContado-label" for="RAZON_IND">Nombre de la empresa *</label>
                                        <input class="form-control inputs" type="text" id="RAZON_IND"
                                            ng-model="lead.RAZON_IND" required />
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label class="ventaContado-label" for="ACT_IND">Qué vendes o comercializas?
                                            *</label>
                                        <input class="form-control inputs" type="text" id="ACT_IND"
                                            ng-model="lead.ACT_IND" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <label class="ventaContado-label" for="ACT_ECO">EPS*</label>
                                        <input class="form-control inputs" type="text" id="ACT_ECO"
                                            ng-model="lead.ACT_ECO" required />
                                    </div>
                                    <div class="col-sm-12 col-md-4"
                                        ng-show="lead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO'">
                                        <label class="ventaContado-label" for="FEC_CONST">¿Desde qué año desempeña la
                                            actividad?*</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                ng-model="lead.FEC_CONST" id="FEC_CONST" ng-disabled="true" required
                                                data-inputmask-inputformat="yyyy-mm" data-mask>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4"
                                        ng-show="lead.ACTIVIDAD == 'NO CERTIFICADO' || lead.ACTIVIDAD == 'RENTISTA'">
                                        <label for="dateCreationCompany">¿Desde qué año desempeña la actividad?</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                ng-model="lead.FEC_CONST" id="FEC_CONST" ng-disabled="true" required
                                                data-inputmask-inputformat="yyyy-mm" data-mask>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label class="ventaContado-label">Salario*</label>
                                        <input class="form-control inputs" type="text" ng-model="lead.SUELDOIND"
                                            ng-currency fraction="0" required />
                                        <div class="alert alert-danger" role="alert" ng-show="showAlertSalary"
                                            style="margin-top: 10px;">
                                            El salario no puede ser menor a $100.000
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div ng-if="lead.ACTIVIDAD == 'PENSIONADO'">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <label class="ventaContado-label" for="RAZON_SOC">Nombre de la empresa*</label>
                                        <input class="form-control inputs" type="text" ng-model="lead.RAZON_SOC"
                                            id="RAZON_SOC" required />
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label class="ventaContado-label">Fecha de Pensión*</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                ng-model="lead.FEC_CONST" id="FEC_CONST" ng-disabled="true" required
                                                data-inputmask-inputformat="yyyy-mm" data-mask>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <label class="ventaContado-label" for="SUELDOIND">Salario*</label>
                                        <input class="form-control inputs" type="text" ng-model="lead.SUELDOIND"
                                            id="SUELDOIND" ng-currency fraction="0" required />
                                        <div class="alert alert-danger" role="alert" ng-show="showAlertSalary"
                                            style="margin-top: 10px;">
                                            El salario no puede ser menor a $100.000
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label class="ventaContado-label" for="ACT_ECO">EPS*</label>
                                        <input class="form-control inputs" type="text" id="ACT_ECO"
                                            ng-model="lead.ACT_ECO" required />
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label class="ventaContado-label" for="BANCOP">Banco*</label>
                                        <select class="form-control inputs select2bs4" ng-model="lead.BANCOP"
                                            id="BANCOP" ng-options="bank.value as bank.label for bank in banks"
                                            required></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-secondary" ng-click="step=step-1"><i
                                            class="fas fa-arrow-circle-left arrowReturnBack"></i> Regresar</button>
                                    <button class="btn btn-primary" type="submit">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form ng-submit="addSolic()" ng-show="step == 5" class="crearCliente-form">
                    <div class="row container-form">
                        <div class="col-12 type-client">
                            <div class="forms-descStep forms-descStep-avances">
                                <strong>Información básica</strong><br>
                                <span class="forms-descText">Ingresa las referencias</span>
                                <img src="{{ asset('images/datosPersonales.png') }}" class="img-fluid forms-descImg">
                                <span class="forms-descStepNum">5</span>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="ventaContado-subTitle">Referencias personales</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">1. Referencia personal</h5>
                                            <br>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <label for="NOM_REFPER" class="labels">Nombre*</label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.NOM_REFPER" id="NOM_REFPER" required />
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <label for="DIR_REFPER" class="labels">Dirección </label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.DIR_REFPER" id="DIR_REFPER" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="TEL_REFPER" class="labels">Teléfono*</label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.TEL_REFPER" id="TEL_REFPER" required />
                                                </div>
                                            </div>
                                            <h5 class="card-title">2. Referencia personal</h5>
                                            <br>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <label for="NOM_REFPE2" class="labels">Nombre*</label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.NOM_REFPE2" id="NOM_REFPE2" required />
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <label for="DIR_REFPE2" class="labels">Dirección</label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.DIR_REFPE2" id="DIR_REFPE2" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="TEL_REFPE2" class="labels">Teléfono*</label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.TEL_REFPE2" id="TEL_REFPE2" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="ventaContado-subTitle">Referencias familiares</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">1. Referencia familiar</h5>
                                            <br>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <label for="NOM_REFFAM" class="labels">Nombre*</label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.NOM_REFFAM" id="NOM_REFFAM" required />
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <label for="DIR_REFFAM" class="labels">Dirección</label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.DIR_REFFAM" id="DIR_REFFAM" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <label for="TEL_REFFAM" class="labels">Teléfono*</label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.TEL_REFFAM" id="TEL_REFFAM" required />
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <label for="PARENTESCO" class="labels">Parentesco*</label>
                                                    <select id="PARENTESCO" class="inputs form-control"
                                                        ng-model="lead.PARENTESCO"
                                                        ng-options="kinship.TIPO as kinship.TIPO for kinship in kinships"
                                                        required></select>
                                                </div>
                                            </div>
                                            <h5 class="card-title">2. Referencia familiar</h5>
                                            <br>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <label for="NOM_REFFA2" class="labels">Nombre*</label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.NOM_REFFA2" id="NOM_REFFA2" required />
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <label for="DIR_REFFA2" class="labels">Dirección</label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.DIR_REFFA2" id="DIR_REFFA2" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <label for="TEL_REFFA2" class="labels">Teléfono*</label>
                                                    <input type="text" class="inputs form-control"
                                                        ng-model="lead.TEL_REFFA2" id="TEL_REFFA2" required />
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <label for="PARENTESC2" class="labels">Parentesco*</label>
                                                    <select id="PARENTESC2" class="inputs form-control"
                                                        ng-model="lead.PARENTESC2"
                                                        ng-options="kinship.TIPO as kinship.TIPO for kinship in kinships"
                                                        required></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-secondary" ng-click="step=step-1"><i
                                            class="fas fa-arrow-circle-left arrowReturnBack"></i> Regresar</button>
                                    <button class="btn btn-primary" ng-disabled="disabledButtonSolic"
                                        type="submit">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <form name="clienteContado" ng-submit="validateVentaContado()" ng-show="tipoCliente == 'CONTADO'"
                class="crearCliente-form">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 type-client">
                        <div class="forms-descStep forms-descStep-avances">
                            <strong>Información básica</strong><br>
                            <span class="forms-descText">Ingresa tus datos personales</span>
                            <img src="{{ asset('images/datosPersonales.png') }}" class="img-fluid forms-descImg">
                            <span class="forms-descStepNum">1</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label class="labels" for="tipodoc">Tipo de documento*</label>
                        <select class="inputs select2bs4" ng-model="lead.TIPO_DOC" id="tipodoc"
                            ng-options="type.value as type.label for type in typesDocuments"></select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="labels" for="identificationNumberContado">Número de documento*</label>
                        <input class="inputs" ng-model="lead.CEDULA" ng-blur="getValidationLead()" type="text"
                            validation-pattern="identificationNumber" id="identificationNumberContado" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label class="labels" for="nombresContado">Nombres*</label>
                        <input class="inputs" ng-model="lead.NOMBRES" validation-pattern="name" type="text"
                            id="nombresContado" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="labels" for="apellidosContado">Apellidos*</label>
                        <input class="inputs" ng-model="lead.APELLIDOS" type="text" validation-pattern="name"
                            id="apellidosContado" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="labels" for="emailContado">Correo electrónico*</label>
                        <input class="inputs" ng-model="lead.EMAIL" type="text" id="emailContado"
                            validation-pattern="email" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label class="ventaContado-label labels" for="telContado">Teléfono fijo*</label>
                        <input ng-model="lead.TELFIJO" class="inputs" type="text" id="telContado" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="ventaContado-label labels" for="celularCotado">Celular*</label>
                        <input class="inputs" ng-model="lead.CELULAR" type="text" id="celularCotado"
                            validation-pattern="telephone" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="ventaContado-label labels" for="genero">Género</label>
                        <select class="inputs select2bs4" ng-model="lead.SEXO" id="genero"
                            ng-options="gender.label as gender.value for gender in genders"></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label class="ventaContado-label labels">Dirección de residencia*</label>
                        <input class="inputs" ng-model="lead.DIRECCION" type="text" />
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="ventaContado-label" for="ciud_ubiContado">Ciudad de sucursal*</label>
                        <select class="inputs form-control select2bs4" ng-model="lead.CIUD_UBI" id="ciud_ubiContado"
                            ng-options="city.value as city.label for city in citiesUbi"></select>
                        <div class="alert alert-danger" role="alert" ng-show="showAlertCiudUbiContado"
                            style="margin-top: 10px;">
                            Debe seleccionar una ciudad
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label class="ventaContado-label labels" for="nom1">Nombre de autorizado 1</label>
                        <input class="inputs" type="text" id="nom1" ng-model="lead.VCON_NOM1" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="ventaContado-label labels" for="ced1">Cédula de autorizado 1</label>
                        <input class="inputs" type="text" id="ced1" ng-model="lead.VCON_CED1" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="ventaContado-label labels" for="tel1">Teléfono de autorizado 1</label>
                        <input class="inputs" type="text" id="tel1" ng-model="lead.VCON_TEL1" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label class="ventaContado-label labels" for="nom2">Nombre de autorizado 2</label>
                        <input class="inputs" type="text" id="nom2" ng-model="lead.VCON_NOM2" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="ventaContado-label labels" for="ced2">Cédula de autorizado 2</label>
                        <input class="inputs" type="text" id="ced2" ng-model="lead.VCON_CED2" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="ventaContado-label labels" for="tel2">Teléfono de autorizado 2</label>
                        <input class="inputs" type="text" id="tel2" ng-model="lead.VCON_TEL2" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <label class="ventaContado-label labels" for="dir">Dirección de entrega</label>
                        <input class="inputs" type="text" id="dir" ng-model="lead.VCON_DIR" />
                    </div>
                </div>
                <div class="row  text-center form-group">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade modalThankYouPage-asessors" id="showWarningErrorData" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modalCode">
            <div class="modal-content">
                <div class="modal-body" style="padding: 0">
                    <div class="row resetRow">
                        <div class="col-12 text-center resetCol headThankYuoModal">
                            <img src="{{ asset('images/asessors/logoModal.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="row resetRow ">
                        <div class="col-12 form-group">
                            <h2 class="decisionCredit-title text-center" style="color: #dc3545;">Información errónea
                            </h2>
                            <p class="textModal text-center">
                                Por favor verifica la información suministrada
                            </p>
                        </div>
                    </div>
                    <div class="row resetRow form-group">
                        <div class="col-12 form-group text-center">
                            <button class="btn btn-danger" ng-click="close()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade hide modalThankYouPage-asessors" data-backdrop="static" data-keyboard="false"
        id="decisionCredit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modalCode">
            <div class="modal-content">
                <div class="modal-body" style="padding: 0">
                    <div class="row resetRow">
                        <div class="col-12 text-center resetCol headThankYuoModal">
                            <img src="{{ asset('images/asessors/logoModal.png') }}" alt="" class="img-fluid">
                        </div>
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                        <div class="col-12" ng-if="resp.resp == 'true'">
                            <h2 class="decisionCredit-title text-center">Selecciona una opción</h2>
                            <div class="row my-4">
                                <div class="col-12 col-sm-6 text-center my-4">
                                    <div class="decisionCredit-option"
                                        ng-class="{'decisionCredit-selected': decisionCredit == 1}"
                                        ng-click="changeDesicionCredit(1)">
                                        <p>@{{ resp.infoLead.TARJETA }}</p>
                                        <i class="fas fa-credit-card decisionCredit-option-icon"></i>
                                        <p class="mb-0">
                                            Cupo Compras : $ @{{ resp.quotaApprovedProduct | number:0 }} <br>
                                            Cupo Avance : $ @{{ resp.quotaApprovedAdvance | number:0 }}
                                        </p>
                                        <p class="decisionCredit-textOption">
                                            <button type="button" class="btn btn-default">Click aquí</button>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-center my-4">
                                    <div class="decisionCredit-option"
                                        ng-class="{'decisionCredit-selected': decisionCredit == 2}"
                                        ng-click="changeDesicionCredit(2)">
                                        <p>Crédito Tradicional</p>
                                        <i class="fas fa-money-bill-wave decisionCredit-option-icon"></i>
                                        <p class="mb-0" style="font-style:italic; margin-top: 11px">
                                            * Aprobado sin codeudor
                                        </p>
                                        <p class="decisionCredit-textOption">
                                            <button type="button" class="btn btn-default">Click aquí</button>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary" ng-click="sendDecisionCredit()"
                                        ng-disabled="decisionCredit == '' || disabledDecisionCredit">Continuar</button>
                                    <button class="btn btn-danger" ng-click="desistCredit()"
                                        ng-disabled="disabledDecisionCredit">Desistir</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" ng-if="resp.resp == '-2'">
                            <h2 class="decisionCredit-title text-center">Selecciona una opciòn</h2>
                            <div class="row my-4">
                                <div class="col-12 text-center my-4">
                                    <div class="decisionCredit-option"
                                        ng-class="{'decisionCredit-selected': decisionCredit == 2}"
                                        ng-click="changeDesicionCredit(2)">
                                        <p>Crédito Tradicional</p>
                                        <i class="fas fa-money-bill-wave decisionCredit-option-icon"></i>
                                        <p class="mb-0">
                                            Preaprobado <br>
                                            * <span
                                                style="font-style:italic; font-size:13px">@{{ resp.infoLead.DESCRIPCION }}</span>
                                        </p>
                                        <p class="decisionCredit-textOption">
                                            <button type="button" class="btn btn-default">Click aquí</button>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary" ng-click="sendDecisionCredit()"
                                        ng-disabled="decisionCredit == '' || disabledDecisionCredit">Continuar</button>
                                    <button class="btn btn-danger" ng-click="desistCredit()"
                                        ng-disabled="disabledDecisionCredit">Desistir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade hide" data-backdrop="static" data-keyboard="false" id="confirmCodeVerification" tabindex="-1"
        role="dialog" aria-hidden="true">
        <div class="modal-dialog modalCode">
            <div class="modal-content">
                <div class="modal-body" style="padding: 10px">
                    <form ng-submit="verificationCode()">
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="">Código de Verificacion</label>
                                <input type="text" ng-model="code.code" class="form-control" required />
                            </div>
                            <div class="col-12 text-center form-group">
                                <button class="btn btn-primary" ng-disabled="disabledButtonCode">Confirmar
                                    Código</button>
                                <button type="button" ng-show="reNewToken" class="btn btn-warning"
                                    ng-click="getCodeVerification(true)">Generar Nuevo Código</button>
                            </div>
                            <div class="col-12 text-center" ng-show="showAlertCode">
                                <div class="alert alert-danger" role="alert">
                                    Código erróneo, por favor verifícalo
                                </div>
                            </div>
                            <div class="col-12 text-center" ng-show="showWarningCode">
                                <div class="alert alert-warning" role="alert">
                                    El código ya expiró, <span class="renewCode"
                                        ng-click="getCodeVerification(true)">clic aquí</span> para generar un nuevo
                                    código
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modalCardExist fade hide" data-backdrop="static" data-keyboard="false" id="validationLead"
        tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modalCardContent">
                <div class="modal-body modalStepsBody " style="padding: 0">
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
                                <div class="offset-4 offset-sm-4 col-sm-8 mt-5 offset-ld-1 col-8 text-center">
                                    <p ng-bind-html="messageValidationLead">
                                    </p>
                                    <div class="text-center">
                                        <a class="btn btn-danger buttonBackCardExist"
                                            href="/Administrator/crearCliente">Regresar</a>
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

    <div class="modal fade hide" data-backdrop="static" data-keyboard="false" id="confronta" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modalConfronta">
            <div class="modal-content">
                <div class="modal-body" style="padding: 0 30px">
                    <h2 class="text-center confronta-title">Preguntas de Seguridad</h2>
                    <form ng-submit="sendConfronta()">
                        <div class="col-12 form-group" ng-repeat="pregunta in formConfronta">
                            <p>@{{ pregunta.pregunta }}</p>
                            <div ng-repeat="opcion in pregunta.opciones">
                                <input type="radio" name="@{{ pregunta.secuencia }}" ng-model="pregunta.opcion"
                                    class="form-group" id="@{{ opcion.secuencia_resp }}"
                                    ng-value="opcion.secuencia_resp"><label class="confronta-label"
                                    for="@{{ opcion.secuencia_resp }}">@{{ opcion.opcion }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog" id="error"
        data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body " style="padding: 0">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div>
                                <img src="{{ asset('images/error.gif')}}" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="error-content p-3">
                                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! El aplicativo a
                                    presentado un
                                    error.</h3>
                                <div>
                                    <p style="margin: 0px;">
                                        Puedes comunicate con el area de desarrollo y darle este número de error<strong
                                            style="font-size:20px; color: #1b8acc">@{{ numError }}</strong>.
                                    </p>
                                    <p class="text-right m-0">
                                        <a href="/Administrator/crearCliente"
                                            class="btn  btn-primary btn-sm">Regresar</a>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modalThankYouPage-asessors hide" data-backdrop="static" data-keyboard="false"
        id="congratulations" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body " style="padding: 0">
                    <div class="row resetRow">
                        <div class="col-12 text-center resetCol headThankYuoModal">
                            <img src="{{ asset('images/asessors/logoModal.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="row resetRow">
                        <div class="col-12 text-center" ng-if="estadoCliente == 'CONTADO'">
                            <p class="textTnakYouModal" style="font-size: 22px; margin-top:25px">
                                Cliente creado exitosamente.
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'TRADICIONAL'">
                            <img src="{{ asset('images/asessors/tarjetaIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                Solictud <strong style="font-size:18px">@{{ numSolic }}</strong> creada
                                exitosamente,
                                <br>
                                procede a ingresar los datos del negocio.
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'APROBADO'">
                            <img src="{{ asset('images/asessors/openIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                <b>¡FELICIDADES!</b> <br>
                                <b>Solicitud aprobada</b> para tarjeta
                            </p>
                            <p class="textModalNumSolic text-center">
                                El número de solicitud es <strong
                                    style="font-size:16px; color: #1b8acc">@{{ numSolic }}</strong>
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'PREAPROBADO'">
                            <img src="{{ asset('images/asessors/revisandoIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                <b>La solicitud</b> está siendo revisada <br>
                                por el área de fábrica de créditos.
                            </p>
                            <p class="textModalNumSolic text-center">
                                El número de solicitud es <strong
                                    style="font-size:16px; color: #1b8acc">@{{ numSolic }}</strong>
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal"
                            ng-if="estadoCliente == 'SIN COMERCIAL'">
                            <img src="{{ asset('images/asessors/revisandoIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                <b>El aplicativo, está presentado un error, <br /> por favor inténtalo de nuevo más
                                    tarde</b>
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'NEGADO'">
                            <img src="{{ asset('images/asessors/revisandoIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                <b>Lo sentimos,</b> en esta ocasión <br>
                                no tenemos una aprobación para ti.
                            </p>
                            <p class="textModalNumSolic text-center">
                                <strong style="font-size:13px; font-style: italic;color: #1b8acc">*
                                    @{{ infoLead.DESCRIPCION }}</strong>
                            </p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 text-center">
                            <a class="btn btn-danger buttonBackCardExist" href="/Administrator/crearCliente">Nuevo
                                Registro</a>
                            <a ng-if="estadoCliente == 'TRADICIONAL'"
                                href="/Administrator/creditLiquidator/@{{lead.CEDULA}}"
                                class="btn bg-primary buttonBackCardExist">Crear negocio @{{lead.CEDULA}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modalSteps fade hide" data-backdrop="static" data-keyboard="false" id="proccess" tabindex="-1"
        role="dialog" aria-hidden="true">
        <div class="modal-dialog modalPrincipal" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center" style="padding: 50px;">
                        <img src="{{ asset('images/gif-load.gif') }}" alt="">
                        <p class="text-procces">
                            Procesando Solicitud...<br>
                            <span style="font-size: 15px; font-style:italic; font-weight:normal">*No te desesperes,
                                se
                                están realizando las consultas necesarias, esto
                                puede tomar un tiempo de aproximadamente 2 minutos</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scriptsJs')

<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/assessorVentaContado.js') }}"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-sanitize.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ng-currency/1.2.7/ng-currency.min.js"></script>
@endsection