 <form name="clienteContado" ng-submit="validateVentaContado()" ng-show="tipoCliente == 'CONTADO'" class="crearCliente-form">
     <div class="row">
         <div class="col-12 col-sm-12 col-md-12 type-client">
             <div class="forms-descStep forms-descStep-avances">
                 <strong>Información básica</strong><br>
                 <span class="forms-descText">Ingresa tus datos personales</span>
                 <img src="{{ asset('images/datosPersonales.png') }}" class="img-fluid forms-descImg">
                 <span class="forms-descStepNum">1</span>
             </div>
         </div>
     </div>
     <div class="row">
         <div class="col-12 col-sm-6">
             <label class="labels" for="tipodoc">Tipo de documento*</label>
             <select class="inputs select2bs4" ng-model="lead.TIPO_DOC" id="tipodoc" ng-options="type.value as type.label for type in typesDocuments"></select>
         </div>
         <div class="col-12 col-sm-6">
             <label class="labels" for="identificationNumberContado">Número de documento*</label>
             <input class="inputs" ng-model="lead.CEDULA" ng-blur="getValidationLead()" type="text" validation-pattern="identificationNumber" id="identificationNumberContado" />
         </div>
     </div>
     <div class="row">
         <div class="col-12 col-md-4">
             <label class="labels" for="nombresContado">Nombres*</label>
             <input class="inputs" ng-model="lead.NOMBRES" validation-pattern="name" type="text" id="nombresContado" />
         </div>
         <div class="col-12 col-md-4">
             <label class="labels" for="apellidosContado">Apellidos*</label>
             <input class="inputs" ng-model="lead.APELLIDOS" type="text" validation-pattern="name" id="apellidosContado" />
         </div>
         <div class="col-12 col-md-4">
             <label class="labels" for="emailContado">Correo electrónico*</label>
             <input class="inputs" ng-model="lead.EMAIL" type="text" id="emailContado" validation-pattern="email" />
         </div>
     </div>
     <div class="row">
         <div class="col-12 col-md-4">
             <label class="ventaContado-label labels" for="telContado">Teléfono fijo*</label>
             <input ng-model="lead.TELFIJO" class="inputs" type="text" id="telContado" />
         </div>
         <div class="col-12 col-md-4">
             <label class="ventaContado-label labels" for="celularCotado">Celular*</label>
             <input class="inputs" ng-model="lead.CELULAR" type="text" id="celularCotado" validation-pattern="telephone" />
         </div>
         <div class="col-12 col-md-4">
             <label class="ventaContado-label labels" for="genero">Género</label>
             <select class="inputs select2bs4" ng-model="lead.SEXO" id="genero" ng-options="gender.label as gender.value for gender in genders"></select>
         </div>
     </div>
     <div class="row">
         <div class="col-12 col-sm-6">
             <label class="ventaContado-label labels">Dirección de residencia*</label>
             <input class="inputs" ng-model="lead.DIRECCION" type="text" />
         </div>
         <div class="col-12 col-sm-6">
             <label class="ventaContado-label" for="ciud_ubiContado">Ciudad de sucursal*</label>
             <select class="inputs form-control select2bs4" ng-model="lead.CIUD_UBI" id="ciud_ubiContado" ng-options="city.value as city.label for city in citiesUbi"></select>
             <div class="alert alert-danger" role="alert" ng-show="showAlertCiudUbiContado" style="margin-top: 10px;">
                 Debe seleccionar una ciudad
             </div>
         </div>
     </div>
     <div class="row">
         <div class="col-12 col-md-4">
             <label class="ventaContado-label labels" for="nom1">Nombre de autorizado 1</label>
             <input class="inputs" type="text" id="nom1" ng-model="lead.VCON_NOM1" />
         </div>
         <div class="col-12 col-md-4">
             <label class="ventaContado-label labels" for="ced1">Cédula de autorizado 1</label>
             <input class="inputs" type="text" id="ced1" ng-model="lead.VCON_CED1" />
         </div>
         <div class="col-12 col-md-4">
             <label class="ventaContado-label labels" for="tel1">Teléfono de autorizado 1</label>
             <input class="inputs" type="text" id="tel1" ng-model="lead.VCON_TEL1" />
         </div>
     </div>
     <div class="row">
         <div class="col-12 col-md-4">
             <label class="ventaContado-label labels" for="nom2">Nombre de autorizado 2</label>
             <input class="inputs" type="text" id="nom2" ng-model="lead.VCON_NOM2" />
         </div>
         <div class="col-12 col-md-4">
             <label class="ventaContado-label labels" for="ced2">Cédula de autorizado 2</label>
             <input class="inputs" type="text" id="ced2" ng-model="lead.VCON_CED2" />
         </div>
         <div class="col-12 col-md-4">
             <label class="ventaContado-label labels" for="tel2">Teléfono de autorizado 2</label>
             <input class="inputs" type="text" id="tel2" ng-model="lead.VCON_TEL2" />
         </div>
     </div>
     <div class="row">
         <div class="col-12 col-sm-12">
             <label class="ventaContado-label labels" for="dir">Dirección de entrega</label>
             <input class="inputs" type="text" id="dir" ng-model="lead.VCON_DIR" />
         </div>
     </div>
     <div class="row  text-center form-group">
         <div class="col-12">
             <button type="submit" class="btn btn-primary">Continuar</button>
         </div>
     </div>
 </form>
