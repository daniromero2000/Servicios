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
                <div class="w-100 card-container-products-logo">
                    <img src="{{asset('storage/'.$product->brand_id->cover)}}" class="card-products-logo">
                </div>
                <div class="height-container-img-product">
                    <img src="{{asset("storage/$product->cover")}}" class="card-products-img"
                        alt="{{asset("storage/$product->cover")}}">
                </div>
                <div class="card-body pt-0 pr-4 pl-4">
                    {{-- @php
                    $desc = ($product->price - $product->sale_price);
                    $desc= round(($desc / $product->price)*100 );
                    @endphp --}}
                    <h5 class=" card-products-title">{{ $product->reference}} </h5>
                    <div class="relative">
                        @if ($product->discount && $product->discount > 0)
                        <div class="card-products-discount">
                            <p>{{ $product->discount}}%</p>
                            <p>Dcto</p>
                        </div>
                        @endif

                        <img src="{{ asset('images/Front/OportuyaCustomers/Fotos Productos/TV LG 43/Tarjeta.png')}}"
                            class="card-products-card-black">
                        <p class="card-text card-products-old-price mb-0"> <del>${{ number_format($product->price)}}
                            </del></p>
                        <p class="card-text card-products-label mb-1">Precio antes</p>

                        <p class="card-text card-products-new-price mb-0">$ {{ number_format($product->desc)}}
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
                        <a href="/Administrator/catalog/{{ $product->slug}}"
                            class="btn card-products-button btn-primary" style="">Ver
                            más</a>
                        <a href="/step1?productId={{ $product->id}}"
                            class="btn card-products-button btn-danger">Solicitar
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