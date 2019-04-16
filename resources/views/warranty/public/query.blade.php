<div Class="contentGarantias">
    <div class="align-self-center ml-auto ">
        <a href="{{ route('TermsAndConditions') }}" class="align-middle warrantyLegal-xs">Términos y Condiciones</a>
    </div>
    <div class="row resetRow">
        <div class="logoHeaderWarranty">
            <img src="{{ asset('images/warranty-oportunidades.png') }}" class="img-fluid" alt="Oportuya" />
        </div>
        <div class="align-self-center ml-auto conditions">
            <a href="{{  route('TermsAndConditions') }}" class="align-middle warrantyLegal">Términos y Condiciones</a>
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
    <div class="Garantia-containerForm" id='WarrantyStep1' ng-if='step == 1'>
        <div class="row resetRow">
            <div class="descriptionStep">
                <strong>Información básica</strong><br>
                <span class="descText">Ingresa tus datos personales</span>
                <img src="{{ asset('images/datosPersonales-min.png') }}" class="img-fluid forms-descImg" />
                <span class="descStepNum">1</span>
            </div>
        </div>
        <form ng-submit="getProducts()">
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="idType">Tipo de identificación *</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="$parent.WarrantyRequest.idType" id="idType" required ng-options="idType.codigo as idType.descripcion for idType in idTypes">
                        <option></option>
                    </select>                
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="identificationNumber"> Número de identificación *</label>
                    <input class="form-control warrantyInputs WarrantyInputText" type="text" validation-pattern="IdentificationNumber" ng-model="$parent.WarrantyRequest.identificationNumber" id="identificationNumber" required="" placeholder="Número de identificación titular de la factura"/>
                </div>          
            </div>
            <div class="capchaContetent">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display(['data-callback' => 'enableBtn']) !!}
            </div>
            <div class="row justify-content-center resetRow">
                <button type="submit" class="btn btn-primary sendRequest" id="button1">Siguiente</button> 
            </div>
        </form>
    </div>
    <div class="Garantia-containerForm" id='WarrantyStep2' ng-if='step == 2'>
        <div class="row resetRow">
            <div class="descriptionStep">
                <strong>Información del producto</strong><br>
                <span class="descText">Ingresa la descripción de tu producto</span>
                <img src="{{ asset('images/datosPersonales2-min.png') }}" class="img-fluid forms-descImg" />
                <span class="descStepNum">2</span>
            </div>
        </div>
        <form ng-submit="sendStep2()">
            <div class="row resetRow text-center">
                <div class="col resetCol text-center">
                    <h3 class="text-greeting">Hola! @{{WarrantyRequest.names+' '+$parent.WarrantyRequest.lastNames }}</h3>
                    <br>         
                    <p class="text-center textGreeting ">¿Puedes indicarnos con cual de tus productos tienes inconvenientes?</p>            
                </div>
            </div>
            
            <div class="table table-responsive">
                <table class="table table-hover table-stripped warrantyTable">
                    <thead class="headTableWarranty">
                        <tr>
                            <th scope="col" width="25%">Marca</th>
                            <th scope="col" width="25%">Referencia</th>
                            <th scope="col" width="25%">Fecha de compra</th>
                            <th scope="col" width="25%">Numero de la factura</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="product in products" ng-click="$parent.$parent.selectedProduct = product" style=@{{style(product)}}>
                            <td>@{{product.MARCA}}</td>
                            <td>@{{product.REFERENCIA}}</td>
                            <td>@{{product.FEC_AUR}}</td>
                            <td>@{{product.FACTURA}}</td>
                        </tr>
                        <tr ng-click="$parent.step = 21;$parent.other=1">
                            <td>OTRO</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row resetRow">
                <div class="col-12 form-group">
                    <label for="fault">Descripción de la falla *</label>
                    <textarea id="fault" rows="3" class="form-control warrantyInputs inputSelect" ng-model="$parent.WarrantyRequest.faultDescription" placeholder="Señor usuario explique detalladamente  la falla del producto y/o su inconformidad" required></textarea>               
                </div>               
            </div>
            <div class="row justify-content-center resetRow">
                <button type="submit" class="btn btn-primary sendRequest" >Siguiente</button> 
            </div>
        </form>
    </div>
    <div class="Garantia-containerForm" id='WarrantyStep21' ng-if='step == 21'>
        <div class="row resetRow">
            <div class="descriptionStep">
                <strong>Información del producto</strong><br>
                <span class="descText">Ingresa la descripción de tu producto</span>
                <img src="{{ asset('images/datosPersonales2-min.png') }}" class="img-fluid forms-descImg" />
                <span class="descStepNum">2</span>
            </div>
        </div>
        <form ng-submit="sendStep21()">
            <div class="alert alert-info" role="alert">
                <p>Señor usuario si requiere garantía para varios productos, por favor realice el trámite para cada uno.</p>
            </div>
            <div class="row resetRow" ng-if='$parent.other == 0'>
                <div class="col-12 col-sm-6 form-group">
                    <label for="clientNames"> Nombres * @{{$parent.$parent.WarrantyRequest.names}}</label>
                    <input class="form-control warrantyInputs WarrantyInputText" type="text"  ng-model="$parent.WarrantyRequest.names" id="clientName" required validation-pattern="textOnly" placeholder="Nombres titular de la factura"/>
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="clientLastNames"> Apellidos *</label>
                    <input class="form-control warrantyInputs WarrantyInputText" type="text"  ng-model="$parent.WarrantyRequest.lastNames" id="clientLastName" required validation-pattern="textOnly" placeholder="Apellidos titular de la factura"/>
                </div>   
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="product">Producto*</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="$parent.brandByType" id="product" required ng-options="value as key for (key, value) in groups">
                        <option></option>
                    </select>                
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="brand">Marca*</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="$parent.WarrantyRequest.productBrand" id="brand" required ng-options="brand.name for brand in brandByType">
                        <option></option>
                    </select>               
                </div>
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="reference"> Referencia*</label>
                    <input class="form-control warrantyInputs WarrantyInputText" type="text"  ng-model="$parent.WarrantyRequest.reference" id="reference" required="" placeholder="la referencia la puedes encontrar en la factura y/o en las etiquetas que tiene adheridas el producto"/>
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                    <label for="dateDocumentExpedition">Fecha de compra (puedes digitar una aproximación)*</label>
                    <div class="input-group"
                            moment-picker="WarrantyRequest.dateShop"
                            format="YYYY-MM-DD"
                            locale="es">
                        <input class="form-control inputsSteps inputText"
                                ng-model="WarrantyRequest.dateShop" id="dateDocumentExpedition" readonly="" required="" placeholder="Año/Mes/Día">
                        <span class="input-group-addon">
                            <i class="octicon octicon-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="invoiceNumber">Numero de factura (opcional)</label>
                    <input class="form-control warrantyInputs inputSelect" type="text" ng-model="$parent.WarrantyRequest.invoiceNumber" id="invoiceNumber">                        
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="meansSale">Medio de compra*</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="$parent.WarrantyRequest.meansSale" id="meansSale" required ng-options="meansSale as meansSale.name for meansSale in meansSales">
                        <option></option>
                    </select>               
                </div>               
            </div>
            <div class="row resetRow" data-ng-if="WarrantyRequest.meansSale.id == 5 ">
                <div class="col-12 col-sm-6 form-group">
                    <label for="departamento">Departamento *</label>
                    <select class="form-control warrantyInputs inputSelect"  required ng-model="$parent.storesByDepartamentos" id="departamento" ng-options="value as key for (key, value) in stores"></select>    
                </div>
        
                <div class="col-12 col-sm-6 form-group">
                    <label for="city">ciudad *</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="$parent.storesByCity" id="city" required ng-options="value as key for (key, value) in storesByDepartamentos" ng-change="myFunc()"></select>               
                </div>               
            </div>
            <div class="row resetRow" ng-if="WarrantyRequest.meansSale.id == 5">
                <div class="col-12 col-sm-6 form-group">
                    <label for="store">Tienda *</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="$parent.WarrantyRequest.store" id="WarrantyRequest.store" ng-options="store as store.DOMICILIO for store in storesByCity" required></select>              
                </div>             
            </div>
            <div class="row resetRow">
                <div class="col-12 form-group">
                    <label for="fault">Descripción de la falla *</label>
                    <textarea id="fault" rows="3" class="form-control warrantyInputs inputSelect" ng-model="$parent.WarrantyRequest.faultDescription" required></textarea>               
                </div>               
            </div>
           
            <div class="row justify-content-center resetRow">
                <button type="submit" class="btn btn-primary sendRequest" >Siguiente</button> 
            </div>
        </form>
    </div>
    <div class="Garantia-containerForm" id='WarrantyStep21' ng-if='step == 3'>
        <div class="row resetRow">
            <div class="descriptionStep">
                <strong>Información de ubicación </strong><br>
                <span class="descText">Ingresa tus datos de ubicación y de contacto</span>
                <img src="{{ asset('images/datosLaborales-min.png') }}" class="img-fluid forms-descImg" />
                <span class="descStepNum">3</span>
            </div>
        </div>
        <form ng-submit="sendRequest()">
            <div class="row resetRow">
                <div class="col-12 form-group">
                    <label for="Yes">¿El usuario del producto es el titular de la cuenta? *</label>            
                </div>
                <div class="form-check isUserCheck">
                    <input class="form-check-input" ng-model="$parent.WarrantyRequest.isUser"  name="isuser" type="radio"  id="yes"  value="True" checked required>
                    <label class="form-check-label" for="exampleRadios1">Si</label>
                </div>
                <div class="form-check isUserCheck">
                    <input class="form-check-input" ng-model="$parent.WarrantyRequest.isUser"   name="isuser" type="radio" id="yes" value="False" required>
                    <label class="form-check-label" for="exampleRadios2">No</label>
                </div>               
            </div>
            <div class="row resetRow" ng-if="WarrantyRequest.isUser == 'False'">
                <div class="col-12 col-sm-6 form-group">
                    <label for="userName">Nombre del usuario del producto*</label>
                    <input class="form-control warrantyInputs inputSelect" type="Text" ng-model="$parent.WarrantyRequest.userName" id="userName" validation-pattern="textOnly" required>                   
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="city">Relación con el titular de la factura*</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="$parent.WarrantyRequest.relationship" id="relationship" ng-options="relationship.name as relationship.name for relationship in relations" required>
                        <option></option>
                    </select>               
                </div>               
            </div>
        
            <div class="row resetRow" >
                <div class="col-12 col-sm-9 col-md-6 form-group resetCol">
                    <div class="row" >
                        <div class="col-11 form-group" ng-repeat="phone in WarrantyRequest.cellPhones">
                            <div class="row resetRow ">
                                <div class="col-11 form-group "> 
                                    <label for="phone">Celular*</label>
                                    <input class="form-control warrantyInputs inputSelect" type="text" ng-model="phone.number" id="phone" validation-pattern="telephone" required>
                                </div>
                                <div class="col-1 form-group align-self-end deletePhoneContainer resetCol">
                                    <button type="button" class="btn btn-danger deletePhone"  ng-click="$parent.WarrantyRequest.cellPhones.splice($index,1)" ng-if="!$first"><i class="fas fa-minus"></i></button> 
                                </div> 
                            </div>
                                            
                        </div>
                        <div class="col-1 form-group align-self-end addPhoneContainer" ng-if="WarrantyRequest.cellPhones.length<3">
                            <button type="button" class="btn btn-success addPhone"  ng-click="WarrantyRequest.cellPhones.push({number:null})" ><i class="fas fa-plus"></i></button> 
                        </div> 
                    </div>
                </div>             
            </div>

            <div class="row resetRow" >
                <div class="col-12 col-sm-9 col-md-6 form-group">
                        <label for="phone">Teléfono fijo</label>
                        <input class="form-control warrantyInputs inputSelect" type="text" ng-model="$parent.WarrantyRequest.phone" id="phone" validation-pattern="telephone">  
                </div>             
            </div>
            <div class="alert alert-danger" role="alert" ng-if="validEmail">
                Los campos de correo electrónico y confirmación deben coincidir 
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="email">Correo electrónico*</label>
                    <input class="form-control warrantyInputs inputSelect" type="text" ng-model="$parent.WarrantyRequest.email" id="email"  validation-pattern="email" required>                   
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="confirmEmail">Confirma tu correo electrónico</label>
                    <input class="form-control warrantyInputs inputSelect" type="text" ng-model="$parent.WarrantyRequest.confirmEmail" id="confirmEmail" ng-paste="$event.preventDefault();" autocomplete="off">                   
                </div>             
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="address">Dirección (Donde se encuentra ubicado el producto) *</label>
                    <input class="form-control warrantyInputs inputSelect" type="text" ng-model="$parent.WarrantyRequest.address" id="address" required>                   
                </div>             
            </div>
            <div class="row justify-content-center resetRow">
                <button type="submit" class="btn btn-primary sendRequest" >Enviar</button> 
            </div>
        </form>
    </div>
</div>

<!-- Valid request Modal -->
<div class="modal" tabindex="-1" role="dialog" id="ValidRequest" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
            <div class="imageSuccessful">
                <img src="{{ asset('images/successful.png')}}" class="img-fluid rounded">
            </div>
            <div class="successfulText">
            
                <p>Su solicitud de garantía se ha procesado exitosamente, en el transcurso de 36 horas un asesor se comunicará con usted, por favor esté pendiente de los teléfonos ingresados. Tenga presente el número de caso asignado<b class="NumberCase"> @{{WarrantyRequest.number}}</b> </p>
            </div>
            <div class="containerReturn">
                <a href="{{ route('start') }}"><button type="button" class="btn btn-primary returnButton" >Salir</button></a>
            </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade hide" data-backdrop="static" data-keyboard="false" id="confirmNumCel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modalCode">
        <div class="modal-content">
            <div class="modal-body" style="padding: 10px">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Número de Celular</label>
                        <input type="text" ng-model="WarrantyRequest.cellPhones[0].number" class="form-control" />
                    </div>
                    <div class="col-12 text-center form-group">
                        <button class="btn btn-primary" ng-click="sendSms()">Enviar Código</button>
                        <button type="button"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col text-center">
                        <p class="textCodeVerificacion">
                            *Enviaremos un código de verificación a tu número celular
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade hide" data-backdrop="static" data-keyboard="false" id="confirmCodeVerification" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modalCode">
        <div class="modal-content">
            <div class="modal-body" style="padding: 10px">
                <form ng-submit="verificationCode()">
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="">Código de Verificación</label>
                            <input type="text" ng-model="code" class="form-control" />
                        </div>
                        <div class="col-12 text-center form-group">
                            <button type="submit" class="btn btn-primary">Confirmar Código</button>
                        </div>
                        <div class="col-12 text-center" ng-show="showAlertCode">
                            <div class="alert alert-danger" role="alert">
                                Código erróneo, por favor verifícalo
                            </div>
                        </div>
                        <div class="col-12 text-center" ng-show="showWarningCode">
                            <div class="alert alert-warning" role="alert">
                                El código ya expiró, <span class="renewCode" ng-click="getCodeVerification(true)">clic aquí</span> para generar un nuevo código
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("button1").disabled = true;
    function enableBtn(){
        document.getElementById("button1").disabled = false;
    }
</script>

<script type="text/javascript" src="{{asset('js/validateV2.js')}}"></script>
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>

