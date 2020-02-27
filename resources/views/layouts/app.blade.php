<!DOCTYPE html>

@php
$activeOportuya = ($_SERVER['REQUEST_URI'] == '/oportuya') ? 'activeMenu' : '' ;
$barraOportuya = ($_SERVER['REQUEST_URI'] == '/oportuya') ? 'activeMenuOportuya' : '' ;
$activeMotos = ($_SERVER['REQUEST_URI'] == '/motos') ? 'activeMenu' : '' ;
$activeAvance = ($_SERVER['REQUEST_URI'] == '/avance') ? 'activeMenu' : '' ;
$activeSeguros = ($_SERVER['REQUEST_URI'] == '/seguros') ? 'activeMenu' : '' ;
$activeViajes = ($_SERVER['REQUEST_URI'] == '/viajes') ? 'activeMenu' : '' ;
$activeLibranza = ($_SERVER['REQUEST_URI'] == '/libranza') ? 'activeMenu' : '' ;
$activeWarranty = ($_SERVER['REQUEST_URI'] == '/digitalWarranty') ? 'activeMenu' : '' ;
@endphp

<html>

<head>
	<!-- Global site tag (gtag.js) - Google Ads: 781153823 -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-781153823"></script>
	<script>
		window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-781153823'); 
	</script>
	@yield('eventTag')
	<!-- Google Tag Manager -->
	<script>
		(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-KV55LLG');
	</script>
	<!-- End Google Tag Manager -->
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KV55LLG" height="0" width="0"
			style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<script>
		(function(h,e,a,t,m,p) {
			m=e.createElement(a);m.async=!0;m.src=t;
			p=e.getElementsByTagName(a)[0];p.parentNode.insertBefore(m,p);
			})(window,document,'script','https://u.heatmap.it/log.js');
	</script>
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
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	@yield('metaTags')
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
		integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	@yield('linkStyleSheets')
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/slick-theme.css')}}">
	<link rel="stylesheet" href="{{ asset('css/slick.css')}}">
	<link href="{{ asset('editor/contentbuilder/codemirror/lib/codemirror.css')}}" rel="stylesheet" type="text/css" />
	<link href="https://rawgit.com/rzajac/angularjs-slider/master/dist/rzslider.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://gitcdn.xyz/cdn/angular/bower-material/master/angular-material.css">
	<link rel="stylesheet" href="{{ asset('css/app2.css') }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-animate.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-aria.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-messages.min.js"></script>
	<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>


	<!-- Angular Material Library -->
	<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.12/angular-material.min.js"></script>

	<script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
	</script>
	<link href="{{ asset('editor/contentbuilder/contentbuilder.css')}}" rel="stylesheet" type="text/css" />
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel='shortcut icon' type='image/x-icon' href='{{ asset('images/oportunidadesServicios.ico') }}' />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
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
</head>

<body>
	<div class="ex-loader">
		<div id="loader"></div>
	</div>
	<div id="ex-global-content" class="ex-loader-blur">

		<div id="preHeader">
			<div class="container-itemsPreHeader">
				<a class="preHeader-item  borderLeftItems" href="/quienes-somos">Quiénes somos</a>
				<a class="preHeader-item  borderLeftItems" href="/Nuestras-tiendas">Oficinas</a>
				<a class="preHeader-item  borderLeftItems" href="#">01 8000 11 77 87 o (1) 484 2122 en Bogotá</a>
				<a class="preHeader-item " href="/Terminos-y-condiciones">* Aplican condiciones y restricciones</a>
				@if(Auth::guard('web')->check())
				<div class="logoutButton mr-2">
					<a href=" /Administrator/dashboard" class="badge text-md badge-primary" style="font-size: 13px;">
						<i class="fas fa-sign-out-alt"></i></i> Volver
					</a>
					<a href=" {{ route('logout') }}" class="badge text-md badge-danger" style="font-size: 13px;">
						<i class="fas fa-power-off"></i> Cerrar Sesion
					</a>

				</div>

				@elseif(Auth::guard('assessor')->check())

				<div class="logoutButton">
					<a class="dropdown-item" href="{{ route('assessor.logout') }}"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</a>
					<form id="logout-form" action="{{ route('assessor.logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>

				@else

				<div class="assesorLogin ">
					<a class="ingreso" href="/login">Ingreso asesores</a>
					<p>{{Auth::user()}}</p>
				</div>
				@endif
			</div>
		</div>

		<div id="header">
			<div class="row">
				<div class="col-12 col-sm-12 col-lg-4 resetCol headerImage">
					<div class="header-containerLogo">
						<a href="/">
							<img src="{{ asset('images/oportunidadesServiciosFinancierosLogo.png')}}"
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
							<a class="nav-item nav-link header-item header-item1" href="{{url('oportuya')}}">
								<span class="header-textoItem">Crédito Electrodomésticos</span>
							</a>
							<a class="nav-item nav-link header-item header-item1" href="/libranza">
								<span class="header-textoItem">Libranza</span>
							</a>
							<a class="nav-item nav-link header-item header-item1" href="/motos">
								<span class="header-textoItem">Crédito motos</span>
							</a>
							<a class="nav-item nav-link header-item header-item1" href="/avance">
								<span class="header-textoItem">Avances</span>
							</a>
							<a class="nav-item nav-link header-item header-item1" href="/seguros">
								<span class="header-textoItem">Seguros</span>
							</a>
							<a class="nav-item nav-link header-item header-item1" href="/digitalWarranty">
								<span class="header-textoItem">Garantía digital</span>
							</a>
						</div>
					</div>
					<nav class="navbar header-menu navbar-expand-lg navbar-light navBarHide">
						<div class="collapse navbar-collapse header-containerItems" id="navbarNavAltMarkup">
							<div class="navbar-nav header-menu @php echo $barraOportuya @endphp">
								<a class="nav-item nav-link header-item header-item1 @php echo $activeOportuya @endphp"
									href="/oportuya">
									<span class="header-textoItem">Crédito Electrodomésticos</span>
								</a>
								<a class="nav-item nav-link header-item header-item2 @php echo $activeMotos @endphp"
									href="/motos">
									<img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
										class="img-fluid imgSombraMenu"> <span class="header-textoItem">Crédito
										motos</span>
								</a>
								<a class="nav-item nav-link header-item header-item3 @php echo $activeLibranza @endphp "
									href="/libranza">
									<img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
										class="img-fluid imgSombraMenu"> <span class="header-textoItem">Libranza</span>
								</a>
								<a class="nav-item nav-link header-item header-item4 @php echo $activeAvance @endphp "
									href="/avance">
									<img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
										class="img-fluid imgSombraMenu"> <span class="header-textoItem">Avances</span>
								</a>
								<a class="nav-item nav-link header-item header-item5 @php echo $activeSeguros @endphp "
									href="/seguros">
									<img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
										class="img-fluid imgSombraMenu"> <span class="header-textoItem">Seguros</span>
								</a>
								<a class="nav-item nav-link header-item header-item6 @php echo $activeViajes @endphp "
									href="/viajes">
									<img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
										class="img-fluid imgSombraMenu"> <span class="header-textoItem">Viajes</span>
								</a>
								<a class="nav-item nav-link header-item header-item7 @php echo $activeWarranty @endphp "
									href="/digitalWarranty">
									<img src="{{ asset('images/sombraMenu.png') }}" alt="Sombra Menú"
										class="img-fluid imgSombraMenu"> <span class="header-textoItem">Garantía
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
					href="https://api.whatsapp.com/send?phone=573115195753&text=Quiero%20más%20informaci%C3%B3n%20sobre%20el%20cr%C3%A9dito%20de%20Oportunidades!">
					<img class="img-btnWpp" src=" {{ asset ('images/btnwpp.png')}}"> <span>¿Quieres más
						información?</span> <span class="textCl">(Click aquí)</span></a>
			</div>
		</div>
		<div id="footer">
			<div class="row resetRow">
				<div class="col-12 col-md-12 col-lg-3 resetCol footer-containMenu">
					<div class="footer-contianerLogo">
						<img src="{{ asset('images/footer-oportunidadesServiciosFinancierosLogo.png')}}"
							alt="Oportunidades Servicios Financieros" class="img-fluid">
					</div>
					<div class="footer-contianerNosotros">
						<ul class="footer-menuNosotros">
							<h5 class="footer-menuTitle">NOSOTROS</h5>
							<li><a href="/codigo-etica" class="footer-menuItem"
									title="Código de ética y buen gobierno corporativo">Código de ética y buen gobierno
									corporativo</a></li>
							<li><a href="/quienes-somos" class="footer-menuItem" title="Quiénes somos">Quiénes somos</a>
							</li>
							<li><a href="/Proteccion-de-datos-personales" class="footer-menuItem"
									title="Protección de datos personales">Protección de datos personales</a></li>
							<li><a href="/Terminos-y-condiciones" class="footer-menuItem"
									title="Términos y condiciones">Términos y condiciones</a></li>
						</ul>
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-6 resetCol footer-containMenu">
					@if( Request::path() != 'digitalWarranty')
					<h4 class="text-center footer-title">Si tienes alguna inquietud <strong>¡Contáctanos!</strong></h4>
					@endif
					<div class="footer-containerServicioCliente">
						<div class="footer-contianerTelefonos">
							<img src="{{ asset('images/footer-telefonoIcon.png')}}" alt="Línea Nacional"
								class="img-fluid footer-imgNosotros" />
							<p class="footer-textTelefonos">
								@if( Request::path() == 'digitalWarranty')
								<span class="footer-textTelefonosNal"> Línea nacional: 01 8000 11 77 87</span> <br />
								@else
								<span class="footer-textTelefonosNal"> Línea nacional: 57 (1)484 2122 - 01 8000 11 77
									87</span> <br />
								@endif
								<span class="footer-textHorario">Lunes a Viernes 8:00 am a 5:00 pm</span>
							</p>
						</div>
						<ul class="footer-menu">
							<h5 class="footer-menuTitle">SERVICIO AL CLIENTE</h5>
							<li><a href="/Por-que-comprar-con-nosotros" class="footer-menuItem"
									title="Por qué comprar con nosotros">Por qué comprar con nosotros</a></li>
							<li><a href="/Cambios-devoluciones-y-atencion-de-garantias" class="footer-menuItem"
									title="Cambios , devoluciones y atención de garantías">Cambios , devoluciones y
									atención de garantías</a></li>
							<li><a href="http://www.sic.gov.co/proteccion-del-consumidor" target="_blank"
									class="footer-menuItem" title="Protección al consumidor">Protección al
									consumidor</a></li>
							<li><a href="{{route('preguntas.frecuentes')}}" class="footer-menuItem"
									title="Preguntas Frecuentes">Preguntas Frecuentes</a></li>
							<li><a href="{{ route('TermsAndConditions') }}" class="footer-menuItem"
									title="Términos y condiciones garantía">Términos y condiciones garantía</a></li>
						</ul>
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-3 resetCol">
					<div class="footer-containerNewsletter">
						<h5 class="footer-titleNewsLetter">QUIERES RECIBIR LAS MEJORES OFERTAS</h5>
						<form action="{{route('newsletter.store')}}" method="POST">
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
											target="_blank">términos y condiciones</a> y <a
											href="/Proteccion-de-datos-personales" class="linkTermAndCondition"
											target="_blank">política de tratamiento de datos</a>
									</label>
								</div>
						</form>
					</div>
					<span class="footer-menuText">SÍGUENOS:</span> <a
						href="https://www.facebook.com/almacenes.oportunidades/" target="_blank"><img
							src="{{ asset('images/footer-facebookIcon.png')}}"
							alt="Facebook Oportunidades Servicios Financieros" class="img-fluid"></a>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script src="{{ asset('editor/contentbuilder/jquery-ui.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('editor/contentbuilder/contentbuilder.js')}}" type="text/javascript"></script>
	<script type="text/javascript" src="{{ asset('js/libranza.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/validateV2.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
	@yield('scriptsJs')
	<link href="{{ asset('editor/contentbuilder/contentbuilder.css')}}" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
				editorInit('test1','http://localhost:8000/editor/assets/minimalist-basic/snippets-bootstrap.html');
				var contentCardHeight=$('.contentCards').height();
				$('.oportuyaCardsContent').height(contentCardHeight);
				
			});
			 function view() {
				/* This is how to get the HTML (for saving into a database) */
				 var sHTML = $('#contentarea').data('contentbuilder').viewHtml();
			 }
	</script>

</body>
<script type="text/javascript">
	$(function() {
   // For card rotation
   $(".btn-rotate").click(function() {
      $(".card-front").toggleClass(" rotate-card-front");
      $(".card-back").toggleClass(" rotate-card-back");
   });
   $(".btn-rotate-second").click(function() {
      $(".card-front-second").toggleClass(" rotate-card-front-second");
      $(".card-back-second").toggleClass(" rotate-card-back-second");
   });
   $(".btn-rotate-third").click(function() {
      $(".card-front-third").toggleClass(" rotate-card-front-third");
      $(".card-back-third").toggleClass(" rotate-card-back-third");
   });
   $(".btn-rotate-four").click(function() {
      $(".card-front-four").toggleClass(" rotate-card-front-four");
      $(".card-back-four").toggleClass(" rotate-card-back-four");
   });
});

window.sr = ScrollReveal();

    sr.reveal('.container-first-sector-text', {
      duration: 1000,
	  origin: 'right',
	  distance: '30%',
 	  delay: 1000,
    });

    sr.reveal('.container-second-sector-text', {
      duration: 2000,
      origin: 'right',
	  distance: '30%',
 	  delay: 2000,
	});
	
	sr.reveal('#thankPageInsurances', {
      duration: 2000,
      origin: 'right',
	  distance: '30%',
 	  delay: 1000,
    });


    sr.reveal('#cardsInsurance', {
      duration: 1000,
      origin: 'left',
      distance: '300px',
      viewFactor: 0.2
    });

	$('#oportuyaSlider').slick({
			autoplay: true,
			autoplaySpeed: 15000,
			nextArrow: '<i class="fa fa-chevron-left slideNext"></i>',
			prevArrow: '<i class="fa fa-chevron-right slidePrev"></i>',
			responsive: [
				{
					breakpoint: 768,
					settings: {
						arrows: false,
					}
				}
			]
		});

		$('#warrantySlider').slick({
			autoplay: true,
			autoplaySpeed: 15000,
			nextArrow: '<i class="fa fa-chevron-left slideNext"></i>',
			prevArrow: '<i class="fa fa-chevron-right slidePrev"></i>',
			responsive: [
				{
					breakpoint: 768,
					settings: {
						arrows: false,
					}
				}
			]
		});

		$('#warrantyBrandsSlider').slick({
			slidesToShow: 5,
			arrows:false,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						infinite: true,
						autoplay: true,
						autoplaySpeed: 3000,
						slidesToShow : 1,
						slidesToScroll : 1,
					}
				}
			]
		});

		/*$('#sliderPrincipalLibranza').slick({
			autoplay: true,
			autoplaySpeed: 15000,
			nextArrow: '<i class="fa fa-chevron-left slideNext"></i>',
			prevArrow: '<i class="fa fa-chevron-right slidePrev"></i>',
			responsive: [
				{
					breakpoint: 768,
					settings: {
						arrows: false,
					}
				}
			]
		});*/

		$('#creditoLibranza-slider').slick({
			slidesToShow : 3,
			slidesToScroll : 1,
			autoplay: true,
			autoplaySpeed: 5000,
			responsive: [
				{
					breakpoint : 1300,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 768,
					settings: {
						arrows: false,
						slidesToShow: 1,
					}
				}
			]
		});


		$('.sliderOffer').slick({
            autoplay: true,
            autoplaySpeed: 15000,
            slidesToShow: 2,
            slidesToScroll: 1,
            nextArrow: '<i class="fa fa-chevron-left slideNext"></i>',
            prevArrow: '<i class="fa fa-chevron-right slidePrev"></i>',
            responsive: [
                {
                breakpoint: 991,
                settings: 
                	{
	                    arrows: false,
	                    slidesToShow: 1,
	                    slidesToScroll: 1,
                    }
                }
            ],
            
        });

		$(".multiple-items-motos").slick({
          
		  infinite: true,
		  slidesToShow: 3,
		  slidesToScroll:3,
		  vertical: true,
	      verticalSwiping: true,
	      asNavFor: '.single-item-motos',
	      centerMode: true,
		  focusOnSelect: true,
		  nextArrow: '<img src="/images/motos/arrow2.png" class="img-fluid not-shadow">',
          prevArrow: '<img src="/images/motos/arrow.png" class="img-fluid not-shadow">',
        });
        $('.single-item-motos').slick({
			arrows: false,
			asNavFor: '.multiple-items-motos', 
		});
		
</script>

</html>