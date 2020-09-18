<!--AddCommunityLead modal-->
<div class="modal fade" id="showProduct{{ $product->id }}" tabindex="-1" role="dialog"
    aria-labelledby="productCreateModalLabel">
    <div class="modal-dialog" style=" max-width: 1400px !important; margin: auto;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$product->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body p-0">
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

                <div class="my-3 padding-reset"
                    style="max-width: 1300px;margin: 0px auto; margin-bottom: 5% !important;">
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
                                <div id="description-product">

                                    {!!html_entity_decode($product->description)!!}
                                </div>
                            </div>
                            <div style="border-radius: 21px; margin-top: 5%;">
                                <div class="carousel-container position-relative row">
                                    <div class="row mx-auto">

                                        <div class="container">

                                            <div id="myCarousel{{ $product->id }}" class="carousel slide"
                                                data-ride="carousel">
                                                {{-- <div style="height: 20px;">
                                            <img src="{{asset('storage/'.$product->brand->cover)}}"
                                                class="card-products-deal-logo" style=" z-index: 99; ">
                                            </div> --}}
                                            <div class="carousel-inner">

                                                @foreach($imagenes as $image)
                                                <div @if ($image[1]==0) class="carousel-item active" @else
                                                    class="carousel-item" @endif data-slide-number="{{$image[1]}}">
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

                            <div id="carousel-thumbs{{ $product->id }}" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row mx-0">
                                            @foreach($imagenes as $image)

                                            <div id="carousel-selector-{{$image[1]}}" @if ($image[1]==0)
                                                class="thumb col-4 col-sm-3 px-0 py-2 selected" @else
                                                class="thumb col-4 col-sm-3 px-0 py-2" @endif
                                                data-target="#myCarousel{{ $product->id }}"
                                                data-slide-to="{{$image[1]}}">
                                                <img data-src="{{asset('storage/'.$image[0])}}"
                                                    src="{{ asset('images/blank.jpg')}}" class="img-fluid lazy"
                                                    alt="{{$image[0]}}">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carousel-thumbs{{ $product->id }}" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-thumbs{{ $product->id }}" role="button"
                                    data-slide="next">
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
                            <div class="card shadow-none border-0 container-deal-product">
                                <div class="card-body pt-0 pr-4 pl-4">
                                    <div class="relative text-center  container-desc-deal">
                                        {{-- @if ($product->discount && $product->discount > 0) --}}
                                        <div class="card-products-discount">
                                            <p>1%</p>
                                            <p>Dcto</p>
                                        </div>
                                        {{-- @endif --}}
                                        <div class="container-price-deal">
                                            <p class="card-text card-products-old-price mb-0"> <del>a calcular
                                                </del></p>
                                            <p class="card-text card-products-label mb-1">Precio antes</p>

                                            <p class="card-text card-products-new-price mb-0">a calcular
                                            </p>
                                            <p class="card-text card-products-label mb-3">Precio ahora</p>
                                        </div>

                                    </div>
                                    <div class="relative">

                                        <img data-src="{{ asset('images/Front/OportuyaCustomers/Fotos Productos/TV LG 43/Tarjeta.jpg')}}"
                                            src="{{ asset('images/blank.jpg')}}" class="img-card-deal-product lazy">



                                        <p class="card-text term-deal-product">Llévalo a <b> {{$product->months}}
                                                meses </b> con tu tarjeta oportuya:
                                        </p>
                                        <div class="container-dues-deal-product">
                                            <p class="card-text card-products-price">a calcular </p>
                                            <p class="card-text text-dues-deal-product">* Cuota semanal</p>
                                            <a href="/step1?productId={{ $product->id}}"
                                                class="btn card-products-button btn-primary"
                                                style="margin-left: 15px;">Solicitar
                                                aqui</a>
                                        </div>

                                    </div>

                                    <div class="relative">
                                        <ol class="container-ol-steps-deal-product">
                                            <li>Diligencia la solicitud de crédito en linea</li>
                                            <li>Recibiras un SMS con un token de confirmación</li>
                                            <li>Una vez aprobado tu crédito uno de nuestros asesores se comunicará
                                                contigo </li>
                                            <li>Nuestro personal se encargara de recoger la documentación firmada</li>
                                            <li>Realizaremos la entrega del articulo en la puerta de tu casa</li>
                                        </ol>
                                    </div>

                                    <div class="relative">
                                        <h4 class="question-contact-deal-product">¿No tienes claro el procedimiento?
                                        </h4>
                                        <img alt="{{ asset('images/Front/OportuyaCustomers/iconos/Icon_WhatsApp.png')}}"
                                            data-src="{{ asset('images/Front/OportuyaCustomers/iconos/Icon_WhatsApp.png')}}"
                                            src="{{ asset('images/blank.jpg')}}"
                                            class="first-img-contact-deal-product lazy">
                                        <img data-src="{{ asset('images/Front/OportuyaCustomers/iconos/Icon_Tell.png')}}"
                                            src="{{ asset('images/blank.jpg')}}"
                                            alt="{{ asset('images/Front/OportuyaCustomers/iconos/Icon_Tell.png')}}"
                                            class="second-img-contact-deal-product lazy">
                                        <div class="container-text-contact-deal-product">
                                            <p>Preguntale a nuestros asesores:</p>
                                        </div>
                                        <h4 class="number-contact-deal-product text-center">311 5195753</h4>
                                        <div class="text-center">
                                            <a href="https://api.whatsapp.com/send?phone=573115195753&text=Quiero más información sobre el producto {{ $product->reference}} y el crédito en electrodomésticos."
                                                target="_blank" class="button-contact-deal-product"
                                                type="button">Whatsapp
                                                Directo</a>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="mt-5" style="max-width: 1300px;margin: 0px auto;margin-bottom: 5%;">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link link-nav-description active" id="home-tab{{ $product->id }}"
                                data-toggle="tab" href="#home{{ $product->id }}" role="tab"
                                aria-controls="home{{ $product->id }}" aria-selected="true">Descripción del producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-nav-description" id="profile-tab{{ $product->id }}"
                                data-toggle="tab" href="#profile{{ $product->id }}" role="tab"
                                aria-controls="profile{{ $product->id }}" aria-selected="false">Especificaciones</a>
                        </li>
                    </ul>
                    <div class="tab-content padding-responsive" id="myTabContent">
                        <div class="tab-pane fade show active" id="home{{ $product->id }}" role="tabpanel"
                            aria-labelledby="home-tab{{ $product->id }}">
                            <div class="card shadow-none border-0 padding-responsive padding-reset"
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
                        <div class="tab-pane fade" id="profile{{ $product->id }}" role="tabpanel"
                            aria-labelledby="profile-tab{{ $product->id }}">
                            <div class="card shadow-none border-0 padding-reset padding-responsive"
                                style="box-shadow: 0 .4rem 1rem rgba(0,0,0,0.08)!important;">
                                <div class="card-body padding-responsive">
                                    <a data-toggle="modal" data-target="#exampleModal">
                                        <img class="img-fluid lazy"
                                            data-src="{{asset('storage/'.$product->specification_image)}}"
                                            src="{{ asset('images/blank.jpg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            </div>

            {{-- <div id="cover_product_{{ $product->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <img class="img-fluid" src="{{ asset('images/blank.jpg')}}"
                            data-src="{{asset("storage/$product->cover")}}" alt="">
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>