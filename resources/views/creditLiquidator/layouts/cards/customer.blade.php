<div class="card">
    <div class="card-body">
        <div class="row mt-2">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Nombres</label>
                    <input class="form-control" id="nombres" readonly validation-pattern="name" ng-model="lead.NOMBRES"
                        type="text" required />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Apellidos</label>
                    <input class="form-control" id="lastName" readonly validation-pattern="name" type="text"
                        ng-model="lead.APELLIDOS" required />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Solicitud</label>
                    <input class="form-control" id="request" readonly validation-pattern="name" type="text"
                        ng-model="request.SOLICITUD" required />
                </div>
            </div>

            <div style=" position: absolute; top: 12px; right: 18px; ">
                <div class="ml-auto my-auto">
                    <button type="button" ng-disabled="!request.SOLICITUD" ng-click="addItem()"
                        class="btn btn-primary btn-sm">Agregar item</button>
                </div>
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
                            Liquidación <strong style="font-size:18px">@{{ numSolic }}</strong> creada
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