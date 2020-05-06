@extends('layouts.app')
@section('title', 'Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta.')
@section('metaTags')
<meta name="googlebot" content="noindex">
<meta name="robots" content="noindex">
<link rel="canonical" href="https://www.serviciosoportunidades.com/oportuya" />
<meta name="description"
    content="Tarjeta Oportuya, nuestro cupo de tarjeta de crédito con el que podrás obtener todos los beneficios de ser un cliente Oportunidades.">
<meta name="keywords"
    content="Tarjeta de credito, Tarjeta de crédito, solicitar tarjeta de credito, solicitar tarjeta de crédito, tarjeta de credito online, tarjeta de crédito online, su tarjeta de crédito, su tarjeta de credito, como sacar una tarjeta de credito, como sacar una tarjeta de crédito, como tramitar una tarjeta de credito, como tramitar una tarjeta de crédito, requisitos para tarjeta de crédito, requisitos para tarjeta de credito, obtén una tarjeta de credito, obtén una tarjeta de crédito, requisitos tarjeta de credito, requisitos tarjeta de crédito, quiero una tarjeta de credito, quiero una tarjeta de crédito, tarjeta oportunidades, oportunidades, tarjeta con credito para compras, tarjeta con crédito para compras, credito en tarjeta, crédito en tarjeta.">
<meta property="og:title" content="Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta." />
<meta property="og:url" content="https://www.serviciosoportunidades.com/oportuya" />
<meta property="og:type" content="Website" />
<meta property="og:image" content="{{ asset('images/OportuyaPortadaOg.png') }}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:description"
    content="Tarjeta Oportuya, nuestro cupo de tarjeta de crédito con el que podrás obtener todos los beneficios de ser un cliente Oportunidades">
<link rel="stylesheet" href="{{ asset('css/front/homeAppliances/app.css')}}">

@endsection()

@section('content')
@php
$images = $product->images()->get(['src']);
$imagenes = [];
$productImages =[];
array_push($productImages, $product->cover);
foreach ( $images as $key => $value) {
array_push($productImages, $images[$key]->src );
}
foreach ( $productImages as $key => $value) {
array_push($imagenes, [$productImages[$key], $key]);
}
@endphp

<div class="my-3 padding-reset" style="max-width: 1300px;margin: 0px auto; margin-bottom: 5% !important;">
    <div class="row mr-0 justify-content-center">
        <div class="col-12">
            <h5 class="breadcrumb-product">Oportunidades Servicios > Crédito Electrodomésticos >
                {{ $product->reference }} </h5>
        </div>
        <div class="col-lg-7 mt-3 px-0"
            style="box-shadow: 0 .4rem 1rem rgba(0,0,0,0.05)!important;border-radius: 21px;">
            <div class="w-100 padding-reset">
                <p class="reference-product">{{ $product->reference}}.</p>
                <h4 class="name-product"> {{ $product->name}} </h4>
                <div class="description-produc">

                    {!!html_entity_decode($product->description)!!}
                </div>

                {{-- <ul class="description-product">
                    <li>{{ $product->description}}</li>
                <li>Lorem ipsum</li>
                <li>Lorem ipsum</li>
                <li>Lorem ipsum</li>
                </ul> --}}

            </div>
            <div class="" style="border-radius: 21px; margin-top: 5%;">
                <div class="carousel-container position-relative row">
                    <div class="row mx-auto">
                        <div class="container">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($imagenes as $image)
                                    <div @if ($image[1]==0) class="carousel-item active" @else class="carousel-item"
                                        @endif data-slide-number="{{$image[1]}}">
                                        <img src="{{asset('storage/'.$image[0])}}" class="img-principal-carousel"
                                            alt="..." data-type="image" data-toggle="lightbox"
                                            data-gallery="example-gallery">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="carousel-thumbs" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row mx-0">
                                @foreach($imagenes as $image)

                                <div id="carousel-selector-{{$image[1]}}" @if ($image[1]==0)
                                    class="thumb col-4 col-sm-3 px-0 py-2 selected" @else
                                    class="thumb col-4 col-sm-3 px-0 py-2" @endif data-target="#myCarousel"
                                    data-slide-to="{{$image[1]}}">
                                    <img src="{{asset('storage/'.$image[0])}}" class="img-fluid" alt="...">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-thumbs" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-thumbs" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-5 container-deal">
            <div class="row mx-0 container-steps-products justify-content-center text-center">
                <div class="col-4">
                    <div>
                        <img src="{{ asset('images/Front/OportuyaCustomers/iconos/Icon_Envio.png') }}" alt=""
                            class="img-step-product">
                    </div>
                    <div class="mt-2 text-step-product">
                        Envio gratis para ciudades con tienda fisica
                    </div>
                </div>
                <div class="col-4">
                    <div>
                        <img src="{{ asset('images/Front/OportuyaCustomers/iconos/Icono_Credit.png') }}" alt=""
                            class="img-step-product">
                    </div>
                    <div class="mt-2 text-step-product">
                        Crédito sujeto a aprobación de politicas
                    </div>
                </div>
                <div class="col-4">
                    <div>
                        <img src="{{ asset('images/Front/OportuyaCustomers/iconos/Icon_Store.png') }}" alt=""
                            class="img-step-product">
                    </div>
                    <div class="mt-2 text-step-product">
                        Crédito aplica para ubicación en tienda fisica
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card border-0 container-deal-product">
                    <div class="card-body pt-0 pr-4 pl-4">
                        @php
                        $desc = ($product->price - $product->sale_price);
                        $desc= round(($desc / $product->price)*100 );
                        @endphp
                        <div class="relative text-center  container-desc-deal">

                            <div class="card-products-discount">
                                <p>{{$desc}}%</p>
                                <p>Dcto</p>
                            </div>
                            <div class="container-price-deal">
                                <p class="card-text card-products-old-price mb-0"> <del>$
                                        {{ number_format($product->price)}}
                                    </del></p>
                                <p class="card-text card-products-label mb-1">Precio antes</p>

                                <p class="card-text card-products-new-price mb-0">$
                                    {{ number_format($product->sale_price)}}
                                </p>
                                <p class="card-text card-products-label mb-3">Precio ahora</p>
                            </div>

                        </div>
                        <div class="relative">

                            <img src="{{ asset('images/Front/OportuyaCustomers/Fotos Productos/TV LG 43/Tarjeta.png')}}"
                                class="img-card-deal-product">



                            <p class="card-text term-deal-product">Llévalo a <b> {{$product->months}}
                                    meses </b> con tu tarjeta oportuya:
                            </p>
                            <div class="container-dues-deal-product">
                                <p class="card-text card-products-price">
                                    $ {{ number_format($product->pays)}}
                                </p>
                                <p class="card-text text-dues-deal-product">* Cuota semanal</p>
                                <a href="#" class="btn card-products-button card-products-button-apply">Solicitar
                                    aqui</a>
                            </div>

                        </div>

                        <div class="relative">
                            <ol class="container-ol-steps-deal-product">
                                <li>Diligencia la solicitud de crédito en linea</li>
                                <li>Recibiras un SMS con un token de confirmación</li>
                                <li>Una vez aprobado tu crédito uno de nuestros asesores se comunicará contigo </li>
                                <li>Nuestro personal se encargara de recoger la documentación firmada</li>
                                <li>Realizaremos la entrega del articulo en la puerta de tu casa</li>
                            </ol>
                        </div>

                        <div class="relative">
                            <h4 class="question-contact-deal-product">¿No tienes claro el procedimiento?</h4>
                            <img src="{{ asset('images/Front/OportuyaCustomers/iconos/Icon_WhatsApp.png')}}" alt=""
                                class="first-img-contact-deal-product">
                            <img src="{{ asset('images/Front/OportuyaCustomers/iconos/Icon_Tell.png')}}" alt=""
                                class="second-img-contact-deal-product">
                            <div class="container-text-contact-deal-product">
                                <p>Preguntale a nuestros asesores:</p>
                            </div>
                            <h4 class="number-contact-deal-product text-center">311 5195753</h4>
                            <div class="text-center">
                                <button class="button-contact-deal-product" type="button">Whatsapp Directo</button>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<div style="max-width: 1300px;margin: 0px auto;margin-bottom: 5%;">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">Descripción del producto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Especificaciones</a>
        </li>
    </ul>
    <div class="tab-content padding-responsive" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card border-0 padding-responsive padding-reset"
                style="box-shadow: 0 .4rem 1rem rgba(0,0,0,0.08)!important;">
                <div class="card-body padding-responsive">
                    <div class="row justify-content-center ">
                        <div class="col-12 col-sm-6  p-0"> <img src="{{asset('storage/'.$product->description_image1)}}"
                                class="img-fluid img-description-product img-responsive">
                        </div>
                        <div class="col-12 col-sm-6  p-0"> <img src="{{asset('storage/'.$product->description_image2)}}"
                                class="img-fluid img-description-product img-responsive">
                        </div>
                        <div class="col-12 col-sm-6  p-0"> <img src="{{asset('storage/'.$product->description_image3)}}"
                                class="img-fluid img-description-product img-responsive">
                        </div>
                        <div class="col-12 col-sm-6  p-0"> <img src="{{asset('storage/'.$product->description_image4)}}"
                                class="img-fluid img-description-product img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card border-0 padding-reset padding-responsive"
                style="box-shadow: 0 .4rem 1rem rgba(0,0,0,0.08)!important;">
                <div class="card-body padding-responsive">
                    <a data-toggle="modal" data-target="#exampleModal">
                        <img class="img-fluid" src="{{asset('storage/'.$product->specification_image)}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                style=" margin-left: auto; margin-right: 6px; ">
                <span aria-hidden="true">&times;</span>
            </button>
            <img class="img-fluid" src="{{asset('storage/'.$product->specification_image)}}" alt="">

        </div>
    </div>
</div>


<div class="container mt-5 mb-5 pt-5  border-0 mx-auto  shadow p-3 mb-5 bg-white rounded" style="margin top: 0%">
    <div class="card    border-0 mx-auto" style="center">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h4 class="text-primary font-weight-bold title-card-step"> Obten tu crédito de la siguiente maneras</h4>
            </div>

            <div class="col-md-6 col-sm-8 col-10 ">
                <div class="card text-center step-cards-product  border-0 mx-auto">
                    <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/1.png') }}" alt=""
                        class="number-img-step-cards">
                    <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/Image_1.png') }}" alt=""
                        class="icon-step-cards">
                    <div class="card-body card-body-view">
                        <p class="card-text text-step-cards">Ingresa nuestra solicitud de crédito para comenzar
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-8 col-10 ">
                <div class="card text-center step-cards-product  border-0 mx-auto">
                    <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/2.png') }}" alt=""
                        class="number-img-step-cards">
                    <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/Image_2.png') }}" alt=""
                        class="icon-step-cards">
                    <div class="card-body card-body-view">
                        <p class="card-text text-step-cards">Deja tus datos completos según la solicitud de crédito que
                            estés dilifenciando. De la calidad de la información dependerá la velocidad en el resultado.
                            Además recuerda que todos los datos son verificados.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-8 col-10 ">
                <div class="card text-center step-cards-product  border-0 mx-auto">
                    <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/3.png') }}" alt=""
                        class="number-img-step-cards">
                    <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/Image_3.png') }}" alt=""
                        class="icon-step-cards">
                    <div class="card-body card-body-view">
                        <p class="card-text text-step-cards">En el intermedio del proceso recibirás un token de
                            confirmación para verificar la existencia de tu número telefónico; no lo elimines, el
                            proceso te lo exigirá para continuar con tu solicitud.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-8 col-10 ">
                <div class="card text-center step-cards-product  border-0 mx-auto">
                    <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/4.png') }}" alt=""
                        class="number-img-step-cards">
                    <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/Image_4.png') }}" alt=""
                        class="icon-step-cards">
                    <div class="card-body card-body-view">
                        <p class="card-text text-step-cards">Una vez haya sido aprobada tu solicitud de crédito. Un
                            asesor se comunicará contigo para finalizar el proceso.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@stop


@section('scriptsJs')
<script src="{{asset('js/front/homeAppliances/app.js')}}"></script>
@endsection