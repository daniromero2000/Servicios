@extends('layouts.admin.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
            </div>
            <div class="col-2">
                <button class="btn btn-primary">
                    <a data-toggle="modal" data-target="#addleadmodal">Agregar Lead <i
                            class="far fa-plus-square"></i></a>
                </button>
            </div>
            <div class="col-sm-8">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/Administrator/dashboard/comunitymanager">Dashboard
                            Leads Canal Digital</a>
                    <li class="breadcrumb-item active"><a href="/Administrator/digitalchannelleads">Leads Canal
                            Digital</a></li>
                    <li class="breadcrumb-item active"><a href="">Detalle Intención</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content border-0">
    @include('layouts.errors-and-messages')
    <div class="card border-0 ">
        <ul class="nav nav-tabs border-0" id="tablist" role="tablist">
            <li class="active" role="presentation">
                <a class="nav-link active " data-toggle="tab" href="#info" role="tab" aria-controls="home">Lead</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#seguimiento" role="tab"
                    aria-controls="profile">Seguimiento</a>
            </li>
        </ul>
        <div class="tab-content mt-4" id="tabcontent">
            <div role="tabpanel" class="tab-pane container-fluid active" id="info">
                @include('digitalchannelleads.layouts.generals')
                @include('digitalchannelleads.layouts.lead_prices')
            </div>
            <div role="tabpanel" class="tab-pane" id="contact">
                <div class="row">
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="seguimiento">
                <div class="row">
                    @include('digitalchannelleads.layouts.commentaries', ['datas' => $digitalChannelLead->comments])
                    @include('digitalchannelleads.layouts.statusesLog', ['datas' =>
                    $digitalChannelLead->leadStatusesLogs])
                </div>
            </div>
            <div class="row row-reset border-0">
                <a data-toggle="modal" data-target="#updateleadModal" class="btn btn-primary ml-auto mr-3 mb-2 " style="
                    color: white;">Editar</a>
                <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
            </div>
        </div>
</section>
@include('digitalchannelleads.layouts.update_lead_modal')
@include('digitalchannelleads.layouts.create_lead_modal')
@endsection