@extends('layouts.admin.app')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/Administrator/dashboard/">Dashboard </a></li>
          <li class="breadcrumb-item active"><a href="/Administrator/dashboard/intentions">Dashboard Intenciones Web</a>
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <section class="content">
    <div class="row mt-2">
      <!-- /.col (RIGHT) -->
      <div class="col-sm-12 col-md-4">
        <div class="col-12 col-sm-12">
          <div class="row d-flex justify-content-center">
            <div class="col-12 ">
              <!-- /.info-box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h2>{{ $totalStatuses }}</h2>
                  <p>Intenciones en el ultimo mes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars" style="color: white;"></i>
                </div>

                <div class="col-12 text-right">
                  <span class="info-box-text text-right"><a href="{{ route('web.index') }}"
                      style="color: white; !important">Ver
                      Más</a></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12">
          <!-- debe ir oculta -->
          <div hidden class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Donut Chart</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                    class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="donutChart" style="height:230px; min-height:230px"></canvas>
            </div>
          </div>
          <!-- TORTA -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Resumen Intenciones</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                    class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="pieChart" style="height:200px; min-height:auto"></canvas>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($creditCards as $creditCard)
          @if(!empty($creditCard['TARJETA']))
          <div class="col-12 col-sm-12 col-md-12">
            <!-- Card 1 -->
            <div class="col-12">
              <div class="info-box ">
                <span class="info-box-icon"><i class="fas fa-credit-card"></i></span>
                <div class="info-box-content">
                  <div class="row">
                    <div class="col-6">
                      <span class="info-box-text"> {{ $creditCard['TARJETA'] }} </span>
                      <span class="info-box-number">{{ $creditCard['total'] }}</span>
                    </div>
                    <div class="col-6">
                      <span class="info-box-text text-right"><a href="{{ route('web.index') }}"
                          style="color: black; !important">Ver
                          Más</a></span>
                    </div>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    {{ number_format ($creditCard['percentage'])}}% es apto para {{ $creditCard['TARJETA'] }}
                  </span>
                </div>
              </div>
            </div>
          </div>
          @endif
          @endforeach
          <!-- AREA CHART debe ir oculta -->
          <div hidden class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Area Chart</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                    class="fas fa-times"></i></button>
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
      <div class="col-md-8">
        <div class="row">
          <div class="col-12">
            <!-- PORCENTAJES -->
            <div class="card">
              <div class="card-body">
                <div class="col-12">
                  @include('layouts.admin.date_filter', ['route' => route('intention_dashboard')])
                </div>
              </div>
            </div>
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Perfiles Crediticios</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                      class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">

                <div class="chart">
                  <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
                </div>
                <div class="col-12">
                  <div class="row text-center">
                    @foreach ($statusPercentage as $statusPercentage)
                    <div class="col-3 header-table mt-2">
                      {{ number_format ($statusPercentage['percentage']) }} % {{$statusPercentage['status']}}
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col (LEFT) -->
    </div>
    <div class="row">
      <!-- /.col (RIGTH) -->
      <div class="col-md-4">
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
    </div>
</div>
@endsection
@include('layouts.admin.dashboard_imports')
@include('intentionAssessors.dashboardJS')
@endsection