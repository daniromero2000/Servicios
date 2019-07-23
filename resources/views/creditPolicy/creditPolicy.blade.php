<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 1 }" ng-click="tabs = 1" data-toggle="tab" role="tab" aria-controls="nav-general">Parametría</a>
        <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 2 }" ng-click="tabs = 2" data-toggle="tab" role="tab" aria-controls="nav-general">Simular Individual</a>
        <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 3 }" ng-click="tabs = 3" data-toggle="tab" role="tab" aria-controls="nav-general">Simular Grupo</a>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 1 }">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="headerAdmin ng-scope">Parametría</h2>
            </div>
            <div class="col-sm-12">
                <form ng-submit="edtCredit()">
                    <div class="row">
                        <div class="col-12 col-sm-6 form-group">
                            <label for="pub_vigencia">Tiempo límite de consulta / Días (Servicios Financieros)</label>
                            <input type="number" id="pub_vigencia" validation-pattern="number" class="form-control" ng-model="credit.pub_vigencia" />
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="fab_vigencia">Tiempo límite de consulta / Días (Oportudata)</label>
                            <input type="number" id="fab_vigencia" validation-pattern="number" class="form-control" ng-model="credit.fab_vigencia" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 form-group">
                            <label for="sms_vigencia">Vigencia SMS / Minutos</label>
                            <select ng-model="credit.sms_vigencia" id="sms_vigencia" class="form-control" ng-options="option.value as option.label for option in optionsSms"></select>
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="rechazado_vigencia">Vigencia rechazados / Días</label>
                            <select ng-model="credit.rechazado_vigencia" id="rechazado_vigencia" class="form-control" ng-options="option.value as option.label for option in optionsVigenciaRechazados"></select>
                        </div>
                    </div>
                    <div class="row" style="margin-top:50px">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">Actualizar</button>
                            <button type="button" class="btn btn-danger buttonFormModal buttonFormModalSubmit" ng-click="volver()">Volver</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" ng-controller="simulatePolicySingleCtrl" ng-class="{ 'show active': tabs == 2 }">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="headerAdmin ng-scope">Simular política / individual</h2>
            </div>
            <div class="col-6 offset-3">
                <form name="simular" ng-submit="simulate()">
                    <div class="row">
                        <div class="col-12">
                            <md-input-container class="md-block">
                                <label class="ventaContado-label">Número de identificación</label>
                                <input required name="cedula" ng-model="lead.cedula" validation-pattern="number" ng-blur="getInfoLead()">
                            </md-input-container>
                        </div>
                        <div class="col-12 text-center">
                            <md-button type="submit" class="md-raised md-primary">Simular</md-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div ng-show="showResp">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="headerAdmin ng-scope">Resultado política</h2>
                    <p class="resultadoPolitica colourGreen" ng-if="infoLead.ESTADO == 'PREAPROBADO'">
                        @{{ infoLead.DESCRIPCION + " / " + infoLead.ID_DEF }}
                    </p>
                    <p class="resultadoPolitica colourRed" ng-if="infoLead.ESTADO != 'PREAPROBADO'">
                        @{{ infoLead.DESCRIPCION + " / " + infoLead.ID_DEF }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                   <p>
                       <label for="">Tipo de documento: </label>
                       <span ng-if="infoLead.TIPO_DOC == 1">Cédula de ciudadanía</span>
                       <span ng-if="infoLead.TIPO_DOC == 2">NIT</span>
                       <span ng-if="infoLead.TIPO_DOC == 3">Cédula de extranjería</span>
                       <span ng-if="infoLead.TIPO_DOC == 4">Tarjeta de identidad</span>
                       <span ng-if="infoLead.TIPO_DOC == 5">Pasaporte</span>
                       <span ng-if="infoLead.TIPO_DOC == 6">Tarjeta seguro social extranjero</span>
                       <span ng-if="infoLead.TIPO_DOC == 7">Sociedad extranjera sin NIT en Colombia</span>
                       <span ng-if="infoLead.TIPO_DOC == 8">Fidecoismo</span>
                    </p>
                   <p>
                       <label for="">Número de documento: </label>@{{ infoLead.CEDULA }}
                    </p>
                   <p>
                       <label for="">Tipo de cliente: </label>@{{ infoLead.TIPO_CLIENTE }}
                    </p>
                   <p>
                       <label for="">Fecha nacimiento: </label>@{{ infoLead.FEC_NAC }}
                    </p>
                   <p>
                       <label for="">Tipo de vivienda: </label>@{{ infoLead.TIPOV }}
                    </p>
                   <p>
                        <label for="">Actividad: </label>@{{ infoLead.ACTIVIDAD }}
                    </p>
                    <p ng-if="infoLead.ACTIVIDAD == 'NO CERTIFICADO' || infoLead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO'">
                        <label for="">Actividad independiente: </label>@{{ infoLead.ACT_IND }}
                    </p>
                   <p>
                        <label for="">Tiempo Labor: </label><span ng-if="infoLead.TIEMPO_LABOR == 1">Si cumple</span> <span ng-if="infoLead.TIEMPO_LABOR == 0">No cumple</span>
                    </p>
                    <p ng-if="infoLead.ACTIVIDAD == 'NO CERTIFICADO' || infoLead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || infoLead.ACTIVIDAD == 'RENTISTA'">
                        <label for="">Ingresos: </label><span>$ @{{ infoLead.SUELDOIND + infoLead.OTROS_ING | number:0}}</span>
                    </p>
                    <p ng-if="infoLead.ACTIVIDAD == 'EMPLEADO' || infoLead.ACTIVIDAD == 'PENSIONADO' || infoLead.ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA' || infoLead.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'">
                        <label for="">Ingresos: </label><span>$@{{ infoLead.SUELDO + infoLead.OTROS_ING | number:0 }}</span>
                    </p>
                </div>
                <div class="col-sm-12 col-md-6">
                   <p>
                       <label for="">Sucursal: </label>@{{ infoLead.SUC }}
                    </p>
                   <p>
                       <label for="">Dirección: </label>@{{ infoLead.DIRECCION }}
                    </p>
                   <p>
                       <label for="">Celular: </label>@{{ infoLead.CELULAR }}
                    </p>
                   <p>
                       <label for="">Score: </label>@{{ infoLead.score }}
                    </p>
                    <p>
                        <label for="">Tarjeta: </label> @{{ infoLead.TARJETA }}
                    </p>
                    <p>
                        <label for="">Estado: </label> @{{ infoLead.ESTADO }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="caracteristicaPolitica">
                       <i>* @{{ infoLead.CARACTERISTICA }}</i>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 3 }">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="headerAdmin ng-scope">Simular política / Grupos</h2>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Filtros de búsqueda</strong>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>