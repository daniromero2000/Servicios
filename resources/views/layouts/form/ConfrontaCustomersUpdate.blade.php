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
                        <form action="/change-customer-data/{{$customer->CEDULA}}" id="customerData" method="POST">
                            <div class="row register-form justify-content-center">
                                <input type="text" name="CEDULA" id="CEDULA" value="{{$customer->CEDULA}}" hidden>
                                <div class="col-12 col-sm-10 col-md-6">
                                    <label class="label-form" for="">Número de Teléfono <span
                                            class="color-red">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="CELULAR" id="CELULAR" value="{{$customer->CELULAR}}"
                                            class="form-control border-right-0 input-form" required>
                                        <div class="input-group-append border-left-0">
                                            <div class="input-group-text bg-white">
                                                <span class="fas fa-phone-alt color-gray"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-10 col-md-6">
                                    <label class="label-form" for="">Dirección de residencia <span
                                            class="color-red">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="DIRECCION" id="DIRECCION"
                                            value="{{$customer->DIRECCION}}"
                                            class="form-control border-right-0 input-form" required>
                                        <div class="input-group-append border-left-0 ">
                                            <div class="input-group-text bg-white">
                                                <span class="fas fa-address-card color-gray"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="label-form" for="">Email <span class="color-red">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="EMAIL" id="EMAIL" value="{{$customer->EMAIL}}"
                                            class="form-control border-right-0 input-form" required>
                                        <div class="input-group-append border-left-0 ">
                                            <div class="input-group-text bg-white">
                                                <span class="fas fa-address-card color-gray"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4 container-button-form">
                                        <a href="/change-customer-data" type="button"
                                            class="btn btn-secondary button-form mr-2">Regresar</a>
                                        <a id="confronta" class="btn btn-primary button-form text-white">Actualizar</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('layouts.modals.formConfronta')

                </div>
            </div>
        </div>
    </div>
</div>