@extends('layouts.admin.app')
@section('linkStyleSheets')
@endsection
@section('content')
<section >
    @include('layouts.errors-and-messages')
    @if(!is_null($assessorQuotations))
    <div class="mx-auto" style="max-width: 1450px;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-9 order-sm-last">
                        <ol class="breadcrumb bradcrumb-reset float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="/Administrator/assessorquotations">Listado de
                                    cotizaciones</a></li>
                        </ol>
                    </div>
                    <div class="col-sm-3 mt-2 order-sm-first">
                        <a href="{{ URL::previous() }}"
                            class="btn btn-primary ml-auto mr-3 mb-2 btn-sm-reset">Regresar</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="row mx-0 p-2">

            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Reportes</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-sm-6 col-md-6">
                                <!-- /.info-box -->
                                <div class="small-box ">
                                    <div class="inner">
                                        <h2 class="titleCardNumber">{{ $listCount }}</h2>
                                        @if (request()->input())
                                        <p class="textCardNumber">Total de Cotizaciones</p>
                                        @else
                                        <p class="textCardNumber">Cotizaciones en este mes</p>
                                        @endif
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6">
                                <div class="small-box ">
                                    <div class="inner">
                                        <h2 class="titleCardNumber">Total</h2>
                                        <p>${{ number_format ($assessorQuotationsTotal) }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Filtros</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('layouts.admin.search_quotations', ['route' => route('assessorquotations.index')])
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xl-9">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Cotizaciones</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        @if($assessorQuotations->toArray())
                        @include('layouts.admin.tables.tables_assessor_quotations_status', [$headers, 'datas' =>
                        $assessorQuotations ])
                        @include('layouts.admin.pagination.pagination', [$skip])
                        @else
                        <div class="px-3">
                            @include('layouts.admin.pagination.pagination_null', [$skip])
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
</section>
@endsection

@section('scriptsJs')

@endsection