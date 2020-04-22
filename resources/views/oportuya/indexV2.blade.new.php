@extends('layouts.app')



@section('title', 'Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta.')

@section('metaTags')
<meta name="googlebot" content="noindex">
<meta name="robots" content="noindex">
<link rel="canonical" href="https://www.serviciosoportunidades.com/oportuya" />
<meta name="description"
	content="Tarjeta Oportuya, nuestro cupo de tarjeta de crédito con el que podrás obtener todos los beneficios de ser un cliente Oportunidades.">
<meta name="keywords"
	content="Tarjeta de credito, Tarjeta de crédito, solicitar tarjeta de credito, solicitar tarjeta de crédito, tarjeta de credito online, tarjeta de crédito online, su tarjeta de crédito, su tarjeta de credito, como sacar una tarjeta de credito, como sacar una tarjeta de crédito, como tramitar una tarjeta de credito, como tramitar una tarjeta de crédito, requisitos para tarjeta de crédito, requisitos para tarjeta de credito, obtén una tarjeta de credito, obtén una tarjeta de crédito, requisitos tarjeta de credito, requisitos tarjeta de crédito, quiero una tarjeta de credito, quiero una tarjeta de crédito, tarjeta oportunidades, oportunidades, tarjeta con credito para compras, tarjeta con crédito para compras, credito en tarjeta, crédito en tarjeta.">
<meta property="og:title" content="Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta." />
<meta property="og:url" content="https://www.serviciosoportunidades.com/oportuya" />
<meta property="og:type" content="Website" />
<meta property="og:image" content="{{ asset('images/OportuyaPortadaOg.png') }}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:description"
	content="Tarjeta Oportuya, nuestro cupo de tarjeta de crédito con el que podrás obtener todos los beneficios de ser un cliente Oportunidades">
@endsection()

@section('content')
<!-- Slider Section Oportuya Page -->
<div id="oportuyaSlider">

	<div class="containImg">
		<img src="{{ asset('images/Front/OportuyaCustomers/PageCredit/Banner/Banner.png')}}"
			class="img-fluid img-responsive" />
		<div class="oportuyaSliderContent">
			<div class="oportuyaSliderTitle">

			</div>
			<br>
			<div class="oportuyaSliderDescription">

			</div>

			<div class="oportuyaSliderButton">

			</div>
		</div>
	</div>
</div>

<!-- Credit Card Section -->
<div class="step-cards">


</div>


<div id="oportuyaBanner">
	<div class="max-width-content-19">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-8 col-lg-6 offset-lg-1">
					<p class="text-center">
						Confiamos en ti, es por eso que tenemos una aprobación <br>
						inmediata si cumples con nuestras políticas de crédito <br>
						Podemos otorgarte un cupo desde $1.800.000 para que <br>
						lo utilices en nuestras tiendas, <br>
						<span>Rápido, confiables y sin moverte de casa.</span>
						<br>
					</p>
					<br>
					<p class="text-center">
						<a data-toggle="modal" href="#oportuyaBeneficiosModal">Conoce más</a>
					</p>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4">
					<img src="{{asset('images/oportuyaBlackBanner.png')}}" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>
<!--Requirements Section -->

<div id="credito-online">
	<img src="{{asset('images/banner3-top-avances-new.png')}}" alt="" class="img-fluid">
	<div class="container text-center credito-online-texto">
		<div>
			<h3><span>Crédito Online</span>, desde la <br> comodidad de tu casa. </h3>
		</div>
	</div>
	<div class="credito-online-boton">
		<p class="textTarjeta">
			<i>*Tarjeta Oportuya NO VIGILADA por la SUPERINTENDENCIA FINANCIERA de Colombia</i>
		</p>
		<div>
			<a href="/avance/step1">Click para Crédito</a>
		</div>
	</div>
</div>


<div id="requirements">
	<div class="row requirementsContent">
		<div class="col-md-6 col-xs-12 contentRequirements ">
			<img src="{{asset('/images/requirementsIcon.png')}}" class="img-responsive">
			<p class="titleRequirements">
				Requisitos
			</p>
			<p class="descriptionRequirements">
				<ul class="requirementsList">
					<li>Pertenecer al perímetro urbano de las ciudades donde se encuentran los <a
							href="/Nuestras-tiendas">puntos</a> de venta físicos de ALMACENES OPORTUNIDADES. </li>
					<li>En caso de ser empleado, pertenecer al régimen “Activo contributivo Cotizante”, o ser aportante
						a seguridad social.</li>
					<li>Para el caso de los independientes, tener registro en cámara de comercio y renovación el último
						año. .</li>
					<li>Tener ingresos iguales o superior a 1 SMMLV.</li>
					<li>Edad Máxima de 70 años.</li>
					<li>Presentar un buen historial de crédito en el sector financiero.</li>
					<li>Ser mayor de edad.</li>
					<li>Tener nacionalidad colombiana </li>
				</ul>
			</p>
		</div>

		<div class="col-md-6 col-xs-12 contentRequirements requirementsLine">

			<img src="{{asset('/images/howGetIcon.png')}}" class="img-responsive">

			<p class="titleRequirements">

				Como Tenerla

			</p>

			<p class="descriptionRequirements">

				<b>Estas interesado en obtenerla? </b> <br>
				<br>
				Solo debes ingresar los datos y un asesor se pondrá en contacto contigo, o si quieres ir a nuestras
				oficinas ubicadas en 48 ciudades del Pais, Cualquiera de nuestros asesores estará listo para atenderte.
				<br> <br> <b>Te esperamos! </b>

			</p>

		</div>

	</div>

</div>

<!-- Oportuya section -->
<div id="oportuyaSection">
	<div class="oportuyaContent">
		<div class=" row oportuyaContentHeader">
			<p class="textOportuyaHeader oportuyaText">
				<b class="efectiveText">
					Solicita tu crédito en línea
				</b>


			</p>
			<div class="col-md-3 col-sm-3 oportuyaHeaderImage">
				<img src="{{asset('/images/logoOportuya-inverso.png')}}" class="img-fluid">
			</div>
			<div class="col-sm-9 col-md-9 oportuyaTextResponsive">
				<p class="textOportuyaHeader">
					<b class="efectiveText">
						Solicita tu crédito en línea
					</b>

				</p>
			</div>
		</div>
		<div class="row oportuyaContentFeatures">
			<div class=" col-md-8">
				<div class="row">
					<div class="col-xs-12 col-12 contentFeatures">
						<div class="row contentListFeatures">
							<div class="col-md-4 text-center stepContainer steps">
								<img src="{{asset('/images/iconPaso1.png')}}">
								<p>
									<span>Paso 1</span>
								</p>
								<p>Déjanos tus datos</p>
							</div>
							<div class="col-md-4 text-center stepContainer steps">
								<img src="{{asset('/images/iconPaso2.png')}}">
								<p>
									<span>Paso 2</span>
								</p>
								<p>Llena tu solicitud de crédito</p>
							</div>
							<div class="col-md-4 text-center steps">
								<img src="{{asset('/images/iconPaso3.png')}}">
								<p>
									<span>Paso 3</span>
								</p>
								<p>Empieza a disfrutar de los mejores descuentos</p>
							</div>
						</div>
						<div class=" row contentListFeaturesResponsive">
							<div class="col-12 col-md-12 col-lg-4 text-center stepContainer steps">
								<div class="row stepResponsive">
									<div class="col-2 col-md-2">
										<img src="{{asset('/images/iconPaso1.png')}}">
									</div>
									<div class="col-2 col-md-3 text-left">

										<span>Paso 1</span>

									</div>
									<div class="col-8 col-md-7 text-left">
										<p>Déjanos tus datos</p>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-12 col-lg-4 text-center stepContainer steps">
								<div class="row stepResponsive">
									<div class="col-2 col-md-2">
										<img src="{{asset('/images/iconPaso2.png')}}">
									</div>
									<div class="col-2 col-md-3 text-left">

										<span>Paso 2</span>

									</div>
									<div class="col-8 col-md-7 text-left">
										<p>Llena tu solicitud de crédito</p>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-12 col-lg-4 text-center steps">
								<div class="row stepResponsive">
									<div class="col-2 col-md-2">
										<img src="{{asset('/images/iconPaso3.png')}}">
									</div>
									<div class="col-2 col-md-3 text-left">

										<span>Paso 3</span>

									</div>
									<div class="col-8 col-md-7 text-left">
										<p>Empieza a disfrutar de los mejores descuentos</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
						</div>

					</div>

				</div>

				<div class="row buttonOportuyaSection buttonOportuya text-center">
					<a href="/step1" alt="Realizar Solicitud de Crédito">
						¡Solicítala aquí!
					</a>
				</div>

				<div class="row buttonOportuyaSection responsiveButtonOportuya">
					<a href="/step1" alt="Realizar Solicitud de Crédito">
						¡Solicita la tuya ahora!
					</a>
				</div>
			</div>
			<div class=" col-md-4 contentFeatures oportuyaContentImage">

				<img src="{{ asset('/images/modeloNew.png')}}" class="img-fluid">

			</div>
		</div>

	</div>
</div>

<div id="servicesPoint">
	<div class="row">
		<div class="col-12 col-md-6 servicesPointContainer">
			<div class="serviceContainer">
				<img src="{{asset('/images/iconPuntosServicio.png')}}">
				<p>48 Puntos de servicios para que puedas</p>
				<p>utilizar tus tarjetas Oportuya</p>
			</div>
		</div>
		<div class="col-12 col-md-6 servicesPointCard">
			<div class="serviceContainerCard">
				<img src="{{asset('/images/tarjeta-de-credito_28.png')}}">
				<p>Los mejores descuentos con </p>
				<p>nuestras tarjetas de crédito</p>
			</div>
		</div>
	</div>

</div>

<div class="fixedButton">
	<div class="row">
		<div class="col-2">
			<img src="{{asset('images/iconFlotante.png')}}">
		</div>
		<div class="col-8">
			<p>
				<span>¡Te gustaría saber</span>
			</p>
			<p>
				<span> por qué pedimos </span>
			</p>
			<p>
				<span>tus datos!</span>
			</p>
		</div>
		<div class="col-12">
			<a href="">Click aquí</a>
		</div>
	</div>
</div>

<div class="modal modalFormulario fade hide" id="oportuyaBeneficiosModal" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body oportuyaModal-body">
				<h4 class="text-center">
					Conoce la manera más fácil de tener todos
					<hr>
					los beneficios de nuestros clientes.
				</h4>
				<br>
				<br>
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="row border-top min-height-modal-item">
							<div class="col-2 text-center">
								<img src="{{asset('images/icon-accede-oportuya.png')}}" alt="" class="img-fluid">
							</div>
							<div class="col-10">
								Accede con facilidad a una gran variedad de electrodomésticos para tu hogar.
							</div>
						</div>
						<div class="row border-top">
							<div class="col-2 text-center">
								<img src="{{asset('images/icon-cupo-oportuya.png')}}" alt="" class="img-fluid">
							</div>
							<div class="col-10">
								Un cupo de avances para que utilices cuando más lo necesites (Desde $100.000 - hasta
								$500.000)
							</div>
						</div>
						<div class="row border-top border-bottom">
							<div class="col-2 text-center">
								<img src="{{asset('images/icon-rotativo-oportuya.png')}}" alt="" class="img-fluid">
							</div>
							<div class="col-10">
								El cupo de crédito con nuestra tarjeta es rotativo.
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="row border-top min-height-modal-item">
							<div class="col-2 text-center">
								<img src="{{asset('images/icon-descuentos-oportuya.png')}}" alt="" class="img-fluid">
							</div>
							<div class="col-10">
								Tienes acceso a los súper descuentos que lanzamos cada semana con los mejores precios
								por ser cliente Oportuya.
							</div>
						</div>
						<div class="row border-top">
							<div class="col-2 text-center">
								<img src="{{asset('images/icon-seguros-oportuya.png')}}" alt="" class="img-fluid">
							</div>
							<div class="col-10">
								Descuentos en SOAT y otros seguros para que estés protegido siempre.
							</div>
						</div>
						<div class="row border-top border-bottom">
							<div class="col-2 text-center">
								<i class="fas fa-credit-card"></i>
							</div>
							<div class="col-10">
								Cuota de manejo $14.400 mensuales.
							</div>
						</div>
					</div>
				</div>
				<br>
				<h5 class="text-center">
					Antes de iniciar con los pasos queremos que sepas que <br> tenemos muchas oportunidades de crédito
					para ti.
				</h5>
				<br>
				<div class="row content-pasos-oportuya">
					<div class="col-12 border-bottom pasos-oportuya">
						<div class="row">
							<div class="col-md-1 col-2 text-center paso-oportuya-numero"> <span>1</span></div>
							<div class="col-md-8 col-10 paso-oportuya-vertica-centrar">
								<p> Ingresa nuestra solicitud de crédito para comenzar </p>
							</div>
							<div class="col-md-3 col-12 text-center">
								<a href="/step1"><img src="{{asset('images/icon-ingresar-modal.png')}}" alt=""
										class="img-fluid"></a>
							</div>
						</div>
					</div>
					<div class="col-12 border-bottom pasos-oportuya">
						<div class="row">
							<div class="col-2 col-md-1 text-center paso-oportuya-numero"> <span>2</span></div>
							<div class="col-10 col-md-8">
								<p>Deja tus datos completos según la solicitud de crédito
									que estés diligenciando.De la calidad de la información
									dependerá la velocidad en el resultado.
									Además recuerda que todos los datos son verificados.</p>
							</div>
							<div class="col-12 col-md-3 text-center">
								<a href="/step1"><img src="{{asset('images/icon-datos-oportuya.png')}}" alt=""
										class="img-fluid"></a>
							</div>
						</div>
					</div>
					<div class="col-12 border-bottom pasos-oportuya">
						<div class="row">
							<div class="col-md-1 col-2 text-center paso-oportuya-numero"> <span>3</span></div>
							<div class="col-md-8 col-10">
								<p>En el intermedio del proceso recibirás un token de
									confirmación para verificar la existencia de tu número
									telefónico;no lo elimines, el proceso te lo exigirá para
									continuar con tu solicitud.</p>
							</div>
							<div class="col-md-3 col-12	 text-center">
								<img src="{{asset('images/icon-token-oportuya.png')}}" alt="" class="img-fluid">
							</div>
						</div>
					</div>
					<div class="col-12 pasos-oportuya">
						<div class="row">
							<div class="col-md-1 col-2 text-center paso-oportuya-numero"> <span>4</span></div>
							<div class="col-md-8 col-10 padding-top-30">
								<p>Una vez haya sido aprobada tu solicitud de crédito.
									un asesor se comunicará contigo para finalizar el proceso.
								</p>
							</div>
							<div class="col-md-3 col-12 text-center asesor-img-modal">
								<img src="{{asset('images/icon-asesor-oportuya.png')}}" alt="" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row footer-modal-oportuya">
					<div class="col-md-7 bg-oportuya-modal-footer">
					</div>
					<div class="col-md-5 bg-oportuya-modal-footer">
						<p>Avances aplica para las tres tarjetas <br>
							Black, Blue y Gray: <br>
							<span>Blue y Black:</span>hasta $500.000<br>
							<span>Gray:</span>hasta $200.000
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- oportuya Modal -->
@stop