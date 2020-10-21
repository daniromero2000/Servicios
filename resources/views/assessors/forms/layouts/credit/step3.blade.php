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
                <div class="col-12 col-sm-4">
                    <label class="ventaContado-label" for="ciud_ubi2">Ciudad de sucursal*</label>
                    <select ng-disabled="true" class="inputs form-control" ng-model="lead.CIUD_UBI" id="ciud_ubi2"
                        ng-options="city.value as city.label for city in citiesUbi"></select>
                </div>
                <div class="col-12 col-sm-4">
                    <label for="TIPOV" class="labels">Tipo de vivienda</label>
                    <select class="inputs form-control select2bs4" ng-model="lead.TIPOV" id="TIPOV"
                        ng-options="housingType.value as housingType.label for housingType in housingTypes"
                        required></select>
                </div>
                <div class="col-12 col-sm-4">
                    <label for="TIEMPO_VIV" class="labels">Tiempo en vivienda</label>
                    <input type="text" class="inputs form-control" ng-model="lead.TIEMPO_VIV" id="TIEMPO_VIV" />
                </div>
            </div>
            <div class="row" ng-show="lead.TIPOV == 'ARRIENDO'">
                <div class="col-12 col-sm-4">
                    <label for="PROPIETARIO" class="labels">Propietario de la vivienda</label>
                    <input type="text" class="inputs form-control" ng-model="lead.PROPIETARIO" id="PROPIETARIO" />
                </div>
                <div class="col-12 col-sm-4">
                    <label for="TEL_PROP" class="labels">Teléfono del propietario</label>
                    <input type="text" class="inputs form-control" ng-model="lead.TEL_PROP" id="TEL_PROP" />
                </div>
                <div class="col-12 col-sm-4">
                    <label for="VRARRIENDO" class="labels">Valor del arriendo ($)</label>
                    <input type="text" class="inputs form-control" ng-model="lead.VRARRIENDO" id="VRARRIENDO" />
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-4">
                    <label for="DIRECCION" class="labels">Dirección</label>
                    <input type="text" class="inputs form-control" ng-model="lead.DIRECCION" id="DIRECCION" />
                </div>
                <div class="col-12 col-sm-4">
                    <label for="ESTRATO" class="labels">Tipo de población</label>
                    <select class="form-control inputs select2bs4" ng-model="lead.DIRECCION3" id="DIRECCION3" required>
                        <option value="" selected>Seleccione</option>
                        <option value="Sector urbano">Sector urbano</option>
                        <option value="Sector rural">Sector rural</option>
                    </select>
                </div>
                <div class="col-12 col-sm-4">
                    <label for="ESTRATO" class="labels">Estrato</label>
                    <select class="form-control inputs select2bs4" ng-model="lead.ESTRATO" id="ESTRATO"
                        ng-options="strat.value as strat.label for strat in stratum"></select>
                </div>

            </div>
            <div class="row form-group">
                <div class="col-12 col-sm-4">
                    <label for="TELFIJO" class="labels">Teléfono fijo</label>
                    <input type="text" class="form-control inputs" validation-pattern="telephoneReal"
                        ng-model="lead.TELFIJO" id="TELFIJO" />
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