@extends('layouts.app')

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
								<p class="mensajeFinal-text">
									Si tu crédito no fue aprobado, no te preocupes,<br> aún tenemos más <strong>Oportunidades</strong> de crédito para ti
								</p>
								<p class="mensajeFinal-text2">
									Un asesor se contactará contigo <br> para ofrecerte más información.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()