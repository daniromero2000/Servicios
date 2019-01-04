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
    <div ng-app="catalogApp" class="containerleads container">
        <br>
        <div class="container">
            <ng-view>
            </ng-view>
        </div>

    </div>
    <script src="{{ asset('js/appCatalog/app.js') }}"></script>
    <script src="{{ asset('js/appCatalog/controllers/productsController.js') }}"></script>
    <script src="{{ asset('js/appCatalog/controllers/linesController.js') }}"></script>
    <script src="{{ asset('js/appCatalog/controllers/brandsController.js') }}"></script>
@stop