@extends('layouts.app')
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


<div class=" container-step-cards justify-content-center ml-auto mr-auto">
    <div class="row justify-content-center mt-4 row-step-cards">

        <div class="col-md-4 col-sm-6 col-10 beforeLine">
            <div class="card text-center first-step-cards step-cards border-0">

                <img src="{{ asset('images/Front/OportuyaCustomers/PageCredit/Snipet Pasos/1.png') }}" alt=""
                    class="first-img-step-cards">

                <img src="{{ asset('images/Front/OportuyaCustomers/PageCredit/Snipet Pasos/Hoja.png') }}" alt=""
                    class="second-img-step-cards">
                <div class="card-body card-body-view">
                    <p class="card-text text-step-cards">Solicita tu <b>crédito</b> llenando el formulario</p>
                    <a href="/step1" class="btn first-step-cards-button" type="button">Solicitar</a>

                </div>
            </div>

        </div>

        <div class="col-md-4 col-sm-6 col-10 beforeLine">
            <div class="card text-center step-cards border-0">
                <img src="{{ asset('images/Front/OportuyaCustomers/PageCredit/Snipet Pasos/2.png') }}" alt=""
                    class="first-img-step-cards">
                <img src="{{ asset('images/Front/OportuyaCustomers/PageCredit/Snipet Pasos/Contact_Icon.png') }}" alt=""
                    class="second-img-step-cards">
                <div class="card-body card-body-view">
                    <p class="card-text text-step-cards">Uno de nuestros asesores se comunicará contigo para que
                        elijas
                        tu electrodoméstico y finalizar el proceso <b>100% digital</b>
                    </p>
                </div>
            </div>

        </div>
        <div class="col-md-4 col-sm-6 col-10 ">
            <div class="card text-center step-cards last-step-cards border-0">

                <img src="{{ asset('images/Front/OportuyaCustomers/PageCredit/Snipet Pasos/3.png') }}" alt=""
                    class="first-img-step-cards">

                <img src="{{ asset('images/Front/OportuyaCustomers/PageCredit/Snipet Pasos/HomeIcon.png') }}" alt=""
                    class="second-img-step-cards">

                <div class="card-body card-body-view">
                    <p class="card-text text-step-cards">Finalmente enviaremos un asesor hasta tu <b>domicilio</b>
                        para
                        firmar tus documentos</p>

                </div>
            </div>

        </div>
    </div>
</div>
<div class="row m-0 relative">
    <img src="{{ asset('images/Front/OportuyaCustomers/PageCredit/SnipetPromociones/Promociones.png')}}"
        class="img-fluid img-responsive img-promociones" />
    <img src="{{ asset('images/Front/OportuyaCustomers/PageCredit/SnipetPromociones/Promociones02.png')}}"
        class="img-fluid img-responsive img-promociones-responsive" />
    <div class="text-center container-text-snipet-promotions">
        <h4 class="text-snipet-promotions">Tenemos estas <br> <b>súper promociones </b> <br>
            a
            crédito para ti</h4>
    </div>

</div>
<div style=" margin-top: 5%;">
    <div class=" row justify-content-center container-card-products">
        @if ($products)
        @foreach ($products as $product)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow border-0 text-center card-products">
                <div class="w-100 card-container-products-logo">
                    <img src="{{asset('storage/'.$product->brand_id->cover)}}" class="card-products-logo">
                </div>
                <div class="height-container-img-product">
                    <img src="{{asset("storage/$product->cover")}}" class="card-products-img" alt="...">
                </div>
                <div class="card-body pt-0 pr-4 pl-4">
                    @php
                    $desc = ($product->price - $product->sale_price);
                    $desc= round(($desc / $product->price)*100 );
                    @endphp
                    <h5 class="card-title card-products-title">{{ $product->reference}} </h5>
                    <div class="relative">
                        <div class="card-products-discount">
                            <p>{{$desc}}%</p>
                            <p>Dcto</p>
                        </div>
                        <img src="{{ asset('images/Front/OportuyaCustomers/Fotos Productos/TV LG 43/Tarjeta.png')}}"
                            class="card-products-card-black">
                        <p class="card-text card-products-old-price mb-0"> <del>$ {{ number_format($product->price)}}
                            </del></p>
                        <p class="card-text card-products-label mb-1">Precio antes</p>

                        <p class="card-text card-products-new-price mb-0">$ {{ number_format($product->sale_price)}}
                        </p>


                        <p class="card-text card-products-label mb-3">Precio ahora</p>

                        <p class="card-text card-products-text">Llévalo a <b> {{$product->months}}
                                meses </b> con
                            <br>
                            tu tarjeta black
                        </p>
                        <p class="card-text card-products-price">
                            $ {{ number_format($product->pays)}}
                        </p>
                        <p class="card-text card-products-label">* Cuota semanal</p>
                        <a href="/credito-electrodomesticos/catalogo/{{ $product->slug}}"
                            class="btn card-products-button btn-primary" style="">Ver
                            más</a>
                        <a href="/step1" class="btn card-products-button btn-danger">Solicitar aqui</a>
                    </div>


                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

<div style=" margin-bottom: 5%; ">
    <div class="p-3 background-container-snipet-benefits">
        <div class="row container-snipet-benefits text-white justify-content-center text-center">
            <div class="col-12 mt-4 mb-4">
                <h4 class="container-snipet-benefits-title">Más beneficios para ti </h4>
            </div>
            <div class="col-md-4 col-sm-5">

                <div class="card container-card-benefits ">
                    <img src="{{asset('images/Front/OportuyaCustomers/PageCredit/SnipetMasBeneficios/Icon_Electrodomesticos.png')}} "
                        alt="" class="img-card">
                    <div class="card-body">
                        <p class="card-text">Accede con facilidad a una gran variedad de <b>electrodomésticos</b>
                            para
                            tu
                            parra <b>hogar</b>.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-5">

                <div class="card container-card-benefits">
                    <img src="{{asset('images/Front/OportuyaCustomers/PageCredit/SnipetMasBeneficios/Icon_Avances.png')}} "
                        alt="" class="img-card">
                    <div class="card-body">
                        <p class="card-text">Un cupo de avances para que utilices cuando más lo necesites (desde
                            <b>$100.000</b> - hasta <b>$500.000</b>). </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-5">

                <div class="card container-card-benefits">
                    <img src="{{asset('images/Front/OportuyaCustomers/PageCredit/SnipetMasBeneficios/Icon_Descuentos.png')}} "
                        class="img-card">
                    <div class="card-body">
                        <p class="card-text">Tienes acceso a los súper descuentos que lanzamos cada semana con los
                            mejores precios.</p>
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