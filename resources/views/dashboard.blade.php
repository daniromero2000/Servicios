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
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Bienvenido {{ auth()->user()->name }}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<section class="content">
  <div class="container">
    <div class="row d-flex mt-3">
      @foreach ($modules as $module)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center ">
        <a class="btn btn-primary mb-3 " href="{{ $module->route}}"
          style="min-width: 220px; min-height: 115px;border-radius: 10px;">
          <i class="mt-1 {{ $module->icon}} nav-icon" style="font-size: 50px;"></i>
          <p class="mt-1" style="font-size: 17px;">{{ $module->name }}</p>
        </a>
      </div>
      @endforeach
      <!-- /.col -->
    </div>
</section>
@endsection