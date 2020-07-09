@extends('layouts.admin.app')

@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/productList/productList.css') }}">
<link rel="stylesheet" href="{{ asset('css/ngTags/ng-tags-input.min.css') }}">
<link rel="stylesheet"
    href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection

@section('content')
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
    <input type="hidden" id="identification" ng-model="lead.CEDULA" value="{{$id}}">
    <div class="container-fluid">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <nav>
                    <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 1 }"
                            ng-click="tabs = 1" data-toggle="tab" role="tab" aria-controls="nav-general">Liquidador de
                            crédito</a>
                        {{-- <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 2 }"
                            ng-click="tabs = 2" data-toggle="tab" role="tab" aria-controls="nav-general">Productos</a>
                        <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 3 }"
                            ng-click="tabs = 3" data-toggle="tab" role="tab" aria-controls="nav-general">Calcular
                            precio</a> --}}
                    </div>
                </nav>
            </div>
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel"
                        aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 1 }">
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                @include('creditLiquidator.layouts.cards.customer')
                                @include('creditLiquidator.layouts.cards.liquidator')
                            </div>
                            {{-- <div class="col-md-6 col-lg-5">
                                @include('ProductList.layouts.Cards.CardProductLists')
                            </div> --}}
                        </div>
                    </div>

                    <div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel"
                        aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 2 }">
                        {{-- <div class="row">
                            <div class="col-md-6">
                                @include('ProductList.layouts.Cards.CardListGiveAway')
                            </div>
                            <div class="col-md-6">
                                @include('ProductList.layouts.Cards.CardFactors')
                            </div>
                        </div> --}}
                    </div>

                    <div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel"
                        aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 3 }">
                        {{-- <div class="row">
                            <div class="col-12">
                                @include('ProductList.layouts.Cards.cardProductPrice')
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="ml-auto my-auto">
                    <button type="button" ng-click="createLiquidator()" class="btn btn-primary btn-sm">Crear
                        Liquidacion</button>
                </div>
            </div>
            {{-- <div> @include('ProductList.layouts.Modals.ModalFactors') </div>
            <div> @include('ProductList.layouts.Modals.ModalProductLists')</div>
            <div> @include('ProductList.layouts.Modals.ModalListProduct') </div>
            <div> @include('ProductList.layouts.Modals.ModalListGiveAway') </div> --}}
        </div>
    </div>
</div>
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