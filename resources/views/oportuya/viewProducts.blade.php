@extends('layouts.app')
@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('css/front/viewProducts/app.css') }}">
@endsection
@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Descripción del producto</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Especificaciones</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="container mt-2">
      <div class="row justify-content-center ">
        <div class="col-10 col-sm-6  p-0"> <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Espe1.png') }}" class="img-fluid img-responsive">
        </div>
        <div class="col-10 col-sm-6  p-0"> <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Espe2.png') }}" class="img-fluid img-responsive">
        </div>
        <div class="col-10 col-sm-6  p-0"> <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Espe3.png') }}" class="img-fluid img-responsive">
        </div>
        <div class="col-10 col-sm-6  p-0"> <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Espe4.png') }}" class="img-fluid img-responsive">
        </div>
      </div>
    </div>

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="card">
      <div class="card-body">
        <div class="container mt-2 ">
          <div class="card">
            <img class="img-fluid" src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/especificaciones1.png') }}" alt="">

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="container mt-5 mb-5 pt-5  border-0 mx-auto  shadow p-3 mb-5 bg-white rounded" style="margin top: 0%">
  <div class="card    border-0 mx-auto" style="center">
    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <h4 class="text-primary font-weight-bold title-card-step"> Obten tu crédito de la siguiente maneras</h4>
      </div>

      <div class="col-md-6 col-sm-8 col-10 ">
        <div class="card text-center step-cards last-step-cards  border-0 mx-auto">
          <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/1.png') }}" alt="" class="first-img-step-cards">
          <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/Image_1.png') }}" alt="" class="second-img-step-cards">
          <div class="card-body card-body-view">
            <p class="card-text text-step-cards">Ingresa nuestra solicitud de crédito para comenzar
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-8 col-10 ">
        <div class="card text-center step-cards last-step-cards  border-0 mx-auto">
          <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/2.png') }}" alt="" class="first-img-step-cards">
          <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/Image_2.png') }}" alt="" class="second-img-step-cards">
          <div class="card-body card-body-view">
            <p class="card-text text-step-cards">Deja tus datos completos según la solicitud de crédito que estés dilifenciando. De la calidad de la información dependerá la velocidad en el resultado. Además recuerda que todos los datos son verificados.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-8 col-10 ">
        <div class="card text-center step-cards last-step-cards  border-0 mx-auto">
          <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/3.png') }}" alt="" class="first-img-step-cards">
          <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/Image_3.png') }}" alt="" class="second-img-step-cards">
          <div class="card-body card-body-view">
            <p class="card-text text-step-cards">En el intermedio del proceso recibirás un token de confirmación para verificar la existencia de tu número telefónico; no lo elimines, el proceso te lo exigirá para continuar con tu solicitud.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-8 col-10 ">
        <div class="card text-center step-cards last-step-cards  border-0 mx-auto">
          <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/4.png') }}" alt="" class="first-img-step-cards">
          <img src="{{ asset('images/Front/OportuyaCustomers/PaginaInterna/Snipet/Image_4.png') }}" alt="" class="second-img-step-cards">
          <div class="card-body card-body-view">
            <p class="card-text text-step-cards">Una vez haya sido aprobada tu solicitud de crédito. Un asesor se comunicará contigo para finalizar el proceso.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@stop