@extends('layouts.admin.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
            </div>
            <div class="col-sm-12 text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item bradcrumb-reset"><a href="/Administrator/dashboard">Dashboard</a></li>
                    @if (auth()->user()->idProfile == 2 )
                    <li class="breadcrumb-item active"><a href="/Administrator/dashboard/comunitymanager">Dashboard
                            Leads Canal Digital</a></li>
                    <li class="breadcrumb-item active"><a href="/Administrator/digitalchannelleads">Leads Canal
                            Digital</a></li>
                    @endif
                    @if (auth()->user()->idProfile == 20 )
                    <li class="breadcrumb-item active"><a href="/Administrator/LeadsInsurance">Leads Seguros</a></li>
                    @endif
                    @if (auth()->user()->idProfile == 19 )
                    <li class="breadcrumb-item active"><a href="/Administrator/LeadWallets">Leads Cartera</a></li>
                    @endif
                    @if (auth()->user()->idProfile == 18 )
                    <li class="breadcrumb-item active"><a href="/Administrator/LeadWarranties">Leads Garantias</a></li>
                    @endif
                    @if (auth()->user()->idProfile == 22 )
                    <li class="breadcrumb-item active"><a href="/Administrator/LeadsAdvancedUnit">Leads Unidad
                            Avanzada</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active"><a href="">Detalle Intención</a></li>
                </ol>
            </div>
            <div class="col-12 mt-3">
                <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto btn-sm ">Regresar</a>
                <button class="btn btn-primary btn-sm">
                    <a data-toggle="modal" data-target="#addleadmodal">Agregar Lead <i
                            class="far fa-plus-square"></i></a>
                </button>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content border-0 m-2">
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
        <div class="tab-content" id="tabcontent">
            <div role="tabpanel" class="tab-pane container-fluid active" id="info">
                @include('digitalchannelleads.layouts.generals')
                @if (auth()->user()->idProfile == 2 || auth()->user()->idProfile == 4 || auth()->user()->idProfile == 3)
                @include('digitalchannelleads.layouts.lead_libranza')
                @endif
                @if (auth()->user()->idProfile == 2 || auth()->user()->idProfile == 4)
                @include('digitalchannelleads.layouts.lead_prices')
                @endif
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

        </div>
        <div class="row row-reset border-0">
            <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto btn-sm mr-3 mb-2 ">Regresar</a>
        </div>
</section>
@include('digitalchannelleads.layouts.update_lead_modal')
@include('digitalchannelleads.layouts.create_lead_modal')
@endsection
@section('scriptsJs')
<script src="{{ asset('js/selectDigitalChanel.js') }}"></script>
@endsection