@php
$fechaActual = strtotime(date("Y-m-d"));
$fechaMayorEdad = date("Y-m-d", strtotime("-18 years", $fechaActual));
@endphp
@extends('layouts.admin.app')
@section('content')

<section class="content">
    @include('layouts.errors-and-messages')
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"> <i class="fa fa-home"></i> Dashboard</a><span
                        class="divider"></span>
                </li>
                <li><a href="{{ route('admin.customers.index') }}">Clientes</a><span class="divider"></span>
                <li class="breadactive"> <i class="fa fa-user" aria-hidden="true"></i> {{$customer->name}}
                    {{$customer->last_name}}</li>
            </ol>
        </div>
    </div>
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <ul class="nav nav-tabs" role="tablist" id="tablist">
            <li role="presentation" @if(!request()->has('info')) class="active" @endif><a href="#info"
                    aria-controls="home" role="tab" data-toggle="tab">Cliente</a></li>
            <li role="presentation" @if(request()->has('contact')) class="active" @endif><a href="#contact"
                    aria-controls="profile" role="tab" data-toggle="tab">Contacto</a></li>
            <li role="presentation" @if(request()->has('seguimiento')) class="active" @endif><a href="#seguimiento"
                    aria-controls="profile" role="tab" data-toggle="tab">Seguimiento</a></li>
        </ul>
        <div class="tab-content" id="tabcontent">
            <div role="tabpanel" class="tab-pane active" id="info">
                @include('customers::layouts.generals')
                @include('customers::layouts.ids')
                @include('customers::layouts.vehicles')
                @include('customers::layouts.professions')
                @include('customers::layouts.references')
                @include('customers::layouts.economic_activities')
            </div>
            <div role="tabpanel" class="tab-pane" id="contact">
                <div class="row">
                    @include('customers::layouts.addresses')
                    @include('customers::layouts.phones')
                    @include('customers::layouts.epss')
                    @include('customers::layouts.emails')
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="seguimiento">
                <div class="row">
                    @include('layouts.admin.commentaries', ['datas' => $customer->customerCommentaries])
                    @include('customers::layouts.statusesLog', ['datas' => $customer->customerStatusesLog])
                </div>
            </div>
        </div>
        <div class="row">
            <a href="{{ route('admin.customers.index') }}" class="btn btn-default btn-sm">Regresar</a>
        </div>
        @include('customers::layouts.comment_modal')
        @include('customers::layouts.add_address_modal')
        @include('customers::layouts.add_identity_modal')
        @include('customers::layouts.add_phone_modal')
        @include('customers::layouts.add_eps_modal')
        @include('customers::layouts.add_email_modal')
        @include('customers::layouts.vehicle_modal')
        @include('customers::layouts.reference_modal')
        @include('customers::layouts.economic_activity_modal')
        @include('customers::layouts.add_profession_modal')
    </div>
</section>
@endsection