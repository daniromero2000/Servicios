@extends('layouts.admin.app')
@section('content')
<section>
    @include('layouts.errors-and-messages')
    @if(!is_null($intentionAssessors))
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb bradcrumb-reset float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="/Administrator/dashboard/intentions">Dashboard
                                    Intenciones Web</a>
                            <li class="breadcrumb-item active"><a href="/Administrator/intentions">Intenciones</a></li>
                        </ol>
                    </div>
                    <div class="col-12 mt-2">
                        <a href="{{ URL::previous() }}"
                            class="btn btn-primary ml-auto mr-3 mb-2  btn-sm-reset">Regresar</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container-fluid">
            <div class="card  mb-4 border-0 shadow-lg">
                <div class="row form-group" ng-if="filtros">
                    <div class="col-12">
                        <div class="card-header">
                            @include('layouts.admin.filter_intentionAssessor', ['datas' => $status,'route'
                            =>"/Administrator/intentions/assessors/web"])
                        </div>
                        <div class=" mt-2 col-12 col-sm-12 col-md-12">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6">
                                    <!-- /.info-box -->
                                    <div class="small-box ">
                                        <div class="inner">
                                            <h2>{{ $listCount }}</h2>
                                            @if ($_GET)
                                            <p>Total de Solicitudes</p>
                                            @else
                                            <p>Solicitudes en este mes</p>
                                            @endif
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0 pb-0 ">
                            @if($intentionAssessors)
                            @include('layouts.admin.tables.table_intention_status_assessors', [$headers, 'datas' =>
                            $intentionAssessors ])
                            @include('layouts.admin.pagination.pagination', [$skip])
                            @else
                            @include('layouts.admin.pagination.pagination_null', [$skip])
                            @endif
                        </div>
                        <div class=" mt-2 col-12 col-sm-12 col-md-12">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6">
                                    <!-- /.info-box -->
                                    <div class="small-box ">
                                        <div class="inner">
                                            <h2>{{ $listJarvis->count() }}</h2>
                                            @if ($_GET)
                                            <p>Total de Solicitudes sin finalizar</p>
                                            @else
                                            <p>Solicitudes sin finalizar en este mes</p>
                                            @endif
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0 pb-0 ">
                            @if($listJarvis && $assessorId == 2)
                            @include('layouts.admin.tables.table_intention_status_assessors', [$headers, 'datas' =>
                            $listJarvis ])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-reset text-right">
            <div class="col-12">
                <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection
@section('scriptsJs')
@endsection