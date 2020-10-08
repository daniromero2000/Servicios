@extends('layouts.admin.app')

@section('metaTags')
<meta name="googlebot" content="noindex">
<meta name="robots" content="noindex">
@endsection()

@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/assessor/forms/ventaContado.css') }}">
<link rel="stylesheet" href="{{ asset('css/assessor/forms/creacionCliente.css') }}">
<link rel="stylesheet"
    href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection

@section('content')
<div class="container" ng-app="asessorVentaContadoApp" ng-controller="asessorVentaContadoCtrl" ng-cloak>
    <div class="row">
        <div class="col-12 text-center">
            <p class="ventaContado-text">
                <i>* Recuerde que el correcto diligenciamiento de este formulario agilizará el proceso de facturación de
                    la cajera con Apoteosys.</i>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 offset-sm-3">
            <label class="ventaContado-label" for="tipoCliente">Tipo de Cliente*</label>
            <select class="form-control" id="tipoCliente" ng-model="tipoCliente" ng-change="resetInfoLead()">
                <option value="CREDITO">Crédito</option>
                <option value="CONTADO">Contado</option>
            </select>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12 content-top">
                </div>
            </div>
            <div ng-show="tipoCliente == 'CREDITO'">
                @include('assessors.forms.layouts.credit.step1')
                @include('assessors.forms.layouts.credit.step2')
                @include('assessors.forms.layouts.credit.step3')
                @include('assessors.forms.layouts.credit.step4')
                @include('assessors.forms.layouts.credit.step5')
            </div>
            @include('assessors.forms.layouts.counted.form_contado')
        </div>
    </div>
    @include('assessors.forms.modals.error_data')
    @include('assessors.forms.modals.thank_you_page')
    @include('assessors.forms.modals.code_verefication')
    @include('assessors.forms.modals.validation_lead')
    @include('assessors.forms.modals.confronta')
    @include('assessors.forms.modals.app_error')
    @include('assessors.forms.modals.congratulations')
    @include('assessors.forms.modals.loader')
</div>
@endsection

@section('scriptsJs')

<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/assessorVentaContado.js') }}"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-sanitize.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ng-currency/1.2.7/ng-currency.min.js"></script>
@endsection