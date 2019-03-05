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
        <div class="col-12 conatiner-imgAnalista">
            <img src="{{ asset('images/analistaGarantiaDigital.png') }}"  alt="" class="img-fluid imgAnalista" />
        </div>
        <div class="stepBystep">
            <span><strong>Reclamacion de Garantia </strong></span>
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
        <form ng-submit="WarrantyRequest()">
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="identificationNumber"> Número de identificación*</label>
                    <input class="form-control warrantyInputs WarrantyInputText" type="text" validation-pattern="number" ng-model="WarrantyRequest.identificationNumber" id="identificationNumber" required="" placeholder="Titular de la factura"/>
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="clientName"> Nombre*</label>
                    <input class="form-control warrantyInputs WarrantyInputText" type="text"  ng-model="WarrantyRequest.clientName" id="clientName" required="" placeholder="Titular de la factura"/>
                </div>           
            </div>
            <div class="row resetRow">
                <div class="col-12 col-sm-6 form-group">
                    <label for="typeRequestes">Tipo de reclamación*</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.type" id="typeRequestes" required="" ng-options="typeRequest.name for typeRequest in typeRequestes"></select>                
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
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.product" id="product" required="" ng-options="product.name for product in products"></select>                
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="brand">Marca*</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.brand" id="brand" required="" ng-options="brand.name for brand in brands"></select>               
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
                    <input class="form-control warrantyInputs inputSelect" type="number" ng-model="WarrantyRequest.invoiceNumber" id="invoiceNumber" min="0"></select>                        
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="meansSale">Medio de compra*</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.meansSale" id="meansSale" required="" ng-options="meansSale.id as meansSale.name for meansSale in meansSales"></select>               
                </div>               
            </div>
            <div class="row resetRow" ng-if="WarrantyRequest.meansSale == 5 ">
                <div class="col-12 col-sm-6 form-group">
                    <label for="departamento">Departamento *</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.departamento" id="departamento" required="" ng-options="departamento as departamento.name for departamento in departamentos"></select>               
                </div>
                <div class="col-12 col-sm-6 form-group">
                    <label for="city">ciudad *</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.city" id="city" required="" ng-options="city as city.name for city in cities"></select>               
                </div>               
            </div>
            <div class="row resetRow" ng-if="WarrantyRequest.meansSale == 5 ">
                <div class="col-12 col-sm-6 form-group">
                    <label for="store">Tienda *</label>
                    <select class="form-control warrantyInputs inputSelect" ng-model="WarrantyRequest.store" id="store" required="" >              
                        <option value="store" ng-repeat="store in stores">@{{store}}</option>
                    </select> 
                </div>             
            </div>
        </form>
    </div>
</div>
