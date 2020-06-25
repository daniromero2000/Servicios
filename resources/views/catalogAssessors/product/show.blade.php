@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/admin/catalog/app.css')}}">
@endsection
@section('content')
<div class="my-3 padding-reset father" style="max-width: 1300px;margin: 0px auto; margin-bottom: 5% !important;">
    <div class="row mr-0 justify-content-center">
        <div class="col-12 mb-3">
            <h5 class="breadcrumb-product">Oportunidades Servicios > Crédito Electrodomésticos >
                {{ $product->reference }} </h5>
        </div>
        <div class="col-lg-7 col-xl-8 px-0 order-lg-last"
            style="box-shadow: 0 .4rem 1rem rgba(0,0,0,0.05)!important;border-radius: 21px; margin-top: 5%">
            <div style="border-radius: 21px">
                <div class="carousel-container position-relative row">
                    <div class="row mx-auto">

                        <div class="container">

                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">

                                    @foreach($imagenes as $image)
                                    <div @if ($image[1]==0) class="carousel-item active" @else class="carousel-item"
                                        @endif data-slide-number="{{$image[1]}}">
                                        <img class="img-principal-carousel lazy" alt="{{$image[0]}}"
                                            data-src="{{asset('storage/'.$image[0])}}"
                                            src="{{ asset('images/blank.jpg')}}" data-type="image"
                                            data-toggle="lightbox" data-gallery="example-gallery">
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
                                    <img data-src="{{asset('storage/'.$image[0])}}" src="{{ asset('images/blank.jpg')}}"
                                        class="img-fluid lazy" alt="{{$image[0]}}">
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
        <div class="col-lg-5 col-xl-4 container-deal">
            <div class="w-100">
                <p class="reference-product">{{ $product->reference}}.</p>
                <h4 class="name-product"> {{ $product->name}} </h4>
                <div id="description-product">

                    {!!html_entity_decode($product->description)!!}
                </div>
            </div>
            <div class="row mx-0 container-steps-products justify-content-center text-center">
                <div class="col-4">
                    <div>
                        <img data-src="{{ asset('images/Front/OportuyaCustomers/iconos/Icon_Envio.jpg') }}"
                            src="{{ asset('images/blank.jpg')}}" alt="envio" class="img-step-product lazy">
                    </div>
                    <div class="mt-2 text-step-product">
                        Envio gratis para ciudades con tienda fisica
                    </div>
                </div>
                <div class="col-4">
                    <div>
                        <img src="{{ asset('images/blank.jpg')}}"
                            data-src="{{ asset('images/Front/OportuyaCustomers/iconos/Icono_Credit.jpg') }}"
                            alt="credito" class="img-step-product lazy ">
                    </div>
                    <div class="mt-2 text-step-product">
                        Crédito sujeto a aprobación de politicas
                    </div>
                </div>
                <div class="col-4">
                    <div>
                        <img data-src="{{ asset('images/Front/OportuyaCustomers/iconos/Icon_Store.jpg') }}"
                            src="{{ asset('images/blank.jpg')}}" alt="tienda" class="img-step-product lazy">
                    </div>
                    <div class="mt-2 text-step-product">
                        Crédito aplica para ubicación en tienda fisica
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card border-0 container-deal-product"
                    style="box-shadow: 0 .125rem .25rem rgba(0,0,0,.0)!important;">
                    <div class="card-body pt-0 pr-4 pl-0" style="margin-top: 5px;">
                        <div class="relative text-center  container-desc-deal">
                            @if ($product->discount && $product->discount > 0)
                            <div class="card-products-discount">
                                <p>{{ $product->discount}}%</p>
                                <p>Dcto</p>
                            </div>
                            @endif
                            <div class="container-price-deal">
                                <p class="card-text card-products-old-price mb-0"> <del>$
                                        {{ number_format($prices['normal_public_price'])}}
                                    </del></p>
                                <p class="card-text card-products-label mb-1">Precio antes</p>

                                <p class="card-text card-products-new-price mb-0">$
                                    {{ number_format($priceNew)}} </p>
                                <p class="card-text card-products-label mb-3">Precio ahora</p>
                                <p class="card-text card-products-new-price mb-0">${{ number_format($desc)}}
                                </p>
                                <p class="card-text card-products-label mb-3" style="    width: 125px;">* Precio de
                                    descuento con tarjeta
                                    black</p>
                            </div>

                        </div>
                        <div class="relative">

                            <img data-src="{{ asset('images/Front/OportuyaCustomers/Fotos Productos/TV LG 43/Tarjeta.jpg')}}"
                                src="{{ asset('images/blank.jpg')}}" class="img-card-deal-product lazy">
                            <p class="card-text term-deal-product">Llévalo a <b> {{$product->months}}
                                    meses </b> con tu tarjeta oportuya:
                            </p>
                            <div class="container-dues-deal-product">
                                <p class="card-text card-products-price">
                                    $ {{ number_format($pays)}}
                                </p>
                                <p class="card-text text-dues-deal-product mb-3">* Cuota semanal</p>
                                <a href="/step1?productId={{ $product->id}}"
                                    class="btn card-products-button btn-success" style="margin-left: 15px;">Solicitar
                                    aquí</a>
                                <a href="/step1?productId={{ $product->id}}"
                                    class="btn card-products-button btn-primary" style="margin-left: 15px;">Cotizar
                                    aquí</a>
                            </div>

                        </div>
                        <div class="relative">
                            <ol class="container-ol-steps-deal-product">
                                <li>Diligencia la solicitud de crédito en linea</li>
                                <li>Recibiras un SMS con un token de confirmación</li>
                                <li>Realizaremos la entrega del articulo en la puerta de tu casa</li>
                            </ol>
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
            <a class="nav-link link-nav-description active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                aria-controls="home" aria-selected="true">Descripción del producto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link link-nav-description" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                aria-controls="profile" aria-selected="false">Especificaciones</a>
        </li>
    </ul>
    <div class="tab-content padding-responsive" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card border-0 padding-responsive padding-reset-two"
                style="box-shadow: 0 .4rem 1rem rgba(0,0,0,0.08)!important;">
                <div class="card-body padding-responsive">
                    <div class="row justify-content-center ">
                        <div class="col-12 col-sm-6  p-0">
                            <img class="img-fluid img-description-product img-responsive lazy"
                                src="{{ asset('images/blank.jpg')}}"
                                data-src="{{asset('storage/'.$product->description_image1)}}">
                        </div>
                        <div class="col-12 col-sm-6  p-0">
                            <img class="img-fluid img-description-product img-responsive lazy"
                                data-src="{{asset('storage/'.$product->description_image2)}}"
                                src="{{ asset('images/blank.jpg')}}">
                        </div>
                        <div class="col-12 col-sm-6  p-0">
                            <img class="img-fluid img-description-product img-responsive lazy"
                                data-src="{{asset('storage/'.$product->description_image3)}}"
                                src="{{ asset('images/blank.jpg')}}">
                        </div>
                        <div class="col-12 col-sm-6  p-0">
                            <img class="img-fluid img-description-product img-responsive lazy"
                                data-src="{{asset('storage/'.$product->description_image4)}}"
                                src="{{ asset('images/blank.jpg')}}">
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
                        <img class="img-fluid lazy" data-src="{{asset('storage/'.$product->specification_image)}}"
                            src="{{ asset('images/blank.jpg')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                style=" margin-left: auto;margin-right: 9px;margin-top: 5px; ">
                <span aria-hidden="true">&times;</span>
            </button>
            <img class="img-fluid lazy" data-src="{{asset('storage/'.$product->specification_image)}}"
                src="{{ asset('images/blank.jpg')}}" alt="">
        </div>
    </div>
</div>
@stop
@section('scriptsJs')
<script src="{{asset('js/front/homeAppliances/app.min.js')}}"></script>
<script>
    $(document).ready(function(){
            $("#description-product ul").addClass("description-product");
    });
</script>
<script type="text/javascript">
    !function(window){
  var $q = function(q, res){
        if (document.querySelectorAll) {
          res = document.querySelectorAll(q);
        } else {
          var d=document
            , a=d.styleSheets[0] || d.createStyleSheet();
          a.addRule(q,'f:b');
          for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
            l[b].currentStyle.f && c.push(l[b]);

          a.removeRule(0);
          res = c;
        }
        return res;
      }
    , addEventListener = function(evt, fn){
        window.addEventListener
          ? this.addEventListener(evt, fn, false)
          : (window.attachEvent)
            ? this.attachEvent('on' + evt, fn)
            : this['on' + evt] = fn;
      }
    , _has = function(obj, key) {
        return Object.prototype.hasOwnProperty.call(obj, key);
      }
    ;

  function loadImage (el, fn) {
    var img = new Image()
      , src = el.getAttribute('data-src');
    img.onload = function() {
      if (!! el.parent)
        el.parent.replaceChild(img, el)
      else
        el.src = src;

      fn? fn() : null;
    }
    img.src = src;
  }

  function elementInViewport(el) {
    var rect = el.getBoundingClientRect()

    return (
       rect.top    >= 0
    && rect.left   >= 0
    && rect.top <= (window.innerHeight || document.documentElement.clientHeight)
    )
  }

    var images = new Array()
      , query = $q('img.lazy')
      , processScroll = function(){
          for (var i = 0; i < images.length; i++) {
            if (elementInViewport(images[i])) {
              loadImage(images[i], function () {
                images.splice(i, i);
              });
            }
          };
        }
      ;
    // Array.prototype.slice.call is not callable under our lovely IE8 
    for (var i = 0; i < query.length; i++) {
      images.push(query[i]);
    };

    processScroll();
    addEventListener('scroll',processScroll);

}(this);
</script>
@endsection