@extends('layouts.admin.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/Administrator/dashboard/intentions">Dashboard
                            Intenciónes Web</a>
                    <li class="breadcrumb-item active"><a href="/Administrator/intentions">Intenciónes</a></li>
                    <li class="breadcrumb-item active"><a href="">Detalle Intención</a></li>
                </ol>
            </div>
            <div class="col-12 mt-2">
                <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content border-0">
    @include('layouts.errors-and-messages')

    <div class="card border-0 ">
        <ul class="nav nav-tabs border-0" id="tablist" role="tablist">
            <li class="active" role="presentation">
                <a class="nav-link active " data-toggle="tab" href="#info" role="tab" aria-controls="home">Intención</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#seguimiento" role="tab"
                    aria-controls="profile">Seguimiento</a>
            </li>
        </ul>
        <div class="tab-content mt-4" id="tabcontent">
            <div role="tabpanel" class="tab-pane container-fluid active" id="info">
                @include('intentions.layouts.generals')
            </div>
            <div role="tabpanel" class="tab-pane" id="seguimiento">
                <div class="row">
                    @include('intentions.layouts.intention_data', ['datas' => $intention->dataIntentionRequest])
                    {{-- @include('intentions.layouts.statusesLog', ['datas' => $digitalChannelLeads->leadStatusesLogs]) --}}
                </div>
            </div>
            <div class="row row-reset border-0">
                <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
            </div>

        </div>
</section>
@endsection