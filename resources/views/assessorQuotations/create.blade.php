@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/productList/productList.css') }}">
<link rel="stylesheet" href="{{ asset('css/ngTags/ng-tags-input.min.css') }}">
<link rel="stylesheet"
    href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
<style>
    .rotate {
        transition-duration: .2s, 1s;
        transition-timing-function: linear, ease-in;
    }

    .rotate:hover {
        transform: rotate(180deg);
    }

    .main-header {
        min-width: 440px !important;
    }

    .modal-backdrop {
        width: 100% !important;
        height: auto !important;
    }

    @media(max-width:440px) {
        .card-body {
            padding: 1.25rem 10px !important;
        }
    }

</style>
<style>
    .overlay {
        background: #ffffff;
        display: block;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        opacity: 0.5;
        z-index: 999999;
        max-height: 100%;
    }

    .loader-products {
        background: #ffffff;
        border: 10px solid #f3f3f3;
        border-radius: 50%;
        border-top: 6px solid #007bff;
        border-right: 6px solid #3094ff;
        border-bottom: 6px solid #007bff;
        border-left: 6px solid #3094ff;
        width: 35px;
        height: 35px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        position: absolute;
        margin: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .text-loader {
        margin: auto;
        position: absolute;
        top: 71px;
        left: 0;
        right: 0;
        bottom: 0;
        width: 88px;
        text-align: center;
        height: 10px;
        font-weight: bold;
    }

    .card .overlay {
        background: rgba(255, 255, 255, .9) !important;
    }

    .overlay {
        opacity: 0.8 !important;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

</style>
<link rel="stylesheet" href="{{ asset('css/assessor/forms/creacionCliente.css') }}">
<link rel="stylesheet"
    href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection
@section('content')
<section style="min-width: 540px">
    @include('layouts.errors-and-messages')
    <div class="mx-auto" style="max-width: 1450px;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-9 order-sm-last">
                        <ol class="breadcrumb bradcrumb-reset float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="/Administrator/assessorquotations">Listado de
                                    cotizaciones</a></li>
                            <li class="breadcrumb-item active"><a href="/Administrator/assessorquotations">Crear
                                    Cotización</a></li>
                        </ol>
                    </div>
                    <div class="col-sm-3 mt-2 order-sm-first">
                        <a href="{{ URL::previous() }}"
                            class="btn btn-primary ml-auto mr-3 mb-2 btn-sm-reset">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
        <div ng-app="appQuotations" ng-controller="quotationsController">
            <div class="row mx-0 p-3">
                <div class="w-100">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel"
                            aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 1 }">
                            <div class="row" style=" position: relative; ">
                                <div class="overlay" data-ng-show="loader">
                                    <div class="loader-products">
                                    </div>
                                    <div class="text-loader">
                                        Cargando...
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="container">
                                        <form ng-submit="validateStep1()" name="clienteCredito" id="addCustomerStep1"
                                            ng-show="step == 1" class="crearCliente-form">
                                            <div class="row mx-0 container-form">

                                                <div class="col-12 type-client">
                                                    <div class="forms-descStep forms-descStep-avances">
                                                        <strong>Información principal</strong><br>
                                                        <span class="forms-descText">Ingresa los datos principales para
                                                            hacer la cotización</span>
                                                        <img src="{{ asset('images/datosPersonales.png') }}"
                                                            class="img-fluid forms-descImg">
                                                        <span class="forms-descStepNum">1</span>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            <label class="labels" for="tipodoc">Tipo de
                                                                documento*</label>
                                                            <select class="inputs form-control select2bs4"
                                                                ng-model="lead.TIPO_DOC" id="tipodoc"
                                                                ng-options="type.value as type.label for type in typesDocuments"
                                                                required></select>
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <label class="labels" for="CEDULA">Número de
                                                                documento*</label>
                                                            <input class="inputs"
                                                                validation-pattern="IdentificationNumber"
                                                                ng-blur="getInfoLead()" type="text"
                                                                ng-model="lead.CEDULA" id="CEDULA" required />
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <label class="labels" for="nombres">Nombres*</label>
                                                            <input class="inputs" id="nombres" validation-pattern="name"
                                                                ng-model="lead.NOMBRES" type="text" required />
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <label class="labels" for="lastName">Apellidos*</label>
                                                            <input class="inputs" id="lastName"
                                                                validation-pattern="name" type="text"
                                                                ng-model="lead.APELLIDOS" required />
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <div ng-hide="lead.CEL_VAL">
                                                                <label class="ventaContado-label">Celular*</label>
                                                                <input class="inputs" ng-blur="checkIfExistNum()"
                                                                    ng-model="lead.CELULAR"
                                                                    validation-pattern="telephone" required />
                                                                <div class="alert alert-danger" role="alert"
                                                                    ng-show="showAlertCel" style="margin-top: 10px;">
                                                                    Debe digitar un número de celular
                                                                </div>
                                                            </div>
                                                            <div ng-show="lead.CEL_VAL">
                                                                <label class="ventaContado-label">Celular*</label>
                                                                <input class="inputs" ng-model="CELULAR" readonly
                                                                    ng-disabled="true" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <label class="labels" for="email">Correo electrónico</label>
                                                            <input class="inputs" id="email" type="text"
                                                                validation-pattern="email" ng-model="lead.EMAIL" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center mt-4">
                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                        <input type="checkbox" ng-model="lead.termsAndConditions"
                                                            name="termsAndConditions" id="termsAndConditions"
                                                            required="">
                                                        <label for="termsAndConditions" class="termAndConditions">
                                                            Aceptar <a href="/Terminos-y-condiciones"
                                                                class="linkTermAndCondition" target="_blank"
                                                                style="color: #167efa;">términos y condiciones</a> y
                                                            <a href="/Proteccion-de-datos-personales"
                                                                class="linkTermAndCondition" target="_blank"
                                                                style="color: #167efa;">política de tratamiento de
                                                                datos</a>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-12 text-center">
                                                    <button type="submit" class="btn btn-primary"
                                                        ng-disabled="disabledButton">Continuar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-12" ng-show="step == 2">
                                    <div class="col-12 type-client">
                                        <div class="forms-descStep forms-descStep-avances">
                                            <strong>Cotización</strong><br>
                                            <span class="forms-descText">Ingresa los datos necesarios para el
                                                proceso</span>
                                            <img src="{{ asset('images/datosPersonales.png') }}"
                                                class="img-fluid forms-descImg">
                                            <span class="forms-descStepNum">2</span>
                                        </div>
                                    </div>
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">Cotización</h3>
                                            <div style=" position: absolute; top: 6px; right: 18px; ">
                                                <div class="ml-auto my-auto">
                                                    <button type="button" ng-click="addItem()"
                                                        class="btn btn-primary btn-sm">Agregar
                                                        item</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            @include('assessorQuotations.layouts.quotations')
                                            <div class="ml-auto my-auto">
                                                <button type="button" ng-if="quotations[0]"
                                                    ng-click="createLiquidator()" class="btn btn-primary btn-sm">Crear
                                                    Cotización</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel"
                            aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 2 }">
                            <div class="row">
                                <div class="col-12">
                                    @include('creditLiquidator.layouts.cards.search_product')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade hide" data-backdrop="static" data-keyboard="false" id="congratulations"
                    tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body " style="padding: 0">
                                <div class="row resetRow">
                                    <div class="col-12 text-center resetCol mt-4 ">
                                        <img style="width: 250px;" src="{{ asset('images/oportunidades.png')}}">
                                    </div>
                                </div>
                                <div class="row mt-2 resetRow">
                                    <div class="col-12 text-center">
                                        <img src="https://image.flaticon.com/icons/svg/845/845646.svg" alt=""
                                            style=" width: 11%;margin-top: 1%;margin-right: 0%;margin-bottom: 1%;" />
                                        <p class="">
                                            La cotización fue creada exitosamente,
                                            <br>
                                            Puedes proceder a hacer el proceso de consulta.
                                        </p>
                                    </div>
                                </div>
                                <div class="row mx-0 my-3 justify-content-center">
                                    <a href="/Administrator/assessorquotations"
                                        class="btn btn-primary mr-2">Terminar</a>
                                    <a href="/Administrator/crearCliente" class="btn btn-primary ">Consultar Cliente</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
@endsection

@section('scriptsJs')
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angucomplete-alt/3.0.0/angucomplete-alt.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-sanitize.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ng-currency/1.2.7/ng-currency.min.js"></script>
<script src="{{ asset('js/libsJs/flow.js') }}"></script>
<script src="{{ asset('js/libsJs/fusty-flow.js') }}"></script>
<script src="{{ asset('js/libsJs/fusty-flow-factory.js') }}"></script>
<script src="{{ asset('js/libsJs/ng-flow.js') }}"></script>
<script src="{{ asset('js/libsJs/ng-tags-input.min.js') }}"></script>
<script src="{{ asset('js/appQuotations/controllers/quotationsController.js') }}"></script>
@endsection