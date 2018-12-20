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
    <div ng-app="ProductApp" class="containerleads container">
        <br>
        <div class="container">
            <ng-view>
            </ng-view>
        </div>

    </div>
    <script src="{{ asset('js/appProduct/app.js') }}"></script>
    <script src="{{ asset('js/appProduct/services/myService.js') }}"></script>
    <script src="{{ asset('js/appProduct/controllers/Controller.js') }}"></script>
@stop
