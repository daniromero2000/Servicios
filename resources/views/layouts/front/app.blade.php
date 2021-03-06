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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-128431645-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-128431645-1');

    </script>
    <!-- Google Tag Manager -->

    <script>
        (function(h, e, a, t, m, p) {
            m = e.createElement(a);
            m.async = !0;
            m.src = t;
            p = e.getElementsByTagName(a)[0];
            p.parentNode.insertBefore(m, p);
        })(window, document, 'script', 'https://u.heatmap.it/log.js');

    </script>

    @yield('eventTag')
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KV55LLG');

    </script>
    <!-- End Google Tag Manager -->
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KV55LLG" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script>
        (function(h, e, a, t, m, p) {
            m = e.createElement(a);
            m.async = !0;
            m.src = t;
            p = e.getElementsByTagName(a)[0];
            p.parentNode.insertBefore(m, p);
        })(window, document, 'script', 'https://u.heatmap.it/log.js');

    </script>
    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '406230336580137');
        fbq('track', 'PageView');

    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=406230336580137&ev=PageView
  &noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    @yield('metaTags')

    @yield('linkStyleSheets')
    <link rel="stylesheet" href="{{ asset('css/front/app/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app2.css') }}">
    <script type="text/javascript" src="{{ asset('js/front/app/jquery.v3.min.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/front/app/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/front/app/fontawesomev4.min.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('images/oportunidadesServicios.ico') }}' />
    <link rel="stylesheet" href="{{ asset('css/front/app/animate.min.css') }}">

    <script>
        function hideLoader() {

            $('#ex-global-content').removeClass('ex-loader-blur');
            $(".ex-loader").fadeOut(1000, function() {
                $(".ex-loader").remove();

            });
        };

        window.onload = function() {
            hideLoader();
        };

        $(document).ready(function($) {
            setTimeout(function() {
                hideLoader();
            }, 800);
        });

    </script>
</head>

<body>
    <div class="ex-loader">
        <div id="loader"></div>
    </div>
    <div id="ex-global-content" class="ex-loader-blur">

        <div id="preHeader">
            <div class="container-itemsPreHeader">
                <a class="preHeader-item  borderLeftItems" href="/quienes-somos">Qui??nes somos</a>
                <a class="preHeader-item  borderLeftItems" href="/Nuestras-tiendas">Oficinas</a>
                <a class="preHeader-item  borderLeftItems" href="#">01 8000 18 05 20 o (1) 484 2122 en Bogot??</a>
                <a class="preHeader-item " href="/Terminos-y-condiciones">* Aplican condiciones y restricciones</a>
                @if (Auth::guard('web')->check())
                    <div class="logoutButton mr-2">
                        <a href=" /Administrator/dashboard" class="badge badge-primary" style="font-size: 13px;">
                            <i class="fas fa-sign-out-alt"></i></i> Volver
                        </a>
                        <a href=" {{ route('logout') }}" class="badge badge-danger" style="font-size: 13px;">
                            <i class="fas fa-power-off"></i> Cerrar Sesion
                        </a>

                    </div>

                @elseif(Auth::guard('assessor')->check())

                    <div class="logoutButton">
                        <a class="dropdown-item" href="{{ route('assessor.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('assessor.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>

                @else

                    <div class="assesorLogin ">
                        <a class="ingreso" href="/login">Ingreso asesores</a>
                        <p>{{ Auth::user() }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div id="header">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-4 resetCol headerImage">
                    <div class="header-containerLogo">
                        <a href="/">
                            <img src="{{ asset('images/oportunidadesServiciosFinancierosLogo.png') }}"
                                alt="Oportunidades Servicios Financieros" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-sm-12  col-lg-8 resetCol toggleResponsive">
                    <div class="buttonResponsive">
                        <div class="innerButtonResponsive"></div>
                        <div class="innerButtonResponsive1"></div>
                        <div class="innerButtonResponsive2"></div>
                    </div>
                    <div class="header-containerItemsResponsive header-item1" id="navbarNavAltMarkup">
                        <div class="navbar-nav header-menu">
                            <a class="nav-item nav-link header-item header-item1"
                                href="{{ url('credito-electrodomesticos/catalogo') }}">
                                <span class="header-textoItem">Cr??dito Electrodom??sticos</span>
                            </a>
                            <a class="nav-item nav-link header-item header-item1" href="/libranza">
                                <span class="header-textoItem">Libranza</span>
                            </a>

                            <a class="nav-item nav-link header-item header-item1" href="/avance">
                                <span class="header-textoItem">Avances</span>
                            </a>
                            <a class="nav-item nav-link header-item header-item1" href="/seguros">
                                <span class="header-textoItem">Seguros</span>
                            </a>
                            <a class="nav-item nav-link header-item header-item1" href="/digitalWarranty">
                                <span class="header-textoItem">Garant??a digital</span>
                            </a>
                        </div>
                    </div>
                    <nav class="navbar header-menu navbar-expand-lg navbar-light navBarHide">
                        <div class="collapse navbar-collapse header-containerItems" id="navbarNavAltMarkup">
                            <div class="navbar-nav header-menu @php echo $barraOportuya @endphp ">
                                <a class="nav-item nav-link header-item header-item1 @php echo $activeOportuya @endphp"
                                    href="/credito-electrodomesticos/catalogo">
                                    <span class="header-textoItem">Cr??dito Electrodom??sticos</span>
                                </a>
                                <a class="nav-item nav-link header-item header-item3 @php echo $activeLibranza @endphp "
                                    href="/libranza">
                                    <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Men??"
                                        class="img-fluid imgSombraMenu"> <span class="header-textoItem">Libranza</span>
                                </a>
                                <a class="nav-item nav-link header-item header-item4 @php echo $activeAvance @endphp "
                                    href="/avance">
                                    <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Men??"
                                        class="img-fluid imgSombraMenu"> <span class="header-textoItem">Avances</span>
                                </a>
                                <a class="nav-item nav-link header-item header-item5 @php echo $activeSeguros @endphp "
                                    href="/seguros">
                                    <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Men??"
                                        class="img-fluid imgSombraMenu"> <span class="header-textoItem">Seguros</span>
                                </a>
                                {{-- <a
                                    class="nav-item nav-link header-item header-item6 @php echo $activeViajes @endphp "
                                    href="/viajes">
                                    <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Men??"
                                        class="img-fluid imgSombraMenu"> <span class="header-textoItem">Viajes</span>
                                </a> --}}
                                <a class="nav-item nav-link header-item header-item2 @php echo $activeMotos @endphp"
                                    href="/credito-electrodomesticos/catalogo">
                                    <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Men??"
                                        class="img-fluid imgSombraMenu"> <span class="header-textoItem">
                                        Oportucr??dito </span>
                                </a>
                                <a class="nav-item nav-link header-item header-item7 @php echo $activeWarranty @endphp "
                                    href="/digitalWarranty">
                                    <img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Men??"
                                        class="img-fluid imgSombraMenu"> <span class="header-textoItem">Garant??a
                                        digital</span>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

        </div>

        <div id="container">
            @yield('content')
            <div class="container-button">
                <a style="display: none; visibility: hidden" target="_blank" class="btnwpp"
                    href="https://api.whatsapp.com/send?phone=573115195753&text=Quiero%20m??s%20informaci%C3%B3n%20sobre%20el%20cr%C3%A9dito%20de%20Oportunidades!">
                    <img class="img-btnWpp" src=" {{ asset('images/btnwpp.png') }}"> <span>??Quieres m??s
                        informaci??n?</span> <span class="textCl">(Click aqu??)</span></a>
            </div>
        </div>
        <div id="footer">
            <div class="row resetRow">
                <div class="col-12 col-md-12 col-lg-3 resetCol footer-containMenu">
                    <div class="footer-contianerLogo">
                        <img src="{{ asset('images/footer-oportunidadesServiciosFinancierosLogo.png') }}"
                            alt="Oportunidades Servicios Financieros" class="img-fluid">
                    </div>
                    <div class="footer-contianerNosotros">
                        <ul class="footer-menuNosotros">
                            <h5 class="footer-menuTitle">NOSOTROS</h5>
                            <li><a href="/codigo-etica" class="footer-menuItem"
                                    title="C??digo de ??tica y buen gobierno corporativo">C??digo de ??tica y buen
                                    gobierno
                                    corporativo</a></li>
                            <li><a href="/quienes-somos" class="footer-menuItem" title="Qui??nes somos">Qui??nes
                                    somos</a>
                            </li>
                            <li><a href="/Proteccion-de-datos-personales" class="footer-menuItem"
                                    title="Protecci??n de datos personales">Protecci??n de datos personales</a></li>
                            <li><a href="/Terminos-y-condiciones" class="footer-menuItem"
                                    title="T??rminos y condiciones">T??rminos y condiciones</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6 resetCol footer-containMenu">
                    @if (Request::path() != 'digitalWarranty')
                        <h4 class="text-center footer-title">Si tienes alguna inquietud <strong>??Cont??ctanos!</strong>
                        </h4>
                    @endif
                    <div class="footer-containerServicioCliente">
                        <div class="footer-contianerTelefonos">
                            <img src="{{ asset('images/footer-telefonoIcon.png') }}" alt="L??nea Nacional"
                                class="img-fluid footer-imgNosotros" />
                            <p class="footer-textTelefonos">
                                @if (Request::path() == 'digitalWarranty')
                                    <span class="footer-textTelefonosNal"> L??nea nacional: 01 8000 18 05 20</span>
                                    <br />
                                @else
                                    <span class="footer-textTelefonosNal"> L??nea nacional: 57 (1)484 2122 - 01 8000 18
                                        05 20</span> <br />
                                @endif
                                <span class="footer-textHorario">Lunes a Viernes 8:00 am a 5:00 pm</span>
                            </p>
                        </div>
                        <ul class="footer-menu">
                            <h5 class="footer-menuTitle">SERVICIO AL CLIENTE</h5>
                            <li><a href="/Por-que-comprar-con-nosotros" class="footer-menuItem"
                                    title="Por qu?? comprar con nosotros">Por qu?? comprar con nosotros</a></li>
                            <li><a href="/Cambios-devoluciones-y-atencion-de-garantias" class="footer-menuItem"
                                    title="Cambios , devoluciones y atenci??n de garant??as">Cambios , devoluciones y
                                    atenci??n de garant??as</a></li>
                            <li><a href="http://www.sic.gov.co/proteccion-del-consumidor" target="_blank"
                                    class="footer-menuItem" title="Protecci??n al consumidor">Protecci??n al
                                    consumidor</a></li>
                            <li><a href="{{ route('preguntas.frecuentes') }}" class="footer-menuItem"
                                    title="Preguntas Frecuentes">Preguntas Frecuentes</a></li>
                            <li><a href="{{ route('TermsAndConditions') }}" class="footer-menuItem"
                                    title="T??rminos y condiciones garant??a">T??rminos y condiciones garant??a</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-3 resetCol">
                    <div class="footer-containerNewsletter">
                        <h5 class="footer-titleNewsLetter">QUIERES RECIBIR LAS MEJORES OFERTAS</h5>
                        <form action="{{ route('newsletter.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="input-group mb-3">
                                <input type="email" name="email" class="form-control input-footer-max"
                                    placeholder="Ingresa tu e-mail">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary">Suscribirse</button>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1"
                                        required>
                                    <label for="termsAndConditions"
                                        style="font-size: 10px; font-style: italic;color:#FFF;">
                                        Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition"
                                            target="_blank">t??rminos y condiciones</a> y <a
                                            href="/Proteccion-de-datos-personales" class="linkTermAndCondition"
                                            target="_blank">pol??tica de tratamiento de datos</a>
                                    </label>
                                </div>
                        </form>
                    </div>
                    <span class="footer-menuText">S??GUENOS:</span> <a
                        href="https://www.facebook.com/almacenes.oportunidades/" target="_blank"><img
                            src="{{ asset('images/footer-facebookIcon.png') }}"
                            alt="Facebook Oportunidades Servicios Financieros" class="img-fluid"></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    @yield('scriptsJs')


</body>

</html>
