    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for Lines CRUD
    **Fecha: 19/12/2018
     -->
@extends('layouts.app')

@section('content')
    <div ng-app="LineApp" class="containerleads container">
        <br>

        <div class="container">
            <ng-view>
            </ng-view>
        </div>

    </div>
    <script src="{{ asset('js/appLines/app.js') }}"></script>
    <script src="{{ asset('js/appLines/services/myService.js') }}"></script>
    <script src="{{ asset('js/appLines/controllers/Controller.js') }}"></script>
@stop
