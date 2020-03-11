@extends('layouts.admin.app')
<style type="text/css">
  #header,
  #preHeader,
  #footer {
    display: none;
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
          <div class="card-body p-4">
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
      <div class="col-8 col-sm-6 col-lg-4 col-xl-3">
        <a class="cursor" data-toggle="tooltip" data-placement="top" title="Ir al panel" href="{{ $module->route}}">
          <div class="info-box info-box-reset">
            <span class="info-box-icon info-icon-reset bg-primary elevation-1"><i class="{{ $module->icon}}"></i></span>
            <div class="info-box-content">
              <span class="info-box-text wellcomeDashboard text-dark ">{{ $module->name }}</span>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection