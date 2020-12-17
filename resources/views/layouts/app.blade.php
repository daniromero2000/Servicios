<!DOCTYPE html>

@php
$activeOportuya = ($_SERVER['REQUEST_URI'] == '/credito-electrodomesticos/catalogo') ? 'activeMenu' : '' ;
$barraOportuya = ($_SERVER['REQUEST_URI'] == '/credito-electrodomesticos/catalogo') ? 'activeMenuOportuya' : '' ;
$activeMotos = ($_SERVER['REQUEST_URI'] == '/motos') ? 'activeMenu' : '' ;
$activeAvance = ($_SERVER['REQUEST_URI'] == '/avance') ? 'activeMenu' : '' ;
$activeSeguros = ($_SERVER['REQUEST_URI'] == '/seguros') ? 'activeMenu' : '' ;
$activeViajes = ($_SERVER['REQUEST_URI'] == '/viajes') ? 'activeMenu' : '' ;
$activeLibranza = ($_SERVER['REQUEST_URI'] == '/libranza') ? 'activeMenu' : '' ;
$activeWarranty = ($_SERVER['REQUEST_URI'] == '/digitalWarranty') ? 'activeMenu' : '' ;
@endphp

<html>

<head>
    @yield('eventTag')
    @include('layouts.front.layouts.googleAds')
    @include('layouts.front.layouts.tags')  

    <title>@yield('title')</title>
    @yield('metaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    @include('layouts.front.layouts.headerLinks')  

    @yield('linkStyleSheets')
    
</head>

<body>
    <div class="ex-loader">
        <div id="loader"></div>
    </div>
    <div id="ex-global-content" class="ex-loader-blur">
    @include('layouts.front.layouts.preHeader')
    @include('layouts.front.layouts.header')

        <div id="container">
            @yield('content')
            <div class="container-button">
                <a style="display: none; visibility: hidden" target="_blank" class="btnwpp"
                    href="https://api.whatsapp.com/send?phone=573115195753&text=Quiero%20más%20informaci%C3%B3n%20sobre%20el%20cr%C3%A9dito%20de%20Oportunidades!">
                    <img class="img-btnWpp" src=" {{ asset('images/btnwpp.png') }}"> <span>¿Quieres más
                        información?</span> <span class="textCl">(Click aquí)</span></a>
            </div>
        </div>

    @include('layouts.front.layouts.footer')
    </div>
    </div>
    <script src="{{ asset('editor/contentbuilder/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('editor/contentbuilder/contentbuilder.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('js/libranza.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/validateV2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    @yield('scriptsJs')
    <link href="{{ asset('editor/contentbuilder/contentbuilder.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            editorInit('test1', 'http://localhost:8000/editor/assets/minimalist-basic/snippets-bootstrap.html');
            var contentCardHeight = $('.contentCards').height();
            $('.oportuyaCardsContent').height(contentCardHeight);

        });

        function view() {
            /* This is how to get the HTML (for saving into a database) */
            var sHTML = $('#contentarea').data('contentbuilder').viewHtml();
        }

    </script>

</body>
<script type="text/javascript">
  $(function() { $(".btn-rotate").click(function() { $(".card-front").toggleClass(" rotate-card-front"); $(".card-back").toggleClass(" rotate-card-back"); }); $(".btn-rotate-second").click(function() { $(".card-front-second").toggleClass(" rotate-card-front-second"); $(".card-back-second").toggleClass(" rotate-card-back-second"); }); $(".btn-rotate-third").click(function() { $(".card-front-third").toggleClass(" rotate-card-front-third"); $(".card-back-third").toggleClass(" rotate-card-back-third"); }); $(".btn-rotate-four").click(function() { $(".card-front-four").toggleClass(" rotate-card-front-four"); $(".card-back-four").toggleClass(" rotate-card-back-four"); }); }); window.sr = ScrollReveal(); sr.reveal('.container-first-sector-text', { duration: 1000, origin: 'right', distance: '30%', delay: 1000, }); sr.reveal('.container-second-sector-text', { duration: 2000, origin: 'right', distance: '30%', delay: 2000, }); sr.reveal('#thankPageInsurances', { duration: 2000, origin: 'right', distance: '30%', delay: 1000, }); sr.reveal('#cardsInsurance', { duration: 1000, origin: 'left', distance: '300px', viewFactor: 0.2 }); $('#oportuyaSlider').slick({ autoplay: true, autoplaySpeed: 15000, nextArrow: '<i class="fa fa-chevron-left slideNext"></i>', prevArrow: '<i class="fa fa-chevron-right slidePrev"></i>', responsive: [{ breakpoint: 768, settings: { arrows: false, } }] }); $('#warrantySlider').slick({ autoplay: true, autoplaySpeed: 15000, nextArrow: '<i class="fa fa-chevron-left slideNext"></i>', prevArrow: '<i class="fa fa-chevron-right slidePrev"></i>', responsive: [{ breakpoint: 768, settings: { arrows: false, } }] }); $('#warrantyBrandsSlider').slick({ slidesToShow: 5, arrows: false, responsive: [{ breakpoint: 768, settings: { infinite: true, autoplay: true, autoplaySpeed: 3000, slidesToShow: 1, slidesToScroll: 1, } }] }); $('#creditoLibranza-slider').slick({ slidesToShow: 3, slidesToScroll: 1, autoplay: true, autoplaySpeed: 5000, responsive: [{ breakpoint: 1300, settings: { slidesToShow: 2, } }, { breakpoint: 768, settings: { arrows: false, slidesToShow: 1, } } ] }); $('.sliderOffer').slick({ autoplay: true, autoplaySpeed: 15000, slidesToShow: 2, slidesToScroll: 1, nextArrow: '<i class="fa fa-chevron-left slideNext"></i>', prevArrow: '<i class="fa fa-chevron-right slidePrev"></i>', responsive: [{ breakpoint: 991, settings: { arrows: false, slidesToShow: 1, slidesToScroll: 1, } }], }); $(".multiple-items-motos").slick({ infinite: true, slidesToShow: 3, slidesToScroll: 3, vertical: true, verticalSwiping: true, asNavFor: '.single-item-motos', centerMode: true, focusOnSelect: true, nextArrow: '<img src="/images/motos/arrow2.png" class="img-fluid not-shadow">', prevArrow: '<img src="/images/motos/arrow.png" class="img-fluid not-shadow">', }); $('.single-item-motos').slick({ arrows: false, asNavFor: '.multiple-items-motos', });
</script>

</html>
