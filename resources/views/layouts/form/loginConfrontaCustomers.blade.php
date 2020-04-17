<div class="row ml-0 mr-0 mb-5 mt-5 d-flex justify-content-center">
    <div class="login-box">
        <div class="login-logo">
            <a class="text-decoration-none" style="font-size: 21px;"><b>Actualizar Número Telefónico</b></a>
        </div>
        <input type="text" id="notification" value="{{$notification}}" hidden>
        <div class="card border-0 shadow-lg">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Diligencie los siguientes datos</p>

                <form action="/change-customer-data" method="POST">
                    @csrf

                    <label for=" inputEmail4">Tipo de Identificación</label>
                    <div class="input-group mb-3">
                        <select class="custom-select" name="typeIdentification" required>
                            <option selected value="">Seleccione</option>
                            <option value="1">CÉDULA</option>
                            <option value="2">NIT</option>
                            <option value="3">CÉDULA DE EXTRANJERIA</option>
                            <option value="4">TARJETA DE IDENTIDAD</option>
                            <option value="5">PASAPORTE</option>
                            <option value="6">TARJETA SEGURO SOCIAL EXTRANJERO</option>
                            <option value="7">SOCIEDAD EXTRANJERA SIN NIT EN COLOMBIA </option>
                            <option value="8">FIDEICOMISO</option>
                            <option value="9">REGISTRO CIVIL</option>
                            <option value="10">CARNET DIPLOMÁTICO</option>
                        </select>
                    </div>
                    <label for="inputPassword4">Número de Identificación</label>
                    <div class="input-group mb-3">
                        <input type="text" name="numberIdentification" class="form-control" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-address-card"></span>
                            </div>
                        </div>
                    </div>
                    <label for="inputAddress">Fecha de Expedición</label>
                    <div class="input-group mb-4">
                        <input class="form-control" name="dateExpedition" type="date" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-calendar-day"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" value="1" required
                            class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required">
                        <label for="termsAndConditions" style="font-size: 10px; font-style: italic;">
                            Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition"
                                target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales"
                                class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
                        </label>
                    </div>
                    <div class="row d-flex justify-content-sm-end">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"
                                style="min-width: 100px;">Continuar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>