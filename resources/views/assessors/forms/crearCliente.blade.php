@extends('layouts.app')
@section('title', 'Crear Cliente'.' - '.Auth::guard('assessor')->user()->NOMBRE)

@section('metaTags')
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
@endsection()

@section('linkStyleSheets')
    <link rel="stylesheet" href="{{ asset('css/assessor/forms/ventaContado.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assessor/forms/creacionCliente.css') }}">
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
                <div class="row">
                    <div class="col-12 content-top">
                        <img class="img-top"src="{{asset('images/asessors/top.jpg')}}" alt="" class="img-fluid">
                    </div>
                </div>
                <form name="clienteCredito" ng-submit="getCodeVerification()" ng-show="tipoCliente == 'CREDITO'">
                    <div class="row container-form">
                        <div class="col-12 col-sm-12 col-md-12 type-client">
                            <div class="forms-descStep forms-descStep-avances">
                                <strong>Información básica</strong><br>
                                <span class="forms-descText">Ingresa tus datos personales</span>
                                    <img src="http://192.168.200.60:8081/images/datosPersonales.png" class="img-fluid forms-descImg">
                                <span class="forms-descStepNum">1</span>
                            </div>  
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="tipodoc">Tipo de documento*</label>
                                    <md-select class="inputs" name="TIPO_DOC" ng-model="lead.TIPO_DOC" placeholder="Seleccione" required>
                                        <md-option ng-repeat="type in typesDocuments" value="@{{type.value}}">@{{ type.label }}</md-option>
                                    </md-select>
                                </div>
                                <div class="col-12 col-sm-4">
                                        <label class="labels" for="">Número de Documento*</label>
                                    <input class="inputs" type="text" name="" id="" placeholder="Número de documento*">  
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Fecha Expedición Documento*</label>
                                    <input class="inputs" type="date" placeholder="Año/Mes/Día"></input> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="labels" for="">Nombres*</label>
                                    <input class="inputs" type="text" placeholder="Nombres*"></input>        
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="labels" for="">Apellidos*</label>
                                    <input class="inputs" type="text" placeholder="Apellidos*"></input>        
                                </div>                              
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label class="labels" for="">Correo Electrónico*</label>
                                    <input class="inputs" type="mail" placeholder="Correo Electrónico*"></input>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="labels" for="">Confirmación Correo Electrónico*</label>
                                    <input class="inputs" type="mail" placeholder="Confirmar Correo Electrónico*"></input>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label class="ventaContado-label labels">Celular*</label>
                                    <input class="inputs" type="text" placeholder="Celular*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="ventaContado-label labels">Ocupación</label>
                                    <md-select class="inputs" required name="ACTIVIDAD" ng-model="lead.ACTIVIDAD" required>
                                        <md-option ng-repeat="actividad in occupations" value="@{{actividad.value}}">@{{ actividad.label }}</md-option>
                                    </md-select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="ventaContado-label labels">Ciudad</label>
                                    <input class="inputs" type="text" placeholder="Ciudad*"></input>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 type-client">
                            <div class="forms-descStep forms-descStep-avances">
                                <strong>Cuentanos más de ti</strong><br>
                                <span class="forms-descText">Ingresa tu información personal</span>
                                    <img src="http://192.168.200.60:8081/images/datosPersonales.png" class="img-fluid forms-descImg">
                                <span class="forms-descStepNum">2</span>
                            </div> 
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Fecha De Nacimiento*</label>
                                    <input class="inputs" type="date" placeholder="Año/Mes/Día"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="ventaContado-label labels">Lugar de Nacimiento*</label>
                                    <md-select class="inputs" required name="CIUD_EXP" ng-model="lead.CIUD_EXP" required>
                                    <md-option ng-repeat="city in cities" value="@{{city.value}}">@{{ city.label }}</md-option>
                                    </md-select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="ventaContado-label labels">Tipo de Vivienda*</label>
                                    <md-select class="inputs" required name="TIPOV" ng-model="lead.TIPOV" required>
                                    <md-option ng-repeat="housingType in housingTypes" value="@{{housingType.value}}">@{{ housingType.label }}</md-option>
                                    </md-select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Antiguedad en Vivienda*</label>
                                    <input class="inputs" type="number" placeholder="Antiguedad de la vivienda (Meses)*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="ventaContado-label labels">Dirección de Residencia*</label>
                                    <input class="inputs" type="text" placeholder="Dirección de Residencia*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Teléfono de Residencia*</label>
                                    <input class="inputs" type="text" placeholder="Teléfono de Residencia*"></input>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Estrato*</label>
                                    <input class="inputs" type="number" placeholder="Estrato*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="ventaContado-label labels">Género</label>
                                    <md-select class="inputs" name="SEXO" ng-model="lead.SEXO" required>
                                    <md-option ng-repeat="gender in genders" value="@{{gender.value}}">@{{ gender.label }}</md-option>
                                    </md-select>  
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="ventaContado-label labels">Estado civil</label>
                                    <md-select class="inputs" name="ESTADOCIVIL" ng-model="lead.ESTADOCIVIL" required>
                                        <md-option ng-repeat="civilType in civilTypes" value="@{{civilType.value}}">@{{ civilType.label }}</md-option>
                                    </md-select>
                                </div>
                            </div>      
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 type-client">
                            <div class="forms-descStep forms-descStep-avances">
                                <strong>Información laboral</strong><br>
                                <span class="forms-descText">Ingresa tus datos laborales</span>
                                    <img src="http://192.168.200.60:8081/images/datosPersonales.png" class="img-fluid forms-descImg">
                                <span class="forms-descStepNum">3</span>
                            </div> 
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Nit (sin número de verificación)*</label>
                                    <input class="inputs" type="text" placeholder="Nit (sin número de verificación)*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Nombre de la empresa*</label>
                                    <input class="inputs" type="text" placeholder="Nombre de la empresa*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Dirección de la empresa*</label>
                                    <input class="inputs" type="text" placeholder="Dirección de la empresa*"></input>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Nit (sin número de verificación)*</label>
                                    <input class="inputs" type="text" placeholder="Nit (sin número de verificación)*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Nombre de la empresa*</label>
                                    <input class="inputs" type="text" placeholder="Nombre de la empresa*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Dirección de la empresa*</label>
                                    <input class="inputs" type="text" placeholder="Dirección de la empresa*"></input>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Teléfono de la empresa*</label>
                                    <input class="inputs" type="text" placeholder="Teléfono de la empresa*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Teléfono 2 de la empresa*</label>
                                    <input class="inputs" type="text" placeholder="Teléfono 2 de la empresa*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">S.O.S.*</label>
                                    <input class="inputs" type="text" placeholder="S.O.S.*"></input>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Cargo*</label>
                                    <input class="inputs" type="text" placeholder="Cargo*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Fecha de Ingreso*</label>
                                    <input class="inputs" type="date" placeholder="Año/Mes/Día"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Antiguedad (Meses)*</label>
                                    <input type="number" name="" id="" placeholder="Antiguedad (Meses)*"></input>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Salario*</label>
                                    <input class="inputs" type="number" placeholder="Salario*"></input>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="ventaContado-label labels">Tipo de contrato*</label>
                                    <md-select class="inputs" required name="TIPO_CONT" ng-model="lead.TIPO_CONT" required="required">
                                        <md-option ng-repeat="typeContract in typesContracts" value="@{{typeContract.value}}">@{{ typeContract.label }}</md-option>
                                    </md-select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="labels" for="">Otros Salarios*</label>
                                    <input class="inputs" type="Text" placeholder="Otros Salarios*"></input>
                                </div>
                            </div>      
                        </div>     
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 type-client">
                            <div class="forms-descStep forms-descStep-avances">
                                <strong>Referencias</strong><br>
                                <span class="forms-descText">Ingresa los datos de tus referencias</span>
                                    <img src="http://192.168.200.60:8081/images/datosPersonales.png" class="img-fluid forms-descImg">
                                <span class="forms-descStepNum">4</span>
                            </div> 
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label class="labels-blue" for="">Referencia Personal:</label>
                                <input class="inputs" type="text" placeholder="Nombres*"></input>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="labels" for=""></label>
                                <input class="inputs" type="text" placeholder="Celular*"></input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label class="labels-blue" for="">Referencia Familiar:</label>
                                <input class="inputs" type="text" placeholder="Nombres*"></input>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="labels" for=""></label>
                                <input class="inputs" type="text" placeholder="Celular*"></input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <md-button type="submit" class="md-raised md-primary px-3 py-2">Continuar</md-button>
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
                                    <img src="http://192.168.200.60:8081/images/datosPersonales.png" class="img-fluid forms-descImg">
                                <span class="forms-descStepNum">1</span>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="labels" for="tipodoc">Tipo de documento*</label>
                            <md-select class="inputs" name="TIPO_DOC" ng-model="lead.TIPO_DOC" placeholder="Seleccione" required>
                                <md-option ng-repeat="type in typesDocuments" value="@{{type.value}}">@{{ type.label }}</md-option>
                            </md-select>
                        </div>
                        <div class="col-12 col-sm-4">
                                <label class="labels" for="">Número de Documento*</label>
                            <input class="inputs" type="text" name="" id="" placeholder="Número de documento*">  
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="labels" for="">Fecha Expedición Documento*</label>
                            <input class="inputs" type="date" placeholder="Año/Mes/Día"></input> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="labels" for="">Nombres*</label>
                            <input class="inputs" type="text" placeholder="Nombres*"></input>        
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="labels" for="">Apellidos*</label>
                            <input class="inputs" type="text" placeholder="Apellidos*"></input>        
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label class="labels" for="">Correo Electrónico*</label>
                            <input class="inputs" type="mail" placeholder="Correo Electrónico*"></input>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="labels" for="">Confirmación Correo Electrónico*</label>
                            <input class="inputs" type="mail" placeholder="Confirmar Correo Electrónico*"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="ventaContado-label labels">Celular*</label>
                            <input class="inputs" type="text" placeholder="Celular*"></input>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="ventaContado-label labels">Ciudad</label>
                            <input class="inputs" type="text" placeholder="Ciudad*"></input>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="ventaContado-label labels">Teléfono Fijo*</label>
                            <input class="inputs" type="text" placeholder="Teléfono Fijo*"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="ventaContado-label labels">Género</label>
                            <md-select class="inputs" name="SEXO" ng-model="lead.SEXO" required>
                            <md-option ng-repeat="gender in genders" value="@{{gender.value}}">@{{ gender.label }}</md-option>
                            </md-select>  
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="ventaContado-label labels">Dirección de Residencia*</label>
                            <input class="inputs" type="text" placeholder="Dirección de Residencia*"></input>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="ventaContado-label labels">Ciudad de Ubicación*</label>
                            <input class="inputs" type="text" placeholder="Ciudad de Ubicación*"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <label class="ventaContado-label labels">Tratamiento de datos</label>
                            <md-select class="inputs" name="TRAT_DATOS" ng-model="lead.TRAT_DATOS">
                                <md-option value="SI">Si</md-option>
                                <md-option value="NO">No</md-option>
                            </md-select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="ventaContado-label labels">Nombre de autorizado 1</label>
                            <input class="inputs" type="text" name="VCON_NOM1" required ng-model="lead.VCON_NOM1">                                      
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="ventaContado-label labels">Cédula de autorizado 1</label>
                            <input class="inputs" type="text" name="VCON_CED1" required ng-model="lead.VCON_CED1">
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="ventaContado-label labels">Teléfono de autorizado 1</label>
                            <input class="inputs" type="text" name="VCON_TEL1" required ng-model="lead.VCON_TEL1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <label class="ventaContado-label labels">Dirección de entrega</label>
                            <input class="inputs" type="text" name="VCON_DIR" required ng-model="lead.VCON_DIR">
                        </div>
                    </div>
                    <div class="row  text-center">
                        <div class="col-12">
                            <md-button type="submit" class="md-raised md-primary px-3 py-2">Continuar</md-button>
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