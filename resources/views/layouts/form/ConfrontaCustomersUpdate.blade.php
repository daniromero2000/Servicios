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
                        <h3 class="register-heading">Actualiza tu número de telefono</h3>
                        <div class="row register-form">
                            <div class="col-md-6">
                                <label for="inputPassword4">Número de Identificación <span
                                        class="color-red">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="numberIdentification" class="form-control border-right-0"
                                        required>
                                    <div class="input-group-append border-left-0 ">
                                        <div class="input-group-text bg-white">
                                            <span class="fas fa-address-card color-gray"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4">Número de Telefono Anterior <span
                                        class="color-red">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="oldNumberTelephone " class="form-control border-right-0"
                                        required>
                                    <div class="input-group-append border-left-0">
                                        <div class="input-group-text bg-white">
                                            <span class="fas fa-phone-alt color-gray"></span>
                                        </div>
                                    </div>
                                </div>
                                <label for="inputPassword4">Número de Telefono Nuevo <span
                                        class="color-red">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="newNumberTelephone" class="form-control border-right-0"
                                        required>
                                    <div class="input-group-append border-left-0">
                                        <div class="input-group-text bg-white">
                                            <span class="fas fa-phone-alt color-gray"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>