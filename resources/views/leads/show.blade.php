@extends('layouts.admin.app')
@section('content')

<section class="content border-0">
    @include('layouts.errors-and-messages')

    <div class="card border-0 mt-5">
        <ul class="nav nav-tabs border-0" id="tablist" role="tablist">
            <li class="active" role="presentation">
                <a class="nav-link active " data-toggle="tab" href="#info" role="tab" aria-controls="home">Cliente</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#seguimiento" role="tab"
                    aria-controls="profile">Seguimiento</a>
            </li>
        </ul>
        <div class="tab-content mt-4" id="tabcontent">
            <div role="tabpanel" class="tab-pane container-fluid active" id="info">
                <div class="container-fluid card">

                    @include('leads.layouts.generals')
                </div>

                <div class="container-fluid mt-5 card">
                    @include('leads.layouts.customer')

                </div>

                <div class="container-fluid mt-5 card">
                    @include('leads.layouts.creditcard')

                </div>

            </div>
            <div role="tabpanel" class="tab-pane" id="contact">
                <div class="row">


                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="seguimiento">
                <div class="row">
                     @include('layouts.admin.commentaries', ['datas' => $digitalChannelLead->comments])
                    {{-- @include('customers::layouts.statusesLog', ['datas' => $digitalChannelLead->customerStatusesLog]) --}}
                </div>
            </div>


            <div class="row border-0">
                <a href="{{ route('leads.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>

        </div>
</section>
@endsection