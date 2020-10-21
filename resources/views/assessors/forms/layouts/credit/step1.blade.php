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
                    <input class="inputs" validation-pattern="IdentificationNumber" ng-blur="getValidationLead()"
                        type="text" ng-model="lead.CEDULA" id="CEDULA" required />
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
                    <input class="inputs" id="nombres" validation-pattern="name" ng-model="lead.NOMBRES" type="text"
                        required />
                </div>
                <div class="col-12 col-md-3">
                    <label class="labels" for="lastName">Apellidos*</label>
                    <input class="inputs" id="lastName" validation-pattern="name" type="text" ng-model="lead.APELLIDOS"
                        required />
                </div>
                <div class="col-12 col-md-3">
                    <label class="labels" for="email">Correo electrónico</label>
                    <input class="inputs" id="email" type="text" validation-pattern="email" ng-model="lead.EMAIL" />
                </div>
                <div class="col-12 col-md-3">
                    <div ng-hide="lead.CEL_VAL">
                        <label class="ventaContado-label">Celular*</label>
                        <input class="inputs" ng-blur="checkIfExistNum()" ng-model="lead.CELULAR"
                            validation-pattern="telephone" required />
                        <div class="alert alert-danger" role="alert" ng-show="showAlertCel" style="margin-top: 10px;">
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
                    <select class="inputs form-control select2bs4" ng-model="lead.CIUD_UBI" id="ciud_ubi"
                        ng-options="city.value as city.label for city in citiesUbi" ng-required="true"></select>
                    <div class="alert alert-danger" role="alert" ng-show="showAlertCiudUbi" style="margin-top: 10px;">
                        Debe seleccionar una ciudad
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <label class="ventaContado-label labels" for="actividad">Ocupación*</label>
                    <select class="inputs form-control select2bs4" ng-model="lead.ACTIVIDAD" id="actividad"
                        ng-options="actividad.value as actividad.label for actividad in occupations"></select>
                </div>
                <div class="col-12 col-md-4"
                    ng-show="lead.ACTIVIDAD == 'EMPLEADO' || lead.ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA' || lead.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'">
                    <label class="ventaContado-label labels" for="FEC_ING">Fecha de ingreso*</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" data-inputmask-alias="datetime" ng-model="lead.FEC_ING"
                            id="FEC_ING" data-inputmask-inputformat="yyyy-mm" data-mask>
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
                            ng-model="lead.FEC_CONST" id="FEC_CONST" data-inputmask-inputformat="yyyy-mm" data-mask>
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
                            ng-model="lead.FEC_CONST" id="dateCreationCompany" data-inputmask-inputformat="yyyy-mm"
                            data-mask>
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
                            ng-model="lead.FEC_CONST" id="FEC_CONSTpensionado" data-inputmask-inputformat="yyyy-mm"
                            data-mask>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary" ng-disabled="disabledButton">Continuar</button>
        </div>
        <div class="col-12 text-center mt-2">
            <p class="ventaContado-text">
                <i><a href="/change-customer-data" class="ventaContado-changeDataCustomer" target="_blank">Click
                        aquí</a> si desea actualizar los datos del cliente</i>
            </p>
        </div>
    </div>
</form>