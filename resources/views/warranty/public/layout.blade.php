    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to warranty form
    **Date: 05/03/2019
     -->
     
@extends('layouts.BasicIncludes')

@section('content')

    <div ng-app="WarrantyApp">
        <ng-view>
        </ng-view>
    </div>
    <script src="{{ asset('js/appWarranty/appPublic/app.js') }}"></script>
    <script src="{{ asset('js/appWarranty/appPublic/controllers/warranty.js') }}"></script>
@stop
