@extends('layouts.admin.app')
@section('content')

<section>
    @include('layouts.errors-and-messages')
    @if(!is_null($digitalChannelLeads))
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <ol class="breadcrumb bradcrumb-reset float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="/Administrator/dashboard/digitalChannelLead">Dashboard
                                    Leads Canal Digital</a>
                            <li class="breadcrumb-item active"><a href="/Administrator/digitalchannelleads">Leads</a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-12 mt-2">
                        <a href="{{ URL::previous() }}"
                            class="btn btn-primary ml-auto mr-3 mb-2 btn-sm-reset">Regresar</a>
                        <button class="btn btn-primary ml-auto mr-3 mb-2 btn-sm-reset">
                            <a data-toggle="modal" data-target="#addleadmodal">Agregar Lead <i
                                    class="far fa-plus-square"></i></a>
                        </button>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @include('layouts.admin.leads.template_list',['data' => $digitalChannelLeads , 'route' =>
        'digitalchannelleads.index'])
        <div class="row row-reset text-right">
            <div class="col-12">
                <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
            </div>
        </div>
    </div>
    @endif
    @include('digitalchannelleads.layouts.create_lead_modal')
    @include('digitalchannelleads.layouts.delete_lead_modal')
</section>
@endsection
@section('scriptsJs')
<script src="{{ asset('js/selectDigitalChanel.js') }}"></script>
@endsection