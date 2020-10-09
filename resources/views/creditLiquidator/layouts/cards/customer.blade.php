<div class="card" id="focusedItem">
    <div class="card-body" style="display: block;">
        <div class="row py-3">
            <div class="text-gray px-4">
                <b>Solicitud:</b> @{{ request.SOLICITUD }}
            </div>
            <div class="text-gray px-4">
                <b>Cliente:</b> @{{ lead.NOMBRES }} @{{ lead.APELLIDOS }}
            </div>
            <div class="text-gray px-4">
                <b>Tipo de crédito:</b> @{{ lead.latest_intention.CREDIT_DECISION }}
            </div>
            <div ng-if="lead.latest_intention.CREDIT_DECISION == 'Tarjeta Oportuya'" class="text-gray px-4">
                <b>Tipo de tarjeta:</b> @{{ lead.latest_intention.TARJETA }}
            </div>
            <div class="text-gray px-4">
                <b>Definición:</b> @{{ lead.latest_intention.definition.DESCRIPCION }}
            </div>
        </div>
    </div>
    <div style=" position: absolute; top: 12px; right: 18px; ">
        <div class="ml-auto my-auto">
            <button type="button" ng-disabled="!request.SOLICITUD" ng-click="addItem()"
                class="btn btn-primary btn-sm">Agregar item</button>
        </div>
    </div>

</div>

<div id="list-quotations" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="row resetRow">
                    <div class="col-12 text-center py-3">
                        <img style="width: 250px;" src="{{ asset('images/oportunidades.png')}}">
                    </div>
                    <p style="font-weight: bold;font-size: 84%;margin: auto;padding-bottom: 2%;text-align: center;">
                        <i>* Actualmente cuentas con las siguientes cotizaciones, puedes seleccionar con las que deseas
                            continuar.</i>
                    </p>
                </div>
                <div class="row justify-content-center">
                    <div ng-repeat="(key2, quotation) in quotations"
                        class="col-12 col-sm-6 col-lg-4 d-flex align-items-stretch" ng-if="quotation.total > 0 && quotation.state != 1">
                        <div class="card bg-light w-100">
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="lead mt-3"><b>Total: </b> @{{ quotation.total | currency }}</b></h2>
                                        <ul class="ml-4 mb-0 fa-ul text-muted"
                                            ng-repeat="(key3, item) in quotation.quotation_values">
                                            <div class="form-check text-right">
                                                <input class="form-check-input" name="itemsValue[]" value="@{{item}}"
                                                    type="checkbox">
                                                <label class="form-check-label"></label>
                                            </div>
                                            <li class="small mb-1"><span class="fa-li">
                                                    <i class="fas fa-barcode"></i></span> Código:
                                                @{{ item.sku }}</li>
                                            <li class="small mb-1"><span class="fa-li">
                                                    <i class="fas fa-shopping-cart"></i></span> Producto:
                                                @{{ item.article }}</li>
                                            <li class="small mb-1"><span class="fa-li">
                                                    <i class="fas fa-list"></i></span> Lista:
                                                @{{ item.list }}</li>
                                            <li class="small mb-1"><span class="fa-li">
                                                    <i class="far fa-caret-square-right"></i></span> Cantidad:
                                                @{{ item.quantity }}</li>
                                            <div class="dropdown-divider"></div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="ml-auto btn btn-primary" ng-click="addItemForQuotation()"
                    style=" float: right; ">Continuar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modalCardExist fade hide" data-backdrop="static" data-keyboard="false" id="validationCustomer"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modalCardContent">
            <div class="modal-body modalStepsBody " style="padding: 0">
                <div class="row resetRow">
                    <div class="col-12 text-center pt-4 pb-3">
                        <img style="width: 250px;" src="{{ asset('images/oportunidades.png')}}">
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
                                <p ng-bind-html="messageValidationLead" style=" padding: 20px; ">
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

<div class="modal fade modalThankYouPage-asessors hide" data-backdrop="static" data-keyboard="false"
    id="congratulations" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body " style="padding: 0">
                <div class="row resetRow">
                    <div class="col-12 text-center resetCol mt-4 headThankYuoModal">
                        <img style="width: 250px;" src="{{ asset('images/oportunidades.png')}}">
                    </div>
                </div>
                <div class="row mt-2 resetRow">
                    <div class="col-12 text-center containTextThankYouModal">
                        <img src="https://image.flaticon.com/icons/svg/845/845646.svg" alt=""
                            style=" width: 11%;margin-top: 1%;margin-right: 0%;margin-bottom: 1%;" />
                        <p class="textTnakYouModal">
                            La liquidación para la solicitud <strong
                                style="font-size:18px">@{{ request.SOLICITUD }}</strong> fue creada
                            exitosamente,
                            <br>
                            procede en <strong>OPORTUDATA</strong> a terminar el proceso de crédito.
                        </p>
                    </div>
                </div>
                <div class="row mx-0 my-3 text-center">
                    <a href="/Administrator/dashboard" class="btn btn-primary mx-auto">Terminar</a>
                </div>
            </div>
        </div>
    </div>
</div>