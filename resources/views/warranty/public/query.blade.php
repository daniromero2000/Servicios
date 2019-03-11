    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view of the Warranty Request
    **Date: 05/03/2019
     -->

<div Class="contentGarantias">
    <div class="row resetRow">
        <div class="logoHeaderWarranty">
            <img src="{{ asset('images/warranty-oportunidades.png') }}" class="img-fluid" alt="Oportuya" />
        </div>
        <div class="align-self-center ml-auto conditions">
            <a href="{{  route('TermsAndConditions') }}" class="align-middle warrantyLegal">Términos y condiciones</a>
        </div>
        <div class="col-12 conatiner-imgAnalista">
            <img src="{{ asset('images/analistaGarantiaDigital.png') }}"  alt="" class="img-fluid imgAnalista" />
        </div>
        <div class="stepBystep">
            <span><strong>Reclamación de Garantía</strong></span>
        </div>
    </div>
    <div class="row resetRow">
        <div class="col-12 containTitle">
            <h2 class="text-center titleAnalista"><strong>Hola!</strong> soy Marcela tu asesora digital</h2>
            <p class="text-center textAnalista">En este momento te encuentras haciendo tu reclamación de garantía, por favor diligencia <br>todos los datos para que la gestión sea más fácil</p>
            <h3 class="text-analyst text-center">Solo te tomará unos minutos solicitar tu Garantía</h3>
        </div>
    </div>
    <div class="Garantia-containerForm">
        <div class="row resetRow">
            <div class="descriptionStep">
                <strong>Información básica</strong><br>
                <span class="descText">Ingresa tus datos personales</span>
                <img src="{{ asset('images/datosPersonales-min.png') }}" class="img-fluid forms-descImg" />
                <span class="descStepNum">1</span>
            </div>
        </div>
        <form ng-submit="sendRequest()">
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="identificationNumber"> Número de identificación*</label>
                    <input class="form-control warrantyInputs WarrantyInputText" type="text" validation-pattern="IdentificationNumber" ng-model="WarrantyRequest.identificationNumber" id="identificationNumber" required="" placeholder="Número de identificación titular de la factura"/>
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="clientName"> Nombre*</label>
                    <input class="form-control warrantyInputs WarrantyInputText" type="text"  ng-model="WarrantyRequest.clientName" id="clientName" required validation-pattern="textOnly" placeholder="Nombre titular de la factura"/>
                </div>           
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="typeRequestes">Tipo de reclamación*</label>
                    <select required class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.type" id="typeRequestes"  ng-options="typeRequest.name for typeRequest in typeRequestes">
                        <option></option>
                    </select>                
                </div>
            </div>
            <div class="row resetRow">
                <div class="descriptionStep">
                    <strong>Información del producto</strong><br>
                    <span class="descText">Ingresa la descripción de tu producto</span>
                    <img src="{{ asset('images/datosPersonales2-min.png') }}" class="img-fluid forms-descImg" />
                    <span class="descStepNum">2</span>
                </div>
            </div>
            <div class="warranty-info">
                <p>Señor usuario si requiere garantía para varios productos, por favor realice el trámite para cada uno.</p>
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="product">Producto*</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.product" id="product" required ng-options="product.name for product in products">
                        <option></option>
                    </select>                
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="brand">Marca*</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.brand" id="brand" required ng-options="brand.name for brand in brands">
                        <option></option>
                    </select>               
                </div>               
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="reference"> Referencia*</label>
                    <input class="form-control warrantyInputs WarrantyInputText" type="text"  ng-model="WarrantyRequest.reference" id="reference" required="" placeholder="Puedes proporcionar una aproximación"/>
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                    <div class="row resetRow">
                        <div class="form-group col-3">
                            <label for="date"> Fecha de compra*</label>
                        </div>
                        <div class="form-group col-3">
                            <label for="day">Día</label>
                            <input class="form-control warrantyInputs inputSelect" type="number" ng-model="WarrantyRequest.day" id="day" required="" min="1" max="31"></select>
                        </div>
                        <div class="form-group col-3">
                            <label for="month">Mes</label>
                            <input class="form-control warrantyInputs inputSelect" type="number" ng-model="WarrantyRequest.month" id="month" required="" min="1" max="12"></select>
                        </div>
                        <div class="form-group col-3">
                            <label for="year">Año</label>
                            <input class="form-control warrantyInputs inputSelect" type="number" ng-model="WarrantyRequest.year" id="year" required="" min="2010" max="2019"></select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="invoiceNumber">Numero de factura (opcional)</label>
                    <input class="form-control warrantyInputs inputSelect" type="text" ng-model="WarrantyRequest.invoiceNumber" id="invoiceNumber">                        
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="meansSale">Medio de compra*</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.meansSale" id="meansSale" required ng-options="meansSale.id as meansSale.name for meansSale in meansSales">
                        <option></option>
                    </select>               
                </div>               
            </div>
            <div class="row resetRow" ng-if="WarrantyRequest.meansSale == 5 ">
                <div class="col-12 col-sm-6 form-group">
                    <label for="departamento">Departamento *</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.departamento" id="departamento" required ng-options="departamento as departamento.name for departamento in departamentos">
                        <option></option>
                    </select>               
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="city">ciudad *</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.city" id="city" required ng-options="city as city.name for city in cities">
                        <option></option>
                    </select>               
                </div>               
            </div>
            <div class="row resetRow" ng-if="WarrantyRequest.meansSale == 5">
                <div class="col-12 col-sm-6 form-group">
                    <label for="store">Tienda *</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.store" id="store" required>              
                        <option value="@{{store}}" ng-repeat="store in stores">@{{store}}</option>
                    </select>              
                </div>             
            </div>
            <div class="row resetRow">
                <div class="col-12 form-group">
                    <label for="fault">Descripción de la falla *</label>
                    <textarea id="fault" rows="3" class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.faultDescription" required></textarea>               
                </div>               
            </div>
            <div class="row resetRow">
                <div class="descriptionStep">
                    <strong>Información de ubicación </strong><br>
                    <span class="descText">Ingresa tus datos de ubicación y de contacto</span>
                    <img src="{{ asset('images/datosPersonales2-min.png') }}" class="img-fluid forms-descImg" />
                    <span class="descStepNum">3</span>
                </div>
            </div>
            <div class="row resetRow">
                <div class="col-12 form-group">
                    <label for="Yes">¿El usuario del producto es el titular de la cuenta? *</label>            
                </div>
                <div class="form-check isUserCheck">
                    <input class="form-check-input" ng-model="isUser"  name="isuser" type="radio"  id="yes"  value="True" checked required>
                    <label class="form-check-label" for="exampleRadios1">Si</label>
                </div>
                <div class="form-check isUserCheck">
                    <input class="form-check-input" ng-model="isUser"   name="isuser" type="radio" id="yes" value="False" required>
                    <label class="form-check-label" for="exampleRadios2">No</label>
                </div>               
            </div>
            <div class="row resetRow" ng-if="isUser == 'False'">
                <div class="col-12 col-sm-6 form-group">
                    <label for="userName">Nombre del Usuario*</label>
                    <input class="form-control warrantyInputs inputSelect" type="Text" ng-model="WarrantyRequest.userName" id="userName" validation-pattern="textOnly" required>                   
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="city">Relación *</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.relationship" id="relationship" ng-options="relationship.id as relationship.name for relationship in relations" required>
                        <option></option>
                    </select>               
                </div>               
            </div>
            <div class="row resetRow" >
                <div class="col-12 col-sm-9 col-md-6 form-group">
                    <div class="row" >
                        <div class="col-11 form-group" ng-repeat="phone in WarrantyRequest.phones">
                            <div class="row resetRow ">
                                <div class="col-11 form-group "> 
                                    <label for="phone">Teléfono*</label>
                                    <input class="form-control warrantyInputs inputSelect" type="text" ng-model="phone.number" id="phone" validation-pattern="telephone" required>
                                </div>
                                <div class="col-1 form-group align-self-end deletePhoneContainer resetCol">
                                    <button type="button" class="btn btn-danger deletePhone"  ng-click="WarrantyRequest.phones.splice($index,1)" ng-if="!$first"><i class="fas fa-minus"></i></button> 
                                </div> 
                            </div>
                                              
                        </div>
                        <div class="col-1 form-group align-self-end addPhoneContainer">
                            <button type="button" class="btn btn-success addPhone"  ng-click="WarrantyRequest.phones.push({number:null})" ><i class="fas fa-plus"></i></button> 
                        </div> 
                    </div>
                </div>             
            </div>
            <div class="alert alert-danger" role="alert" ng-if="validEmail">
                Los campos de correo electrónico y confirmación deben coincidir 
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="email">Correo electrónico*</label>
                    <input class="form-control warrantyInputs inputSelect" type="text" ng-model="WarrantyRequest.email" id="email"  validation-pattern="email" required>                   
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="confirmEmail">Confirma tu correo electrónico</label>
                    <input class="form-control warrantyInputs inputSelect" type="text" ng-model="WarrantyRequest.confirmEmail" id="confirmEmail" >                   
                </div>             
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="address">Dirección (Donde se encuentra ubicado el producto) *</label>
                    <input class="form-control warrantyInputs inputSelect" type="text" ng-model="WarrantyRequest.address" id="address" required>                   
                </div>             
            </div>
            <div class="row justify-content-center resetRow">
                <button type="submit" class="btn btn-primary sendRequest"  >Enviar</button> 
            </div> 
        </form>
    </div>
</div>

<!-- Valid request Modal -->
<div class="modal fade" id="ValidRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Solicitud exitosa!!!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Regresar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="{{asset('js/validateV2.js')}}"></script>