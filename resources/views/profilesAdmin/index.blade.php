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
