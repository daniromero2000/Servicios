@extends('layouts.app')
@section('title', 'Crear Cliente'.' - '.Auth::guard('assessor')->user()->NOMBRE)

@section('metaTags')
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
@endsection()

@section('linkStyleSheets')
	<link rel="stylesheet" href="{{ asset('css/assessor/forms/ventaContado.css') }}">
@endsection

@section('content')
    <div class="container" ng-app="asessorVentaContadoApp" ng-controller="asessorVentaContadoCtrl">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="ventaContado-nameAssessor">
                    {{Auth::guard('assessor')->user()->NOMBRE}}
                </h3>
                <p class="ventaContado-text">
                    <i>* Recuerde que el correcto diligenciamiento de este formulario agilizará el proceso de facturación de la cajera con Apoteosys.</i>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 offset-sm-3">
                <md-input-container class="md-block">
                    <label class="ventaContado-label">Tipo de Cliente</label>
                    <md-select required ng-model="tipoCliente" ng-change="resetInfoLead()">
                        <md-option value="CREDITO">Crédito</md-option>
                        <md-option value="CONTADO">Contado</md-option>
                    </md-select>
                </md-input-container>
            </div>
            <div class="col-12">
                <form name="clienteCredito" ng-submit="getCodeVerification()" ng-show="tipoCliente == 'CREDITO'">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Tipo de documento</label>
                                <md-select name="TIPO_DOC" ng-model="lead.TIPO_DOC" required>
                                    <md-option ng-repeat="type in typesDocuments" value="@{{type.value}}">@{{ type.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Número de identificación</label>
                                <input required name="CEDULA" ng-model="lead.CEDULA" validation-pattern="number" ng-blur="getInfoLead()">
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Fecha expedición documento</label>
                                <md-datepicker ng-model="lead.FEC_EXP" md-current-view="year"></md-datepicker>
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Nombres</label>
                                <input required name="NOMBRES" ng-model="lead.NOMBRES" validation-pattern="name">
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Apellidos</label>
                                <input required name="APELLIDOS" ng-model="lead.APELLIDOS" validation-pattern="name">
                            </md-input-container>
                        </div>
                        <div class="col-12 col-sm-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Email</label>
                                <input required name="EMAIL" ng-model="lead.EMAIL" validation-pattern="email">
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block" ng-hide="lead.CEL_VAL" >
                                <label class="ventaContado-label">Celular</label>
                                <input required name="CELULAR" ng-model="lead.CELULAR" validation-pattern="telephone" >
							</md-input-container>
							<md-input-container class="md-block" ng-show="lead.CEL_VAL" >
								<label class="ventaContado-label">Celular</label>
								<input required ng-model="CELULAR" readonly ng-disabled="true">
							</md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Ocupación</label>
                                <md-select required name="ACTIVIDAD" ng-model="lead.ACTIVIDAD" required>
                                    <md-option ng-repeat="actividad in occupations" value="@{{actividad.value}}">@{{ actividad.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Fecha de Nacimiento</label>
                                <md-datepicker required ng-model="lead.FEC_NAC" md-current-view="year"></md-datepicker>
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Ciudad de ubicación</label>
                                <md-select required name="CIUD_UBI" ng-model="lead.CIUD_UBI" required>
                                    <md-option ng-repeat="city in citiesUbi" value="@{{city.value}}">@{{ city.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Ciudad expedición documento</label>
                                <md-select required name="CIUD_EXP" ng-model="lead.CIUD_EXP" required>
                                    <md-option ng-repeat="city in cities" value="@{{city.value}}">@{{ city.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Tipo de vivienda</label>
                                <md-select required name="TIPOV" ng-model="lead.TIPOV" required>
                                    <md-option ng-repeat="housingType in housingTypes" value="@{{housingType.value}}">@{{ housingType.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Antigüedad en la vivienda (Meses)</label>
                                <input type="number" required name="TIEMPO_VIV" ng-model="lead.TIEMPO_VIV">
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Propietario de la vivienda</label>
                                <input name="PROPIETARIO" ng-model="lead.PROPIETARIO" validation-pattern="name">
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Dirección residencia</label>
                                <input required name="DIRECCION" ng-model="lead.DIRECCION" validation-pattern="text">
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Valor arriendo</label>
                                <input type="text" ng-model="lead.VRARRIENDO" name="VRARRIENDO" ng-currency fraction="0">
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Teléfono de residencia</label>
                                <input type="text" name="TELFIJO" ng-model="lead.TELFIJO">
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Estrato</label>
                                <input type="text" name="ESTRATO" ng-model="lead.ESTRATO">
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Género</label>
                                <md-select name="SEXO" ng-model="lead.SEXO" required>
                                    <md-option ng-repeat="gender in genders" value="@{{gender.value}}">@{{ gender.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Estado civil</label>
                                <md-select name="ESTADOCIVIL" ng-model="lead.ESTADOCIVIL" required>
                                    <md-option ng-repeat="civilType in civilTypes" value="@{{civilType.value}}">@{{ civilType.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                    </div>
                    <div ng-if="lead.ACTIVIDAD == 'EMPLEADO' || lead.ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA' || lead.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Nit (sin número de verificación)</label>
                                    <input type="text" name="NIT_EMP" ng-model="lead.NIT_EMP">
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Nombre de la empresa</label>
                                    <input type="text" name="RAZON_SOC" ng-model="lead.RAZON_SOC">
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Dirección de la empresa</label>
                                    <input type="text" name="DIR_EMP" ng-model="lead.DIR_EMP">
                                </md-input-container>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Teléfono de la empresa</label>
                                    <input type="text" name="TEL_EMP" ng-model="lead.TEL_EMP">
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Teléfono 2 de la empresa</label>
                                    <input type="text" name="TEL2_EMP" ng-model="lead.TEL2_EMP">
                                </md-input-container>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">EPS</label>
                                    <input type="text" name="ACT_ECO" ng-model="lead.ACT_ECO">
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Cargo</label>
                                    <input required type="text" name="CARGO" ng-model="lead.CARGO">
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Fecha de ingreso</label>
                                    <md-datepicker ng-model="lead.FEC_ING" md-current-view="year" md-mode="month"></md-datepicker>
                                </md-input-container>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Antigüedad (Meses)</label>
                                    <input required type="text" name="ANTIG" ng-model="lead.ANTIG">
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Salario</label>
                                    <input required type="text" name="SUELDO" ng-model="lead.SUELDO" ng-currency fraction="0">
                                </md-input-container>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Tipo de contrato</label>
                                    <md-select required name="TIPO_CONT" ng-model="lead.TIPO_CONT" required="required">
                                        <md-option ng-repeat="typeContract in typesContracts" value="@{{typeContract.value}}">@{{ typeContract.label }}</md-option>
                                    </md-select>
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Otros ingresos</label>
                                    <input type="text" name="OTROS_ING" ng-model="lead.OTROS_ING" ng-currency fraction="0">
                                </md-input-container>
                            </div>
                        </div>
                    </div>
                    <div ng-if="lead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || lead.ACTIVIDAD == 'NO CERTIFICADO' || lead.ACTIVIDAD == 'RENTISTA'">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Cámara de comercio</label>
                                    <md-select name="CAMARAC" ng-model="lead.CAMARAC">
                                        <md-option value="SI">Si</md-option>
                                        <md-option value="NO">No</md-option>
                                    </md-select>
                                </md-input-container>
                            </div>
                            <div class="col-12 col-sm-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Nit (sin número de verificación)</label>
                                    <input type="text" ng-model="lead.NIT_IND" name="NIT_IND">
                                </md-input-container>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Nombre de la Empresa</label>
                                    <input type="text" validation-pattern="text" ng-model="lead.RAZON_IND" />
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Qué Vendes o Comercializas?</label>
                                    <input type="text" validation-pattern="text" ng-model="lead.ACT_IND" />
                                </md-input-container>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">EPS</label>
                                    <input type="text" name="ACT_ECO" ng-model="lead.ACT_ECO" validation-pattern="textOnly" />
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6" ng-show="lead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO'">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Fecha de Constitución</label>
                                    <md-datepicker required ng-model="lead.FEC_CONST" md-current-view="year" md-mode="month"></md-datepicker>
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6" ng-show="lead.ACTIVIDAD == 'NO CERTIFICADO' || lead.ACTIVIDAD == 'RENTISTA'">
                                <md-input-container class="md-block">
                                    <label for="dateCreationCompany">Fecha de Constitución</label>
                                    <md-datepicker ng-model="lead.FEC_CONST" md-current-view="year"></md-datepicker>
                                </md-input-container>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Atigüedad (Meses)</label>
                                    <input required type="number" name="EDAD_INDP" ng-model="lead.EDAD_INDP" validation-pattern="number" />
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Salario</label>
                                    <input required type="text" name="SUELDOIND" ng-model="lead.SUELDOIND" ng-currency fraction="0" />
                                </md-input-container>
                            </div>
                        </div>
                    </div>
                    <div ng-if="lead.ACTIVIDAD == 'PENSIONADO'">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Nombre de la Empresa</label>
                                    <input type="text" validation-pattern="text" ng-model="lead.RAZON_SOC" name="RAZON_SOC" />
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Fecha de Pensión</label>
                                    <md-datepicker ng-model="lead.FEC_CONST" name="FEC_CONST" md-current-view="year" md-mode="month"></md-datepicker>
                                </md-input-container>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Atigüedad (Meses)</label>
                                    <input required type="number" ng-model="lead.ANTIG" name="ANTIG" validation-pattern="number" />
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Salario</label>
                                    <input required type="text" ng-model="lead.SUELDOIND" name="SUELDOIND" ng-currency fraction="0" />
                                </md-input-container>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">EPS</label>
                                    <input type="text" name="ACT_ECO" ng-model="lead.ACT_ECO" validation-pattern="textOnly" />
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Banco</label>
                                    <md-select name="BANCOP" ng-model="lead.BANCOP">
                                        <md-option ng-repeat="bank in banks" value="@{{bank.value}}">@{{ bank.label }}</md-option>
                                    </md-select>
                                </md-input-container>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Tratamiento de datos</label>
                                <md-select name="TRAT_DATOS" ng-model="lead.TRAT_DATOS">
                                    <md-option value="SI">Si</md-option>
                                    <md-option value="NO">No</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
					</div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <md-button type="submit" class="md-raised md-primary">Enviar</md-button>
                        </div>
                    </div>
                </form>
                <form name="clienteContado" ng-submit="addCliente('CONTADO')" ng-show="tipoCliente == 'CONTADO'">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Tipo de documento</label>
                                <md-select name="TIPO_DOC" ng-model="lead.TIPO_DOC" required>
                                    <md-option ng-repeat="type in typesDocuments" value="@{{type.value}}">@{{ type.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Número de identificación</label>
                                <input required name="CEDULA" ng-model="lead.CEDULA" validation-pattern="number" ng-blur="getInfoLead()">
                                <div ng-messages="ventaContado.CEDULA.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                    <div ng-message="pattern">Solo se permiten números.</div>
                                </div>
                            </md-input-container>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Nombres</label>
                                <input required name="NOMBRES" ng-model="lead.NOMBRES" validation-pattern="name">
                                <div ng-messages="ventaContado.NOMBRES.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                </div>
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Apellidos</label>
                                <input required name="APELLIDOS" ng-model="lead.APELLIDOS" validation-pattern="name">
                                <div ng-messages="ventaContado.APELLIDOS.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                </div>
                            </md-input-container>
                        </div>
                        <div class="col-12 col-sm-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Email</label>
                                <input required name="EMAIL" ng-model="lead.EMAIL" validation-pattern="email">
                                <div ng-messages="ventaContado.EMAIL.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                </div>
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Teléfono Fijo</label>
                                <input type="text" name="TELFIJO" ng-model="lead.TELFIJO" validation-pattern="telephone">
                            </md-input-container>
                        </div>
                        <div class="col-12 col-sm-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Celular</label>
                                <input type="text" name="CELULAR" ng-model="lead.CELULAR" required validation-pattern="telephone">
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Género</label>
                                <md-select name="SEXO" ng-model="lead.SEXO" required>
                                    <md-option ng-repeat="gender in genders" value="@{{gender.value}}">@{{ gender.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Dirección residencia</label>
                                <input required name="DIRECCION" ng-model="lead.DIRECCION" validation-pattern="text">
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Ciudad de ubicación</label>
                                <md-select required name="CIUD_UBI" ng-model="lead.CIUD_UBI" required>
                                    <md-option ng-repeat="city in citiesUbi" value="@{{city.value}}">@{{ city.label }}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Tratamiento de datos</label>
                                <md-select name="TRAT_DATOS" ng-model="lead.TRAT_DATOS">
                                    <md-option value="SI">Si</md-option>
                                    <md-option value="NO">No</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                    </div>
                    <div class="row">
						<div class="col-sm-12 col-md-4">
							<md-input-container class="md-block">
								<label class="ventaContado-label">Nombre de autorizado 1</label>
								<input type="text" name="VCON_NOM1" required ng-model="lead.VCON_NOM1">
							</md-input-container>
						</div>
						<div class="col-sm-12 col-md-4">
							<md-input-container class="md-block">
								<label class="ventaContado-label">Cédula de autorizado 1</label>
								<input type="text" name="VCON_CED1" required ng-model="lead.VCON_CED1">
							</md-input-container>
						</div>
						<div class="col-sm-12 col-md-4">
							<md-input-container class="md-block">
								<label class="ventaContado-label">Teléfono de autorizado 1</label>
								<input type="text" name="VCON_TEL1" required ng-model="lead.VCON_TEL1">
							</md-input-container>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-4">
							<md-input-container class="md-block">
								<label class="ventaContado-label">Nombre de autorizado 2</label>
								<input type="text" name="VCON_NOM2" ng-model="lead.VCON_NOM2">
							</md-input-container>
						</div>
						<div class="col-sm-12 col-md-4">
							<md-input-container class="md-block">
								<label class="ventaContado-label">Cédula de autorizado 2</label>
								<input type="text" name="VCON_CED2" ng-model="lead.VCON_CED2">
							</md-input-container>
						</div>
						<div class="col-sm-12 col-md-4">
							<md-input-container class="md-block">
								<label class="ventaContado-label">Teléfono de autorizado 2</label>
								<input type="text" name="VCON_TEL2" ng-model="lead.VCON_TEL2">
							</md-input-container>
						</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block">
								<label class="ventaContado-label">Dirección de entrega</label>
								<input type="text" name="VCON_DIR" required ng-model="lead.VCON_DIR">
							</md-input-container>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <md-button type="submit" class="md-raised md-primary">Crear</md-button>
                        </div>
                    </div>
                </form>
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
        <div class="modal modalSteps fade hide" data-backdrop="static" data-keyboard="false" id="proccess" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modalPrincipal" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="text-center" style="padding: 50px;">
							<img src="{{ asset('images/gif-load.gif') }}" alt="">
							<p class="text-procces">
								Procesando Información...
							</p>
						</div>
					</div>
				</div>
			</div>
        </div>
        <div class="modal modalSteps fade hide" data-backdrop="static" data-keyboard="false" id="showResp" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modalPrincipal" role="document">
				<div class="modal-content">
					<div class="modal-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 style="margin:0" class="headerAdmin ng-scope">Resultado política</h2>
                                <p class="resultadoPolitica colourGreen" ng-if="infoLead.ESTADO == 'PREAPROBADO'">
                                    @{{ infoLead.DESCRIPCION + " / " + infoLead.ID_DEF }}
                                </p>
                                <p class="resultadoPolitica colourRed" ng-if="infoLead.ESTADO != 'PREAPROBADO'">
                                    @{{ infoLead.DESCRIPCION + " / " + infoLead.ID_DEF }}
                                </p>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p>
                                    <label for="">Tipo de documento: </label>
                                    <span ng-if="infoLead.TIPO_DOC == 1">Cédula de ciudadanía</span>
                                    <span ng-if="infoLead.TIPO_DOC == 2">NIT</span>
                                    <span ng-if="infoLead.TIPO_DOC == 3">Cédula de extranjería</span>
                                    <span ng-if="infoLead.TIPO_DOC == 4">Tarjeta de identidad</span>
                                    <span ng-if="infoLead.TIPO_DOC == 5">Pasaporte</span>
                                    <span ng-if="infoLead.TIPO_DOC == 6">Tarjeta seguro social extranjero</span>
                                    <span ng-if="infoLead.TIPO_DOC == 7">Sociedad extranjera sin NIT en Colombia</span>
                                    <span ng-if="infoLead.TIPO_DOC == 8">Fidecoismo</span>
                                </p>
                                <p>
                                    <label for="">Número de documento: </label>@{{ infoLead.CEDULA }}
                                </p>
                                <p>
                                    <label for="">Tipo de cliente: </label>@{{ infoLead.TIPO_CLIENTE }}
                                </p>
                                <p>
                                    <label for="">Fecha nacimiento: </label>@{{ infoLead.FEC_NAC }}
                                </p>
                                <p>
                                    <label for="">Tipo de vivienda: </label>@{{ infoLead.TIPOV }}
                                </p>
                                <p>
                                        <label for="">Actividad: </label>@{{ infoLead.ACTIVIDAD }}
                                </p>
                                <p ng-if="infoLead.ACTIVIDAD == 'NO CERTIFICADO' || infoLead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO'">
                                        <label for="">Actividad independiente: </label>@{{ infoLead.ACT_IND }}
                                </p>
                                <p>
                                    <label for="">Tiempo Labor: </label><span ng-if="infoLead.TIEMPO_LABOR == 1">Si cumple</span> <span ng-if="infoLead.TIEMPO_LABOR == 0">No cumple</span>
                                </p>
                                <p ng-if="infoLead.ACTIVIDAD == 'NO CERTIFICADO' || infoLead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || infoLead.ACTIVIDAD == 'RENTISTA'">
                                    <label for="">Ingresos: </label><span>$ @{{ infoLead.SUELDOIND + infoLead.OTROS_ING | number:0}}</span>
                                </p>
                                <p ng-if="infoLead.ACTIVIDAD == 'EMPLEADO' || infoLead.ACTIVIDAD == 'PENSIONADO' || infoLead.ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA' || infoLead.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'">
                                    <label for="">Ingresos: </label><span>$@{{ infoLead.SUELDO + infoLead.OTROS_ING | number:0 }}</span>
                                </p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <p>
                                    <label for="">Sucursal: </label>@{{ infoLead.SUC }}
                                </p>
                                <p>
                                    <label for="">Dirección: </label>@{{ infoLead.DIRECCION }}
                                </p>
                                <p>
                                    <label for="">Celular: </label>@{{ infoLead.CELULAR }}
                                 </p>
                                <p>
                                <label for="">Score: </label>@{{ infoLead.score }}
                                </p>
                                <p>
                                    <label for="">Tarjeta: </label> @{{ infoLead.TARJETA }}
                                </p>
                                <p>
                                    <label for="">Estado: </label> @{{ infoLead.ESTADO }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="caracteristicaPolitica">
                                <i>* @{{ infoLead.CARACTERISTICA }}</i>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <a href="/assessor/forms/crearCliente" class="btn btn-primary">Nuevo Registro</a>
                                <a href="/assessor/dashboard" class="btn btn-secondary">Volver al Menú</a>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
    </div>
@endsection

@section('scriptsJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
    <script type="text/javascript" src="{{ asset('js/assessorVentaContado.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ng-currency/1.2.7/ng-currency.min.js"></script>    
@endsection