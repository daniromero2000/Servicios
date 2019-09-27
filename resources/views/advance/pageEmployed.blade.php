@extends('layouts.app')
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-781153823"></script>
<script>
	window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','AW-781153823',{'page_title':'Empleado','page_path':'/Employed'});
</script>
@section('content')
	<div class="row resetRow">
		<div class="col-12 text-center resetCol thankContainer">
			<div class="containerThankPage">	
				<img src="{{ asset('images/imageThankPage.jpg')}}" class="img-fluid">
			</div>
			<div class="dialogThakPage">	
				<img src="{{ asset('images/dialogThankPage.png')}}" class="img-fluid">
				<p> En nuestra base de datos se registra que tienes una relación laboral con la organización, comunícate a nuestras líneas de atención, para conocer las opciones que tenemos para ti .</p>
			</div>
		</div>
	</div>
@endsection()