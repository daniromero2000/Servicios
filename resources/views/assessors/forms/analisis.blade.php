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
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/Administrator/analisis">Realizar Analisis</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div ng-app="asessorVentaContadoApp" ng-controller="realizarAnalisisCtrl" class="containerleads container" ng-cloak>
    <div class="row ">
        <div class="col-12 text-center">
            <h2 class="headerAdmin ng-scope">Resumen análisis política</h2>
        </div>
        <div class="col-12 col-sm-4 offset-sm-4">
            <form name="simular" ng-submit="getInfoLead()">
                <div class="row">
                    <div class="col-12 form-group">
                        <label class="ventaContado-label">Número de identificación</label>
                        <input required class="form-control" ng-model="lead.cedula" validation-pattern="number">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Ver Resumen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="alert alert-danger" role="alert" ng-if="showMessageNoExistClienteFab || showMessageNoExistConsulta">
        Verifica la cédula ingresada, el cliente no presenta registro en nuestra base de datos.
    </div>
    <div ng-show="showResp">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-10">
                <div class="card mt-4 mb-4 shadow" style="border-radius: 22px;">
                    <div class="card-header border-bottom-0">
                        <div class="row">
                            <div class="col-12 text-center">

                                <h2 class="headerAdmin ng-scope" style="color: #007bff;">Resultado política</h2>
                                <p class="resultadoPolitica colourGreen">
                                    @{{ infoLead.latest_intention.definition.DESCRIPCION + " / " + infoLead.latest_intention.definition.ID_DEF }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-sm-7 col-md-6 d-flex justify-content-center">
                                <div class="col-sm-12 col-md-8">
                                    <p>
                                        <label for="">Número de documento: </label> @{{ infoLead.CEDULA }}
                                    </p>
                                    <p>
                                        <label for="">Actividad: </label> @{{ infoLead.ACTIVIDAD }}
                                    </p>
                                    <p
                                        ng-if="infoLead.ACTIVIDAD == 'NO CERTIFICADO' || infoLead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO'">
                                        <label for="">Actividad independiente: </label> @{{ infoLead.ACT_IND }}
                                    </p>
                                    <p>
                                        <label for="">Tiempo Labor: </label> <span
                                            ng-if="infoLead.latest_intention.TIEMPO_LABOR == 1"> Si
                                            cumple</span> <span ng-if="infoLead.latest_intention.TIEMPO_LABOR == 0"> No
                                            cumple</span>
                                    </p>
                                    <p
                                        ng-if="infoLead.ACTIVIDAD == 'NO CERTIFICADO' || infoLead.ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || infoLead.ACTIVIDAD == 'RENTISTA'">
                                        <label for="">Ingresos: </label> <span> $
                                            @{{ infoLead.SUELDOIND + infoLead.OTROS_ING | number:0}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-7 col-md-6 d-flex justify-content-center">
                                <div class="col-sm-12 col-md-8 ">
                                    <p>
                                        <label for="">Sucursal: </label> @{{ infoLead.SUC }}
                                    </p>
                                    <p>
                                        <label for="">Celular: </label> @{{ infoLead.CELULAR }}
                                    </p>
                                    <p>
                                        <label for="">Tarjeta: </label> @{{ infoLead.latest_intention.TARJETA }}
                                    </p>
                                    <p>
                                        <label for="">Estado: </label> @{{ infoLead.ESTADO }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="caracteristicaPolitica">
                                <i>* @{{ infoLead.latest_intention.definition.CARACTERISTICA }}</i>
                            </p>
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