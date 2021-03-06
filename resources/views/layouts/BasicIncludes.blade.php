<!DOCTYPE html>

<!--
    **Project: SERVICIOS FINANCIEROS
    **Case of use: ALL MODULES
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: this filie contains only a a set of files commonly used in the project
    **Date: 18/01/2019
     -->


<html>

<head>
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	@include('layouts.front.layouts.googleAds')
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
	@yield('metaTags')
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
		integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	@yield('linkStyleSheets')
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app2.css') }}">
	<link rel="stylesheet" href="{{ asset('css/slick-theme.css')}}">
	<link rel="stylesheet" href="{{ asset('css/slick.css')}}">
	<link href="{{ asset('editor/contentbuilder/codemirror/lib/codemirror.css')}}" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>

	<script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
	</script>
	<link href="{{ asset('editor/contentbuilder/contentbuilder.css')}}" rel="stylesheet" type="text/css" />
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
</head>

<body>
	<div class="ex-loader">
		<div id="loader"></div>
	</div>
	<div id="ex-global-content" class="ex-loader-blur">



		<div id="container">
			@yield('content')
		</div>


		<script type="text/javascript" src="{{asset('js/validateV2.js')}}"></script>
		@yield('scriptsJs')

</body>

</html>