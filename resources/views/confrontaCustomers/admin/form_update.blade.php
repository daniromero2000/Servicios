@extends('layouts.admin.app')
@section('title', 'Actualizar Datos')
@section('metaTags')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('linkStyleSheets')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/front/ConfrontaCustomers/app.css')}}">
{{-- @php
dd($customer);
@endphp --}}
@endsection
@section('content')
<div class="content-header" style=" margin-bottom: -15px; ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb bradcrumb-reset float-sm-right">
                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/Administrator/customers">Clientes</a></li>
                    <li class="breadcrumb-item"><a href="/change-customer-data">Actualizar Cliente</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<input type="text" value="{{$notification}}" id="notification" hidden>
@include('layouts.form.ConfrontaCustomersUpdate')

@endsection
@section('scriptsJs')
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ asset('js/front/ConfrontaCustomers/app.js') }}"></script>
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endsection