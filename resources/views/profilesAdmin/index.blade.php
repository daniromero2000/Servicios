<!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for cities profiles CRUD
    **Fecha: 21/12/2018
     -->

@extends('layouts.admin.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Bienvenido</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/Administrator/Profiles#!/">Administración de
                            Perfiles</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div ng-app="ProfileApp" class="containerleads container">
    <br>

    <div class="container">

        <ng-view>
        </ng-view>
    </div>

</div>
<script src="{{ asset('js/appProfiles/app.js') }}"></script>
<script src="{{ asset('js/appProfiles/services/myService.js') }}"></script>
<script src="{{ asset('js/appProfiles/controllers/Controller.js') }}"></script>
@stop
@section('scriptsJs')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jsGrid -->
<script src="{{ asset('plugins/jsgrid/demos/db.js') }}"></script>
<script src="{{ asset('plugins/jsgrid/jsgrid.min.js') }}"></script>
@endsection