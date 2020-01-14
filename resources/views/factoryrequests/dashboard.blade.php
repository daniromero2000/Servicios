@extends('layouts.admin.app')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/Administrator/dashboard/">Dashboard </a></li>
          <li class="breadcrumb-item active"><a href="/Administrator/dashboard/factoryrequests">Dashboard Solicitudes
              Fábrica</a>
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row mt-2">
    <div class="col-sm-12 col-md-5 col-lg-4">
      <div class="col-12 col-sm-12">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6 ">
            <div class="small-box bg-primary">
              <div class="inner">
                <h2>{{ $totalStatuses }}</h2>
                <p>Solicitudes Crédito <br> en los últimos 30 días</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h2>Total</h2>
                <br>
                <p>${{ number_format ($factoryRequestsTotal) }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-sm-6 col-md-12">
          <!-- Card 1 -->
          <div class="col-12">
            <div class="info-box ">
              <span class="info-box-icon"><i class="fas fa-thumbs-up"></i></span>
              <div class="info-box-content">
                <div class="row">
                  <div class="col-6">
                    <span class="info-box-text">Aprobados</span>
                    <span class="info-box-number">41,410</span>
                  </div>
                  <div class="col-6">
                    <span class="info-box-text text-right"><a href="{{ route('factoryrequests.index') }}"
                        style="color: black; !important">Ver
                        Más</a></span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  70% Increase in 30 Days
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-12">
          <!-- Card 2 -->
          <div class="col-12">
            <div class="info-box ">
              <span class="info-box-icon"><i class="fas fa-envelope-open-text"></i></span>
              <div class="info-box-content">
                <div class="row">
                  <div class="col-6">
                    <span class="info-box-text">Pendientes</span>
                    <span class="info-box-number">41,410</span>
                  </div>
                  <div class="col-6">
                    <span class="info-box-text text-right"><a href="/factoryrequests"
                        style="color: black; !important">Ver
                        Más</a></span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  70% Increase in 30 Days
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-12">
          <!-- Card 3 -->
          <div class="col-12">
            <div class="info-box ">
              <span class="info-box-icon"><i class="fas fa-door-open"></i></span>
              <div class="info-box-content">
                <div class="row">
                  <div class="col-6">
                    <span class="info-box-text">Desistidos</span>
                    <span class="info-box-number">41,410</span>
                  </div>
                  <div class="col-6">
                    <span class="info-box-text text-right"><a href="/factoryrequests"
                        style="color: black; !important">Ver
                        Más</a></span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  70% Increase in 30 Days
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-12">
          <!-- Card 4 -->
          <div class="col-12">
            <div class="info-box ">
              <span class="info-box-icon"><i class="fas fa-thumbs-down"></i></span>
              <div class="info-box-content">
                <div class="row">
                  <div class="col-6">
                    <span class="info-box-text">Negados</span>
                    <span class="info-box-number">41,410</span>
                  </div>
                  <div class="col-6">
                    <span class="info-box-text text-right"><a href="/factoryrequests"
                        style="color: black; !important">Ver
                        Más</a></span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  70% Increase in 30 Days
                </span>
              </div>
            </div>
          </div>
        </div>
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
            @include('layouts.admin.date_filter', ['route' => route('factory_dashboard')])
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Estados Solicitudes</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
           
            <div class="col-12">
              <canvas id="pieChart" style="height:334px; min-height:300px"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> {{ $totalWeb }} Solicitudes Web</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="pieChart2" style="height:200px; min-height:auto"></canvas>
        </div>
      </div>
      <!-- AREA CHART DEBE IR OCULTA-->
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
    <!-- Card 1 -->
    <div class="col-md-8">
      <!-- PORCENTAJES -->
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title">Estados Solicitudes</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body row justify-content-center">
          <div class="col-10">
            <div class="chart">
             <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@include('layouts.admin.dashboard_imports')
@include('factoryrequests.dashboardJS')

@endsection