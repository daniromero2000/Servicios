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
                    <select ng-disabled="true" class="inputs form-control" ng-model="lead.ACTIVIDAD" id="actividad"
                        ng-options="actividad.value as actividad.label for actividad in occupations"></select>
                </div>
            </div>
            <div
                ng-if="lead.ACTIVIDAD == 'EMPLEADO' || lead.ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA' || lead.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label class="labels" for="empresaNombre">Nombre de la empresa*</label>
                        <input class="inputs" type="text" id="empresaNombre" ng-model="lead.RAZON_SOC" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="labels" for="dirEmpresa">Dirección de la empresa*</label>
                        <input class="inputs" type="text" id="dirEmpresa" ng-model="lead.DIR_EMP" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="labels" for="telEmpresa">Teléfono de la empresa*</label>
                        <input class="inputs" id="telEmpresa" type="text" ng-model="lead.TEL_EMP"
                            validation-pattern="telephone" required />
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
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
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
                        <select class="inputs form-control select2bs4" ng-model="lead.TIPO_CONT" id="tipoCont"
                            ng-options="typeContract.value as typeContract.label for typeContract in typesContracts"></select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="labels" for="salario">Salario*</label>
                        <input class="inputs" id="salario" ng-currency fraction="0" type="text" ng-model="lead.SUELDO"
                            required />
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
                        <select class="form-control select2bs4 inputs" ng-model="lead.CAMARAC" id="CAMARAC">
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="ventaContado-label" for="RAZON_IND">Nombre de la empresa *</label>
                        <input class="form-control inputs" type="text" id="RAZON_IND" ng-model="lead.RAZON_IND"
                            required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="ventaContado-label" for="dirEmpresa">Dirección de la empresa*</label>
                        <input class="form-control inputs" type="text" id="dirEmpresa" ng-model="lead.DIR_EMP"
                            required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="ventaContado-label" for="dirEmpresa">Sector económico*</label>
                        <select class="inputs form-control" ng-model="lead.RAZON_IND" id="RAZON_IND">
                            <option value="" selected>Seleccione</option>
                            <option ng-repeat="(key, economicSector) in economicSectors"
                                value="@{{economicSector.name}}">
                                @{{economicSector.name}}</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="ventaContado-label" for="ACT_IND">Qué vendes o comercializas?
                            *</label>
                        <input class="form-control inputs" type="text" id="ACT_IND" ng-model="lead.ACT_IND" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label class="ventaContado-label" for="ACT_ECO">EPS*</label>
                        <input class="form-control inputs" type="text" id="ACT_ECO" ng-model="lead.ACT_ECO" required />
                    </div>
                    <div class="col-sm-12 col-md-4" ng-show="lead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO'">
                        <label class="ventaContado-label" for="FEC_CONST">¿Desde qué año desempeña la
                            actividad?*</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
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
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                ng-model="lead.FEC_CONST" id="FEC_CONST" ng-disabled="true" required
                                data-inputmask-inputformat="yyyy-mm" data-mask>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="ventaContado-label">Salario*</label>
                        <input class="form-control inputs" type="text" ng-model="lead.SUELDOIND" ng-currency
                            fraction="0" required />
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
                        <input class="form-control inputs" type="text" ng-model="lead.RAZON_SOC" id="RAZON_SOC"
                            required />
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label class="ventaContado-label">Fecha de Pensión*</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
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
                        <input class="form-control inputs" type="text" ng-model="lead.SUELDOIND" id="SUELDOIND"
                            ng-currency fraction="0" required />
                        <div class="alert alert-danger" role="alert" ng-show="showAlertSalary"
                            style="margin-top: 10px;">
                            El salario no puede ser menor a $100.000
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="ventaContado-label" for="ACT_ECO">EPS*</label>
                        <input class="form-control inputs" type="text" id="ACT_ECO" ng-model="lead.ACT_ECO" required />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label class="ventaContado-label" for="BANCOP">Banco*</label>
                        <select class="form-control inputs select2bs4" ng-model="lead.BANCOP" id="BANCOP"
                            ng-options="bank.value as bank.label for bank in banks" required></select>
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