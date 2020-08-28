<div class="card">
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

<div class="modal modalCardExist fade hide" data-backdrop="static" data-keyboard="false" id="validationCustomer"
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
                        {{-- <img src="{{ asset('images/asessors/logoModal.png') }}" alt="" class="img-fluid"> --}}
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