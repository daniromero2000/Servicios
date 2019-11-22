<!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DIGITAL
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for render PRODUCT CRUD
    **Fecha: 13/12/2018
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
                    <li class="breadcrumb-item active"><a href="/Administrator/ListaEmpleados#!/ListaEmpleados">Listado
                            de empleados</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div ng-app="listaEmpleadosApp" class="containerleads container">

    <div class="container">
        <ng-view>
        </ng-view>
    </div>

</div>
<script src="{{ asset('js/libsJs/bootbox.js') }}"></script>
<script src="{{ asset('js/appListaEmpleados/app.js') }}"></script>
<script src="{{ asset('js/appListaEmpleados/controllers/listaEmpleadosController.js') }}"></script>
<script src="https://rawgithub.com/angular-ui/ui-sortable/master/src/sortable.js"></script>

@stop