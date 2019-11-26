@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet"
    href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection
@section('content')
<div ng-app="creditPolicyApp" ng-controller="simulatePolicySingleCtrl" class="containerleads container">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="headerAdmin ng-scope">Aplicar política / individual</h2>
        </div>
        <div class="col-6 offset-3">
            <form name="simular" ng-submit="simulate()">
                <div class="row">
                    <div class="col-12">
                        <md-input-container class="md-block">
                            <label class="ventaContado-label">Número de identificación</label>
                            <input required name="cedula" ng-model="lead.cedula" validation-pattern="number"
                                ng-blur="getInfoLead()">
                        </md-input-container>
                    </div>
                    <div class="col-12 text-center">
                        <md-button type="submit" class="md-raised md-primary">Aplicar</md-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="alert alert-danger" role="alert" ng-if="showMessageNoExistClienteFab || showMessageNoExistConsulta">
        Verifica la cédula ingresada, el cliente no presenta registro en nuestra base de datos.
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
                    <span ng-if="infoLead.TIPO_DOC == 8">Fidecomiso</span>
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
                    <label for="">Tiempo Labor: </label><span ng-if="infoLead.TIEMPO_LABOR == 1">Si cumple</span> <span
                        ng-if="infoLead.TIEMPO_LABOR == 0">No cumple</span>
                </p>
                <p
                    ng-if="infoLead.ACTIVIDAD == 'NO CERTIFICADO' || infoLead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || infoLead.ACTIVIDAD == 'RENTISTA'">
                    <label for="">Ingresos: </label><span>$
                        @{{ infoLead.SUELDOIND + infoLead.OTROS_ING | number:0}}</span>
                </p>
                <p
                    ng-if="infoLead.ACTIVIDAD == 'EMPLEADO' || infoLead.ACTIVIDAD == 'PENSIONADO' || infoLead.ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA' || infoLead.ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS'">
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
<script src="{{ asset('js/libsJs/bootbox.js') }}"></script>
<script src="{{ asset('js/appCreditPolicy/app.js') }}"></script>
<script src="{{ asset('js/appCreditPolicy/services/myService.js') }}"></script>
<script src="{{ asset('js/appCreditPolicy/controllers/creditPolicyController.js') }}"></script>
@stop
@section('scriptsJs')
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
@endsection