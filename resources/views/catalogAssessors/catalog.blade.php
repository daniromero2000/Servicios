@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/admin/catalog/app.css')}}">
@endsection

@section('content')


<div style=" margin-top: 5%;">
    <div class=" row justify-content-center container-card-products">
        @if ($products)
        @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 father">
            <div class="card shadow border-0 text-center card-products">
                @if ($product->discount && $product->discount > 0)
                <div class="ribbon-wrapper ribbon-lg">
                    <div class="ribbon bg-danger " style=" padding: 10px;">
                        <p style=" margin-bottom: 0px; font-size: 16px; font-weight: bold; ">{{ $product->discount}}%
                            Dcto</p>
                    </div>
                </div>
                @endif
                <div class="w-100 card-container-products-logo">
                    <img src="{{asset('storage/'.$product->brand_id->cover)}}" class="card-products-logo">
                </div>
                <div class="height-container-img-product">
                    <img src="{{asset("storage/$product->cover")}}" class="card-products-img"
                        alt="{{asset("storage/$product->cover")}}">
                </div>
                <div class="card-body pt-0 pr-4 pl-4">
                    <h5 class=" card-products-title">{{ $product->reference}} </h5>
                    <div class="relative mt-3">
                        <img src="{{ asset('images/Front/OportuyaCustomers/Fotos Productos/TV LG 43/Tarjeta.png')}}"
                            class="card-products-card-black">
                        <p class="card-text card-products-old-price mb-0"> <del>${{ number_format($product->price_old)}}
                            </del></p>
                        <p class="card-text card-products-label mb-2">* Precio antes</p>
                        <p class="card-text card-products-new-price mb-0">${{ number_format($product->price_new)}}
                        </p>
                        <p class="card-text card-products-label mb-2">* Precio ahora</p>
                        <p class="card-text card-products-new-price mb-0">${{ number_format($product->desc)}}
                        </p>
                        <p class="card-text card-products-label mb-3">* Precio de descuento <br> con tarjeta black</p>

                        <p class="card-text card-products-text">Llévalo a <b> {{$product->months}}
                                meses </b> con
                            <br>
                            tu tarjeta black
                        </p>

                        <p class="card-text card-products-price">
                            $ {{ number_format($product->pays)}}
                        </p>
                        <p class="card-text card-products-label">* Cuota semanal</p>
                        <a href="/Administrator/catalog/{{ $product->slug}}"
                            class="btn card-products-button btn-primary" style="">Ver
                            más</a>
                        <a href="/step1?productId={{ $product->id}}" class="btn card-products-button btn-danger">Cotizar
                            aqui</a>
                    </div>


                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

@stop


@section('scriptsJs')
<script src="{{asset('js/front/homeAppliances/app.js')}}"></script>

@endsection