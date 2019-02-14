@extends('layouts.app')

@section('title', 'Avances')

@section('metaTags')
	{{-- <meta name="description" content="">
	<meta name="keywords" content="">
	<meta property="og:title" content="" />
	<meta property="og:url" content="" />
	<meta property="og:type" content="" />
	<meta property="og:image" content="" />
	<meta property="og:description" content=""> --}}
@endsection()
@section('content')
<div id="oportuyaSlider">
		@foreach($images as $slider)
			<div class="containImg">
				<img src="/images/{{ $slider['img'] }}" class="img-fluid img-responsive" title="{{ $slider['title'] }}" />
				<div class="oportuyaSliderContent oportuyaSliderContentAdvance">
					<div class="oportuyaSliderTitle">
							@php
								$titleChunk=explode("-",$slider['title'],2);								
								$chunkOne= @$titleChunk[0];
								$chunkTwo= @$titleChunk[1];
								$chunkOneExplode= explode("_", $chunkOne,2);
								$chunkTwoExplode= explode("_",$chunkTwo,2);
								$chunkExplodeOne=@$chunkOneExplode[0];
								$chunkExplodeTwo=@$chunkOneExplode[1];
								$chunkExplodeThree=@$chunkTwoExplode[0];
								$chunkExplodeFour=@$chunkTwoExplode[1];
							@endphp
						<p>
							@php
								echo $chunkExplodeOne.' <span class="textTitleSliderPink">'.$chunkExplodeTwo.'</span>';
							@endphp							
						</p>
						<p>
							@php
								echo $chunkExplodeThree.' <span class="textTitleSliderBlue">'.$chunkExplodeFour.'</span>';
							@endphp							
						</p>
					</div>
					<br>
					<div class="oportuyaSliderDescription">
						<p>
							@php
							  echo $slider['description'];
							@endphp
						</p>
					</div>
					<br>
					<br>
					<div class="oportuyaSliderButton  oportuyaSliderButtonAdvance">
						<p>
							<a href="/avance/step1" alt="Realizar Solicitud de Crédito">
								@php
								  echo $slider['textButton'];
								@endphp
							</a>
						</p>
					</div>
				</div>
			</div>
		@endforeach
	</div>


	<div id="creditoLibranza" class="cupoAvance">
		<div class="containerCreditoLibranza">
			<h2 class="creditoLibranza-title text-center">¿Qué necesitas y  y cómo<br> solicitas tu <strong>Avance</strong>?</h2>
			<div class="row" id="creditoLibranza-slider">
				<div class="col-md-12 col-lg-6 container-creditoLibranzaCards">
					<div class="creditoLibranza-contianerTexto creditoLibranza-electrodomesticos avance-containerText">
						<img src="{{ asset('images/requirementsIcon.png') }}" alt="Crédito para electrodomésticos" class="img-fluid creditoLibranza-img">
						<div class="containerText-creditoLibranzaCards cardTextAdvance">
							<h3 class="creditoLibranza-titleText">Requisitos</h3>
						</div>
						<div>
						
					<ul class="requirementsList requirementsListAdvance">
						<li>Ser empleado o independiente con un tiempo mínimo de cuatro (4) meses.</li>
						<li>No presentar reportes negativos en las centrales de riesgo.</li>
						<li>Tener ingresos iguales o superior a 1 SMMLV.</li>
						<li>No haber cumplido los 70 años de edad.</li>
						<li>Si tiene entre 70 y 80 años debe ser pensionado.</li>
						<li>Presentar un buen historial de crédito en el sector financiero.</li>
						<li>Ser mayor de edad.</li>
					</ul>
				
						</div>
						<div class="row" style="padding-bottom: 15px;">
							<div class="col-12 text-center">
								<a href="https://api.whatsapp.com/send?phone=573115195753&text=Deseo%20obtener%20más%20información%20acerca%20de%20un%20cupo%20de%20Avanceo" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-lg-6 container-creditoLibranzaCards">
					<div class="creditoLibranza-contianerTexto creditoLibranza-motos avance-containerText">
						<img src="{{ asset('images/howGetIcon.png') }}" alt="Crédito para motos" class="img-fluid creditoLibranza-img">
						<div class="containerText-creditoLibranzaCards cardTextAdvance">
							<h3 class="creditoLibranza-titleText">¿Cómo tenerla?</h3>
						</div>
						<p class="descriptionRequirements descriptionRequirementsAdvance">
						<br>	
						Solo debes ingresar los datos y te llamaremos en menos de 2 horas, o si quieres ir a nuestras oficinas ubicadas en 48 ciudades del Pais, Cualquiera de nuestros asesores estará listo para atenderte. <br> <br>	<b>Te esperamos! </b>
						</p>
						<div class="row" style="padding-bottom: 15px;">
							<div class="col-12 text-center">
								<a href="https://api.whatsapp.com/send?phone=573115195753&text=Deseo%20obtener%20más%20información%20acerca%20de%20un%20cupo%20de%20Avance" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>

	<div id="travelOffers">
	<div class="row">
		<div class="travelOffersIcon col-sm-4 col-4 offset-md-3 col-md-2 travelOffersImg">
			<img src="{{ asset('images/convenios-credibilidadIcon.png') }}" class="img-fluid">
		</div>
		<div class="travelOffersText col-sm-4 col-4 col-md-2">
			<p class="travelMainText">No te quedes</p>
			<p class="travelSecondText">sin tu avance </p>
			<p class="travelAnyText">en efectivo</p>
		</div>
		<div class="travelOffersButton travelOffersButtonAdvance  col-sm-4 col-4 col-md-2">
			<p><a href="/avance/step1">!Solicítala aquí!</a></p>
		</div>
	</div>
</div>


	<div id="credibilidad" class="avanceCredibilidad">
		<div class="container">
			<h2 class="credibilidad-title text-center">Experiencia y <strong>Calidad</strong></h2>
			<div class="row">
				<div class="col-md-12 col-lg-4 text-center">
					<img src="{{ asset('images/libranza-experienciaMapa.png') }}" alt="" class="img-fluid credibilidad-img">
					<p class="credibilidad-text ">
						48 puntos de atención  <br>
						al público
					</p>
				</div>
				<div class="col-md-12 col-lg-4 text-center">
					<img src="{{ asset('images/libranza-experienciaAliados.png') }}" alt="" class="img-fluid credibilidad-img">
					<p class="credibilidad-text ">
						Adquiere experiencia  <br>
						crediticia con nosotros
					</p>
				</div>
				<div class="col-md-12 col-lg-4 text-center">
					<img src="{{ asset('images/libranza-experienciaClientes.png') }}" alt="" class="img-fluid credibilidad-img">
					<p class="credibilidad-text ">
						Más de 500.000 clientes <br>
						atendidos en los últimos 5 años
					</p>
				</div>
			</div>
		</div>
	</div>

	



	<!--
	<div id="construccion">
		<div class="container">
			<h2 class="creditoLibranza-title text-center">Esta sección está actualmente en construcción</h2>
			<p class="text-center">Si te interesa conocer más sobre nuestros avances de créditos, déjanos tus datos y un asesor se pondrá en contacto</p>
			<div class="modalFormulario-body" style="margin: auto;">
				<div class="modal-containerFormulario">
					<h3 class="modal-titleForm titleForm-avances">Avance</h3>
					<form role=form method="POST" id="saveLeadadvance" action="{{ route('avance.store') }}">
						{{ csrf_field() }}
						<input type="hidden" name="typeProduct" value="avance">
						<input type="hidden" name="typeService" value="avance">
						<input type="hidden" name="channel" value="1">
						<div class="form-group">
							<label for="name" class="control-label">Nombres</label>
							<input type="text" name="name" id="name" class="form-control" validation-pattern="name" required="true"  />
						</div>
						<div class="form-group">
							<label for="lastName" class="control-label">Apellidos</label>
							<input type="text" name="lastName" id="lastName" class="form-control" validation-pattern="name" required="true"/>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Correo electrónico</label>
							<input type="email" name="email" id="mail" class="form-control" validation-pattern="email" required="true"/>
						</div>
						<div class="form-group">
							<label for="telephone class="control-label">Teléfono</label>
							<input type="text" name="telephone" id="telephone" class="form-control" validation-pattern="telephone" required="true"/>
						</div>
						<div class="form-group">
							<label for="ciudad class="control-label">Ciudad</label>
							<select name="city" id="city" class="form-control" >
								@foreach($cities as $city)
									<option value="{{ $city['value'] }}">{{ $city['label'] }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1" required>
							<label for="termsAndConditions" style="font-size: 13px; font-style: italic;">
								Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
							</label>
						</div>
						<p class="textCityForm">
							*Válido solo para ciudades que se desplieguen en la casilla.
						</p>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
								Guardar
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>-->
@endsection