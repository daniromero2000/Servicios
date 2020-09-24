 <form ng-submit="validateStep2()" name="clienteCreditoPaso2" ng-show="step == 2" class="crearCliente-form">
     <div class="row container-form">
         <div class="col-12 type-client">
             <div class="forms-descStep forms-descStep-avances">
                 <strong>Información básica</strong><br>
                 <span class="forms-descText">Ingresa los datos personales</span>
                 <img src="{{ asset('images/datosPersonales.png') }}" class="img-fluid forms-descImg">
                 <span class="forms-descStepNum">2</span>
             </div>
             <div class="row">
                 <div class="col-12 col-md-6">
                     <label class="labels" for="tipodoc">Tipo de documento*</label>
                     <select ng-disabled="true" class="inputs form-control" ng-model="lead.TIPO_DOC" id="tipodoc" ng-options="type.value as type.label for type in typesDocuments"></select>
                 </div>
                 <div class="col-12 col-md-6">
                     <label class="labels" for="CEDULA">Número de documento*</label>
                     <input readonly class="inputs" validation-pattern="IdentificationNumber" ng-blur="getValidationLead()" type="text" ng-model="lead.CEDULA" id="CEDULA" required />
                 </div>
             </div>
             <div class="row">
                 <div class="col-12 col-md-6">
                     <label class="labels" for="FEC_EXP">Fecha expedición documento*</label>
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                         </div>
                         <input type="text" class="form-control" data-inputmask-alias="datetime" ng-model="lead.FEC_EXP" id="FEC_EXP" ng-disabled="true" required data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                     </div>
                 </div>
                 <div class="col-12 col-sm-6">
                     <label for="CIUD_EXP" class="labels">Ciudad de expedición</label>
                     <select class="form-control inputs select2bs4" ng-model="lead.CIUD_EXP" id="CIUD_EXP" ng-options="city.value as city.label for city in cities" required></select>
                     <div class="alert alert-danger" role="alert" ng-show="showAlertCiudExp" style="margin-top: 10px;">
                         Debe seleccionar una ciudad
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-12 col-sm-4">
                     <label for="nombres2" class="labels">Nombres*</label>
                     <input type="text" id="nombres2" ng-model="lead.NOMBRES" class="form-control inputs" required="" />
                 </div>
                 <div class="col-12 col-sm-4">
                     <label for="apellidos2" class="labels">Apellidos*</label>
                     <input type="text" id="apellidos2" ng-model="lead.APELLIDOS" class="form-control inputs" required="" />
                 </div>
                 <div class="col-12 col-sm-4">
                     <label for="sexo" class="labels">Género</label>
                     <select class="form-control inputs select2bs4" ng-model="lead.SEXO" id="sexo" ng-options="gender.value as gender.label for gender in genders"></select>
                 </div>
             </div>
             <div class="row">
                 <div class="col-12 col-sm-6">
                     <label class="labels" for="FEC_NAC">Fecha de nacimiento*</label>
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                         </div>
                         <input type="text" ng-disabled="true" class="form-control" validation-pattern="date" data-inputmask-alias="datetime" ng-model="lead.FEC_NAC" id="FEC_NAC" required data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                     </div>
                 </div>
                 <div class="col-12 col-sm-6">
                     <label for="CIUD_NAC" class="labels">Ciudad de nacimiento</label>
                     <select class="form-control inputs select2bs4" ng-model="lead.CIUD_NAC" id="CIUD_NAC" ng-options="city.label as city.label for city in cities"></select>
                 </div>
             </div>
             <div class="row">
                 <div class="col-12 col-sm-4">
                     <label for="ESTUDIOS" class="labels">Nivel de estudios</label>
                     <select id="ESTUDIOS" class="inputs form-control select2bs4" ng-model="lead.ESTUDIOS" ng-options="scolarity.value as scolarity.label for scolarity in scolarities"></select>
                 </div>

                 <div class="col-12 col-sm-4">
                     <label for="PROFESION" class="labels">Profesión</label>
                     <select id="PROFESION" class="inputs form-control select2bs4" ng-model="lead.PROFESION" ng-options="profession.NOMBRE as profession.NOMBRE for profession in professions"></select>
                 </div>
                 <div class="col-12 col-sm-4">
                     <label for="PERSONAS" class="labels">Personas a cargo</label>
                     <input type="text" class="inputs form-control" ng-model="lead.PERSONAS" id="personas" />
                 </div>
             </div>
             <div class="row">
                 <div class="col-12 col-sm-6">
                     <label for="" class="labels">Posee vehículo</label>
                     <select ng-model="lead.POSEEVEH" class="form-control inputs select2bs4" id="POSEEVEH">
                         <option value="S">Si</option>
                         <option value="N">No</option>
                     </select>
                 </div>
                 <div class="col-12 col-sm-6" ng-show="lead.POSEEVEH == 'S'">
                     <label for="PLACA" class="labels">Placa</label>
                     <input type="text" class="inputs form-control" ng-model="lead.PLACA" id="PLACA" />
                 </div>
             </div>
             <div class="row form-group">
                 <div class="col-12 col-sm-12">
                     <label for="ESTADOCIVIL" class="labels">Estado civil</label>
                     <select class="inputs form-control select2bs4" ng-model="lead.ESTADOCIVIL" id="ESTADOCIVIL" ng-options="civilType.value as civilType.label for civilType in civilTypes">
                     </select>
                 </div>
             </div>
             <div ng-show="lead.ESTADOCIVIL == 'CASADO' || lead.ESTADOCIVIL == 'UNION LIBRE'">
                 <div class="col-12">
                     <h6 class="ventaContado-subTitle">Datos del cónyuge</h6>
                 </div>
                 <div class="row">
                     <div class="col-12 col-sm-4">
                         <label for="CEDULA_C" class="labels">Número de cédula del cónyuge</label>
                         <input type="text" class="inputs form-control" ng-model="lead.CEDULA_C" id="CEDULA_C" />
                     </div>
                     <div class="col-12 col-sm-4">
                         <label for="NOMBRE_CONYU" class="labels">Nombre del cónyuge</label>
                         <input type="text" class="inputs form-control" ng-model="lead.NOMBRE_CONYU" id="NOMBRE_CONYU" />
                     </div>
                     <div class="col-12 col-sm-4">
                         <label for="CELULAR_CONYU" class="labels">Celular del cónyuge</label>
                         <input type="text" class="inputs form-control" ng-model="lead.CELULAR_CONYU" id="CELULAR_CONYU" />
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-12 col-sm-4">
                         <label for="TRABAJO_CONYU" class="labels">¿Trabaja en?</label>
                         <input type="text" class="inputs form-control" ng-model="lead.TRABAJO_CONYU" id="TRABAJO_CONYU" />
                     </div>
                     <div class="col-12 col-sm-4">
                         <label for="PROFESION_CONYU" class="labels">Profesión u ocupación del
                             cónyuge</label>
                         <input type="text" class="inputs form-control" ng-model="lead.PROFESION_CONYU" id="PROFESION_CONYU" />
                     </div>
                     <div class="col-12 col-sm-4">
                         <label for="CARGO_CONYU" class="labels">Cargo actual del cónyuge</label>
                         <input type="text" class="inputs form-control" ng-model="lead.CARGO_CONYU" id="CARGO_CONYU" />
                     </div>
                 </div>
                 <div class="row form-group">
                     <div class="col-12 col-sm-6">
                         <label for="SALARIO_CONYU" class="labels">Ingresos del cónyuge</label>
                         <input type="text" class="inputs form-control" ng-model="lead.SALARIO_CONYU" id="SALARIO_CONYU" />
                     </div>
                     <div class="col-12 col-sm-6">
                         <label for="EPS_CONYU" class="labels">Eps del cónyuge</label>
                         <input type="text" class="inputs form-control" ng-model="lead.EPS_CONYU" id="EPS_CONYU" />
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-12 text-center">
                     <button class="btn btn-primary" ng-disabled="disabledButtonStep2" type="submit">Continuar</button>
                 </div>
             </div>
         </div>
     </div>
 </form>
