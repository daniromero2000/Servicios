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
            <label class="ventaContado-label" for="tipoCliente">Tipo de Cliente</label>
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
            <form name="clienteCredito" ng-submit="getCodeVerification()" ng-show="tipoCliente == 'CREDITO'">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                <div class="row container-form">
                    <div class="col-12 col-sm-12 col-md-12 type-client">
                        <div class="forms-descStep forms-descStep-avances">
                            <strong>Información básica</strong><br>
                            <span class="forms-descText">Ingresa tus datos personales</span>
                            <img src="http://192.168.200.60:8081/images/datosPersonales.png"
                                class="img-fluid forms-descImg">
                            <span class="forms-descStepNum">1</span>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="labels" for="tipodoc">Tipo de documento*</label>
                                <select class="inputs form-control" ng-model="lead.TIPO_DOC" id="tipodoc"
                                    ng-options="type.value as type.label for type in typesDocuments"></select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="labels" for="CEDULA">Número de documento*</label>
                                <input class="inputs" validation-pattern="IdentificationNumber"
                                    ng-blur="getValidationLead()" type="text" ng-model="lead.CEDULA" id="CEDULA"
                                    required />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="labels" for="FEC_EXP">Fecha expedición documento*</label>
                                <div class="input-group" moment-picker="lead.FEC_EXP" format="YYYY-MM-DD">
                                    <input class="form-control inputs" ng-model="lead.FEC_EXP" id="FEC_EXP" readonly=""
                                        placeholder="Año/Mes/Día" required>
                                    <span class="input-group-addon">
                                        <i class="octicon octicon-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="labels" for="nombres">Nombres*</label>
                                <input class="inputs" id="nombres" validation-pattern="name" ng-model="lead.NOMBRES"
                                    type="text" required />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="labels" for="lastName">Apellidos*</label>
                                <input class="inputs" id="lastName" validation-pattern="name" type="text"
                                    ng-model="lead.APELLIDOS" required />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="labels" for="email">Correo electrónico*</label>
                                <input class="inputs" id="email" type="text" validation-pattern="email"
                                    ng-model="lead.EMAIL" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div ng-hide="lead.CEL_VAL">
                                    <label class="ventaContado-label">Celular</label>
                                    <input class="inputs" ng-blur="checkIfExistNum()" ng-model="lead.CELULAR" validation-pattern="telephone"
                                        required />
                                </div>
                                <div ng-show="lead.CEL_VAL">
                                    <label class="ventaContado-label">Celular</label>
                                    <input class="inputs" ng-model="CELULAR" readonly ng-disabled="true" />
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="ventaContado-label labels" for="actividad">Ocupación</label>
                                <select class="inputs form-control" ng-model="lead.ACTIVIDAD" id="actividad"
                                    ng-options="actividad.value as actividad.label for actividad in occupations"></select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="ventaContado-label" for="ciud_ubi">Ciudad de ubicación</label>
                                <select class="inputs form-control" ng-model="lead.CIUD_UBI" id="ciud_ubi"
                                    ng-options="city.value as city.label for city in citiesUbi"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 type-client">
                        <div class="forms-descStep forms-descStep-avances">
                            <strong>Cuentanos más de ti</strong><br>
                            <span class="forms-descText">Ingresa tu información personal</span>
                            <img src="http://192.168.200.60:8081/images/datosPersonales.png"
                                class="img-fluid forms-descImg">
                            <span class="forms-descStepNum">2</span>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="labels" for="">Fecha de nacimiento*</label>
                                <div class="input-group" moment-picker="lead.FEC_NAC" format="YYYY-MM-DD">
                                    <input class="form-control inputs" ng-model="lead.FEC_NAC" id="FEC_NAC" readonly=""
                                        placeholder="Año/Mes/Día" required>
                                    <span class="input-group-addon">
                                        <i class="octicon octicon-calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="ventaContado-label labels" for="ciud_exp">Ciudad expedición
                                    documento*</label>
                                <select ng-model="lead.CIUD_EXP" class="inputs form-control" id="ciud_exp"
                                    ng-options="city.value as city.label for city in cities" required></select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="ventaContado-label labels" for="tipov">Tipo de vivienda*</label>
                                <select ng-model="lead.TIPOV" class="inputs form-control" id="tipov"
                                    ng-options="housingType.value as housingType.label for housingType in housingTypes"
                                    required></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="labels" for="antiquity">Antigüedad en vivienda <small>(Meses)</small>*</label>
                                <input class="inputs" id="antiquity" validation-pattern="number" type="number"
                                    ng-model="lead.TIEMPO_VIV" required />
                            </div>
                            <div class="col-12 col-md-4" ng-show="lead.TIPOV == 'ARRIENDO' || lead.TIPOV == 'FAMILIAR'">
                                <label class="labels" for="PROPIETARIO">Propietario de la vivienda</label>
                                <input class="inputs" id="PROPIETARIO" validation-pattern="name" type="text"
                                    ng-model="lead.PROPIETARIO" />
                            </div>
                            <div class="col-12 col-md-4" ng-show="lead.TIPOV == 'ARRIENDO'">
                                <label class="labels" for="VRARRIENDO">Valor del arriendo</label>
                                <input class="inputs" ng-currency="" fraction="0" min="0" id="VRARRIENDO" type="text"
                                    ng-model="lead.VRARRIENDO" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label class="ventaContado-label labels" for="direccion">Dirección de
                                    residencia*</label>
                                <input class="inputs" type="text" id="direccion" validation-pattern="text"
                                    ng-model="lead.DIRECCION" required />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="labels" for="TELFIJO">Teléfono de residencia*</label>
                                <input class="inputs" validation-pattern="telephone" type="text" ng-model="lead.TELFIJO"
                                    id="TELFIJO" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="labels" for="estrato">Estrato*</label>
                                <input class="inputs" id="estrato" validation-pattern="number" type="text"
                                    ng-model="lead.ESTRATO" required />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="ventaContado-label labels" for="genero">Género</label>
                                <select class="inputs form-control" ng-model="lead.SEXO" id="genero"
                                    ng-options="gender.value as gender.label for gender in genders"></select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="ventaContado-label labels" for="estadocivil">Estado civil</label>
                                <select class="inputs form-control" ng-model="lead.ESTADOCIVIL" id="estadocivil"
                                    ng-options="civilType.value as civilType.label for civilType in civilTypes"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 type-client">
                        <div class="forms-descStep forms-descStep-avances">
                            <strong>Información laboral</strong><br>
                            <span class="forms-descText">Ingresa tus datos laborales</span>
                            <img src="http://192.168.200.60:8081/images/datosPersonales.png"
                                class="img-fluid forms-descImg">
                            <span class="forms-descStepNum">3</span>
                        </div>
                        <div
                            ng-if="lead.ACTIVIDAD == 'EMPLEADO' || lead.ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA' || lead.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="labels" for="empresaNombre">Nombre de la empresa*</label>
                                    <input class="inputs" type="text" validation-pattern="text" id="empresaNombre"
                                        ng-model="lead.RAZON_SOC" required />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="labels" for="dirEmpresa">Dirección de la empresa*</label>
                                    <input class="inputs" type="text" validation-pattern="text" id="dirEmpresa"
                                        ng-model="lead.DIR_EMP" required />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="labels" for="telEmpresa">Teléfono de la empresa*</label>
                                    <input class="inputs" id="telEmpresa" validation-pattern="telephone" type="text"
                                        ng-model="lead.TEL_EMP" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="labels" for="eps">E.P.S*</label>
                                    <input class="inputs" id="eps" validation-pattern="text" type="text"
                                        ng-model="lead.ACT_ECO" required />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="labels" for="cargo">Cargo*</label>
                                    <input class="inputs" id="cargo" validation-pattern="text" type="text"
                                        ng-model="lead.CARGO" required />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="labels" for="FEC_ING">Fecha de ingreso*</label>
                                    <div class="input-group" moment-picker="lead.FEC_ING" format="YYYY-MM">
                                        <input class="form-control inputs" ng-model="lead.FEC_ING" id="FEC_ING"
                                            readonly="" placeholder="Año/Mes" required />
                                        <span class="input-group-addon">
                                            <i class="octicon octicon-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="ventaContado-label labels" for="tipoCont">Tipo de contrato*</label>
                                    <select class="inputs form-control" ng-model="lead.TIPO_CONT" id="tipoCont"
                                        ng-options="typeContract.value as typeContract.label for typeContract in typesContracts"></select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="labels" for="salario">Salario*</label>
                                    <input class="inputs" id="salario" ng-currency fraction="0" min="0" type="text"
                                        ng-model="lead.SUELDO" required />
                                </div>
                            </div>
                        </div>
                        <div
                            ng-if="lead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || lead.ACTIVIDAD == 'NO CERTIFICADO' || lead.ACTIVIDAD == 'RENTISTA'">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="ventaContado-label" for="CAMARAC">Cámara de comercio</label>
                                    <select class="form-control" ng-model="lead.CAMARAC" id="CAMARAC">
                                        <option value="SI">Si</option>
                                        <option value="NO">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label class="ventaContado-label" for="RAZON_IND">Nombre de la empresa *</label>
                                    <input class="form-control inputs" type="text" validation-pattern="text"
                                        id="RAZON_IND" ng-model="lead.RAZON_IND" required />
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label class="ventaContado-label" for="ACT_IND">Qué vendes o comercializas?
                                        *</label>
                                    <input class="form-control inputs" type="text" id="ACT_IND"
                                        validation-pattern="text" ng-model="lead.ACT_IND" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <label class="ventaContado-label" for="ACT_ECO">EPS*</label>
                                    <input class="form-control inputs" type="text" id="ACT_ECO" ng-model="lead.ACT_ECO"
                                        validation-pattern="textOnly" required />
                                </div>
                                <div class="col-sm-12 col-md-4" ng-show="lead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO'">
                                    <label class="ventaContado-label" for="FEC_CONST">Fecha de constitución*</label>
                                    <div class="input-group" moment-picker="lead.FEC_CONST" format="YYYY-MM">
                                        <input class="form-control inputs" ng-model="lead.FEC_CONST" id="FEC_CONST"
                                            readonly="" placeholder="Año/Mes" required>
                                        <span class="input-group-addon">
                                            <i class="octicon octicon-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4"
                                    ng-show="lead.ACTIVIDAD == 'NO CERTIFICADO' || lead.ACTIVIDAD == 'RENTISTA'">
                                    <label for="dateCreationCompany">Fecha de Constitución</label>
                                    <div class="input-group" moment-picker="lead.FEC_CONST" format="YYYY-MM">
                                        <input class="form-control inputs" ng-model="lead.FEC_CONST" id="FEC_CONST"
                                            readonly="" placeholder="Año/Mes">
                                        <span class="input-group-addon">
                                            <i class="octicon octicon-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label class="ventaContado-label">Salario*</label>
                                    <input class="form-control inputs" type="text" ng-model="lead.SUELDOIND" ng-currency
                                        fraction="0" required />
                                </div>
                            </div>
                        </div>
                        <div ng-if="lead.ACTIVIDAD == 'PENSIONADO'">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label class="ventaContado-label" for="RAZON_SOC">Nombre de la empresa*</label>
                                    <input class="form-control inputs" type="text" validation-pattern="text"
                                        ng-model="lead.RAZON_SOC" id="RAZON_SOC" required />
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label class="ventaContado-label">Fecha de Pensión*</label>
                                    <div class="input-group" moment-picker="lead.FEC_CONST" format="YYYY-MM">
                                        <input class="form-control inputs" ng-model="lead.FEC_CONST" id="FEC_CONST"
                                            readonly="" placeholder="Año/Mes" required>
                                        <span class="input-group-addon">
                                            <i class="octicon octicon-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <label class="ventaContado-label" for="SUELDOIND">Salario*</label>
                                    <input class="form-control inputs" type="text" ng-model="lead.SUELDOIND"
                                        id="SUELDOIND" ng-currency fraction="0" required />
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label class="ventaContado-label" for="ACT_ECO">EPS*</label>
                                    <input class="form-control inputs" type="text" id="ACT_ECO" ng-model="lead.ACT_ECO"
                                        validation-pattern="textOnly" required />
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label class="ventaContado-label" for="BANCOP">Banco*</label>
                                    <select class="form-control inputs" ng-model="lead.BANCOP" id="BANCOP"
                                        ng-options="bank.value as bank.label for bank in banks" required></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 type-client">
                        <div class="forms-descStep forms-descStep-avances">
                            <strong>Referencias</strong><br>
                            <span class="forms-descText">Ingresa los datos de tus referencias</span>
                            <img src="http://192.168.200.60:8081/images/datosPersonales.png"
                                class="img-fluid forms-descImg">
                            <span class="forms-descStepNum">4</span>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label class="labels-blue" for="refPersonalNombre">Referencia personal:</label>
                                <input class="inputs" id="refPersonalNombre" ng-model="lead.NOM_REFPER"
                                    validation-pattern="name" type="text" placeholder="Nombre*" required />
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="labels" for="refPersonalCelular"></label>
                                <input class="inputs" id="refPersonalCelular" ng-model="lead.TEL_REFPER"
                                    validation-pattern="telephone" type="text" placeholder="Celular*" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label class="labels-blue" for="refFamiliarNombre">Referencia familiar:</label>
                                <input class="inputs" type="text" id="refFamiliarNombre" ng-model="lead.NOM_REFFAM"
                                    validation-pattern="name" placeholder="Nombre*" required />
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="labels" for="refFamiliarCelular"></label>
                                <input class="inputs" type="text" id="refFamiliarCelular" ng-model="lead.TEL_REFFAM"
                                    validation-pattern="telephone" placeholder="Celular*" required />
                            </div>
                        </div>
                        <div class="row" ng-show="showWarningErrorData">
                            <div class="col-12">
                                <p class="alert alert-danger">
                                    Verifique la información suministrada
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center form-group">
                                <button type="submit" class="btn btn-primary">Continuar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form name="clienteContado" ng-submit="getCodeVerification()" ng-show="tipoCliente == 'CONTADO'">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 type-client">
                        <div class="forms-descStep forms-descStep-avances">
                            <strong>Información básica</strong><br>
                            <span class="forms-descText">Ingresa tus datos personales</span>
                            <img src="http://192.168.200.60:8081/images/datosPersonales.png"
                                class="img-fluid forms-descImg">
                            <span class="forms-descStepNum">1</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label class="labels" for="tipodoc">Tipo de documento*</label>
                        <select class="inputs" ng-model="lead.TIPO_DOC" id="tipodoc"
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
                        <select class="inputs" ng-model="lead.SEXO" id="genero"
                            ng-options="gender.value as gender.label for gender in genders"></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label class="ventaContado-label labels">Dirección de residencia*</label>
                        <input class="inputs" ng-model="lead.DIRECCION" type="text" validation-pattern="text" />
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="ventaContado-label" for="ciud_ubiContado">Ciudad de ubicación</label>
                        <select class="inputs form-control" ng-model="lead.CIUD_UBI" id="ciud_ubiContado"
                            ng-options="city.value as city.label for city in citiesUbi"></select>
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

    <div class="modal fade hide modalThankYouPage-asessors" data-backdrop="static" data-keyboard="false" id="decisionCredit" tabindex="-1"
        role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modalCode">
            <div class="modal-content">
                <div class="modal-body" style="padding: 0">
                    <div class="row resetRow">
                        <div class="col-12 text-center resetCol headThankYuoModal">
                            <img src="{{ asset('images/asessors/logoModal.png') }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-12" ng-if="resp.resp == 'true'">
                            <h2 class="decisionCredit-title text-center">Selecciona una opciòn</h2>
                            <div class="row my-4">
                                <div class="col-12 col-sm-6 text-center my-4">
                                    <div class="decisionCredit-option" ng-class="{'decisionCredit-selected': decisionCredit == 1}" ng-click="changeDesicionCredit(1)">
                                        <p>@{{ resp.infoLead.TARJETA }}</p>
                                        <i class="fas fa-credit-card decisionCredit-option-icon"></i>
                                        <p>
                                            Cupo Compras : $ @{{ resp.quotaApprovedProduct | number:0 }} <br>
                                            Cupo Avance : $ @{{ resp.quotaApprovedAdvance | number:0 }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-center my-4">
                                    <div class="decisionCredit-option" ng-class="{'decisionCredit-selected': decisionCredit == 2}" ng-click="changeDesicionCredit(2)">
                                        <p>Crédito Tradicional</p>
                                        <i class="fas fa-money-bill-wave decisionCredit-option-icon"></i>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary" ng-click="sendDecisionCredit()" ng-disabled="decisionCredit == '' || disabledDecisionCredit">Continuar</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" ng-if="resp.resp == '-2'">
                            <h2 class="decisionCredit-title text-center">Selecciona una opciòn</h2>
                            <div class="row my-4">
                                <div class="col-12 text-center my-4">
                                    <div class="decisionCredit-option" ng-class="{'decisionCredit-selected': decisionCredit == 2}" ng-click="changeDesicionCredit(2)">
                                        <p>Crédito Tradicional</p>
                                        <i class="fas fa-money-bill-wave decisionCredit-option-icon"></i>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary" ng-click="sendDecisionCredit()" ng-disabled="decisionCredit == '' || disabledDecisionCredit">Continuar</button>
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
                                <input type="text" ng-model="code.code" class="form-control" />
                            </div>
                            <div class="col-12 text-center form-group">
                                <button class="btn btn-primary">Confirmar Código</button>
                                <button type="button" ng-show="reNewToken" class="btn btn-warning" ng-click="getCodeVerification(true)">Generar Nuevo Código</button>
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
                                <div class="offset-sm-5 col-7">
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
                                Solictud <strong style="font-size:18px">@{{ numSolic }}</strong> creada exitosamente, <br>
                                procede en <strong>OPORTUDATA</strong> a ingresar los datos del negocio.
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'APROBADO'">
                            <img src="{{ asset('images/asessors/openIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                <b>¡FELICIDADES!</b> <br>
                                <b>Solicitud aprobada</b> para tarjeta
                            </p>
                            <p class="textModalNumSolic text-center">
                                El número de solicitud es <strong style="font-size:16px; color: #1b8acc">@{{ numSolic }}</strong>
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'PREAPROBADO'">
                            <img src="{{ asset('images/asessors/revisandoIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                <b>La solicitud</b> está siendo revisada <br>
                                por el área de fábrica de créditos.
                            </p>
                            <p class="textModalNumSolic text-center">
                                El número de solicitud es <strong style="font-size:16px; color: #1b8acc">@{{ numSolic }}</strong>
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal"
                            ng-if="estadoCliente == 'SIN COMERCIAL'">
                            <img src="{{ asset('images/asessors/revisandoIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                <b>La solicitud</b> está siendo revisada <br>
                                por el área de fábrica de créditos.
                            </p>
                            <p class="textModalNumSolic text-center">
                                El número de solicitud es <strong style="font-size:16px; color: #1b8acc">@{{ numSolic }}</strong>
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'NEGADO'">
                            <img src="{{ asset('images/asessors/revisandoIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                <b>Lo sentimos,</b> en esta ocasión <br>
                                no tenemos una aprobación para ti.
                            </p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 text-center">
                            <a class="btn btn-danger buttonBackCardExist" href="/Administrator/crearCliente">Nuevo
                                Registro</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modalSteps fade hide" data-backdrop="static" data-keyboard="false" id="proccess" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modalPrincipal" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center" style="padding: 50px;">
                        <img src="{{ asset('images/gif-load.gif') }}" alt="">
                        <p class="text-procces">
                            Procesando Solicitud...<br>
                            <span style="font-size: 15px; font-style:italic; font-weight:normal">*No te desesperes, se están realizando las consultas necesarias, esto
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