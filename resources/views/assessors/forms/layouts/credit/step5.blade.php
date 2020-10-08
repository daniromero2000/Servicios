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
                                    <input type="text" class="inputs form-control" ng-model="lead.NOM_REFPER"
                                        id="NOM_REFPER" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="DIR_REFPER" class="labels">Dirección </label>
                                    <input type="text" class="inputs form-control" ng-model="lead.DIR_REFPER"
                                        id="DIR_REFPER" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="TEL_REFPER" class="labels">Teléfono*</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.TEL_REFPER"
                                        id="TEL_REFPER" required />
                                </div>
                            </div>
                            <h5 class="card-title">2. Referencia personal</h5>
                            <br>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label for="NOM_REFPE2" class="labels">Nombre*</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.NOM_REFPE2"
                                        id="NOM_REFPE2" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="DIR_REFPE2" class="labels">Dirección</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.DIR_REFPE2"
                                        id="DIR_REFPE2" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="TEL_REFPE2" class="labels">Teléfono*</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.TEL_REFPE2"
                                        id="TEL_REFPE2" required />
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
                                    <input type="text" class="inputs form-control" ng-model="lead.NOM_REFFAM"
                                        id="NOM_REFFAM" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="DIR_REFFAM" class="labels">Dirección</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.DIR_REFFAM"
                                        id="DIR_REFFAM" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label for="TEL_REFFAM" class="labels">Teléfono*</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.TEL_REFFAM"
                                        id="TEL_REFFAM" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="PARENTESCO" class="labels">Parentesco*</label>
                                    <select id="PARENTESCO" class="inputs form-control" ng-model="lead.PARENTESCO"
                                        ng-options="kinship.TIPO as kinship.TIPO for kinship in kinships"
                                        required></select>
                                </div>
                            </div>
                            <h5 class="card-title">2. Referencia familiar</h5>
                            <br>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label for="NOM_REFFA2" class="labels">Nombre*</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.NOM_REFFA2"
                                        id="NOM_REFFA2" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="DIR_REFFA2" class="labels">Dirección</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.DIR_REFFA2"
                                        id="DIR_REFFA2" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label for="TEL_REFFA2" class="labels">Teléfono*</label>
                                    <input type="text" class="inputs form-control" ng-model="lead.TEL_REFFA2"
                                        id="TEL_REFFA2" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="PARENTESC2" class="labels">Parentesco*</label>
                                    <select id="PARENTESC2" class="inputs form-control" ng-model="lead.PARENTESC2"
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
                    <button class="btn btn-primary" ng-disabled="disabledButtonSolic" type="submit">Continuar</button>
                </div>
            </div>
        </div>
    </div>
</form>