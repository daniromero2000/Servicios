@extends('layouts.app')
@section('title', 'Seguros')
@section('metaTags')
@endsection()
@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/seguros/app.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{	asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="row row-reset mt-4">
	<div class="col-12 col-reset">
		<div class="container-first-sector">
			<div>
				<img class="img-fluid" src="{{ asset('images/seguros/seguros oportunidades.png')}}"
					style="width: 100%;">
			</div>
			<div class="container-first-sector-text text-center">
				<h4 class="title-first-sector">Pensar en ti, es pensar en cuidar tu patrimonio</h4>
				<div>
					<img class="logo-fist-sector" src="{{ asset('images/seguros/linelogo.png')}}" alt="">
				</div>
				<p class="text-center text-first-sector">Te damos <span class="first-span-first-sector">crédito</span>
					para tu <span class="second-span-first-sector">SOAT</span>
					<br> hasta <span class="third-span-first-sector">11
						meses</span>
					de plazo</p>
				<div class="text-center mt-4">
					<a href="https://api.whatsapp.com/send?phone=573108220610&text=Quiero más información, sobre el crédito fácil de SOAT."
						target="_blank" class="btn btn-first-sector mt-1">Pregunta Aquí</a>

				</div>
			</div>
		</div>
	</div>
	<div class="col-12">
		<div>
			<img class="img-fluid" src="{{ asset('images/seguros/seguros oportunidades2.png')}}" style="width: 100%;">
		</div>
		<div class="container-second-sector-text text-left">
			<h4 class="title-second-sector">Solicita Tu <br> <span style="color: #0F399E;"> <span
						style="font-weight: 500;">Crédito</span>
					para</span> <br> <span class="first-span-second-sector">SOAT</span></h4>
			<div class="text-center content-button-second-sector">
				<a href="/step1" class="btn btn-second-sector mt-1">Solicita Aquí</a>
			</div>
		</div>
	</div>
	<div class="col-12">
		<div class="row margin-md">
			<div class="col-12 col-lg-6 col-reset">
				<div>
					<img class="img-fluid" src="{{ asset('images/seguros/texto_banner_formulario.png')}}"
						style="width: 100%;">
				</div>
			</div>
			<div class="col-12 col-lg-6 img-fondo col-reset">
				<div class="container-third-sector-img">
					<img class="img-fluid img-bacgraund" src="{{ asset('images/seguros/seguros oportunidades3.png')}}"
						style="width: 100%;">
				</div>
				<div class="container-third-sector-text ">
					<h4 class="title-third-sector">Déjanos tus <span style="
						color: #103a9ede;
					"> Datos</span></h4>
					<form action="{{ route('Insurancesleads.store') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input class="form-control input-form-third-sector" id="exampleInputEmail1" name="channel"
							value="1" aria-describedby="emailHelp" hidden>
						<input class="form-control input-form-third-sector" id="exampleInputEmail1" name="assessor_id"
							value="262" aria-describedby="emailHelp" hidden>
						<input class="form-control input-form-third-sector" id="exampleInputEmail1" name="lead_area_id"
							value="2" aria-describedby="emailHelp" hidden>
						<input class="form-control input-form-third-sector" id="exampleInputEmail1" name="typeService"
							value="4" aria-describedby="emailHelp" hidden>

						<div class="row">
							<div class="col-6 col-xl-12">
								<div class="form-group">
									<div class="row">
										<div class="col-12 col-xl-5"><label class="title-form-third-sector"
												for="exampleInputEmail1">Nombre</label></div>
										<div class="col-12 col-xl-7">
											<input class="form-control input-form-third-sector" id="exampleInputEmail1"
												validation-pattern="name" id="nameCreate" name="name"
												aria-describedby="emailHelp" required>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-xl-12">
								<div class="form-group">
									<div class="row">
										<div class="col-12 col-xl-5"><label class="title-form-third-sector"
												for="exampleInputEmail1">Email</label></div>
										<div class="col-12 col-xl-7"><input class="form-control input-form-third-sector"
												validation-pattern="email" name="email" id="exampleInputEmail1"
												aria-describedby="emailHelp">
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-xl-12">
								<div class="form-group">
									<div class="row">
										<div class="col-12 col-xl-5"><label class="title-form-third-sector"
												for="exampleInputEmail1">Tipo
												de Vehículo</label></div>
										<div class="col-12 col-xl-7"><input class="form-control input-form-third-sector"
												id="exampleInputEmail1" name="description" aria-describedby="emailHelp">
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-xl-12">
								<div class="form-group">
									<div class="row">
										<div class="col-12 col-xl-5"><label class="title-form-third-sector"
												for="exampleInputEmail1">Télefono</label></div>
										<div class="col-12 col-xl-7"><input class="form-control input-form-third-sector"
												id="exampleInputEmail1" name="telephone" aria-describedby="emailHelp"
												required>
										</div>
									</div>
								</div>
							</div>
							<input type="text" class="form-control" hidden id="typeProduct" value="27"
								name="typeProduct">
						</div>
						<div class="form-group" style="
						margin-bottom: 5px;
					">
							<input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1"
								required="">
							<label for="termsAndConditions" class="termAndConditions">
								Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition"
									target="_blank">términos y condiciones</a> y <a
									href="/Proteccion-de-datos-personales" class="linkTermAndCondition"
									target="_blank">política de tratamiento de datos</a>
							</label>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-third-sector">Enviar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12" id="cardsInsurance">
		<div class="row d-flex justify-content-center container-custom ml-auto mr-auto mb-4">
			<div class="col-12 col-md-12 col-lg-12 col-xl-11">
				<div class="row d-flex justify-content-center">
					<div class="col-12 col-sm-6 col-md-5 col-xl-3 d-flex justify-content-center mt-4">
						<div class="rotate-container-second">
							<div class="card card-front-second border-0 shadow-lg">
								<img src="{{ asset('images/seguros/imagen_iconovida.jpg
								')}}" class="card-img-top" alt="...">
								<div>
									<img class="img-four-sector" src="{{ asset('images/seguros/iconovida.png
								')}}" alt="...">
								</div>
								<div class="card-body card-body-four-sector text-center">
									<h5 class="card-title-four-sector">VIDA</h5>
									<p class="card-text text-center ">Amamos la vida y por eso queremos ayudarte a
										valorar lo importante para tu familia.</p>
									<button class="btn btn-four-sector btn-rotate-second">Conozca Más</button>
								</div>
							</div>
							<div class="card card-back-second border-0 shadow-lg text-left">
								<div class="card-body mt-2 card-body-reset" style="position: relative">
									<h4 class="text-center">Cobertura pólizas de vida</h4>
									<p>
										<div class="bd-example">
											<ul class="font-size-card-rever">
												<li>Muerte por cualquier causa. </li>
												<li>Muerte accidental. </li>
												<li>Incapacidad total y permanente.</li>
												<li>Auxilio funerario.</li>
											</ul>
										</div>
									</p>
									<div class="text-center mt-2">
										<a class="btn btn-card-reverse mt-1" data-toggle="modal"
											data-target="#modalVida">Solicita
											Aquí</a>
									</div>
									<button class="btn btn-primary btn-sm btn-rotate-second position-button-card-rever">
										&nbsp;
										Vover
										<i class="fas fa-arrow-right ml-1"></i> </button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-5 col-xl-3 d-flex justify-content-center mt-4">
						<div class="rotate-container-first">
							<div class="card card-front border-0 shadow-lg">
								<img src="{{ asset('images/seguros/imagen_iconomotos.jpg
								')}}" class="card-img-top" alt="...">
								<div>
									<img class="img-four-sector" src="{{ asset('images/seguros/iconomoto.png
									')}}" alt="...">
								</div>
								<div class="card-body card-body-four-sector text-center">
									<h5 class="card-title-four-sector">MOTOS</h5>
									<p class="card-text text-center ">No solo es proteger tu motocicleta, es proteger
										todo el riesgo que tienes al conducirla.</p>
									<button class="btn btn-four-sector btn-rotate">Conozca Más</button>
								</div>
							</div>
							<div class="card card-back text-center border-0 shadow-lg">
								<div class="card-body mt-2 card-body-reset" style="position: relative">
									<h4>Pólizas todo riesgo motos</h4>
									<p class="text-small">
										<div class="bd-example">
											<ul class="font-size-card-rever">
												<li>Responsabilidad civil extracontractual.
													<ul>
														<li>Daños a terceros. </li>
														<li>Muerte o lesión a una o más personas.</li>
													</ul>
												</li>
												<li>Asistencia jurídica.</li>
												<li>Pérdida Total Y/o Destrucción total.</li>
												<li>Daños parciales de mayor cuantía.</li>
												<li>Protección patrimonial.</li>
												<li>Daños parciales de menor cuantía.</li>
												<li>Hurto de mayor y menor cuantía.</li>
												<li>Terrorismo.</li>
												<li>Terremoto y eventos de la naturaleza.</li>
												<li>Grúa por avería.</li>
											</ul>
										</div>
									</p>

									<div class="text-center mt-2">
										<a class="btn btn-card-reverse mt-1" data-toggle="modal"
											data-target="#modalMotos">Solicita
											Aquí</a>

									</div>
									<button class="btn btn-primary btn-sm btn-rotate position-button-card-rever"> &nbsp;
										Vover
										<i class="fas fa-arrow-right ml-1"></i> </button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-5 col-xl-3 d-flex justify-content-center mt-4">
						<div class="rotate-container-third">
							<div class="card card-front-third border-0 shadow-lg">
								<img src="{{ asset('images/seguros/imagen_iconoauto.jpg
								')}}" class="card-img-top" alt="...">
								<div>
									<img class="img-four-sector" src="{{ asset('images/seguros/iconoauto.png
									')}}" alt="...">
								</div>
								<div class="card-body card-body-four-sector text-center">
									<h5 class="card-title-four-sector">AUTOS</h5>
									<p class="card-text text-center ">Disfruta de un buen viaje en tu vehículo, con las
										coberturas adecuadas para tu patrimonio.</p>
									<button class="btn btn-four-sector btn-rotate-third">Conozca Más</button>
								</div>
							</div>
							<div class="card card-back-third  border-0 shadow-lg text-center">
								<div class="card-body mt-2 card-body-reset" style="position: relative">
									<h4>Póliza Todo Riesgo Automóviles</h4>
									<div class="bd-example">
										<ul class="font-size-card-rever">
											<li>Responsabilidad civil extracontractual. </li>
											<li>Daños a bienes de terceros.</li>
											<li>Pérdidas parciales y totales por daños o hurtos.</li>
											<li>Asistencia jurídica en proceso penal y civil. </li>
											<li>Asistencia en viajes (grúa, carro taller, conductor elegido, etc).
											</li>
											<li>Vehículo de reemplazo.</li>
											<li>Revisión Tecnicomecanica.</li>
											<li>Terrorismo.</li>
											<li>Hurto con violencia.</li>
										</ul>
									</div>

									<div class="text-center margin-card">
										<a class="btn btn-card-reverse mt-1" data-toggle="modal"
											data-target="#modalAutos">Solicita
											Aquí</a>

									</div>
									<button class="btn btn-primary btn-sm btn-rotate-third position-button-card-rever">
										&nbsp;
										Vover
										<i class="fas fa-arrow-right ml-1"></i> </button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-5 col-xl-3 d-flex justify-content-center mt-4">
						<div class="rotate-container-four">
							<div class="card border-0 shadow-lg card-front-four">
								<img src="{{ asset('images/seguros/imagen_iconohogar.jpg
								')}}" class="card-img-top" alt="...">
								<div>
									<img class="img-four-sector" src="{{ asset('images/seguros/iconohogar.png
									')}}" alt="...">
								</div>
								<div class="card-body card-body-four-sector text-center">
									<h5 class="card-title-four-sector">HOGAR</h5>
									<p class="card-text text-center ">Protegemos eso que tanto cuidas, tu familia, tu
										hogar y sus contenidos.</p>
									<button class="btn btn-four-sector btn-rotate-four mt-4">Conozca Más</button>
								</div>
							</div>
							<div class="card border-0 shadow-lg card-back-four text-center">
								<div class="card-body mt-2 card-body-reset" style="position: relative">
									<h4>Póliza de hogar</h4>
									<p class="">

										<div class="bd-example">
											<ul class="font-size-card-rever">
												<li>Incendio. </li>
												<li>Explosión.</li>
												<li>Daños por agua y Anegación.</li>
												<li>Extensión de cobertura (caida de naves o aeronaves, vientos fuertes,
													impactos de vehículos, daños por granizados daños por humo). </li>
												<li>Daños en equipos eléctricos y electrónicos.</li>
												<li>Actos malintencionados de terceros y huelga, motín, asonada,
													conmoción civil,
													popular (AMIT Y HMACCP).</li>
												<li>Responsabilidad civil extracontractual.</li>
												<li>Terremoto y eventos de la naturaleza.</li>
												<li>Hurto con violencia.</li>
											</ul>
										</div>
									</p>

									<div class="text-center mt-2">
										<a class="btn btn-card-reverse mt-1" data-toggle="modal"
											data-target="#modalHogar">Solicita
											Aquí</a>

									</div>
									<button class="btn btn-primary btn-sm btn-rotate-four position-button-card-rever">
										&nbsp;
										Vover
										<i class="fas fa-arrow-right ml-1"></i> </button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modalVida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header border-0 pb-0">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pt-1">
					<div class="row">
						<div class="col-12 text-center">
							<div class=" bg-primary p-1" style="
							border-radius: 4px;
						">
								<h5 class="modal-title text-white" id="exampleModalLabel">Póliza de Vida</h5>
							</div>
						</div>
						<div class="col-12 text-center mt-3">
							<p style="
							color: #5b5d5e;
							font-size: 13px;
							font-style: italic;
							font-weight: 400;
						"><span class="text-primary">*</span> Déjanos tus datos y pronto uno de nuestros asesores se comunicará
								contigo</p>
						</div>
						<div class="col-12 mt-1">
							<div class="container">
								<form action="{{ route('Insurancesleads.store') }}" method="post"
									enctype="multipart/form-data">
									{{ csrf_field() }}
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="channel" value="1" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="assessor_id" value="262" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="lead_area_id" value="2" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="typeService" value="4" aria-describedby="emailHelp" hidden>

									<div class="row">

										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="name">Nombre <span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="name" name="name"
													aria-describedby="emailHelp" required>
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="email">Email <span class="text-danger">*</span></label>
												<input type="email" class="form-control" id="email" name="email"
													validation-pattern="email" aria-describedby="emailHelp">
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="telephone">Télefono <span
														class="text-danger">*</span></label>
												<input type="text" class="form-control" id="telephone" name="telephone"
													validation-pattern="telephone" aria-describedby="emailHelp">
											</div>
										</div>
										<div class="col-12 col-lg-6 form-group">
											<label for="city">Ciudad <span class="text-danger">*</span></label>
											<select id="cityInsurance" name="city" class="form-control" required>
												@if(!empty($cities))
												<option selected value> -- Selecciona Ciudad -- </option>
												@foreach($cities as $city)
												<option value="{{ $city->CIUDAD }}">
													{{ $city->CIUDAD }}
												</option>
												@endforeach
												@endif
											</select>
										</div>
										<div class="col-12 form-group">
											<div class="form-group">
												<input type="checkbox" name="termsAndConditions" id="termsAndConditions"
													value="1" required="">
												<label for="termsAndConditions"
													style="font-size: 13px; font-style: italic;">
													Aceptar <a href="/Terminos-y-condiciones"
														class="linkTermAndCondition" target="_blank">términos y
														condiciones</a> y <a href="/Proteccion-de-datos-personales"
														class="linkTermAndCondition" target="_blank">política de
														tratamiento de datos</a>
												</label>
											</div>
										</div>
										<input type="text" class="form-control" hidden id="typeProduct" value="32"
											name="typeProduct">
									</div>
									<div class="text-center">
										<button type="submit"
											class="btn btn-primary pt-1 pb-1 pl-3 pr-3">Enviar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalMotos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header border-0 pb-0">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pt-1">
					<div class="row">
						<div class="col-12 text-center">
							<div class=" bg-primary p-1" style="
							border-radius: 4px;
						">
								<h5 class="modal-title text-white" id="exampleModalLabel">Póliza de Motos</h5>
							</div>
						</div>
						<div class="col-12 text-center mt-3">
							<p style="
							color: #5b5d5e;
							font-size: 13px;
							font-style: italic;
							font-weight: 400;
						"><span class="text-primary">*</span> Déjanos tus datos y pronto uno de nuestros asesores se comunicará
								contigo</p>
						</div>
						<div class="col-12 mt-1">
							<div class="container">
								<form action="{{ route('Insurancesleads.store') }}" method="post"
									enctype="multipart/form-data">
									{{ csrf_field() }}
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="channel" value="1" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="assessor_id" value="262" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="lead_area_id" value="2" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="typeService" value="4" aria-describedby="emailHelp" hidden>
									<input type="text" class="form-control" hidden id="typeProduct" value="26"
										name="typeProduct">

									<div class="row">

										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="name">Nombre <span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="name" name="name"
													aria-describedby="emailHelp" required>
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="email">Email <span class="text-danger">*</span></label>
												<input type="email" class="form-control" id="email" name="email"
													validation-pattern="email" aria-describedby="emailHelp">
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="telephone">Télefono <span
														class="text-danger">*</span></label>
												<input type="text" class="form-control" id="telephone" name="telephone"
													validation-pattern="telephone" aria-describedby="emailHelp">
											</div>
										</div>
										<div class="col-12 col-lg-6 form-group">
											<label for="city">Ciudad <span class="text-danger">*</span></label>
											<select id="cityInsurance" name="city" class="form-control" required>
												@if(!empty($cities))
												<option selected value> -- Selecciona Ciudad -- </option>
												@foreach($cities as $city)
												<option value="{{ $city->CIUDAD }}">
													{{ $city->CIUDAD }}
												</option>
												@endforeach
												@endif
											</select>
										</div>
										<div class="col-12 form-group">
											<div class="form-group">
												<input type="checkbox" name="termsAndConditions" id="termsAndConditions"
													value="1" required="">
												<label for="termsAndConditions"
													style="font-size: 13px; font-style: italic;">
													Aceptar <a href="/Terminos-y-condiciones"
														class="linkTermAndCondition" target="_blank">términos y
														condiciones</a> y <a href="/Proteccion-de-datos-personales"
														class="linkTermAndCondition" target="_blank">política de
														tratamiento de datos</a>
												</label>
											</div>
										</div>
										<input type="text" class="form-control" hidden id="typeProduct" value="32"
											name="typeProduct">
									</div>
									<div class="text-center">
										<button type="submit"
											class="btn btn-primary pt-1 pb-1 pl-3 pr-3">Enviar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalAutos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header border-0 pb-0">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pt-1">
					<div class="row">
						<div class="col-12 text-center">
							<div class=" bg-primary p-1" style="
							border-radius: 4px;
						">
								<h5 class="modal-title text-white" id="exampleModalLabel">Póliza Autos</h5>
							</div>
						</div>
						<div class="col-12 text-center mt-3">
							<p style="
							color: #5b5d5e;
							font-size: 13px;
							font-style: italic;
							font-weight: 400;
						"><span class="text-primary">*</span> Déjanos tus datos y pronto uno de nuestros asesores se comunicará
								contigo</p>
						</div>
						<div class="col-12 mt-1">
							<div class="container">
								<form action="{{ route('Insurancesleads.store') }}" method="post"
									enctype="multipart/form-data">
									{{ csrf_field() }}
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="channel" value="1" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="assessor_id" value="262" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="lead_area_id" value="2" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="typeService" value="4" aria-describedby="emailHelp" hidden>
									<input type="text" class="form-control" hidden id="typeProduct" value="26"
										name="typeProduct">

									<div class="row">

										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="name">Nombre <span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="name" name="name"
													aria-describedby="emailHelp" required>
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="email">Email <span class="text-danger">*</span></label>
												<input type="email" class="form-control" id="email" name="email"
													validation-pattern="email" aria-describedby="emailHelp">
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="telephone">Télefono <span
														class="text-danger">*</span></label>
												<input type="text" class="form-control" id="telephone" name="telephone"
													validation-pattern="telephone" aria-describedby="emailHelp">
											</div>
										</div>
										<div class="col-12 col-lg-6 form-group">
											<label for="city">Ciudad <span class="text-danger">*</span></label>
											<select id="cityInsurance" name="city" class="form-control" required>
												@if(!empty($cities))
												<option selected value> -- Selecciona Ciudad -- </option>
												@foreach($cities as $city)
												<option value="{{ $city->CIUDAD }}">
													{{ $city->CIUDAD }}
												</option>
												@endforeach
												@endif
											</select>
										</div>
										<div class="col-12 form-group">
											<div class="form-group">
												<input type="checkbox" name="termsAndConditions" id="termsAndConditions"
													value="1" required="">
												<label for="termsAndConditions"
													style="font-size: 13px; font-style: italic;">
													Aceptar <a href="/Terminos-y-condiciones"
														class="linkTermAndCondition" target="_blank">términos y
														condiciones</a> y <a href="/Proteccion-de-datos-personales"
														class="linkTermAndCondition" target="_blank">política de
														tratamiento de datos</a>
												</label>
											</div>
										</div>
										<input type="text" class="form-control" hidden id="typeProduct" value="31"
											name="typeProduct">
									</div>
									<div class="text-center">
										<button type="submit"
											class="btn btn-primary pt-1 pb-1 pl-3 pr-3">Enviar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalHogar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header border-0 pb-0">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pt-1">
					<div class="row">
						<div class="col-12 text-center">
							<div class=" bg-primary p-1" style="
							border-radius: 4px;
						">
								<h5 class="modal-title text-white" id="exampleModalLabel">Póliza Hogar</h5>
							</div>
						</div>
						<div class="col-12 text-center mt-3">
							<p style="
							color: #5b5d5e;
							font-size: 13px;
							font-style: italic;
							font-weight: 400;
						"><span class="text-primary">*</span> Déjanos tus datos y pronto uno de nuestros asesores se comunicará
								contigo</p>
						</div>
						<div class="col-12 mt-1">
							<div class="container">
								<form action="{{ route('Insurancesleads.store') }}" method="post"
									enctype="multipart/form-data">
									{{ csrf_field() }}
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="channel" value="1" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="assessor_id" value="262" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="lead_area_id" value="2" aria-describedby="emailHelp" hidden>
									<input class="form-control input-form-third-sector" id="exampleInputEmail1"
										name="typeService" value="4" aria-describedby="emailHelp" hidden>
									<input type="text" class="form-control" hidden id="typeProduct" value="26"
										name="typeProduct">

									<div class="row">

										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="name">Nombre <span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="name" name="name"
													aria-describedby="emailHelp" required>
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="email">Email <span class="text-danger">*</span></label>
												<input type="email" class="form-control" id="email" name="email"
													validation-pattern="email" aria-describedby="emailHelp">
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div class="form-group">
												<label for="telephone">Télefono <span
														class="text-danger">*</span></label>
												<input type="text" class="form-control" id="telephone" name="telephone"
													validation-pattern="telephone" aria-describedby="emailHelp">
											</div>
										</div>
										<div class="col-12 col-lg-6 form-group">
											<label for="city">Ciudad <span class="text-danger">*</span></label>
											<select id="cityInsurance" name="city" class="form-control" required>
												@if(!empty($cities))
												<option selected value> -- Selecciona Ciudad -- </option>
												@foreach($cities as $city)
												<option value="{{ $city->CIUDAD }}">
													{{ $city->CIUDAD }}
												</option>
												@endforeach
												@endif
											</select>
										</div>
										<div class="col-12 form-group">
											<div class="form-group">
												<input type="checkbox" name="termsAndConditions" id="termsAndConditions"
													value="1" required="">
												<label for="termsAndConditions"
													style="font-size: 13px; font-style: italic;">
													Aceptar <a href="/Terminos-y-condiciones"
														class="linkTermAndCondition" target="_blank">términos y
														condiciones</a> y <a href="/Proteccion-de-datos-personales"
														class="linkTermAndCondition" target="_blank">política de
														tratamiento de datos</a>
												</label>
											</div>
										</div>
										<input type="text" class="form-control" hidden id="typeProduct" value="55"
											name="typeProduct">
									</div>
									<div class="text-center">
										<button type="submit"
											class="btn btn-primary pt-1 pb-1 pl-3 pr-3">Enviar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection