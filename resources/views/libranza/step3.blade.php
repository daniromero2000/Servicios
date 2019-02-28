@extends('layouts.steps')

@section('title', 'Tarjeta de Crédito Oportuya, los mejores descuentos con tarjeta.')

@section('linkStyleSheets')
    <link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection

@section('metaTags')
	<meta name="googlebot" content="noindex">
	<meta name="robots" content="noindex">
@endsection()

@section('content')
	<div id="step3" ng-app="appLibranzaStep3" ng-controller="step3Ctrl" ng-init="leadInfo.identificationNumber = {{$identificactionNumber}}" ng-cloak>
		<div class="row resetRow container-header-forms  container-libranza-forms">
			<div class="form-container-logoHeader form-container-logoLibranza">
				<img src="{{ asset('images/logo_Creo.png') }}" class="img-fluid libranzaSteplogo" alt="Oportuya" />
			</div>
			<div class="col-12 conatiner-logoImg">
				<img ng-src="/@{{ analyst.img }}" class="img-fluid steps-imgAnalista" />
				<span class="steps-textStep"><strong>Solicitud de Crédito Paso 1</strong> > (Información Personal)</span>
			</div>
		</div>
		<div class="row resetRow">
			<div class="col-12 step2-containTitle">
				<h2 class="text-center step2-titleAnalista"><strong>Hola! @{{ leadInfo.name + ' ' + leadInfo.lastName }}</strong> soy @{{ analyst.name }} tu analista digital</h2>
				<p class="text-center step2-textAnalista">Cuéntanos más sobre tu información laboral</p>
			</div>
			<div class="col-12">
				<div class="step3-containerForm">
					<img src="{{ asset('images/iconoStartProgreso2.png') }}" alt="" class="img-fluid imgStartProgress">
					<div class="progreso">
						<div class="barra_vacia barra_vacia_libranza" style="width: 66.66666%;"></div>
						<div class="puntos punto_uno listo punto_listo_libranza">
						</div>
						<span></span>
						<label>Cuentanos sobre ti</label>
						<div class="puntos punto_dos listo punto_listo_libranza">
						</div>
						<span></span>
						<label>Información Personal</label>
						<div class="puntos punto_tres listo punto_listo_libranza">
						</div>
						<span></span>
						<label>Información Laboral</label>
						<div class="puntos punto_cuatro">
						</div>
						<span></span>
						<label>Confirmación</label>
					</div>
					<img src="{{ asset('images/iconoEndProgreso2.png') }}" alt="" class="img-fluid imgEndProgress">
				</div>
			</div>
		</div>
		<div class="step3-containerForm">
			<div class="row resetRow">
				<div class="forms-descStep forms-descStepLibranza">
					<strong>Cuéntanos sobre ti</strong><br>
					<span class="forms-descText">Ingresa tu información laboral</span>
					<img src="{{ asset('images/datosLaborales.png') }}" class="img-fluid forms-descImg" />
					<span class="forms-descStepNum">3</span>
				</div>
			</div>
			<form ng-submit="saveStep3()" class="libranzaSave3" id="formEmpleado" >
			{{ csrf_field() }}
				<div>
					<div class="row resetRow">
						<div class="col-12 form-group">
							<label for="nit">Nit (sin número de verificación)</label>
							<input type="text" class="form-control inputsSteps inputText" id="nit" validation-pattern="number" ng-model="leadInfo.nit" />
						</div>
					</div>
					<div class="row resetRow" ng-if="leadInfo.occupation != 'PENSIONADO'">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="companyName">Nombre de la Empresa*</label>
							<input type="text" class="form-control inputsSteps inputText" id="companyName" validation-pattern="text" ng-model="leadInfo.companyName" required="" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="companyAddres">Dirección de la Empresa*</label>
							<input type="text" class="form-control inputsSteps inputText" id="companyAddres" validation-pattern="text" ng-model="leadInfo.companyAddres" required="" />
						</div>
					</div>
					<div class="row resetRow" ng-if="leadInfo.occupation != 'PENSIONADO'">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="companyTelephone">Teléfono de la Empresa*</label>
							<input type="text" id="companyTelephone" ng-model="leadInfo.companyTelephone" validation-pattern="telephone" class="form-control inputsSteps inputText" required="" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="companyTelephone2">Teléfono 2 de la Empresa</label>
							<input type="text" id="companyTelephone2" ng-model="leadInfo.companyTelephone2" validation-pattern="telephone" class="form-control inputsSteps inputText" />
						</div>
					</div>
					<div class="row resetRow" ng-if="leadInfo.occupation != 'PENSIONADO'">
						<div class="col-sm-12 col-md-4 form-group">
							<label for="eps">EPS*</label>
							<input type="text" id="eps" ng-model="leadInfo.eps" validation-pattern="textOnly" class="form-control inputsSteps inputText" required="" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="companyPosition">Cargo*</label>
							<input type="text" id="companyPosition" ng-model="leadInfo.companyPosition" validation-pattern="textOnly" class="form-control inputsSteps inputText" required="" />
						</div>
						<div class="col-sm-12 col-md-4 form-group">
							<label for="admissionDate">Fecha de Ingreso</label>
							<div class="input-group"
							     moment-picker="leadInfo.admissionDate"
							     format="YYYY-MM-DD">
							    <input class="form-control inputsSteps inputText"
							           ng-model="leadInfo.admissionDate" id="admissionDate" readonly="" placeholder="Año/Mes/Día">
							    <span class="input-group-addon">
							        <i class="octicon octicon-calendar"></i>
							    </span>
							</div>
						</div>
					</div>
					<div class="row resetRow" ng-if="leadInfo.occupation != 'PENSIONADO'">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="antiquity">Antigüedad (Meses)</label>
							<input type="text" id="antiquity" ng-model="leadInfo.antiquity" validation-pattern="number" class="form-control inputsSteps inputText" placeholder="" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="salary">Salario</label>
							<input type="text" id="salary" ng-model="leadInfo.salary" ng-currency fraction="0" min="0" class="form-control inputsSteps inputText" />
						</div>
					</div>
					<div class="row resetRow" ng-if="leadInfo.occupation != 'PENSIONADO'">
						<div class="col-sm-12 col-md-6 form-group">
							<label>Tipo de Contrato*</label>
							<select class="form-control inputsSteps inputSelect" id="typeContract" ng-model="leadInfo.typeContract" validation-pattern="textOnly" ng-options="type.value as type.label for type in typesContracts" required="">
							</select>
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="otherRevenue">Otros ingresos</label>
							<input type="text" id="otherRevenue" ng-model="leadInfo.otherRevenue" ng-currency fraction="0" min="0" class="form-control inputsSteps inputText" />
						</div>
					</div>
				</div>
				<div ng-if="leadInfo.occupation == 'INDEPENDIENTE CERTIFICADO' || leadInfo.occupation == 'INDEPENDIENTE CERTIFICADO' || leadInfo.occupation == 'RENTISTA'">
					<div class="row resetRow">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="camaraComercio">Cámara de Comercio</label>
							<select id="camaraComercio" ng-model="leadInfo.camaraComercio" class="form-control inputsSteps inputSelect" ng-options="type.value as type.label for type in typesCamaraComercio">
							</select>
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="nitInd">Nit (sin número de verificación)</label>
							<input type="text" id="nitInd" ng-model="leadInfo.nitInd" validation-pattern="number" class="form-control inputsSteps inputText" />
						</div>
					</div>
					<div class="row resetRow">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="companyNameInd">Nombre de la Empresa*</label>
							<input type="text" class="form-control inputsSteps inputText" id="companyNameInd" validation-pattern="text" ng-model="leadInfo.companyNameInd" required="" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="whatSell">Qué Vendes o Comercializas?</label>
							<input type="text" class="form-control inputsSteps inputText" id="whatSell" validation-pattern="text" ng-model="leadInfo.whatSell" />
						</div>
					</div>
					<div class="row resetRow">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="eps">EPS*</label>
							<input type="text" id="eps" ng-model="leadInfo.eps" validation-pattern="textOnly" class="form-control inputsSteps inputText" required="" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="dateCreationCompany">Fecha de Constitución*</label>
							<div class="input-group"
							     moment-picker="leadInfo.dateCreationCompany"
							     format="YYYY-MM">
							    <input class="form-control inputsSteps inputText"
							           ng-model="leadInfo.dateCreationCompany" id="dateCreationCompany" readonly="" placeholder="Año/Mes" required="" />
							    <span class="input-group-addon">
							        <i class="octicon octicon-calendar"></i>
							    </span>
							</div>
						</div>
					</div>
					<div class="row resetRow">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="antiquityInd">Atigüedad (Meses)*</label>
							<input type="number" id="antiquityInd" ng-model="leadInfo.antiquityInd" validation-pattern="number" class="form-control inputsSteps inputText" required="" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="salaryInd">Salario</label>
							<input type="text" id="salaryInd" ng-model="leadInfo.salaryInd" ng-currency fraction="0" min="0" class="form-control inputsSteps inputText" />
						</div>
					</div>
				</div>
				<div ng-if="leadInfo.occupation == 'PENSIONADO'">
					<div class="row resetRow">
						<div class="col-sm-12 col-md-6 form-group">
							<label>Nombre de la Empresa*</label>
							<input type="text" class="form-control inputsSteps inputText" id="companyName" validation-pattern="text" ng-model="leadInfo.companyName" required="" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="dateCreationCompany">Fecha de Pensión*</label>
							<div class="input-group"
							     moment-picker="leadInfo.dateCreationCompany"
							     format="YYYY-MM">
							    <input class="form-control inputsSteps inputText"
							           ng-model="leadInfo.dateCreationCompany" id="dateCreationCompany" readonly="" placeholder="Año/Mes" required="" />
							    <span class="input-group-addon">
							        <i class="octicon octicon-calendar"></i>
							    </span>
							</div>
						</div>
					</div>
					<div class="row resetRow">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="antiquity">Atigüedad (Meses)*</label>
							<input type="text" id="antiquity" ng-model="leadInfo.antiquity"  validation-pattern="textOnly" class="form-control inputsSteps inputText" />
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="salaryInd">Salario</label>
							<input type="text" id="salaryInd" ng-model="leadInfo.salary" ng-currency fraction="0" min="0" class="form-control inputsSteps inputText" />
						</div>
					</div>
					<div class="row resetRow">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="pagaduria">Pagaduría*</label>
							<select class="form-control inputsSteps inputSelect" id="pagaduria" ng-model="leadInfo.pagaduria" id="pagaduria" ng-options="i.id as i.name for i in pagadurias"></select>
						</div>
						<div class="col-sm-12 col-md-6 form-group">
							<label for="membershipNumber">Numero de afiliación*</label>
							<input type="text" id="membershipNumber" ng-model="leadInfo.membershipNumber"  fraction="0" min="0" class="form-control inputsSteps inputText" />
						</div>
					</div>
					<div class="row resetRow">
						<div class="col-sm-12 col-md-6 form-group">
							<label for="eps">EPS*</label>
							<input type="text" id="eps" required="" ng-model="leadInfo.eps" validation-pattern="textOnly" class="form-control inputsSteps inputText" />
						</div>
						<!--<div class="col-sm-12 col-md-6 form-group">
							<label for="bankSavingsAccount">Banco*</label>
							<select ng-model="leadInfo.bankSavingsAccount" id="bankSavingsAccount" class="form-control inputsSteps inputSelect" ng-options="bank.value as bank.label for bank in banks" required="">
							</select>
						</div>-->
					</div>
				</div>				
				<div class="row resetRow">
					<div class="col-12 text-center form-group">
						<button class="btn btn-primary btnStep btnStepLibranza">Siguiente</button>
					</div>
				</div>
			</form>
		</div>
		<div class="modal modalSteps fade hide" data-backdrop="static" data-keyboard="false" id="congratulations" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content modalStepsContent">
					<div class="modal-body modalStepsBody" style="padding: 0">
						<div class="row resetRow">
							<div class="col-12 text-center containerLogoModalStep  containerLogoLibranza">
								<img src="{{ asset('images/logo_Creo.png') }}" alt="" class="img-fluid">
							</div>
						</div>
						<div class="row resetRow">
							<div class="col-12">
								<p class="textModal text-center">
									<strong>Felicitaciones</strong> tu solicitud ha sido pre aprobada <br> un analista se pondrá en contacto contigo <br> para continuar el proceso
								</p>
							</div>
						</div>
						<div class="row resetRow containerFormModal">
							<div class="col-sm-7 offset-sm-5">
							<form ng-submit="sendComment()">
									<div class="form-group">
										<label for="">A que hora te podemos llamar*</label>
										<select ng-model="comment.availability" ng-options="time.value as time.label for time in timesContact" class="form-control" required="">
										</select>
									</div>
									<div class="form-group">
										<textarea ng-model="comment.comment" class="form-control" rows="10" placeholder="Algún comentario adicional"></textarea>
									</div>
									<div class="row">
										<div class="col-12 text-center">
											<button type="submit" class="btn btn-primary btnStep">Enviar</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal modalSteps fade hide" data-backdrop="static" data-keyboard="false" id="" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content modalStepsContent">
					<div class="modal-body modalStepsBody" style="padding: 0">
						<div class="row resetRow">
							<div class="col-12 text-center containerLogoModalStep">
								<img src="{{ asset('images/logoOportuyaModalStep.png') }}" alt="" class="img-fluid">
							</div>
						</div>
						<div class="row resetRow">
							<div class="col-12">
								<p class="textModal text-center">
									<strong>Felicitaciones</strong> tu solicitud ha sido pre aprobada <br> un analista se pondrá en contacto contigo <br> para continuar el proceso
								</p>
							</div>
						</div>
						<div class="row resetRow containerFormModal">
							<div class="col-sm-7 offset-sm-5">
								<form ng-submit="sendComment()">
									<div class="form-group">
										<label for="">A que hora te podemos llamar*</label>
										<select ng-model="comment.availability" ng-options="time.value as time.label for time in timesContact" class="form-control" required="">
										</select>
									</div>
									<div class="form-group">
										<textarea ng-model="comment.comment" class="form-control" rows="10" placeholder="Algún comentario adicional"></textarea>
									</div>
									<div class="row">
										<div class="col-12 text-center">
											<button type="submit" class="btn btn-primary btnStep">Enviar</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scriptsJs')
	<script type="text/javascript" src="{{ asset('js/libranzaStep3.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
	<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ng-currency/1.2.7/ng-currency.min.js"></script>
@endsection