@extends('layouts.admin.app')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <div class="row">
          <div class="col-md-12">
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="/Administrator/dashboard/callCenter">Dashboard CallCenter</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row mt-2">
    <div class="col-sm-12 col-md-5 col-lg-4">
      <div class="col-12 col-sm-12">
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-sm-12 col-md-12">
            <div class="small-box bg-primary">
              <div class="inner">
                <h2>{{ $totalStatuses }}</h2>
                <p>Solicitudes de Clientes</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars " style="color: white;"></i>
              </div>
              <div class="col-12 text-right color-white">
                <span class="info-box-text text-right"><a href="{{ route('callCenter.index') }}"
                    style="color: white; !important">Ver
                    Más</a></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($countCustomersForCallSteps as $customerStep)
        <div class="col-12 col-sm-6 col-md-12">
          <!-- Card 1 -->
          <div class="col-12">
            <div class="info-box ">
              <span class="info-box-icon"><i class="fas fa-stopwatch"></i></span>
              <div class="info-box-content">
                <div class="row">
                  <div class="col-6">
                    <span class="info-box-text">{{$customerStep['PASO']}}</span>
                    <span class="info-box-number"> {{$customerStep['total']}} </span>
                  </div>
                  <div class="col-6">
                    <span class="info-box-text text-right"><a href="{{ route('callCenter.index') }}"
                        style="color: black; !important">Ver
                        Mas</a></span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  {{ number_format ($customerStep['percentage'])}}% llegó a este paso
                </span>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        <!-- AREA CHART debe ir oculta -->
        <div hidden class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Area Chart</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="areaChart" style="height:250px; min-height:250px"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col (LEFT) -->
    <div class=" col-md-7 col-lg-8">
      <!-- debe ir oculta -->
      <div hidden class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Donut Chart</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="donutChart" style="height:230px; min-height:230px"></canvas>
        </div>
      </div>
      <!-- TORTA -->
      <div class="card">
        <div class="card-body">
          <div class="col-12">
            @include('layouts.admin.date_filter', ['route' => route('callCenter_dashboard')])
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">

            <div class="col-12">
              <canvas id="pieChart" style="height:310px; min-height:300px"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@include('layouts.admin.dashboard_imports')
@include('callCenter.dashboardJS')
@endsection