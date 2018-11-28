<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		@yield('metaTags')
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		@yield('linkStyleSheets')
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/app2.css') }}">
		<link rel="stylesheet" href="{{ asset('css/slick-theme.css')}}">
		<link rel="stylesheet" href="{{ asset('css/slick.css')}}">
		<link href="{{ asset('editor/contentbuilder/codemirror/lib/codemirror.css')}}" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>
		<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<link href="{{ asset('editor/contentbuilder/contentbuilder.css')}}" rel="stylesheet" type="text/css" /> 
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<script type="text/javascript" src="{{asset('js/validateV2.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
		<link rel='shortcut icon' type='image/x-icon' href='{{ asset('images/oportunidadesServicios.ico') }}' />
	</head>
	</head>
	<body>
		<div id="container">
			@yield('content')
		</div>
		@yield('scriptsJs')
	</body>
</html>