    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO FAQS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for FAQS CRUD
    **Fecha: 12/12/2018
     -->
@extends('layouts.app')

@section('content')
    <div ng-app="BrandApp" class="containerleads container">
        <br>

        <div class="container">
            <ng-view>
            </ng-view>
        </div>

    </div>
    <script src="{{ asset('js/appBrands/app.js') }}"></script>
    <script src="{{ asset('js/appBrands/services/myService.js') }}"></script>
    <script src="{{ asset('js/appBrands/controllers/Controller.js') }}"></script>
@stop
