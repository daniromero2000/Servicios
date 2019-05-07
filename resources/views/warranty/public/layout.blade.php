    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to warranty form
    **Date: 05/03/2019
     -->
     
@extends('layouts.app')

@section('linkStyleSheets')
    <link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@stop
@section('content')

<!-- Slider Section Oportuya Page -->
    <div id="warrantySlider">
		@foreach($images as $slider)
			<div class="containImg">
				<img src="/images/{{ $slider['img'] }}" class="img-fluid img-responsive" title="{{ $slider['title'] }}" />
			</div>
		@endforeach
	</div>


    <div ng-app="WarrantyApp">
        <ng-view>
        </ng-view>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
    <script src="{{ asset('js/appWarranty/appPublic/app.js') }}"></script>
    <script src="{{ asset('js/appWarranty/appPublic/controllers/warranty.js') }}"></script>
@stop
