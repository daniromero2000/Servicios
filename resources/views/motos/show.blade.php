
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
    @if (Session::get('success'))
		<div class="alert alert-success">
			<p>{{ Session::get('success') }}</p>
		</div>
    @endif
  <div ng-app="appMotosLiquidator" ng-controller="motosLiquidadorCtrl" ng-cloak ng-init="idMoto='{{$info[0]['id']}}'">
    <div class="row slideContainer slideContainerMotos max-width-content-19">
        <div class="col-12 col-lg-9">
          <div class="row">
            <div>
                <img src="/images/motos/abs-auteco-barratitulo.png" alt="" class="img-fluid">
            </div>
          </div>
          <div class="row"> 
            <div class="col-3 col-sm-3 col-lg-3 containerSlickMiniature text-center">  
              <div class="multiple-items-motos text-center">
                  @foreach($images as $image)
                      <img src="/images/motos/motos-vistas/{{$image
                      ['image']}}" alt="" class="img-fluid">
                  @endforeach
              </div>	
            </div>
            <div class="col-9 col-sm-9 col-lg-9 containerSlickMain">
              <div class="single-item-motos">
                @foreach($images as $image)
                    <img src="/images/motos/motos-vistas/{{$image
                    ['image']}}" alt="" class="img-fluid">
                @endforeach
              </div>	
            </div>
          </div>
        </div>       
        <div class="col-12 col-lg-3 text-center no-padding margin-bottom-prices"> 
            <img src="/images/motos/{{$info[0]
                    ['brand']}}" alt="" class="img-fluid">
            <br>
            <div class="motosPrecioContado">
                <p class="precioContadoTexto">PRECIO CONTADO</p>
                <span>$ {{number_format($info[0]['creditPrice'],0,',','.')}}</span>
                <p class="motosInfoText">SIN GASTOS DE MATRÍCULA NI SOAT</p>
            </div>
            <br>
            <div class="motosCuotaSimulador">
                <a ng-click="getDataMoto(idMoto)" href="">CALCULA TU CUOTA A CRÉDITO</a>
            </div>
            <br>
            <div class="motosCuotasMensuales">
                <p>CUOTAS MENSUALES DE</p>
                <span>$ {{number_format($info[0]['fee'],0,',','.')}}</span>
            </div>
            <br>
            <p class="motosInfoText">EN EL CRÉDITO INCLUYE SOAT,MATRÍCULA + IVA DEL AVAL (IMPUESTO MAYOR 135 CC)</p>
            <br>
            <a href="/motos/solicitud/step1" class="motosComprarBoton">COMPRALA A CRÉDITO</a>
        </div>
    </div>

 
      
      <div class="row fix-width motosDescriptionContainer max-width-content-19">
        @if($info[0]['imageDescription'] != '')
          <div class="col-12 col-lg-6 motosTextDescription">
        @else
          <div class="col-12 col-lg-12 text-center motosTextDescription">
        @endif
        
              <h3>{{$info[0]['name']}}</h3>
              <br>
              <p>
                  {{$info[0]['description']}}
              </p>
              <br>
              @if(($info[0]['manual'] != '')&& ($info[0]['imageDescription'] != ''))
                <div class="manualBoton">
                    <a href="/images/motos/manuales/{{$info[0]['manual']}}" target="_blank"><p><i class="fas fa-download"></i> Manual de usuario y garantía</p></a>
                </div>
              @elseif(($info[0]['manual'] != '') && ($info[0]['imageDescription'] == '') )
              <div class="manualBoton manualBoton2 ">
                    <a href="/images/motos/manuales/{{$info[0]['manual']}}" target="_blank"><p><i class="fas fa-download"></i> Manual de usuario y garantía</p></a>
                </div>
              @endif
          </div>

          @if($info[0]['imageDescription'] != '')
            <div class="col-12 col-lg-6 motosPaddingTop">
                <img src="{{asset('images/motos/'.$info[0]['imageDescription'])}}" alt="" class="img-fluid">
            </div>
          @endif
      </div>


    
    <br>
    <br>
    <div id="motos-especificaciones">
        <div class="row fix-width motosMainTitle text-center">
            <h3 class=""><span>ESPECIFICACIONES</span></h3>
        </div>
        <br>
        <br>
        <div class="row motosEspecificacionesTabla">
          <div class="col-12 col-sm-3 motosNavLinks">
            <div class="nav flex-column nav-pills nav-pills-motos" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link nav-link-motos active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-motor" role="tab" aria-controls="v-pills-motor" aria-selected="true"> <img src="{{asset('images/motos/icono_motor.png')}}" alt="icono motor" class="img-fluid"> <span>  Motor</span></a>
              <a class="nav-link nav-link-motos" id="v-pills-transmision-tab" data-toggle="pill" href="#v-pills-transmision" role="tab" aria-controls="v-pills-transmision" aria-selected="false"><img src="{{asset('images/motos/icono_cilindraje.png')}}" alt="icono cilindraje" class="img-fluid"> <span> Transmisión</span></a>
              <a class="nav-link nav-link-motos" id="v-pills-suspension-tab" data-toggle="pill" href="#v-pills-suspension" role="tab" aria-controls="v-pills-suspension" aria-selected="false"><img src="{{asset('images/motos/icono_suspension.png')}}" alt="icono suspension" class="img-fluid"> <span> Suspensión</span></a>
              <a class="nav-link nav-link-motos" id="v-pills-llantas-tab" data-toggle="pill" href="#v-pills-llantas" role="tab" aria-controls="v-pills-llantas" aria-selected="false"><img src="{{asset('images/motos/icono_llantas.png')}}" alt="icono llantas" class="img-fluid"> <span> Llanta</span>s</a>
              <a class="nav-link nav-link-motos" id="v-pills-frenos-tab" data-toggle="pill" href="#v-pills-frenos" role="tab" aria-controls="v-pills-frenos" aria-selected="false"><img src="{{asset('images/motos/icono_freno.png')}}" alt="icono freno" class="img-fluid"> <span> frenos</span></a>
              <a class="nav-link nav-link-motos" id="v-pills-dimensiones-tab" data-toggle="pill" href="#v-pills-dimensiones" role="tab" aria-controls="v-pills-dimensiones" aria-selected="false"><img src="{{asset('images/motos/icono_dimensiones.png')}}" alt="icono dimensiones" class="img-fluid"> <span> Dimensiones</span></a>
            </div>
          </div>
          <div class="col-12 col-sm-9 motosNavContent">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-motor" role="tabpanel" aria-labelledby="v-pills-motor-tab">
                  <div class="row fix-width motos-nav-title">
                    <b>::</b> MOTOR
                  </div>
                  <br>
                  <div class="motosNavItems">
                    <div class="row fix-width">
                      <div class="col-5"><b>Tipo</b></div>
                      <div class="col-7">{{$info[0]['engine']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Desplazamiento</b></div>
                      <div class="col-7">{{$info[0]['displacement']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Max. Ptencia</b></div>
                      <div class="col-7">{{$info[0]['power']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Max. Torque</b></div>
                      <div class="col-7">{{$info[0]['torque']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Relación de Compresión</b></div>
                      <div class="col-7">{{$info[0]['compression']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Arranque</b></div>
                      <div class="col-7">{{$info[0]['start']}}</div>
                    </div>
                  </div>
              </div>
              <div class="tab-pane fade" id="v-pills-transmision" role="tabpanel" aria-labelledby="v-pills-transmision-tab">
                  <div class="row fix-width motos-nav-title">   
                  <b>::</b> TRANSMISIÓN
                  </div>
                  <br>
                  <div class="motosNavItems">
                    <div class="row fix-width">
                      <div class="col-5"><b>Sistema de encendido</b></div>
                      <div class="col-7">{{$info[0]['ignition']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Relación de compresión</b></div>
                      <div class="col-7">{{$info[0]['compression']}}</div>
                    </div>
                  </div>
              </div>
              <div class="tab-pane fade" id="v-pills-suspension" role="tabpanel" aria-labelledby="v-pills-suspension-tab">
                    <div class="row fix-width motos-nav-title">
                    <b>::</b> SUSPENSIÓN
                    </div>
                    <br>
                    <div class="motosNavItems">
                      <div class="row fix-width">
                          <div class="col-5"><b>Suspensión delantera</b></div>
                          <div class="col-7">{{$info[0]['frontSuspension']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Suspensión trasera</b></div>
                          <div class="col-7">{{$info[0]['backSuspension']}}</div>
                      </div>
                    </div>
              </div>
              <div class="tab-pane fade" id="v-pills-llantas" role="tabpanel" aria-labelledby="v-pills-llantas-tab">
                    <div class="row fix-width motos-nav-title">
                      <b>::</b>Llantas
                    </div>
                    <br>
                    <div class="motosNavItems">
                      <div class="row fix-width">
                          <div class="col-5"><b>Llanta delantera</b></div>
                          <div class="col-7">{{$info[0]['tireFront']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Llanta trasera</b></div>
                          <div class="col-7">{{$info[0]['tireBack']}}</div>
                      </div>
                    </div>
              </div>
              <div class="tab-pane fade" id="v-pills-frenos" role="tabpanel" aria-labelledby="v-pills-frenos-tab">
                    <div class="row fix-width motos-nav-title">
                    <b>::</b>Frenos
                    </div>
                    <br>
                    <div class="motosNavItems">
                      <div class="row fix-width">
                          <div class="col-5"><b>Freno delantero</b></div>
                          <div class="col-7">{{$info[0]['frontBrake']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Freno trasero</b></div>
                          <div class="col-7">{{$info[0]['rearBrake']}}</div>
                      </div>
                    </div>
              </div>
              <div class="tab-pane fade" id="v-pills-dimensiones" role="tabpanel" aria-labelledby="v-pills-dimensiones-tab">
                    <div class="row fix-width motos-nav-title">
                      <b>::</b>Dimesiones
                    </div>
                    <br>
                    <div class="motosNavItems">
                      <div class="row fix-width">
                          <div class="col-5"><b>Largo total</b></div>
                          <div class="col-7">{{$info[0]['long']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Altura total</b></div>
                          <div class="col-7">{{$info[0]['height']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Ancho total</b></div>
                          <div class="col-7">{{$info[0]['width']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Distancia entre ejes</b></div>
                          <div class="col-7">{{$info[0]['axisDistance']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Altura al sillín</b></div>
                          <div class="col-7">{{$info[0]['seatHeight']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Peso neto</b></div>
                          <div class="col-7">{{$info[0]['weight']}}</div>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div id="motos-especificaciones-responsive">
        <div class="row fix-width motosMainTitle text-center">
            <h3 class=""><span>ESPECIFICACIONES</span></h3>
        </div>
        <br>
        <br>
        <div class="row motosEspecificacionesTabla">
          <div class="col-12 col-sm-12 motosNavLinks">
            <div class="nav nav-pills nav-pills-motos" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
              <a class="nav-link nav-link-motos active" id="v-pills-r-home-tab" data-toggle="pill" href="#v-pills-r-motor" role="tab" aria-controls="v-pills-r-motor" aria-selected="true"> <img src="{{asset('images/motos/icono_motor.png')}}" alt="icono motor" class="img-fluid"> <span>  Motor</span></a>
              <a class="nav-link nav-link-motos" id="v-pills-r-transmision-tab" data-toggle="pill" href="#v-pills-r-transmision" role="tab" aria-controls="v-pills-r-transmision" aria-selected="false"><img src="{{asset('images/motos/icono_cilindraje.png')}}" alt="icono cilindraje" class="img-fluid"> <span> Transmisión</span></a>
              <a class="nav-link nav-link-motos" id="v-pills-r-suspension-tab" data-toggle="pill" href="#v-pills-r-suspension" role="tab" aria-controls="v-pills-r-suspension" aria-selected="false"><img src="{{asset('images/motos/icono_suspension.png')}}" alt="icono suspension" class="img-fluid"> <span> Suspensión</span></a>
              <a class="nav-link nav-link-motos" id="v-pills-r-llantas-tab" data-toggle="pill" href="#v-pills-r-llantas" role="tab" aria-controls="v-pills-r-llantas" aria-selected="false"><img src="{{asset('images/motos/icono_llantas.png')}}" alt="icono llantas" class="img-fluid"> <span> Llantas</span></a>
              <a class="nav-link nav-link-motos" id="v-pills-r-frenos-tab" data-toggle="pill" href="#v-pills-r-frenos" role="tab" aria-controls="v-pills-r-frenos" aria-selected="false"><img src="{{asset('images/motos/icono_freno.png')}}" alt="icono freno" class="img-fluid"> <span> frenos</span></a>
              <a class="nav-link nav-link-motos" id="v-pills-r-dimensiones-tab" data-toggle="pill" href="#v-pills-r-dimensiones" role="tab" aria-controls="v-pills-r-dimensiones" aria-selected="false"><img src="{{asset('images/motos/icono_dimensiones.png')}}" alt="icono dimensiones" class="img-fluid"> <span> Dimensiones</span></a>
            </div>
          </div>
          <div class="col-12 col-sm-12 motosNavContent">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-r-motor" role="tabpanel" aria-labelledby="v-pills-motor-tab">
                  <div class="row fix-width motos-nav-title">
                    <b>::</b> MOTOR
                  </div>
                  <br>
                  <div class="motosNavItems">
                    <div class="row fix-width">
                      <div class="col-5"><b>Tipo</b></div>
                      <div class="col-7">{{$info[0]['engine']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Desplazamiento</b></div>
                      <div class="col-7">{{$info[0]['displacement']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Max. Ptencia</b></div>
                      <div class="col-7">{{$info[0]['power']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Max. Torque</b></div>
                      <div class="col-7">{{$info[0]['torque']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Relación de Compresión</b></div>
                      <div class="col-7">{{$info[0]['compression']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Arranque</b></div>
                      <div class="col-7">{{$info[0]['start']}}</div>
                    </div>
                  </div>
              </div>
              <div class="tab-pane fade" id="v-pills-r-transmision" role="tabpanel" aria-labelledby="v-pills-transmision-tab">
                  <div class="row fix-width motos-nav-title">   
                  <b>::</b> TRANSMISIÓN
                  </div>
                  <br>
                  <div class="motosNavItems">
                    <div class="row fix-width">
                      <div class="col-5"><b>Sistema de encendido</b></div>
                      <div class="col-7">{{$info[0]['ignition']}}</div>
                    </div>
                    <div class="row fix-width">
                      <div class="col-5"><b>Relación de compresión</b></div>
                      <div class="col-7">{{$info[0]['compression']}}</div>
                    </div>
                  </div>
              </div>
              <div class="tab-pane fade" id="v-pills-r-suspension" role="tabpanel" aria-labelledby="v-pills-suspension-tab">
                    <div class="row fix-width motos-nav-title">
                    <b>::</b> SUSPENSIÓN
                    </div>
                    <br>
                    <div class="motosNavItems">
                      <div class="row fix-width">
                          <div class="col-5"><b>Suspensión delantera</b></div>
                          <div class="col-7">{{$info[0]['frontSuspension']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Suspensión trasera</b></div>
                          <div class="col-7">{{$info[0]['backSuspension']}}</div>
                      </div>
                    </div>
              </div>
              <div class="tab-pane fade" id="v-pills-r-llantas" role="tabpanel" aria-labelledby="v-pills-llantas-tab">
                    <div class="row fix-width motos-nav-title">
                      <b>::</b>Llantas
                    </div>
                    <br>
                    <div class="motosNavItems">
                      <div class="row fix-width">
                          <div class="col-5"><b>Llanta delantera</b></div>
                          <div class="col-7">{{$info[0]['tireFront']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Llanta trasera</b></div>
                          <div class="col-7">{{$info[0]['tireBack']}}</div>
                      </div>
                    </div>
              </div>
              <div class="tab-pane fade" id="v-pills-r-frenos" role="tabpanel" aria-labelledby="v-pills-frenos-tab">
                    <div class="row fix-width motos-nav-title">
                    <b>::</b>Frenos
                    </div>
                    <br>
                    <div class="motosNavItems">
                      <div class="row fix-width">
                          <div class="col-5"><b>Freno delantero</b></div>
                          <div class="col-7">{{$info[0]['frontBrake']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Freno trasero</b></div>
                          <div class="col-7">{{$info[0]['rearBrake']}}</div>
                      </div>
                    </div>
              </div>
              <div class="tab-pane fade" id="v-pills-r-dimensiones" role="tabpanel" aria-labelledby="v-pills-dimensiones-tab">
                    <div class="row fix-width motos-nav-title">
                      <b>::</b>Dimesiones
                    </div>
                    <br>
                    <div class="motosNavItems">
                      <div class="row fix-width">
                          <div class="col-5"><b>Largo total</b></div>
                          <div class="col-7">{{$info[0]['long']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Altura total</b></div>
                          <div class="col-7">{{$info[0]['height']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Ancho total</b></div>
                          <div class="col-7">{{$info[0]['width']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Distancia entre ejes</b></div>
                          <div class="col-7">{{$info[0]['axisDistance']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Altura al sillín</b></div>
                          <div class="col-7">{{$info[0]['seatHeight']}}</div>
                      </div>
                      <div class="row fix-width">
                          <div class="col-5"><b>Peso neto</b></div>
                          <div class="col-7">{{$info[0]['weight']}}</div>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <br>
    <br>
    <div id="newsletter-avance">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-6">
            <h3>
              SÉ EL PRIMERO EN RECIBIR NUESTRAS <br> OFERTAS Y LANZAMIENTOS
            </h3>
          </div>
          <div class="col-12 col-sm-12 col-md-6">
            <div class="newsletter-avance-input">
              <form action="{{route('newsletter.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-10">
                      <input type="email" name="email" class="form-control" placeholder="Ingresa tu correo electrónico">	
                    </div>
                    <div class="col-2">
                      <div class="input-group-prepend">
                        <button class="btn btn-newsletter-avances"><i class="fas fa-paper-plane"></i></button>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1" required>
                      <label for="termsAndConditions" style="font-size: 10px; font-style: italic;">
                        Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition" target="_blank">términos y condiciones</a> y <a href="/Proteccion-de-datos-personales" class="linkTermAndCondition" target="_blank">política de tratamiento de datos</a>
                      </label>
                    </div>
                </div>
              </form>	
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal modalFormulario fade hide" id="motosLiquidadorModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-body modalFormulario-body-motos" ng-if="fee==0">
                  <div class="motosHeaderModal">
                    <h3 class="text-center">Simula tu crédito de manera rápida y fácil</h3>
                  </div>
                  <div class="modal-containerFormulario">
                      <div class="containerFormulario motosContainerFormulario">
                          <p class="text-center">
                            <span>
                              Con nuestro simulador de crédito podrás revisar el mejor plazo que <br>
                              se adapte a tu cuota mensual.
                            </span>
                          </p>
                          <form ng-submit="viewCuota()" id="formEx">
                              <div class="formularioSimulador-containInput">
                                  <label class="formularioSimulador-labelFormulario" for="brand">Marca :</label>
                                  <select id="brand" class="form-control" ng-model="data.brand" ng-options="b.id as b.brand for b in brands" required="true" ></select>
                              </div>
                              <div class="formularioSimulador-containInput">
                                  <label for="model" class="formularioSimulador-labelFormulario">Modelo :</label>
                                  <select class="form-control" id="model" ng-model="data.model" ng-options="m.id as m.name for m in motos"  required="true" ></select>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-sm-12 col-md-12">
                                      <div class="initialFeeValue formularioSimulador-containInput text-center">
                                          <div class="row">
                                            <p class="text-center">
                                              <span>
                                                Escribe el monto de cuota inicial que prefieras <br>
                                                aportar para disminuir el monto de tu crédito.
                                              </span>
                                            </p>
                                          </div>
                                          <br>
                                          <input id="rangeInitialFee" ng-class="{'errorFee':invalidFee}" type="text" ng-currency fraction="0" min="0"  ng-model="data.initialFee" data-show-value="true">
                                          <br>
                                          <div class="row" ng-if="invalidFee">
                                            <p class="invalidFeeMsg">
                                              <span>El monto mínimo de la cuota inicial es de $400.000. Por favor ingrese un valor válido</span>
                                            </p>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-sm-12 col-md-12">
                                      <div class="motosTimeLimit formularioSimulador-containInput">
                                        <p class="text-center">
                                          <span>
                                            Escoge el plazo que se adapte a tu cuota ideal.
                                          </span>
                                        </p>
                                        <br>  
                                        <div class="row text-center">
                                          <div class="offset-1"></div>
                                          <div class="col-2">
                                            <p class="timeLimitOption" ng-class="{ 'select-timeLimitOption': data.timeLimit == '6' }" ng-click="AssignTimeLimit(6)">
                                              <span>
                                              6
                                              </span>
                                            </p>
                                          </div>
                                          <div class="col-2">
                                            <p class="timeLimitOption" ng-class="{ 'select-timeLimitOption': data.timeLimit == '12' }" ng-click="AssignTimeLimit(12)">
                                              <span>
                                              12
                                              </span>
                                            </p>
                                          </div>
                                          <div class="col-2">
                                            <p class="timeLimitOption" ng-class="{ 'select-timeLimitOption': data.timeLimit == '24' }" ng-click="AssignTimeLimit(24)">
                                              <span>
                                              24
                                              </span>
                                            </p>
                                          </div>
                                          <div class="col-2">
                                            <p class="timeLimitOption" ng-class="{ 'select-timeLimitOption': data.timeLimit == '36' }"  ng-click="AssignTimeLimit(36)">
                                              <span>
                                              36
                                              </span>
                                            </p>
                                          </div>
                                          <div class="col-2">
                                            <p class="timeLimitOption" ng-class="{ 'select-timeLimitOption': data.timeLimit == '48' }" ng-click="AssignTimeLimit(48)">
                                              <span>
                                              48
                                              </span>
                                            </p>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="formularioSimulador-containInput">
                                  <input type="hidden" id="segMargen" class="form-control" ng-model="libranza.segMargen">
                              </div>
                              <div class="formularioSimulador-containInput text-center">
                                  <button type="submit" class="btn buttonSend formularioSimulador-buttonForm" style="margin-top: 15px;">Simular</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="modal-body modalFormulario-body-motos" ng-if="fee==1"> 
                <div class="motosHeaderModal">
                  <h3>Crédito para Moto</h3>
                </div>
                <div class="infoPayment">
                    <p>
                      <div class="row">
                          <div class="col-12 col-sm-6">
                            <div class="infoPaymentContainer">
                              <span>Modelo</span>
                              <h4>
                                <i class="fas fa-motorcycle"></i> @{{moto.name}}
                              </h4> 
                            </div>
                          </div>
                          <div class="col-12 col-sm-6">
                            <div class="infoPaymentContainer">
                              <span>Número de cuotas</span>
                              <h4>
                                <i class="far fa-clock"></i>@{{data.timeLimit}}
                              </h4>
                            </div>
                          </div>
                      </div>
                      <div class="row infoPaymentFee">
                          <div class="col-12">
                              <h4>Valor cuota mensual:</h4>
                              <h3>$ @{{payment.fee | number:0 }}</h3>
                          </div>
                      </div>
                    </p>
                    <div class="row text-center btn-viewCuota">
                      <div class="col-6">
                        <a ng-click="viewProjection()" class="formularioSimulador-buttonForm btn-credito"> Proyección de crédito</a>
                      </div>
                      <div class="col-6">
                        <a ng-click="backToSimulate()" class="formularioSimulador-buttonForm btn-credito">Volver a Simular</a>
                      </div>
                    </div>
                </div>
              </div>
              <div class="modal-body modalFormulario-proyecciones-motos" ng-if="fee==2"> 
                <div class="row">
                  <div class="table table-responsive text-nowrap">
                    <table class="table table-striped text-center">
                        <thead class="headerTableMotos">
                            <tr>
                                <td class=""># Cuota</td>
                                <td class="">Abono a intereses</td>
                                <td class="">Abono a capital</td>
                                <td class="">Cuota mensual</td>
                                <td class=" ">Saldo</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="cursor">
                                <td>@{{ initialCuota.pos | number:0 }}</td>
                                <td>$ @{{ initialCuota.interestPayment | number:2 }}</td>
                                <td>$ @{{ initialCuota.capitalPayment | number:2 }}</td>
                                <td>$ @{{ initialCuota.fee | number:2 }}</td>
                                <td>$ @{{ initialCuota.balance | number:2 }}</td>
                            </tr>
                            <tr class="cursor" dir-paginate="p in payments|orderBy:sortKey:reverse|filter:search|itemsPerPage:12">
                                <td>@{{ p.pos | number:0 }}</td>
                                <td>$ @{{ p.interestPayment | number:2 }}</td>
                                <td>$ @{{ p.capitalPayment | number:2 }}</td>
                                <td>$ @{{ p.fee | number:2 }}</td>
                                <td>$ @{{ p.balance | number:2 }}</td>
                            </tr>   
                      </tbody>
                    </table>
                    <dir-pagination-controls
                      max-size="6"
                      direction-links="true"
                      boundary-links="true" >
                    </dir-pagination-controls>
                    <div class="row text-center backToCuota-btn">
                      <a ng-click="backToCuota()" class="formularioSimulador-buttonForm btn-credito">Volver</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

  <div class="modal modalFormulario fade hide" id="motosCuotasModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-body modalFormulario-body-motos"> 
                <div class="row">
                  <div class="table table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead class="">
                            <tr>
                                <td class=""># Cuota</td>
                                <td class="">Abono a intereses</td>
                                <td class="">Abono a capital</td>
                                <td class="">Cuota mensual</td>
                                <td class=" ">Saldo</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="cursor" dir-paginate="p in payments|orderBy:sortKey:reverse|filter:search|itemsPerPage:12">
                                <td>@{{ p.pos | number:0 }}</td>
                                <td>$ @{{ p.interestPayment | number:2 }}</td>
                                <td>$ @{{ p.capitalPayment | number:2 }}</td>
                                <td>$ @{{ p.fee | number:2 }}</td>
                                <td>$ @{{ p.balance | number:2 }}</td>
                            </tr>   
                      </tbody>
                    </table>
                    <dir-pagination-controls
                      max-size="6"
                      direction-links="true"
                      boundary-links="true" >
                    </dir-pagination-controls>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  
<script src="{{asset('js/dirPagination.js')}}"></script>
<script src="{{ asset('js/motos.js') }}"></script>
<script> src="{{asset('js/bower_components/angular-slick-carousel/dist/slick.js') }}"</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ng-currency/1.2.7/ng-currency.min.js"></script>

@stop