@extends('layouts.admin.app')
@section('title', 'Actualizar Datos')
@section('metaTags')
@endsection
@section('linkStyleSheets')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
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
@include('layouts.form.loginConfrontaCustomers')
@endsection
@section('scriptsJs')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ asset('js/front/ConfrontaCustomers/app.js') }}"></script>
@endsection