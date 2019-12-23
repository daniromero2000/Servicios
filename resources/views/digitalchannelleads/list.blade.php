@extends('layouts.admin.app')
@section('content')
<section>
    @include('layouts.errors-and-messages')
    @if(!is_null($digitalChannelLeads))
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
                    </div>
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="/Administrator/dashboard/intentions">Dashboard
                                    Intenciones Web</a>
                            <li class="breadcrumb-item active"><a href="/Administrator/intentions">Intenciones</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container-fluid">
            <div class="card  mb-4 border-0 shadow-lg">
                <div class="row form-group" ng-if="filtros">
                    <div class="col-12">
                        <div class="card-header">
                            @include('layouts.admin.filter_digital_channel_leads', ['route' =>
                            route('digitalchannelleads.index')])
                        </div>
                        <div class=" mt-2 col-12 col-sm-12 col-md-12">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6">
                                    <!-- /.info-box -->
                                    <div class="small-box ">
                                        <div class="inner">
                                            <h2>{{ $listCount }}</h2>
                                            <p>Solicitudes</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 small-box inner">
                                    <button class="btn btn-primary">
                                        <a data-toggle="modal" data-target="#addleadmodal">Agregar Lead <i
                                                class="far fa-plus-square"></i></a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0 pb-0 ">
                            @if($digitalChannelLeads)
                            @include('layouts.admin.tables.table_digital_channel_leads_status', [$headers, 'datas' =>
                            $digitalChannelLeads ])
                            @include('layouts.admin.pagination.pagination', [$skip])
                            @else
                            @include('layouts.admin.pagination.pagination_null', [$skip])
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
    @include('digitalchannelleads.layouts.create_lead_modal')
    @include('digitalchannelleads.layouts.delete_lead_modal')
    @include('digitalchannelleads.layouts.update_lead_modal')
</section>
@endsection
@section('scriptsJs')
@endsection