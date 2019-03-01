    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to catalog
    **Date: 18/01/2019
     -->
     
@extends('layouts.basicIncludes')

@section('content')

    <div ng-app="WarrantyApp">
        <ng-view>
        </ng-view>
    </div>
    <script src="{{ asset('js/appWarranty/appPublic/app.js') }}"></script>
    <script src="{{ asset('js/appWarranty/appPublic/Controllers/warrantyController.js') }}"></script>
@stop
