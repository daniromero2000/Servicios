@extends('layouts.admin.app')

@section('linkStyleSheets')
    <link rel="stylesheet" href="{{ asset('css/productList/productList.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ngTags/ng-tags-input.min.css') }}">
    <link rel="stylesheet"
        href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
    <style>
        html {
            min-width: 440px
        }

        body {
            min-width: 440px
        }

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
    <script src="http://parall.ax/parallax/js/jspdf.js?1391533408"></script>
    <script>
        document.write('<base href="' + document.location + '" />');

    </script>

@endsection

@section('content')
    <section style="min-width: 440px">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb bradcrumb-reset float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="/Administrator/ProductList#!/">Administrador de
                                    Listas</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div ng-app="creditLiqudatorApp" ng-controller="creditLiqudatorController" ng-cloak onload="cargar()">

            {{-- <button ng-click="printToCart('printSectionId')"
                class="button">Print</button> --}}
            <input type="hidden" id="identification" ng-model="lead.CEDULA" value="{{ $id }}">
            <div class="container-fluid">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <nav>
                            <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 1 }"
                                    ng-click="tabs = 1" data-toggle="tab" role="tab" aria-controls="nav-general">Liquidador
                                    de crédito</a>
                                <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 2 }"
                                    ng-click="tabs = 2" data-toggle="tab" role="tab" aria-controls="nav-general">Buscar
                                    producto</a>

                            </div>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="overlay" data-ng-show="loader">
                                <div class="loader-products">
                                </div>
                                <div class="text-loader">
                                    Cargando...
                                </div>
                            </div>
                            <div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel"
                                aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 1 }">
                                <div class="row">
                                    <div class="col-12">
                                        @include('creditLiquidator.layouts.cards.customer')
                                        @include('creditLiquidator.layouts.cards.liquidator')
                                    </div>
                                </div>
                                <div class="ml-auto my-auto d-flex justify-content-end">
                                    <div class="d-block mx-2" ng-if="liquidator[0]">
                                        <label for="">¿Se ofrece garantía extendida?</label>
                                        <select name="action" class="form-control" required ng-model="request.EXTENDID"
                                            style=" max-width: 190px; ">
                                            <option selected value> Seleccione </option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="d-flex" ng-if="liquidator[0]">
                                        <button type="button" ng-disabled="!request.EXTENDID" ng-click="createLiquidator()"
                                            class="btn btn-primary btn-sm"
                                            style=" margin-bottom: 2px; margin-top: auto; ">Crear
                                            Liquidacion</button>
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
                </div>
            </div>
        </div>
    </section>
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
    <script src="{{ asset('js/appCreditLiqudator/controllers/creditLiqudatorController.js') }}"></script>
    <script src="{{ asset('js/appCreditLiqudator/services/myService.js') }}"></script>

@endsection
@stop
