<!--
**Proyecto: SERVICIOS FINANCIEROS
**Caso de Uso: Modulos
**Autor: Juan Sebastian Ormaza
**Email: desarrollo@lagobo.com
**Fecha: 04/02/2019
-->
@extends('layouts.app')
@section('content')
    <div ng-app="modulesApp" class="containerleads container">
        <div class="container">
            <ng-view>
            </ng-view>
        </div>
    </div>
    
    <script src="{{ asset('js/libsJs/bootbox.js') }}"></script>
    <script src="{{ asset('js/appModules/app.js') }}"></script>
    <script src="{{ asset('js/appModules/controllers/modulesController.js') }}"></script>
@stop