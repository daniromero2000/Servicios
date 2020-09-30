@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/productList/productList.css') }}">
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
                            <li class="breadcrumb-item active"><a href="/Administrator/assessorquotations">Crear Cotización</a></li>
                        </ol>
                    </div>
                    <div class="col-sm-3 mt-2 order-sm-first">
                        <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 btn-sm-reset">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="false">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Messages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">Settings</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">

                            <div class="row" ng-if="typeQuotations[key].type">
                                <div class="col-12">
                                    <div class="mb-2 text-right" data-toggle="tooltip" data-placement="top" title="Actualizar liquidación">
                                        <a class="mr-3" href>
                                            <i class="fas fa-sync-alt rotate"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between ">
                                            <div>Negocio</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table text-sm" ng-if="tab[0] != ''" style="min-width: 800px;">
                                                    <thead class="">
                                                        <tr>
                                                            <th>Cantidad </th>
                                                            <th>Lista</th>
                                                            <th>Código</th>
                                                            <th>Articulo</th>
                                                            <th>Valor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="item in tab[0]">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div>
                                                    <div class="alert alert-primary" role="alert">
                                                        No hay productos
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-xl-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between ">
                                            <div>Descuentos</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table text-sm" ng-if="tab[1] != ''">
                                                    <thead class="">
                                                        <tr>
                                                            <th>Tipo</th>
                                                            <th>%</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="item in tab[1]">
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div>
                                                    <div class="alert alert-primary" role="alert">
                                                        No hay descuentos
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="name">Plan <span class="text-danger">*</span></label>
                                                    <select id="plan" name="plan" class="form-control " required>
                                                        <option selected value> Selecciona Plan </option>
                                                        <option>
                                                            @{{plan.PLAN}}</option>
                                                    </select>
                                                    <div class="form-group mt-3">
                                                        <label>Aplica IVA?
                                                            <input type="checkbox">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="initialFee">Cuota inicial</label>
                                                    <input required type="text" class="form-control" id="initialFee" aria-describedby="initialFee">
                                                    <div class="form-group mt-3">
                                                        <label>Desea incrementar la cuota inicial?
                                                            <input type="checkbox">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="name">N° de Cuotas <span class="text-danger">*</span></label>
                                                    <select id="feeInitial" name="feeInitial" class="form-control " required>
                                                        <option selected value> Selecciona una Cuota </option>
                                                        <option ng-repeat="fees in numberOfFees" value="@{{fees.CUOTA}}">
                                                            @{{fees.CUOTA}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10 col-md-7 col-lg-6 col-xl-4 mx-auto">
                                    <div>
                                        <div class="row mx-0">
                                            <div class="card bg-white w-100">
                                                <div class="card-header text-muted border-bottom-0">
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row mx-0">
                                                        <div class="col-12">
                                                            <ul class="ml-4 mb-0 fa-ul text-muted mx-auto" style=" max-width: 280px; padding: 0px 20px;">
                                                                <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-percent"></i></span>
                                                                    Total
                                                                    Descuentos: <b> $0 </b>
                                                                </li>
                                                                <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-money-bill-wave-alt"></i></span>
                                                                    Valor cuotas:
                                                                    <b> $ 0</b></li>
                                                                <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-store-alt"></i></span>
                                                                    Aval+Iva:
                                                                    <b> $ 0</b></li>
                                                                <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                                                    Subtotal:
                                                                    <b> $ 0</b></li>
                                                                <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                                                    Iva:
                                                                    <b> $ 0</b></li>
                                                                <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                                                    Total:
                                                                    <b> $ 0</b></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                            Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                            Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                        </div>
                        <div class="tab-pane fade active" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                            Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div>
    </div>
</section>
@endsection

@section('scriptsJs')
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection
