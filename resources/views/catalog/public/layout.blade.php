    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to catalog
    **Date: 18/01/2019
     -->
     
@extends('layouts.appFooter')

@section('content')
    <div ng-app="PublicApp">
        <ng-view>
        </ng-view>
    </div>
    <script src="{{ asset('js/appCatalog/appPublic/app.js') }}"></script>
    <script src="{{ asset('js/appCatalog/appPublic/services/myService.js') }}"></script>
    <script src="{{ asset('js/appCatalog/appPublic/controllers/Controller.js') }}"></script>
@stop
