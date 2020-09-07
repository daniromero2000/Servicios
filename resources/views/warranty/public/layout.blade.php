<!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to warranty form
    **Date: 05/03/2019
     -->

@extends('layouts.app')
@include('layouts.front.layouts.googleAds')
@section('linkStyleSheets')
<link rel="stylesheet"
    href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@stop
@section('title', 'Servicios Financieros Oportunidades - Crédito para todo')



@section('content')

<!-- Slider Section Oportuya Page -->
<div id="warrantySlider">
    @foreach($images as $slider)
    <div class="containImg">
        <img src="/images/{{ $slider['img'] }}" class="img-fluid img-responsive" title="{{ $slider['title'] }}" />
    </div>
    @endforeach
</div>

<div class="row resetRow text-center justify-content-center ">

    <div class="col-12 col-md-3  resetCol Warrantyicons">
        <img src="{{ asset('images/Warranty-icon01-min.jpg') }}" class="img-fluid img-responsive" />
        <p> Ten presente que se debe solucionar tu caso dentro de 30 días hábiles como lo indica la ley.</p>
    </div>
    <div class="col-12 col-md-3 resetCol Warrantyicons">
        <img src="{{ asset('images/Warranty-icon02-min.jpg') }}" class="img-fluid img-responsive" />
        <p> Trabajamos solo con técnicos certificados.</p>
    </div>
    <div class="col-12 col-md-3 resetCol Warrantyicons">
        <img src="{{ asset('images/Warranty-icon03.jpg') }}" class="img-fluid img-responsive" />
        <p> Tramita tu garantía en línea.</p>
    </div>

</div>

<div ng-app="WarrantyApp">
    <ng-view>
    </ng-view>
</div>
<div class="text-center WarrantyBrandsContainer">
    <h2> <span class="WarrantyLogosTitle"> <b> FABRICANTES DE RESPALDO </b> </span> </h2>

    <div class="row resetRow justify-content-center">
        <div class="brandsSlider col-md-12 col-lg-10">
            <div id="warrantyBrandsSlider" class="row resetRow">
                @foreach($logos as $slider)
                <div class="col align-self-center">
                    <img src="/images/{{ $slider['img'] }}" class="img-fluid " title="{{ $slider['title'] }}" />
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="row resetRow warrantyCoverage justify-content-center">
    <div class="col-4 col-sm-2 align-self-center">
        <img src="/images/warrantyColombia-min.png" class="img-fluid" />
    </div>
    <div class="col-12 d-sm-none">
    </div>
    <div class="col-10 col-sm-8 col-md-4 text-center text-md-left align-self-center">
        <p> Tenemos cobertura de garantía para todos nuestros productos a nivel nacional </p>
    </div>
</div>
<div id="newsletter-avance">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6">
                <h3>
                    SÉ EL PRIMERO EN RECIBIR NUESTRAS <br> OFERTAS Y LANZAMIENTOS
                </h3>
            </div>
            <div class="col-12 col-sm-12 col-md-6">
                <div class="newsletter-avance-input">
                    <form action="{{route('newsletter.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-10">
                                <input type="email" name="email" class="form-control"
                                    placeholder="Ingresa tu correo electrónico">
                            </div>
                            <div class="col-2">
                                <div class="input-group-prepend">
                                    <button class="btn btn-newsletter-avances"><i
                                            class="fas fa-paper-plane"></i></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1"
                                    required>
                                <label for="termsAndConditions" style="font-size: 10px; font-style: italic;">
                                    Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition"
                                        target="_blank">términos y condiciones</a> y <a
                                        href="/Proteccion-de-datos-personales" class="linkTermAndCondition"
                                        target="_blank">política de tratamiento de datos</a>
                                </label>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
<script src="{{ asset('js/appWarranty/app.js') }}"></script>
<script src="{{ asset('js/appWarranty/controllers/warranty.js') }}"></script>
@stop