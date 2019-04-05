    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to warranty form
    **Date: 05/03/2019
     -->
     
@extends('layouts.BasicIncludes')

<link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">

@section('content')

    <div ng-app="WarrantyApp">
        <ng-view>
        </ng-view>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
    <script src="{{ asset('js/appWarranty/appPublic/app.js') }}"></script>
    <script src="{{ asset('js/appWarranty/appPublic/controllers/warranty.js') }}"></script>
@stop
