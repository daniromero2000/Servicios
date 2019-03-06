    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DIGITAL
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for render PRODUCT CRUD
    **Fecha: 13/12/2018
     -->
@extends('layouts.app')
@section('content')
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