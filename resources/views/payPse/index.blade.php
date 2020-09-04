<!DOCTYPE html>
<html>

<head>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window,document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		 fbq('init', '406230336580137');
		fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=406230336580137&ev=PageView
		&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->

    <script>
        (function(h,e,a,t,m,p) {
	m=e.createElement(a);m.async=!0;m.src=t;
	p=e.getElementsByTagName(a)[0];p.parentNode.insertBefore(m,p);
	})(window,document,'script','https://u.heatmap.it/log.js');
    </script>

    <title>Servicios Financieros Oportunidades - Crédito para todo</title>
    @yield('metaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    @yield('linkStyleSheets')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('images/oportunidadesServicios.ico') }}' />

    <link rel="canonical" href="https://www.serviciosoportunidades.com/">
    <meta name="description"
        content="Tenemos el crédito para todo lo que necesitas, electrodomésticos, tarjeta de crédito , libranzas y seguros; encuentra todo en un mismo lugar y siempre con los mejores precios.">
    <meta property="og:title" content="Servicios Financieros Oportunidades - Crédito para todo">
    <meta property="og:url" content="https://www.serviciosoportunidades.com/">
    <meta property="og:type" content="Website">
    <script>
        function hideLoader(){

				$('#ex-global-content').removeClass('ex-loader-blur');
				$(".ex-loader").fadeOut(1000,function(){
					$(".ex-loader").remove();

				});
			};

			window.onload = function(){
				hideLoader();
			};

			$(document).ready(function($) {
				setTimeout(function(){
					hideLoader();
				},800);
			});

    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,800;1,200;1,300;1,400;1,500;1,800&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(90deg, rgb(247 247 247) 17%, rgb(222 218 215) 36%, rgb(216 216 216) 100%);
        }

        .container-text {
            position: absolute;
            top: 20%;
            left: 7%;
            text-align: center;
        }

        .relative {
            position: relative
        }

        .text-principal {
            font-size: 3rem !important;
            color: #0056A1;
            font-weight: bold;
            margin-bottom: 1.6rem;
        }

        .title-pay {
            color: #0056A1;
            font-size: 1.5rem;
            font-weight: 400;
        }

        .title-third {
            font-weight: 400;
            color: #0056A1;
            font-size: 2.6rem;
            margin-bottom: 1.8rem;
        }

        .btn-reset {
            background-color: #e00712;
            border-color: #e00712;
            border-radius: 203px;
            font-weight: 600;
            padding: 7px 13px;
            box-shadow: 0 .5rem 1rem rgba(192, 2, 9, .2) !important;
        }

        .view {
            color: #0056A1;
            font-size: 1.1rem;
            margin-top: 3rem;
        }

        .pay {
            width: 80px;
        }


        @media (min-width: 990px) and (max-width: 1400px) {
            .container-text {
                left: 5%;
            }

            .text-principal {
                font-size: 2.4rem !important;
            }

            .title-pay {
                font-size: 1.3rem;
            }

            .title-third {
                font-size: 2rem;
            }

            .view {
                font-size: 1rem;
            }

            .pay {
                width: 68px;
            }

            .conoce-tarjetasImg {
                width: 40px;
            }
        }

        @media (min-width: 990px) and (max-width: 1100px) {
            .container-text {
                left: 3%;
            }
        }

        @media (min-width: 820px) and (max-width: 990px) {
            .container-text {
                left: 3%;
                top: 9%;
            }

            .text-principal {
                font-size: 2rem !important;
            }

            .title-pay {
                font-size: 1.1rem;
            }

            .title-third {
                font-size: 1.8rem;
            }

            .btn-reset {
                font-size: 13px;
            }

            .view {
                font-size: .8rem;
            }

            .pay {
                width: 58px;
            }

            .conoce-tarjetasImg {
                width: 40px;
            }
        }

        @media (min-width: 750px) and (max-width: 819px) {
            .container-text {
                left: 3%;
                top: 9%;
            }

            .text-principal {
                font-size: 1.5rem !important;
            }

            .title-pay {
                font-size: 1rem;
            }

            .title-third {
                font-size: 1.5rem;
            }

            .btn-reset {
                font-size: 13px;
            }

            .view {
                font-size: .8rem;
                margin-top: 2rem;
            }

            .pay {
                width: 58px;
            }

            .conoce-tarjetasImg {
                width: 33px;
            }

            .btn-reset {
                padding: 5px 12px;
            }
        }

        @media (min-width: 310px) and (max-width: 750px) {
            .container-text {
                position: initial;
            }
        }

        @media (min-width: 441px) and (max-width: 750px) {
            .container-text {
                padding: 23px 10px;
            }

            .text-principal {
                font-size: 1.9rem !important;
            }

            .title-pay {
                font-size: 1.2rem;
            }

            .title-third {
                font-size: 1.9rem;
                margin-bottom: 1.2rem;
            }

            .conoce-tarjetasImg {
                width: 35px;
            }

            .btn-reset {
                font-size: 14px;
            }

            .view {
                font-size: .9rem;
                margin-top: 2rem;
            }

            .pay {
                width: 60px;
            }
        }

        @media (min-width: 310px) and (max-width: 440px) {
            .container-text {
                padding: 23px 10px;
            }

            .text-principal {
                font-size: 1.5rem !important;

            }

            .title-pay {
                font-size: 1rem;
            }

            .title-third {
                font-size: 1.5rem;
                margin-bottom: 1.2rem;
            }

            .conoce-tarjetasImg {
                width: 35px;
            }

            .btn-reset {
                font-size: 14px;
            }

            .view {
                font-size: .9rem;
                margin-top: 2rem;
            }

            .pay {
                width: 55px;
            }
        }

        .cursor {
            cursor: pointer;
        }

        .cursor:hover {
            cursor: pointer;
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <div class="ex-loader">
        <div id="loader"></div>
    </div>
    <div id="ex-global-content" class="ex-loader-blur relative">
        <div class="relative">
            <img class=" img-fluid" src="{{ asset('images/Front/payPse/banner.jpg')}}" alt="pagos por PSE">
            <div class="container-text">
                <h1 class="text-principal">¡Pensamos
                    en ti!</h1>

                <h3 class="title-pay">Ahora podrás hacer el pago de tus
                </h3>

                <h2 class="title-third"> <b>Cuotas</b> en
                    <b>línea</b></h2>

                <img src="/images/PSE.png" class="img-fluid conoce-tarjetasImg icon-pse" alt="pse">
                <a class="btn-reset btn btn-danger" href="https://www.zonapagos.com/t_Lagobo">Paga tu cuota aqui</a>

                <p class="view">Aprende como <b>hacer tu pago:</b> <br>
                    mira el
                    video</p>
                <a class="cursor" data-toggle="modal" data-target="#exampleModal"><img class="img-fluid pay"
                        src="{{ asset('images/Front/payPse/icon-video.png')}}" alt="pagos por PSE"></a>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <iframe style="max-height:400px; height: 100vh;" src="https://www.youtube.com/embed/qGuzAU0BgiY"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>

    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="{{ asset('editor/contentbuilder/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script>
        window.sr = ScrollReveal();
            sr.reveal('.container-text', {
            duration: 1000,
            origin: 'left',
            distance: '30%',
            delay: 1000,
        });

    </script>
    @yield('scriptsJs')
</body>

</html>