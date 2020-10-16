@extends('layouts.admin.app')
<style type="text/css">
  .container-icon {
    min-width: 70px;
  }

  @media (max-width:500px) {
    .container-icon {
      min-width: 60px;
    }
  }

</style>
@php
$modules = session('modules');
@endphp
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row d-flex justify-content-center justify-content-md-start">
      <div class="col-10 col-md-6 container-card-dashboard ">
        <div class="card p-1 mt-3 bg-primary" style="border-radius: 20px;">
          <div class="card-body p-reset">
            <h4 class="text-white nameDashboard mb-2">Hola, {{ auth()->user()->name }}</h4>
            <p class="card-text wellcomeDashboard text-white">Bienvenido al Panel Administrativo</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container">
    <div class="row d-flex justify-content-center justify-content-sm-start mt-3">
      @foreach ($modules as $module)
      <div class="col-10 col-sm-6 col-lg-4 col-xl-3">
        <a class="cursor" data-toggle="tooltip" data-placement="top" title="Ir al panel" href="{{ $module->route}}">
          <div class="info-box info-box-reset">
            <span class="info-box-icon info-icon-reset bg-primary elevation-1 container-icon"><i
                class="{{ $module->icon}}"></i></span>

            <div class="card-body px-3 py-2">
              <p class="card-text wellcomeDashboard text-dark">{{ $module->name }}</p>
            </div>
          </div>
        </a>
      </div>
      @endforeach
      @if (auth()->user()->codeOportudata == '1088247299' || auth()->user()->codeOportudata == '98587878' ||
      auth()->user()->codeOportudata == '998877' || auth()->user()->Assessor->subsidiary->CODIGO == '109' ||
      auth()->user()->Assessor->subsidiary->CODIGO == '115' ||
      auth()->user()->Assessor->subsidiary->CODIGO == '139' ||
      auth()->user()->Assessor->subsidiary->CODIGO == '144' ||
      auth()->user()->Assessor->subsidiary->CODIGO == '146' ||
      auth()->user()->Assessor->subsidiary->CODIGO == '147' ||
      auth()->user()->Assessor->subsidiary->CODIGO == '133' ||
      auth()->user()->Assessor->subsidiary->CODIGO == '155' ||
      auth()->user()->Assessor->subsidiary->CODIGO == '149' ||
      auth()->user()->Assessor->subsidiary->CODIGO == '138' ||
      auth()->user()->Assessor->subsidiary->CODIGO == '1')
      <div class="col-10 col-sm-6 col-lg-4 col-xl-3">
        <a class="cursor" data-toggle="tooltip" data-placement="top" title="Ir al panel"
          href="/Administrator/assessorquotations">
          <div class="info-box info-box-reset">
            <span class="info-box-icon info-icon-reset bg-primary elevation-1 container-icon"><i
                class="fas fa-store"></i></span>

            <div class="card-body px-3 py-2">
              <p class="card-text wellcomeDashboard text-dark">Cotizador</p>
            </div>
          </div>
        </a>
      </div>
      @endif
    </div>
  </div>
</section>
@endsection