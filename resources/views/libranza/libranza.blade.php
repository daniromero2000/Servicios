<div id="creoToServicios">
    <img src="{{ asset('images/alianza-creo-oportunidades.jpg') }}" alt="Creo to Servicios" class="img-fluid" />
</div>

<div id="formularioSimulador">
    <div class="formularioSimulador-container">
        <div class="row resetRow">
            <div class="col-12 col-md-12 col-lg-4 resetCol">
                <h2 class="formularioSimulador-title text-center"><strong>Libranza</strong> para pensionados, docentes y militartes</h2>
                <p class="formularioSimulador-textPrincipal text-justify">
                Con nuestro simulador puedes calcular el monto y plazo que se ajuste a tus necesidades y estarás  un paso más cerca de realizar tus sueños. Te invitamos para que dejes tus datos antes de simular tu crédito y uno de nuestros asesores se comunicará contigo para acompañarte en el proceso de aprobación.
                </p>
                <p class="formularioSimulador-textPrincipal text-justify">
                El cupo y cuota del crédito, producto de esta simulación, son aproximados e informativos y podrán variar de acuerdo a las políticas de financiación y de crédito vigentes al momento de su estudio y aprobación.
                </p>
            </div>

            <div class="formularioSimulador-containerFormulario">
                <h3 class="formularioSimulador-titleForm">
                    <img src="{{ asset('images/libranza-formularioPesos.png') }}" alt="Simula tu crédito" class="img-fluid formularioSimulador-imgPesos">
                    Déjanos tus datos
                </h3>
                <div class="containerFormulario">
                    <form ng-submit="addLead()" id="formEx">
                        <input type="hidden" ng.model="libranza.typeService" value="libranza">
                        <input type="hidden" ng.model="libranza.channel" value="1">
                        <div class="formularioSimulador-containInput">
                            <label class="formularioSimulador-labelFormulario" for="name">Nombres</label>
                                    <input id="creditLine" type="text" ng-model="libranza.name" class="form-control" id="name" validation-pattern="name" required="true" />
                        </div>
                        <div class="formularioSimulador-containInput">
                            <label for="customerType" class="formularioSimulador-labelFormulario"id="lastName">Apellidos</label>
                            <input type="text" ng-model="libranza.lastName" class="form-control" id="lastName" validation-pattern="name" />
                        </div>
                        
                        <div class="formularioSimulador-containInput">
                            <label class="formularioSimulador-labelFormulario" for="email">Correo electrónico</label>
                            <input type="email" ng-model="libranza.email" class="form-control" id="email" validation-pattern="email" required="true" />
                        </div>

                        <div class="formularioSimulador-containInput">
                            <label class="formularioSimulador-labelFormulario"  for="telephone">Teléfono</label>
                                    <input type="text" ng-model="libranza.telephone" class="form-control" id="telephone" validation-pattern="telephone" required="true" />
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="formularioSimulador-containInput">
                                    <label class="formularioSimulador-labelFormulario" for="city">Ciudad</label>
                                            <select class="form-control" id="city" ng-model="libranza.city" ng-options="city.city as city.city for city in cities" ng-required="true"></select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="formularioSimulador-containInput">
                                    <label class="formularioSimulador-labelFormulario" for="city">Que te interesa</label>
                                            <select class="form-control" id="city" ng-model="libranza.typeProduct" ng-options="product.value as product.label for product in typeProducts" required="true" ></select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        <input type="checkbox" ng-model="libranza.termsAndConditions" id="termsAndConditions" ng-true-value="1" ng-false-value="0" required>
                        <label for="termsAndConditions" style="font-size: 13px; font-style: italic;">
                            Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
                        </label>
                    </div>
                    <p class="textCityForm">
                        *Válido solo para ciudades que se desplieguen en la casilla.
                    </p>
                        <div class="formularioSimulador-containInput text-center">
                            <button type="submit" class="btn buttonSend formularioSimulador-buttonForm" style="margin-top: 15px;">Siguiente</button>
                        </div>
                    </form>
                </div>
            </div>





         <!--   <div class="formularioSimulador-containerFormulario">
                <h3 class="formularioSimulador-titleForm">
                    <img src="{{ asset('images/libranza-formularioPesos.png') }}" alt="Simula tu crédito" class="img-fluid formularioSimulador-imgPesos">
                    Simula tu crédito
                </h3>
                <div class="containerFormulario">
                    <form ng-submit="simular()" id="formEx">
                        <div class="formularioSimulador-containInput">
                            <label class="formularioSimulador-labelFormulario" for="creditLine">Linea de Crédito :</label>
                            <select id="creditLine" class="form-control" ng-model="libranza.creditLine" ng-options="linea.id as linea.name for linea in lines" required="true" ></select>
                        </div>
                        <div class="formularioSimulador-containInput">
                            <label for="customerType" class="formularioSimulador-labelFormulario">Tipo de Cliente :</label>
                            <select class="form-control" id="customerType" ng-model="libranza.customerType" ng-options="tipo.id as tipo.name for tipo in libranzaProfiles" ng-change="selectPagaduria()" required="true" ></select>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2">
                                <div class="formularioSimulador-containInput">
                                    <label for="age" class="formularioSimulador-labelFormulario">Edad :</label>
                                    <input type="number" class="form-control" min="1" max="127" validation-pattern="number" id="age" ng-model="libranza.age" ng-blur="calculateData()" validate="age" ng-change="validateInt()" required="true" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-10">
                                <div class="formularioSimulador-containInput">
                                    <label class="formularioSimulador-labelFormulario" for="pagaduria">Pagaduría : <span class="text-small">*Selecciona  tu administrador de pensión y/o empleador</span></label>
                                    <select id="pagaduria" class="form-control" ng-model="libranza.pagaduria" ng-options="pagaduriaItem.id as pagaduriaItem.name for pagaduriaItem in pagaduriaLibranza"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="formularioSimulador-containInput">
                                    <label for="salary" class="formularioSimulador-labelFormulario">Salario Básico :</label>
                                    <input type="number" id="salary" class="form-control" validation-pattern="number" ng-model="libranza.salary" ng-blur="calculateData()" ng-change="validateInt()" required="true" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="formularioSimulador-containInput">
                                    <label for="lawDesc" class="formularioSimulador-labelFormulario">Descuentos de ley :</label>
                                    <input type="text" id="lawDesc" class="form-control" validation-pattern="number" ng-model="libranza.lawDesc" ng-disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="formularioSimulador-containInput">
                            <label for="otherDesc" class="formularioSimulador-labelFormulario">Otros Descuentos :</label>
                            <input type="number" id="otherDesc" class="form-control" ng-model="libranza.otherDesc" validation-pattern="number" ng-blur="calculateData()" ng-change="validateInt()" />
                        </div>
                        <div class="formularioSimulador-containInput">
                            <input type="hidden" id="segMargen" class="form-control" ng-model="libranza.segMargen">
                        </div>
                        <div class="formularioSimulador-containInput" ng-if="libranza.creditLine == 'Libre inversion + Compra de cartera'">
                            <label for="quotaBuy" class="formularioSimulador-labelFormulario">Valor Cuota Compra :</label>
                            <input type="number" validation-pattern="number" id="quotaBuy" class="form-control" ng-model="libranza.quotaBuy" ng-blur="calculateData()" ng-change="validateInt()" />
                        </div>
                        <div class="formularioSimulador-containInput text-center">
                            <button type="submit" class="btn buttonSend formularioSimulador-buttonForm" style="margin-top: 15px;">Simular</button>
                        </div>
                    </form>
                </div>
            </div>-->
        </div>
    </div>
    <div class="row resetRow">
        
    </div>
</div>

<div id="credibilidad">
    <div class="container">
        <h2 class="credibilidad-title text-center">Experiencia <strong>Credibilidad</strong></h2>
        <div class="row">
            <div class="col-md-12 col-lg-4 text-center">
                <img src="{{ asset('images/libranza-experienciaMapa.png') }}" alt="" class="img-fluid credibilidad-img">
                <p class="credibilidad-text ">
                    56 puntos de atención  <br>
                    al público
                </p>
            </div>
            <div class="col-md-12 col-lg-4 text-center">
                <img src="{{ asset('images/libranza-experienciaAliados.png') }}" alt="" class="img-fluid credibilidad-img">
                <p class="credibilidad-text ">
                    Más de 40 Aliados estratégicos <br>
                    en todo el territorio nacional
                </p>
            </div>
            <div class="col-md-12 col-lg-4 text-center">
                <img src="{{ asset('images/libranza-experienciaClientes.png') }}" alt="" class="img-fluid credibilidad-img">
                <p class="credibilidad-text ">
                    Más de 500.000 clientes <br>
                    atendidos en los últimos 5 años
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade hide" id="negacionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body simularModal-modalBody">
                <div class="row resetRow">
                    <i class="fas fa-times cursor formularioSimulador-closeModal" data-dismiss="modal"></i>
                    <div class="col-12 text-center form-group">
                        <h3 class="formularioSimulador-title"><strong>Capacidad de endeudamiento insuficiente</strong></h3>
                        <br>
                    </div>
                </div>
                <div class="text-justify textModalSimular">
                    Lastimosamente no cuentas con la capacidad de endeudamiento necesaria para obtener crédito con nosotros. Gracias por preferirnos!
                </div>
                <div class="row">
                    <div class="col-12 text-center" style="padding: 20px 0">
                        <a href="https://api.whatsapp.com/send?phone=573105216830&amp;text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza" class="creditoLibranza-buttonWhatsAppmodal" target="_blank" tabindex="0">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade hide" id="simularModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body simularModal-modalBody">
                <div class="row resetRow">
                    <i class="fas fa-times cursor formularioSimulador-closeModal" data-dismiss="modal"></i>
                    <div class="col-12 text-center form-group">
                        <h3 class="formularioSimulador-title"><strong>Cuota del crédito</strong></h3>
                        <br>
                        <span class="simularModal-quaotaAvailable">$ @{{ libranza.quaotaAvailable | number:0 }}</span>
                    </div>
                    <div class="col-12 text-center form-group text-center">
                        <button class="btn formularioSimulador-buttonForm" ng-click="solicitar()">Solicitar</button>
                    </div>
                </div>
                <div class="text-center row selected-row" ng-if="plazoSelected.amount != '' || plazoSelected.timeLimit != ''">
                    <div class="col-12 col-sm-6">
                        <p>
                            Monto seleccionado:
                            <br> 
                            <span>@{{plazoSelected.amount}}</span>
                        </p>
                    </div>
                    <div class="col-12 col-sm-6">
                        <p>
                            Plazo seleccionado:
                            <br> 
                            <span>@{{plazoSelected.timeLimit}}</span>
                        </p>
                    </div>

                </div>
                <div class="table">
                    <table class="table table-hover">
                        <thead class="simularModal-thead">
                            <tr>
                                <td class="col-sm-8">Cupo máximo aprobado según plazo</td>
                                <td class="col-sm-4">Plazo</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr ng-repeat="plazo in plazos" class="cursor" ng-if="libranza.creditLine==4" ng-click="setPlazo(plazo.amount,plazo.timeLimit.timeLimit)">
                                <td ng-if="plazo.timeLimit.timeLimit <=60">$@{{ plazo.amount | number:0 }}</td>
                                <td ng-if="plazo.timeLimit.timeLimit <=60" >@{{ plazo.timeLimit.timeLimit }}</td>
                            </tr>
                            <tr ng-repeat="plazo in plazos" class="cursor" ng-if="libranza.creditLine!=4" ng-click="setPlazo(plazo.amount,plazo.timeLimit.timeLimit)">
                                <td>$@{{ plazo.amount | number:0 }}</td>
                                <td>@{{ plazo.timeLimit.timeLimit }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="text-justify textModalSimular">
                    *El cupo y cuota del crédito, producto de esta simulación, son aproximados e informativos y podrán variar de acuerdo a las políticas de financiación y de crédito vigentes al momento de su estudio y aprobación por parte de Lagobo.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modalFormulario fade hide" id="solicitarModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modalFormulario-body">
                <div class="modal-containerFormulario">
                    <h3 class="formularioSimulador-titleForm">
                        <img src="{{ asset('images/libranza-formularioPesos.png') }}" alt="Simula tu crédito" class="img-fluid formularioSimulador-imgPesos">
                            Simula tu crédito
                    </h3>
                    <div class="containerFormulario">
                        <form ng-submit="showModal()" id="formEx">
                            <div class="formularioSimulador-containInput">
                                <label class="formularioSimulador-labelFormulario" for="creditLine">Linea de Crédito :</label>
                                <select id="creditLine" class="form-control" ng-blur="ableField()" ng-model="libranza.creditLine" ng-options="linea.id as linea.name for linea in lines" required="true" ></select>
                            </div>
                            <div class="formularioSimulador-containInput">
                                <label for="customerType" class="formularioSimulador-labelFormulario">Tipo de Cliente :</label>
                                <select class="form-control" id="customerType" ng-model="libranza.customerType" ng-options="tipo.id as tipo.name for tipo in libranzaProfiles" ng-change="selectPagaduria()" required="true" ></select>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-2">
                                    <div class="formularioSimulador-containInput">
                                        <label for="age" class="formularioSimulador-labelFormulario">Edad :</label>
                                        <input type="number" class="form-control" min="1" max="127" validation-pattern="number" id="age" ng-model="libranza.age" ng-blur="calculateData()" validate="age" ng-change="validateInt()" required="true" />
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-10">
                                    <div class="formularioSimulador-containInput">
                                        <label class="formularioSimulador-labelFormulario" for="pagaduria">Pagaduría : <span class="text-small">*Selecciona  tu administrador de pensión y/o empleador</span></label>
                                        <select id="pagaduria" class="form-control" ng-model="libranza.pagaduria" ng-options="pagaduriaItem.id as pagaduriaItem.name for pagaduriaItem in pagaduriaLibranza"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="formularioSimulador-containInput">
                                        <label for="salary" class="formularioSimulador-labelFormulario">Salario Básico :</label>
                                        <input type="number" id="salary" class="form-control" validation-pattern="number" ng-model="libranza.salary" ng-blur="calculateData()" ng-change="validateInt()" required="true" />
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="formularioSimulador-containInput">
                                        <label for="lawDesc" class="formularioSimulador-labelFormulario">Descuentos de ley :</label>
                                        <input type="text" id="lawDesc" class="form-control" validation-pattern="number" ng-model="libranza.lawDesc" ng-disabled="true" />
                                    </div>
                                </div>
                            </div>
                            <div class="formularioSimulador-containInput" ng-if="!quotaBuy">
                                <label for="otherDesc" class="formularioSimulador-labelFormulario">Otros Descuentos :</label>
                                <input type="number" id="otherDesc" class="form-control" ng-model="libranza.otherDesc" validation-pattern="number" ng-blur="calculateData()" ng-change="validateInt()" />
                            </div>
                            <div class="row" ng-if="quotaBuy">
                                <div class="col-sm-12 col-md-6">
                                    <div class="formularioSimulador-containInput">
                                        <label for="otherDesc" class="formularioSimulador-labelFormulario">Otros Descuentos :</label>
                                    <input type="number" id="otherDesc" class="form-control" ng-model="libranza.otherDesc" validation-pattern="number" ng-blur="calculateData()" ng-change="validateInt()" />
                                </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="formularioSimulador-containInput">
                                        <label for="quotaBuy" class="formularioSimulador-labelFormulario">Valor Cuota Compra :</label>
                                        <input type="number" validation-pattern="number" id="quotaBuy" class="form-control" ng-model="libranza.quotaBuy" ng-blur="calculateData()" ng-change="validateInt()" />
                                    </div>
                                </div>
                            </div>
                            <div class="formularioSimulador-containInput">
                                <input type="hidden" id="segMargen" class="form-control" ng-model="libranza.segMargen">
                            </div>
                            <div class="formularioSimulador-containInput text-center">
                                <button type="submit" class="btn buttonSend formularioSimulador-buttonForm" style="margin-top: 15px;">Simular</button>
                            </div>
                        </form>
                    </div>                          
                </div>
            </div>
        </div>
    </div>
</div>


<!--<div class="modal modalFormulario fade hide" id="solicitarModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modalFormulario-body">
                <div class="modal-containerFormulario">
                    <h3 class="modal-titleForm titleForm-libranza">
                        Crédito Libranza
                    </h3>
                    <form role="form" ng-submit="addLead()" id="saveLead">
                    <div class="form-group">
                        <label class="control-label modalLabelForm" for="name">Nombres</label>
                        <input type="text" ng-model="libranza.name" class="form-control" id="name" validation-pattern="name" required="true" />
                    </div>
                    <input type="hidden" ng.model="libranza.typeService" value="libranza">
                    <input type="hidden" ng.model="libranza.channel" value="1">
                    <div class="form-group">
                        <label class="control-label modalLabelForm" id="lastName">Apellidos</label>
                        <input type="text" ng-model="libranza.lastName" class="form-control" id="lastName" validation-pattern="name" />
                    </div>
                    <div class="form-group">
                        <label class="control-label modalLabelForm" for="email">Correo electrónico</label>
                        <input type="email" ng-model="libranza.email" class="form-control" id="email" validation-pattern="email" required="true" />
                    </div>
                    <div class="form-group">
                        <label class="control-label modalLabelForm" for="telephone">Teléfono</label>
                        <input type="text" ng-model="libranza.telephone" class="form-control" id="telephone" validation-pattern="telephone" required="true" />
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label modalLabelForm" for="city">Ciudad</label>
                                <select class="form-control" id="city" ng-model="libranza.city" ng-options="city.value as city.label for city in cities" required="true" ></select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label modalLabelForm" for="city">Que te interesa</label>
                                <select class="form-control" id="city" ng-model="libranza.typeProduct" ng-options="product.value as product.label for product in typeProducts" required="true" ></select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" ng-model="libranza.termsAndConditions" id="termsAndConditions" ng-true-value="1" ng-false-value="0" required>
                        <label for="termsAndConditions" style="font-size: 13px; font-style: italic;">
                            Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
                        </label>
                    </div>
                    <p class="textCityForm">
                        *Válido solo para ciudades que se desplieguen en la casilla.
                    </p>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
                            Guardar
                        </button>
                        <button type="button" class=" btn btn-danger buttonFormModal" data-dismiss="modal" aria-label="Close">
                            Cerrar
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>-->