<div class=" register mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3 register-left">
                <img src="https://image.flaticon.com/icons/svg/1077/1077012.svg" alt="" />
                <h3>Bienvenido</h3>
                <p style="font-weight: normal;"> {{$customer->NOMBRES}} {{$customer->APELLIDOS}} </p>
            </div>
            <div class="col-md-9 register-right bg-white">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Actualiza tus Datos</h3>
                        <form action="/testConfronta/{{$customer->CEDULA}}" id="customerData" method="POST">
                            <div class="row register-form">
                                <input type="text" name="CEDULA" id="CEDULA" value="{{$customer->CEDULA}}" hidden>
                                <div class="col-md-6">
                                    <label for="">Número de Telefono <span class="color-red">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="CELULAR" id="CELULAR" value="{{$customer->CELULAR}}"
                                            class="form-control border-right-0" required>
                                        <div class="input-group-append border-left-0">
                                            <div class="input-group-text bg-white">
                                                <span class="fas fa-phone-alt color-gray"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Dirección de residencia <span class="color-red">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="DIRECCION" id="DIRECCION"
                                            value="{{$customer->DIRECCION}}" class="form-control border-right-0"
                                            required>
                                        <div class="input-group-append border-left-0 ">
                                            <div class="input-group-text bg-white">
                                                <span class="fas fa-address-card color-gray"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="">Email <span class="color-red">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="EMAIL" id="EMAIL" value="{{$customer->EMAIL}}"
                                            class="form-control border-right-0" required>
                                        <div class="input-group-append border-left-0 ">
                                            <div class="input-group-text bg-white">
                                                <span class="fas fa-address-card color-gray"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4">
                                        <a href="/testConfronta" type="button"
                                            class="btn btn-secondary mr-2">Regresar</a>
                                        <a id="confronta" class="btn btn-primary text-white">Actualizar</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- <button type="button" id="timer"> hola</button> --}}
                    </div>

                    <div id="confrontaCustomer" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog"
                        aria-labelledby="confrontaCustomer-title" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confrontaCustomer-title">Preguntas de Seguridad</h5>
                                    <div id="timer" style="position: absolute;right: 4%;top: 0.7%;"></div>
                                </div>
                                <div class="modal-body text-center" id="response">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <br>
                                    <span>Cargando...</span>
                                </div>
                                <div class="modal-footer">
                                    <div class="row ">
                                        <div class="col-4">
                                            <button id="confrontaForm" class="btn btn-primary text-white"
                                                type="submit">Enviar</button>
                                            <button id="updateData" class="btn btn-primary text-white"
                                                type="submit">Actualizar</button>
                                            <a id="updateDataFailed" href=" javascript:location.reload()"
                                                class="btn btn-secondary text-white">Reitentar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>