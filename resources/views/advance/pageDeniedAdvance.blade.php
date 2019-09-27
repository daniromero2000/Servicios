@extends('layouts.app')
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-781153823"></script>
<script>
	window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','AW-781153823',{'page_title':'Avance Denied ThankYouPage','page_path':'/OPN_gracias_denied'});
</script>
@section('content')
	<div id="mensajeFinal">
		<div class="max-width-content-12">
			<div class="row">
				<div class="col-sm-10 offset-sm-1">
					<div class="row resetRow containMensajeFinal">
						<div class="col-sm-12 col-md-4 text-center mensajeFinal-containImg">
							<img src="{{asset('images/imgMensajeFinal.png')}}" class="mensajeFinal-img img-fluid" alt="">
						</div>
						<div class="col-sm-12 col-md-8 text-center" style="position:relative">
							<div class="mensajeFinal-containText">
								@php
									echo $mensaje;
								@endphp
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()