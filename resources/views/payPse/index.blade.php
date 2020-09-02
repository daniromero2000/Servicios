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

    <title>Ser</title>
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

        @media (min-width: 900px) and (max-width: 990px) {
            .container-text {
                left: 3%;
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

        @media (min-width: 320px) and (max-width: 900px) {
            .container-text {
                position: initial;
            }
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
                <button class="btn-reset btn btn-danger" type="button">Paga tu cuota aqui</button>

                <p class="view">Aprende como <b>hacer tu pago:</b> <br>
                    mira el
                    video</p>
                <img class="img-fluid pay" src="{{ asset('images/Front/payPse/icon-video.png')}}" alt="pagos por PSE">
            </div>
        </div>
    </div>
    <script src="{{ asset('editor/contentbuilder/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
    @yield('scriptsJs')
</body>

</html>