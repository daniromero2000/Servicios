@extends('layouts.app')

@section('title', 'Crédito de Libranzas para pensionados, docentes y militares.')

@section('metaTags')
	<link rel="canonical" href="https://www.serviciosoportunidades.com/libranza" />
	<meta name="description" content="El Crédito de libranza con el que podrás disfrutar de todas nuestras opciones, compra electrodomésticos, viaja, adquiere tu moto, compra tu cartera o remodela tu casa; sin costos ocultos y con el descuento a tu nomina.">
	<meta name="keywords" content="Libranzas, credito para docentes, crédito para docentes, credito de libranzas, crédito de libranzas, pensionados, crédito para pensionados, credito para pensionados, prestamos para pensionados, préstamos para pensionados, libre inversión, libre inversion, crédito de libre inversión para pensionados, credito de libre inversion para pensionados, prestamos para jubilados, préstamos para jubilados, prestamos a pensionados, préstamos a pensionados, crédito fácil para pensionados, credito facil para pensionados, prestamos para profesores, préstamos para profesores, profesores, prestamo a pensionados y jubilados, préstamo a pensionados y jubilados, crédito para militares, credito para militares, crédito para policías, credito para policias, crédito para casas, credito para casas, pensionados de la policia, pensionados de la policía, pensionados militares, pensionados por la policia, pensionados por la policía, pensionados por las fuerzas armadas, jubilados de casur, jubilados policía, jubilados policia.">
	<meta property="og:title" content="Crédito de Libranzas para pensionados, docentes y militares." />
	<meta property="og:url" content="https://www.serviciosoportunidades.com/libranza" />
	<meta property="og:type" content="Website" />
	<meta property="og:image" content="{{ asset('images/LibranzasPortadaOg.png') }}" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />
	<meta property="og:description" content="El Crédito de libranza con el que podrás disfrutar de todas nuestras opciones, compra electrodomésticos, viaja, adquiere tu moto, compra tu cartera o remodela tu casa; sin costos ocultos y con el descuento a tu nomina.">
@endsection()

@section('content')
<div ng-app="appLibranzaLiquidador" ng-controller="libranzaLiquidadorCtrl">
	<div id="sliderPrincipalLibranza">
			<div class="containImg">
				<img src="/images/sombra.png" alt="Sombra" class="img-fluid sombraSliderPrincipal">
				<img src="/images/creditoLibranza.jpg" class="img-fluid img-responsive" title="Libranza">
				<div class="sliderPrincipal-containTextLeft">
					<p class="sliderPrincipalLibranza-text">
						{{-- @php
							echo $slider['description'];
						@endphp --}}
						Te damos <strong>más</strong> que <strong>Crédito,</strong>  te damos la <br><strong>Oportunidad</strong> de vivir viajando
					</p>

					{{-- <a href="#formularioSimulador" class="sliderPrincipalLibranza-button">@php echo $slider['textButton']; @endphp</a> --}}
					<a href="#formularioSimulador" class="sliderPrincipalLibranza-button" tabindex="0">Solicítalo ya</a>
				</div>
			</div>
			<div class="containImg">
				<img src="/images/sombra.png" alt="Sombra" class="img-fluid sombraSliderPrincipal">
				<img src="/images/creditoLibranzaDocentes.jpg" class="img-fluid img-responsive" title="Libranza">
				<div class="sliderPrincipal-containTextLeft">
					<h2 class="sliderPrincipal-titleSlider">Crédito para<strong> Docentes</strong></h2>
					<p class="sliderPrincipalLibranza-text">
						{{-- @php
							echo $slider['description'];
						@endphp --}}
						Lo hacemos a tu medida, <br> crédito de <strong>libranzas para docentes</strong>
					</p>

					{{-- <a href="#formularioSimulador" class="sliderPrincipalLibranza-button">@php echo $slider['textButton']; @endphp</a> --}}
					<a href="#formularioSimulador" class="sliderPrincipalLibranza-button" tabindex="0">Solicítalo ya</a>
				</div>
			</div>
			<div class="containImg">
				<img src="/images/sombraV2.png" alt="Sombra" class="img-fluid sombraSliderPrincipal">
				<img src="/images/creditoLibranzaSuenos.jpg" class="img-fluid img-responsive" title="Libranza">
				<div class="sliderPrincipal-containTextRigth">
					<p class="sliderPrincipalLibranza-text">
						{{-- @php
							echo $slider['description'];
						@endphp --}}
						¿Soñando con remodelar tu casa? <br> hazlo realidad con nuestro <strong>crédito de libranza</strong>
					</p>

					{{-- <a href="#formularioSimulador" class="sliderPrincipalLibranza-button">@php echo $slider['textButton']; @endphp</a> --}}
					<a href="#formularioSimulador" class="sliderPrincipalLibranza-button" tabindex="0">Solicítalo ya</a>
				</div>
			</div>
	{{-- 	@foreach($images as $slider)
		@endforeach --}}
	</div>


	<div id="creditoLibranza">
		<div class="containerCreditoLibranza">
			<h2 class="creditoLibranza-title text-center">Todo lo que puedes hacer con <br> nuestro <strong>crédito de libranza</strong></h2>
			<div class="row" id="creditoLibranza-slider">
				<div class="col-md-12 col-lg-4 container-creditoLibranzaCards">
					<div class="creditoLibranza-contianerTexto creditoLibranza-electrodomesticos">
						<img src="{{ asset('images/libranza-creditoElectrodomestico.png') }}" alt="Crédito para electrodomésticos" class="img-fluid creditoLibranza-img">
						<div class="containerText-creditoLibranzaCards">
							<h3 class="creditoLibranza-titleText">Crédito para <br> electrodomésticos</h3>
							<p class="creditoLibranza-text">
								A través de nuestras tiendas Oportunidades a nivel nacional, Te financiamos hasta por 60 meses en el electrodoméstico que tanto quieres. <br>
								<strong>¡Compralo a crédito!</strong>
							</p>
						</div>
						<div class="row" style="padding-bottom: 15px;">
							<div class="col-12 text-center">
								<a href="https://api.whatsapp.com/send?phone=573105216830&text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza%20para%20un%20electrodoméstico" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-lg-4 container-creditoLibranzaCards">
					<div class="creditoLibranza-contianerTexto creditoLibranza-motos">
						<img src="{{ asset('images/libranza-creditoMotos.png') }}" alt="Crédito para motos" class="img-fluid creditoLibranza-img">
						<div class="containerText-creditoLibranzaCards">
							<h3 class="creditoLibranza-titleText">Crédito <br> para motos</h3>
							<p class="creditoLibranza-text">
								Accede a la moto que quieres a través de nuestras líneas de crédito que se adaptan a tus posibilidades de pago. te damos hasta 108 mese para que te la lleves. <br>
								<strong>¡Compra tu moto a crédito!</strong>
							</p>
						</div>
						<div class="row" style="padding-bottom: 15px;">
							<div class="col-12 text-center">
								<a href="https://api.whatsapp.com/send?phone=573105216830&text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza%20para%20una%20moto" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-lg-4 container-creditoLibranzaCards">
					<div class="creditoLibranza-contianerTexto creditoLibranza-viajes">
						<img src="{{ asset('images/libranza-creditoViajes.png') }}" alt="Crédito para viajes" class="img-fluid creditoLibranza-img">
						<div class="containerText-creditoLibranzaCards">
							<h3 class="creditoLibranza-titleText">Crédito <br> para viajes</h3>
							<p class="creditoLibranza-text">
								Ahora puedes viajar por el mundo financiando tus paquetes turísticos nacionales hasta por 24 meses e internacionales hasta por 48 meses. <br>
								<strong>¡Viaja Ahora!</strong>
							</p>
						</div>
						<div class="row" style="padding-bottom: 15px;">
							<div class="col-12 text-center">
								<a href="https://api.whatsapp.com/send?phone=573105216830&text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza%20para%20un%20viaje" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-lg-4 container-creditoLibranzaCards">
					<div class="creditoLibranza-contianerTexto creditoLibranza-libreInversion">
						<img src="{{ asset('images/libranza-libreInversion.png') }}" alt="Crédito Libre Inversión" class="img-fluid creditoLibranza-img">
						<div class="containerText-creditoLibranzaCards">
							<h3 class="creditoLibranza-titleText">Crédito <br> libre inversión</h3>
							<p class="creditoLibranza-text">
								Es un préstamo de Libre Destino que se aprueba a personas naturales, vinculadas a entidades con las cuales existen convenios previamente establecido con LAGOBO y cuyas cuotas se descuentan mensualmente del pago de nómina.
							</p>
						</div>
						<div class="row" style="padding-bottom: 15px;">
							<div class="col-12 text-center">
								<a href="https://api.whatsapp.com/send?phone=573105216830&text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza%20libre%20inversión" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-lg-4 container-creditoLibranzaCards">
					<div class="creditoLibranza-contianerTexto creditoLibranza-motos">
						<img src="{{ asset('images/libranza-compraCartera.png') }}" alt="Compra de cartera" class="img-fluid creditoLibranza-img">
						<div class="containerText-creditoLibranzaCards">
							<h3 class="creditoLibranza-titleText">Compra <br> de cartera</h3>
							<p class="creditoLibranza-text">
								Sabemos lo importante administrar mejor tu dinero. Por eso, te ofrecemos unificar tus deudas que presentas con otras entidades en un solo crédito con Tasa y Plazo Fijo para mejorar tu flujo de caja.
							</p>
						</div>
						<div class="row" style="padding-bottom: 15px;">
							<div class="col-12 text-center">
								<a href="https://api.whatsapp.com/send?phone=573105216830&text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza%20por%20medio%20de%20compra%20de%20cartera" class="creditoLibranza-buttonWhatsApp" target="_blank">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="creoToServicios">
		<img src="{{ asset('images/libranza-creoToServiciosV2.jpg') }}" alt="Creo to Servicios" class="img-fluid" />
	</div>

	<div id="formularioSimulador">
		<div class="formularioSimulador-container">
			<div class="row resetRow">
				<div class="col-12 col-md-12 col-lg-4 resetCol">
					<h2 class="formularioSimulador-title text-center"><strong>Libranza</strong> para pensionados y docentes</h2>
					<p class="formularioSimulador-textPrincipal text-justify">
						Con nuestro simulador puedes calcular el monto y plazo que se ajuste a tus necesidades y estarás un paso más cerca de realizar tus sueños. Te invitamos para que dejes tus datos después de simular tu crédito y uno de nuestros asesores se comunicará contigo para acompañarte en el proceso de aprobación.
					</p>
					<p class="formularioSimulador-textPrincipal text-justify">
						El cupo y cuota del crédito, producto de esta simulación, son aproximados e informativos y podrán variar de acuerdo a las políticas de financiación y de crédito vigentes al momento de su estudio y aprobación por parte de Lagobo.
					</p>
				</div>
				<div class="formularioSimulador-containerFormulario">
					<h3 class="formularioSimulador-titleForm">
						<img src="{{ asset('images/libranza-formularioPesos.png') }}" alt="Simula tu crédito" class="img-fluid formularioSimulador-imgPesos">
						Simula tu Crédito
					</h3>
					<div class="containerFormulario">
						<form ng-submit="simular()" id="formEx">
							<div class="formularioSimulador-containInput">
								<label class="formularioSimulador-labelFormulario" for="creditLine">Linea de Crédito :</label>
								<select id="creditLine" class="form-control" ng-model="libranza.creditLine" ng-options="linea.value as linea.label for linea in lineaCredito" required="true" ></select>
							</div>
							<div class="formularioSimulador-containInput">
								<label for="customerType" class="formularioSimulador-labelFormulario">Tipo de Cliente :</label>
								<select class="form-control" id="customerType" ng-model="libranza.customerType" ng-options="tipo.value as tipo.label for tipo in tipoCliente" ng-change="selectPagaduria()" required="true" ></select>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-2">
									<div class="formularioSimulador-containInput">
										<label for="age" class="formularioSimulador-labelFormulario">Edad :</label>
										<input type="number" class="form-control" id="age" ng-model="libranza.age" ng-blur="calculateData()" validate="age" ng-change="validateInt()" required="true" />
									</div>
								</div>
								<div class="col-sm-12 col-md-10">
									<div class="formularioSimulador-containInput">
										<label class="formularioSimulador-labelFormulario" for="pagaduria">Pagaduría : <span class="text-small">*Selecciona  tu administrador de pensión y/o empleador</span></label>
										<select id="pagaduria" class="form-control" ng-model="libranza.pagaduria" ng-options="pagaduriaItem.value as pagaduriaItem.label for pagaduriaItem in pagadurias"></select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-6">
									<div class="formularioSimulador-containInput">
										<label for="salary" class="formularioSimulador-labelFormulario">Salario Básico :</label>
										<input type="number" id="salary" class="form-control" ng-model="libranza.salary" ng-blur="calculateData()" ng-change="validateInt()" required="true" />
									</div>
								</div>
								<div class="col-sm-12 col-md-6">
									<div class="formularioSimulador-containInput">
										<label for="lawDesc" class="formularioSimulador-labelFormulario">Descuentos de ley :</label>
										<input type="text" id="lawDesc" class="form-control" ng-model="libranza.lawDesc" ng-disabled="true" />
									</div>
								</div>
							</div>
							<div class="formularioSimulador-containInput">
								<label for="otherDesc" class="formularioSimulador-labelFormulario">Otros Descuentos :</label>
								<input type="number" id="otherDesc" class="form-control" ng-model="libranza.otherDesc" ng-blur="calculateData()" ng-change="validateInt()" />
							</div>
							<div class="formularioSimulador-containInput">
								<input type="hidden" id="segMargen" class="form-control" ng-model="libranza.segMargen">
							</div>
							<div class="formularioSimulador-containInput" ng-if="libranza.creditLine == 'Libre inversion + Compra de cartera'">
								<label for="quotaBuy" class="formularioSimulador-labelFormulario">Valor Cuota Compra :</label>
								<input type="text" id="quotaBuy" class="form-control" ng-model="libranza.quotaBuy" ng-blur="calculateData()" ng-change="validateInt()" />
							</div>
							<div class="formularioSimulador-containInput text-center">
								<button type="submit" class="btn buttonSend formularioSimulador-buttonForm" style="margin-top: 15px;">Simular</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row resetRow">
			
		</div>
	</div>

	<div id="credibilidad">
		<div class="container">
			<h2 class="credibilidad-title text-center">Experiencia <strong>Credibilidad</strong></h2>
			<div class="row">
				<div class="col-md-12 col-lg-4 text-center">
					<img src="{{ asset('images/libranza-experienciaMapa.png') }}" alt="" class="img-fluid credibilidad-img">
					<p class="credibilidad-text ">
						56 puntos de atención  <br>
						al público
					</p>
				</div>
				<div class="col-md-12 col-lg-4 text-center">
					<img src="{{ asset('images/libranza-experienciaAliados.png') }}" alt="" class="img-fluid credibilidad-img">
					<p class="credibilidad-text ">
						Más de 40 Aliados estratégicos <br>
						en todo el territorio nacional
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


	<div class="modal fade hide" id="simularModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body simularModal-modalBody">
					<div class="row resetRow">
						<i class="fas fa-times cursor formularioSimulador-closeModal" data-dismiss="modal"></i>
						<div class="col-12 text-center form-group">
							<h3 class="formularioSimulador-title"><strong>Cuota Disponible</strong></h3>
							<br>
							<span class="simularModal-quaotaAvailable">$ @{{ libranza.quaotaAvailable | number:0 }}</span>
						</div>
						<div class="col-12 text-center form-group text-center">
							<button class="btn formularioSimulador-buttonForm" ng-click="solicitar()">Solicitar</button>
						</div>
					</div>
					<div class="table">
						<table class="table table-hover">
							<thead class="simularModal-thead">
								<tr>
									<td class="col-sm-8">Monto máximo aprobado por plazo</td>
									<td class="col-sm-4">Plazo</td>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="plazo in plazos">
									<td>$@{{ plazo.amount | number:0 }}</td>
									<td>@{{ plazo.timeLimit }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-12 text-center" style="padding: 20px 0">
							<a href="https://api.whatsapp.com/send?phone=573105216830&amp;text=Estoy%20interesado%20adquirir%20un%20crédito%20en%20libranza" class="creditoLibranza-buttonWhatsAppmodal" target="_blank" tabindex="0">Pregúntanos por WhatsApp <i class="fab fa-whatsapp"></i></a>
						</div>
					</div>
					<div class="text-justify textModalSimular">
						*El cupo y cuota del crédito, producto de esta simulación, son aproximados e informativos y podrán variar de acuerdo a las políticas de financiación y de crédito vigentes al momento de su estudio y aprobación por parte de Lagobo.
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal modalFormulario fade hide" id="solicitarModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body modalFormulario-body">
					<div class="modal-containerFormulario">
						<h3 class="modal-titleForm titleForm-libranza">
							Crédito Libranza
						</h3>
						<form role="form" ng-submit="addLead()" id="saveLead">
						<div class="form-group">
							<label class="control-label modalLabelForm">Nombres</label>
							<input type="text" ng-model="libranza.name" class="form-control" id="nameForm" required="true" />
						</div>
						<input type="hidden" ng.model="libranza.typeService" value="libranza">
						<input type="hidden" ng.model="libranza.channel" value="1">
						<div class="form-group">
							<label class="control-label modalLabelForm">Apellidos</label>
							<input type="text" ng-model="libranza.lastName" class="form-control" id="nameForm" />
						</div>
						<div class="form-group">
							<label class="control-label modalLabelForm">Correo electrónico</label>
							<input type="email" ng-model="libranza.email" class="form-control" id="nameForm" required="true" />
						</div>
						<div class="form-group">
							<label class="control-label modalLabelForm">Teléfono</label>
							<input type="text" ng-model="libranza.telephone" class="form-control" id="nameForm" required="true" />
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label modalLabelForm" for="city">Ciudad</label>
									<select class="form-control" id="city" ng-model="libranza.city" ng-options="city.value as city.label for city in cities" required="true" ></select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label modalLabelForm" for="city">Que te interesa</label>
									<select class="form-control" id="city" ng-model="libranza.typeProduct" ng-options="product.value as product.label for product in typeProducts" required="true" ></select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<input type="checkbox" ng-model="libranza.termsAndConditions" id="termsAndConditions" ng-true-value="1" ng-false-value="0" required>
							<label for="termsAndConditions" style="font-size: 13px; font-style: italic;">
								Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
							</label>
						</div>
						<p class="textCityForm">
							*Válido solo para ciudades que se desplieguen en la casilla.
						</p>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">
								Guardar
							</button>
							<button type="button" class=" btn btn-danger buttonFormModal" data-dismiss="modal" aria-label="Close">
								Cerrar
							</button>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection