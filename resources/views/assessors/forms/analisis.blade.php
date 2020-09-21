@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet"
    href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb  bradcrumb-reset float-right">
                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/Administrator/analisis">Realizar Analisis</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div ng-app="asessorVentaContadoApp" ng-controller="realizarAnalisisCtrl" class="containerleads container" ng-cloak>
    <div class="row d-flex justify-content-center">
        <div class="col-12 text-center">
            <h2 class="headerAdmin title-filter ng-scope">Resumen Análisis Política</h2>
        </div>
        <div class="col-10 col-sm-4">
            <form name="simular" ng-submit="getInfoLead()">
                <div class="row">
                    <div class="col-12 form-group">
                        <label class="label-reset ventaContado-label">Ingrese Número de identificación</label>
                        <input required class="form-control" ng-model="lead.cedula" validation-pattern="number">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-sm-reset">Ver Resumen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="alert alert-danger" role="alert" ng-if="showMessageNoExistClienteFab || showMessageNoExistConsulta">
        Verifica la cédula ingresada, el cliente no presenta registro en nuestra base de datos.
    </div>
    <div ng-show="showResp">
        <div class="row d-flex justify-content-center mt-4">
            <div class="container-fluid justify-content-center customerCardAnaliticsResponsive">
                <div class="col-12 col-sm-12 col-md-10 d-flex justify-content-center align-items-stretch">
                    <div class="card bg-light containerCardCustomer shadow-lg">
                        <div class="card-header border-bottom-0 " style="color: #007bff;">
                            Resultado Política
                        </div>
                        <h2 class="customerNameCardAnalicts pl-3 ml-1"><b>@{{ infoLead.NOMBRES }}
                                @{{ infoLead.APELLIDOS }}</b></h2>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="order-last container-info-principal col-5 text-center">
                                    <img src="{{ asset('images/analisis/user.png')}}" alt=""
                                        class="img-circle img-fluid img-card-client">
                                    <ul
                                        class="ml-1 mb-0 fa-ul text-muted text-card-analitycs text-card-analitycs-responsive  mt-2">
                                        <li class="small mt-2 " style="
                                        color: #007bff;
                                    "><span class="fa-li"> </span> *
                                            @{{ infoLead.latest_intention.definition.CARACTERISTICA }}</li>
                                        <li class="small mt-2 margin-reponsive"><span class="fa-li"> </span> Definición:
                                            @{{ infoLead.latest_intention.definition.DESCRIPCION + " / " + infoLead.latest_intention.definition.ID_DEF }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="order-first col-7 container-info">
                                    <ul class="ml-4 mb-0 fa-ul text-muted text-card-analitycs">
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="fas fa-address-card ml-1 mr-1"></i></i></span>
                                            Numero
                                            de
                                            Documento: <span>@{{ infoLead.CEDULA }}</span> </li>
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="fas fa-warehouse"></i></span>
                                            Sucursal:
                                            <span>
                                                @{{ infoLead.SUC }}</span></li>
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="fas fa-lg fa-phone"></i></span>
                                            Celular:
                                            <span>
                                                @{{ infoLead.CELULAR }}</span></li>
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="fas fa-dollar-sign"></i></span>
                                            Ingresos:
                                            <span> $
                                                @{{ infoLead.SUELDOIND + infoLead.OTROS_ING | number:0}}</span></li>
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="far fa-id-badge"></i></span>
                                            Perfil Crediticio:
                                            <span>
                                                @{{ infoLead.latest_intention.PERFIL_CREDITICIO }}</span></li>
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="fas fa-credit-card"></i></span>
                                            Linea:
                                            <span>
                                                @{{ infoLead.latest_intention.TARJETA }}</span></li>
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="fas fa-question"></i></span>
                                            Estado:
                                            <span>
                                                <span ng-if="infoLead.ESTADO == 'PREAPROBADO'">
                                                    <span
                                                        class="badge badge-warning badge-reset">@{{ infoLead.ESTADO }}</span>
                                                </span>
                                                <span ng-if="infoLead.ESTADO == 'NEGADO'">
                                                    <span
                                                        class="badge badge-danger badge-reset">@{{ infoLead.ESTADO }}</span>
                                                </span>
                                                <span ng-if="infoLead.ESTADO == 'APROVADO'">
                                                    <span
                                                        class="badge badge-danger badge-success">@{{ infoLead.ESTADO }}</span>
                                                </span>
                                                <span ng-if="infoLead.ESTADO == 'EN ANALISIS'">
                                                    <span
                                                        class="badge badge-warning badge-reset">@{{ infoLead.ESTADO }}</span>
                                                </span>
                                            </span></li>
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="fas fa-chart-line"></i></span>
                                            Actividad: @{{ infoLead.ACTIVIDAD }}</li>
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="fas fa-chart-line"></i></span>
                                            Actividad independiente:
                                            @{{ infoLead.ACT_IND }}</li>
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="fas fa-business-time"></i></span>
                                            Tiempo Labor:<span ng-if="infoLead.latest_intention.TIEMPO_LABOR == 1"> Si
                                                cumple</span> <span ng-if="infoLead.latest_intention.TIEMPO_LABOR == 0">
                                                No
                                                cumple</span>
                                        </li>
                                        <li class="small mt-2"><span class="fa-li"><i class="fas fa-eye"></i></span>
                                            Inspección Ocular:<span
                                                ng-if="infoLead.latest_intention.INSPECCION_OCULAR == 1">
                                                Si
                                            </span> <span ng-if="infoLead.latest_intention.INSPECCION_OCULAR == 0">
                                                No</span>
                                        </li>
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="fas fa-business-time"></i></span>
                                            Tipo 5 Especial:<span
                                                ng-if="infoLead.latest_intention.TIPO_5_ESPECIAL == 1">
                                                Si
                                            </span> <span ng-if="infoLead.latest_intention.TIPO_5_ESPECIAL == 0">
                                                No</span>
                                        </li>
                                        <li class="small mt-2"><span class="fa-li"><i
                                                    class="fas fa-business-time"></i></span>
                                            Edad:<span ng-if="infoLead.latest_intention.EDAD == 1">
                                                Si
                                                Cumple</span> <span ng-if="infoLead.latest_intention.EDAD == 0">
                                                No Cumple</span>
                                        </li>
                                        <li class="small mt-2"><span class="fa-li"><i class="fas fa-history"></i></span>
                                            Historial Crediticio :<span
                                                ng-if="infoLead.latest_intention.HISTORIAL_CREDITO == 1">
                                                Con Historial</span> <span
                                                ng-if="infoLead.latest_intention.HISTORIAL_CREDITO == 0">
                                                Sin Historial</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="/Administrator/customers/@{{ infoLead.CEDULA }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> Ver Cliente
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/assessorVentaContado.js') }}"></script>
@stop
@section('scriptsJs')
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-sanitize.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ng-currency/1.2.7/ng-currency.min.js"></script>
@endsection