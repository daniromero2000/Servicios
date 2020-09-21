@extends('layouts.front.app')
@section('title', 'Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta.')
@section('metaTags')
<meta name="googlebot" content="noindex">
<meta name="robots" content="noindex">
<link rel="canonical" href="https://www.serviciosoportunidades.com/credito-electrodomesticos/catalogo" />
<meta name="description"
    content="Tarjeta Oportuya, nuestro cupo de tarjeta de crédito con el que podrás obtener todos los beneficios de ser un cliente Oportunidades.">
<meta name="keywords"
    content="Tarjeta de credito, Tarjeta de crédito, solicitar tarjeta de credito, solicitar tarjeta de crédito, tarjeta de credito online, tarjeta de crédito online, su tarjeta de crédito, su tarjeta de credito, como sacar una tarjeta de credito, como sacar una tarjeta de crédito, como tramitar una tarjeta de credito, como tramitar una tarjeta de crédito, requisitos para tarjeta de crédito, requisitos para tarjeta de credito, obtén una tarjeta de credito, obtén una tarjeta de crédito, requisitos tarjeta de credito, requisitos tarjeta de crédito, quiero una tarjeta de credito, quiero una tarjeta de crédito, tarjeta oportunidades, oportunidades, tarjeta con credito para compras, tarjeta con crédito para compras, credito en tarjeta, crédito en tarjeta.">
<meta property="og:title" content="Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta." />
<meta property="og:url" content="https://www.serviciosoportunidades.com/credito-electrodomesticos/catalogo" />
<meta property="og:type" content="Website" />
<meta property="og:image" content="{{ asset('images/OportuyaPortadaOg.png') }}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:description"
    content="Tarjeta Oportuya, nuestro cupo de tarjeta de crédito con el que podrás obtener todos los beneficios de ser un cliente Oportunidades">
<link rel="stylesheet" href="{{ asset('css/front/homeAppliances/app.css')}}">

@endsection()

@section('content')

<div class="row m-0 relative">
    <img src="{{ asset('images/Front/OportuyaCustomers/PageCredit/Banner/Banner.png')}}"
        class="img-fluid img-responsive img-principal" />
    <img src="{{ asset('images/Front/OportuyaCustomers/PageCredit/Banner/Banner02.png')}}"
        class="img-fluid img-responsive img-secondary" />
    <div class="text-center container-text-baner-initial">
        <h4 class="text-baner-initial">Comprar tus <br>electrodomésticos <br> a crédito jamás
            <br> fue tan facil</h4>
    </div>
    <a href="/step1" class="btn button-baner-initial">
        <div>
            Solicita tu crédito
        </div>
    </a>
</div>

<div class="modal fade" id="getCity" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="getCityLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="p-5">
                <div class="w-100 mb-3">
                    <h5 class="modal-title" id="getCityLabel"
                        style=" line-height: 17px; font-size: 18px; font-weight: bold; color: #2798c5; ">Para un mejor
                        servicio, por favor ingresa tu ciudad</h5>
                </div>
                <div>
                    <form action="/credito-electrodomesticos/catalogo" method="get">
                        <div class="form-group">
                            <label for="my-select">Selecciona tu ciudad</label>
                            <select id="my-select" class="custom-select" name="city">
                                <option value="">Selecciona</option>
                                <option value="MEDIA">ACACIAS</option>
                                <option value="BAJA">ARMENIA</option>
                                <option value="MEDIA">GARZÓN</option>
                                <option value="BAJA">MANIZALES</option>
                                <option value="MEDIA">MARIQUITA</option>
                                <option value="BAJA">LA DORADA</option>
                                <option value="BAJA">PEREIRA</option>
                                <option value="ALTA">PUERTO LÓPEZ</option>
                                <option value="MEDIA">VILLAVICENCIO</option>
                                <option value="MEDIA">VILLANUEVA</option>
                                <option value="MEDIA">YOPAL</option>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-primary " type="submit">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>


            {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
        </div>
    </div>
</div>
@stop


@section('scriptsJs')
<script src="{{asset('js/front/homeAppliances/app.js')}}"></script>
<script>
    $( document ).ready(function() {
     $('#getCity').modal('show')
     $('#getCity').modal({backdrop: 'static', keyboard: false})
    });
</script>
@endsection