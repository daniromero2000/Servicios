@extends('layouts.app')
@section('title', 'Formulario venta de contado')

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
                <h4 class="ventaContado-formName">
                    Formulario venta de contado
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form name="ventaContado">
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
                                <input required name="CEDULA" ng-model="lead.CEDULA" validation-pattern="number" ng-blur="getNumCel()">
                                <div ng-messages="ventaContado.CEDULA.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                    <div ng-message="pattern">Solo se permiten números.</div>
                                </div>
                            </md-input-container>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <md-input-container>
                                <label class="ventaContado-label">Fecha expedición documento</label>
                                <md-datepicker required ng-model="lead.FEC_EXP" md-current-view="year"></md-datepicker>
                                <div ng-messages="ventaContado.FEC_EXP.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
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
                        <div class="col-sm-12 col-md-4">
                            <md-input-container class="md-block" ng-hide="lead.CEL_VAL" >
                                <label class="ventaContado-label">Celular</label>
                                <input required name="CELULAR" ng-model="lead.CELULAR" validation-pattern="telephone" >
                                <div ng-messages="ventaContado.CELULAR.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
								</div>
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
                            <md-input-container>
                                <label class="ventaContado-label">Fecha de Nacimiento</label>
                                <md-datepicker required ng-model="lead.FEC_NAC" md-current-view="year"></md-datepicker>
                                <div ng-messages="ventaContado.FEC_NAC.$error">
                                    <div ng-message="required">Esta campo es requerido.</div>
                                </div>
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
                                <input required name="PROPIETARIO" ng-model="lead.PROPIETARIO" validation-pattern="name">
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
                                <input type="number" ng-model="lead.VRARRIENDO" name="VRARRIENDO">
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
                    <div ng-show="lead.ACTIVIDAD == 'EMPLEADO' || lead.ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA' || lead.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'">
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
                                    <input type="text" required name="TEL_EMP" ng-model="lead.TEL_EMP">
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
                                    <input type="text" name="ACT_ECO" ng-model="lead.ACT_ECO" required>
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
                                    <input type="text" name="ANTIG" ng-model="lead.ANTIG">
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Salario</label>
                                    <input type="number" name="SUELDO" ng-model="lead.SUELDO">
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
                                    <input type="text" name="OTROS_ING" ng-model="lead.OTROS_ING">
                                </md-input-container>
                            </div>
                        </div>
                    </div>
                    <div ng-show="lead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || lead.ACTIVIDAD == 'NO CERTIFICADO' || lead.ACTIVIDAD == 'RENTISTA'">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Cámara de comercio</label>
                                    <md-select name="CAMARAC" ng-model="lead.CAMARAC" required>
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
                                    <input type="text" validation-pattern="text" ng-model="lead.RAZON_IND" required />
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
                                    <input type="text" name="ACT_ECO" ng-model="lead.ACT_ECO" validation-pattern="textOnly" required />
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6" ng-show="lead.occupation == 'INDEPENDIENTE CERTIFICADO'">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Fecha de Constitución</label>
                                    <md-datepicker required ng-model="lead.FEC_CONST" md-current-view="year" md-mode="month"></md-datepicker>
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6" ng-show="lead.occupation == 'NO CERTIFICADO' || lead.occupation == 'RENTISTA'">
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
                                    <input type="number" name="EDAD_INDP" ng-model="lead.EDAD_INDP" validation-pattern="number" required />
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Salario</label>
                                    <input type="text" name="SUELDOIND" ng-model="lead.SUELDOIND" />
                                </md-input-container>
                            </div>
                        </div>
                    </div>
                    <div ng-if="lead.ACTIVIDAD == 'PENSIONADO'">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Nombre de la Empresa</label>
                                    <input type="text" validation-pattern="text" ng-model="lead.RAZON_SOC" name="RAZON_SOC" required />
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Fecha de Pensión</label>
                                    <md-datepicker required ng-model="lead.FEC_CONST" name="FEC_CONST" md-current-view="year" md-mode="month"></md-datepicker>
                                </md-input-container>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Atigüedad (Meses)</label>
                                    <input type="number" ng-model="lead.ANTIG" name="ANTIG" validation-pattern="number" required />
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Salario</label>
                                    <input type="text" ng-model="lead.SUELDOIND" name="SUELDOIND"/>
                                </md-input-container>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">EPS</label>
                                    <input required type="text" name="ACT_ECO" required ng-model="lead.ACT_ECO" validation-pattern="textOnly" />
                                </md-input-container>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <md-input-container class="md-block">
                                    <label class="ventaContado-label">Banco</label>
                                    <md-select name="BANCOP" ng-model="lead.BANCOP" required>
                                        <md-option ng-repeat="bank in banks" value="@{{bank.value}}">@{{ bank.label }}</md-option>
                                    </md-select>
                                </md-input-container>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">¿Cúal es tu forma de pago?</label>
                                <md-select name="MEDIO_PAGO" ng-model="lead.MEDIO_PAGO">
                                    <md-option value="12">Crédito</md-option>
                                    <md-option value="00">Contado</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
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
						<div class="col-sm-12 col-md-4">
							<md-input-container class="md-block">
								<label class="ventaContado-label">Nobre de autorizado 1</label>
								<input type="text" name="VCON_NOM1" ng-model="lead.VCON_NOM1">
							</md-input-container>
						</div>
						<div class="col-sm-12 col-md-4">
							<md-input-container class="md-block">
								<label class="ventaContado-label">Cédula de autoizado 1</label>
								<input type="text" name="VCON_CED1" ng-model="lead.VCON_CED1">
							</md-input-container>
						</div>
						<div class="col-sm-12 col-md-4">
							<md-input-container class="md-block">
								<label class="ventaContado-label">Teléfono de autorizado 1</label>
								<input type="text" name="VCON_TEL1" ng-model="lead.VCON_TEL1">
							</md-input-container>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-4">
							<md-input-container class="md-block">
								<label class="ventaContado-label">Nobre de autorizado 2</label>
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
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scriptsJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script type="text/javascript" src="{{ asset('js/assessorVentaContado.js') }}"></script>
@endsection