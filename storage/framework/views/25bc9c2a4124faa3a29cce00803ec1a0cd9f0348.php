﻿<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Warranty</title>
  <link rel="stylesheet" href="https://stackedit.io/style.css" />
</head>

<body class="stackedit">
  <div class="stackedit__html"><h1 id="digital-warranty">Digital warranty</h1>
<h2 id="guía-de-lectura">guía de lectura</h2>
<p>El framework de desarrollo Laravel utilizado como base para la codificación de este proyecto tiene una estructura de carpetas definida, en la cual se define una ubicación especifica para cada uno de los componentes de la aplicación. Por lo cual como titulo para cada componente a describir se le asignara la ruta dentro de esta estructura, a continuación se describirá su función y posteriormente se dará un ejemplo de su codificación.</p>
<h1 id="routeweb3.php">route/web3.php</h1>
<p>se debe crear un grupo de rutas de la siguiente forma</p>
<pre><code>Route::group(['prefix'=&gt;'/digitalWarranty/'],function(){
    //display warrty request
    Route::get("/",function(){
	    return view('warranty.public.layout');
	})-&gt;name('warranty');
	//render
	Route::get('/Query', function(){
		return view('warranty.public.query');
	});
});
</code></pre>
<h1 id="resourcesviews">resources/views</h1>
<p>Dentro de este directorio se debe crear uno nuevo para las vistas del modulo de garantías /Warranty</p>
<h2 id="resourcesviewswarranty">resources/views/warranty</h2>
<p>dentro de este directorio se debe crear uno nuevo para la gestión de las vistas enfocadas al cliente del aplicativo /public</p>
<h2 id="resourcesviewswarrantypublic">resources/views/warranty/public</h2>
<h3 id="index.blade.php">index.blade.php</h3>
<p>estas vistas servirá como plantilla para el renderizado del aplicativo angular.js.<br>
</p>
<pre><code><?php $__env->startSection('content'); ?>

&lt;div  ng-app="PublicApp"&gt;
	&lt;ng-view&gt;
	&lt;/ng-view&gt;
&lt;/div&gt;
&lt;script  src="<?php echo e(asset('js/appWarranty/appPublic/app.js')); ?>"&gt;&lt;/script&gt;
&lt;script  src="<?php echo e(asset('js/appWarranty/appPublic/Controlles/Controller.js')); ?>"&gt;&lt;/script&gt;
<?php $__env->stopSection(); ?>
</code></pre>
<h1 id="resourcesviewslayouts">resources/views/layouts</h1>
<p>en esta carpeta se debe crear un diseño que contenga las inclusiones comúnmente usadas en los módulos del aplicativo</p>
<h2 id="basicincludes.blade.php">BasicIncludes.Blade.php</h2>
<pre><code>&lt;html&gt;
	&lt;head&gt;
		&lt;title&gt;<?php echo $__env->yieldContent('title'); ?>&lt;/title&gt;
		&lt;meta  name="viewport"  content="width=device-width, initial-scale=1.0"&gt;
		&lt;meta  http-equiv="Content-Type"  content="text/html; charset=utf-8"&gt;
		<?php echo $__env->yieldContent('metaTags'); ?>
		&lt;link  rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"  crossorigin="anonymous"&gt;
		&lt;link  rel="stylesheet"  href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"  integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"  crossorigin="anonymous"&gt;
		<?php echo $__env->yieldContent('linkStyleSheets'); ?>
		&lt;link  rel="stylesheet"  href="<?php echo e(asset('css/app.css')); ?>"&gt;
		&lt;link  rel="stylesheet"  href="<?php echo e(asset('css/app2.css')); ?>"&gt;
		&lt;link  rel="stylesheet"  href="<?php echo e(asset('css/slick-theme.css')); ?>"&gt;
		&lt;link  rel="stylesheet"  href="<?php echo e(asset('css/slick.css')); ?>"&gt;
		&lt;link  href="<?php echo e(asset('editor/contentbuilder/codemirror/lib/codemirror.css')); ?>"  rel="stylesheet"  type="text/css"  /&gt;
		&lt;script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"&gt;&lt;/script&gt;
		&lt;script  src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"&gt;&lt;/script&gt;
		&lt;script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"&gt;&lt;/script&gt;
		&lt;script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"&gt;&lt;/script&gt;
		&lt;script  type="text/javascript"  src="<?php echo e(asset('js/slick.min.js')); ?>"&gt;&lt;/script&gt;
		&lt;script  type="text/javascript"  src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"&gt;&lt;/script&gt;
		&lt;link  href="<?php echo e(asset('editor/contentbuilder/contentbuilder.css')); ?>"  rel="stylesheet"  type="text/css"  /&gt;
		&lt;link  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"  rel="stylesheet"&gt;
		&lt;link  rel='shortcut icon'  type='image/x-icon'  href='<?php echo e(asset('images/oportunidadesServicios.ico')); ?>'  /&gt;
		&lt;script&gt;
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
		&lt;/script&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;div  class="ex-loader"&gt;&lt;div  id="loader"&gt;&lt;/div&gt;&lt;/div&gt;
		&lt;div  id="ex-global-content"  class="ex-loader-blur"&gt;
		&lt;div  id="container"&gt;
			<?php echo $__env->yieldContent('content'); ?>
		&lt;/div&gt;
		<?php echo $__env->yieldContent('scriptsJs'); ?>
	&lt;/body&gt;
&lt;/html&gt;
</code></pre>
<h1 id="publicjs">public/js/</h1>
<p>esta carpeta contiene los scripts de javascrip usados en la aplicacion</p>
<h2 id="publicjsappwarranty">public/js/appWarranty</h2>
<p>en este directorio contiene los archivos del aplicativo angular.js</p>
<h2 id="app.js">app.js</h2>
<p>este archivo contiene la configuración básica del aplicativo y su conexión con los archivos de Laravel</p>
<pre><code>var app = angular.module('PublicApp',['ngRoute']);
	app.config(['$routeProvider',
		function($routeProvider) {
			$routeProvider.
				when('/', { templateUrl: 'digitalWarranty/Query',controller:'warrantyController' })
}]);
</code></pre>
<h1 id="publiccss">public/css/</h1>
<h2 id="app2.css">app2.css</h2>
<p>Este es uno de los archivos que se usa para almacenar los estilos de los aplicativos del proyecto. En este debemos agregar los siguientes estilos.</p>
<pre><code>.form-container-logoHeader{
	background: #167efa;
	padding: 40px;
	position: relative;
}
.form-container-logoHeader:before {
	background: #167efa;
	content: "";
	height: 156px;
	position: absolute;
	top: 0;
	right: -32px;
	transform: skew(338deg);
	width: 64px;
	z-index: 2;
}
@media(max-width: 768px){
	.logoHeaderWarranty{
		padding: 30px;
		margin-bottom: 80px;
		width:100%;
	}
	.form-container-logoHeader:before{
		width: 0;
	}
	.logoHeaderWarranty:before{
		width: 0;
	}
}
</code></pre>
<h1 id="publicimages">public/images/</h1>
<p>En este directorio se deben agregar las imágenes a utilizar en los diseños del aplicativo, en estas se debe agregar una imagen para y con este nombre para LogoGarantias.png y analistaGarantiaDigital.png</p>
</div>
</body>

</html>

<?php echo $__env->make(‘layouts.basicIncludes’, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>