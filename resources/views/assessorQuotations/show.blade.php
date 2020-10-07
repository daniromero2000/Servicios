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
                            <li class="breadcrumb-item active"><a href="/Administrator/assessorquotations">Listado de
                                    cotizaciones</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="/Administrator/assessorquotations/{{$assessorQuotation->id}}">Ver
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
        <div class="container-fluid p-3">
            <div class="card">
                <div class="card-body" style="display: block;">
                    <div class="row py-3">
                        <div class="text-gray px-4">
                            <b>Cliente:</b> {{$assessorQuotation->name }} {{$assessorQuotation->lastName}}
                        </div>
                        <div class="text-gray px-4">
                            <b>Cédula:</b> {{$assessorQuotation->cedula }}
                        </div>
                        <div class="text-gray px-4">
                            <b>Correo:</b> {{$assessorQuotation->email }}
                        </div>
                        <div class="text-gray px-4">
                            <b>Total:</b>$ {{number_format($assessorQuotation->total) }}

                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        @foreach($assessorQuotation->values as $key => $value)
                        <li class="nav-item">
                            <a class="nav-link {{$key == 0 ? 'active' : '' }}" id="item{{$key}}-tab" data-toggle="pill"
                                href="#item{{$key}}" role="tab" aria-controls="item{{$key}}" aria-selected="false">Item
                                {{$key + 1}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        @foreach($assessorQuotation->values as $key => $value)
                        <div class="tab-pane fade {{$key == 0 ? 'active show' : '' }}" id="item{{$key}}" role="tabpanel"
                            aria-labelledby="item{{$key}}-tab">
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-gray"><b>Tipo de Cotización:</b>
                                        @if ($value->type_quotation == 1)
                                        Tradicional
                                        @elseif($value->type_quotation == 2)
                                        Oportuya Blue
                                        @elseif($value->type_quotation == 3)
                                        Oportuya Gray
                                        @elseif($value->type_quotation == 4)
                                        Oportuya Black
                                        @else
                                        Contado
                                        @endif </p>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between ">
                                            <div>Negocio</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table text-sm" style="min-width: 600px;">
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
                                                        <tr>
                                                            <td>{{$value->quantity}}</td>
                                                            <td>{{$value->list}}</td>
                                                            <td>{{$value->sku}}</td>
                                                            <td>{{$value->article}}</td>
                                                            <td>$ {{ number_format($value->price) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
                                                @if (!empty($value->discounts->toArray()))
                                                <table class="table text-sm">
                                                    <thead class="">
                                                        <tr>
                                                            <th>Tipo</th>
                                                            <th>%</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($value->discounts as $key => $discount)
                                                        <tr>
                                                            <td>{{ $discount->type}}</td>
                                                            <td>{{ $discount->value}}%</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @else
                                                <div>
                                                    <div class="alert alert-primary" role="alert">
                                                        No hay descuentos
                                                    </div>
                                                </div>
                                                @endif
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
                                                    <input type="text" readonly class="form-control"
                                                        value="{{$value->plan->PLAN}}" aria-describedby="initialFee">
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="initialFee">Cuota inicial</label>
                                                    <input type="text" readonly class="form-control"
                                                        value="$ {{ $value->initial_fee ? number_format($value->initial_fee) : 0}}"
                                                        aria-describedby="initialFee">
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="name">N° de Cuotas <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" readonly class="form-control"
                                                        value="{{$value->term}}" aria-describedby=" initialFee">
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
                                                            <ul class="ml-4 mb-0 fa-ul text-muted mx-auto"
                                                                style=" max-width: 280px; padding: 0px 20px;">
                                                                <li class="mt-2 small d-flex justify-content-between">
                                                                    <span class="fa-li"><i
                                                                            class="fas fa-percent"></i></span>
                                                                    Total
                                                                    Descuentos: <b> $
                                                                        {{number_format($value->total_discount)}}
                                                                    </b>
                                                                </li>
                                                                <li class="mt-2 small d-flex justify-content-between">
                                                                    <span class="fa-li"><i
                                                                            class="fas fa-money-bill-wave-alt"></i></span>
                                                                    Valor cuotas:
                                                                    <b> $ {{number_format($value->value_fee)}}</b></li>
                                                                <li class="mt-2 small d-flex justify-content-between">
                                                                    <span class="fa-li"><i
                                                                            class="fas fa-store-alt"></i></span>
                                                                    Aval+Iva:
                                                                    <b> $ {{number_format($value->total_aval)}}</b></li>
                                                                <li class="mt-2 small d-flex justify-content-between">
                                                                    <span class="fa-li"><i
                                                                            class="fas fa-dollar-sign"></i></span>
                                                                    Subtotal:
                                                                    <b> $ {{number_format($value->subtotal)}}</b></li>
                                                                <li class="mt-2 small d-flex justify-content-between">
                                                                    <span class="fa-li"><i
                                                                            class="fas fa-dollar-sign"></i></span>
                                                                    Iva:
                                                                    <b> $ {{number_format($value->iva)}}</b></li>
                                                                <li class="mt-2 small d-flex justify-content-between">
                                                                    <span class="fa-li"><i
                                                                            class="fas fa-dollar-sign"></i></span>
                                                                    Total:
                                                                    <b> $ {{number_format($value->total)}}</b></li>
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
                        @endforeach
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