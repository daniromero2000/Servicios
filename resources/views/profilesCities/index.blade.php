    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for cities profiles CRUD
    **Fecha: 21/12/2018
     -->
     
@extends('layouts.app')

@section('content')
    <div ng-app="ProfileCityApp" class="containerleads container">
        <br>

        <div class="container">
            <ng-view>
            </ng-view>
        </div>

    </div>
    <script src="{{ asset('js/appProfilesCities/app.js') }}"></script>
    <script src="{{ asset('js/appProfilesCities/services/myService.js') }}"></script>
    <script src="{{ asset('js/appProfilesCities/controllers/Controller.js') }}"></script>
@stop
