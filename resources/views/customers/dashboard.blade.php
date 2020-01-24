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
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="/Administrator/dashboard/customers">Dashboard Clientes</a></li>
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
                <p>Intenciones Web</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars " style="color: white;"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($customerSteps as $customerStep)
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
                    <span class="info-box-text text-right"><a href="{{ route('customers.index') }}"
                        style="color: black; !important">Ver
                        Más</a></span>
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
            @include('layouts.admin.date_filter', ['route' => route('customer_dashboard')])
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pasos Formulario Intenciónes Web   </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">

            <div class="col-12">
              <canvas id="pieChart" style="height:310; min-height:300px"></canvas>
            </div>
          </div>
        </div>
      </div>

      {{-- aqui --}}
      <div class="row">
<div class="col-6">
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
            <canvas id="donutChart2" style="height:230px; min-height:230px"></canvas>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> <span class="badge badge-primary">{{ $totalFosygas}}</span> Consultas Fosyga<br>
              ¿Falló Consulta?</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="pieChart2" style="height:200px; min-height:auto"></canvas>
          </div>
          <div class="col-12">

            <div class="row text-center">
              @foreach ($customersFosygas as $customersFosyga)
              <div class="col-6 header-table mt-2">

                <p> <span @if ($customersFosyga['fuenteFallo']=='SI' ) class="badge badge-danger" @else
                    class="badge badge-primary" @endif> {{ number_format ($customersFosyga['percentage']) }} % </span>
                  {{$customersFosyga['fuenteFallo']}} Falló</p>

              </div>
              @endforeach
            </div>
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
              <canvas id="areaChart2" style="height:250px; min-height:250px"></canvas>
            </div>
          </div>
          <div class="row text-center">
            <div class="col-12 d-flex justify-content-center">
              @foreach ($customersFosygas as $customersFosyga)
              <div class="col-3 header-table mt-2">
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
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
          <canvas id="donutChart3" style="height:230px; min-height:230px"></canvas>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> <span class="badge badge-primary">{{ $totalRegistradurias}}</span> Consultas
            Registraduría<br> ¿Falló Consulta?</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="pieChart3" style="height:200px; min-height:auto"></canvas>
        </div>
        <div class="row text-center">
          <div class="col-12 d-flex justify-content-center">
            @foreach ($customerRegistradurias as $customerRegistraduria)
            <div class="col-6 header-table mt-2">
              <p><span @if ($customerRegistraduria['fuenteFallo']=='SI' ) class="badge badge-danger" @else
                  class="badge badge-primary" @endif>
                  {{ number_format ($customerRegistraduria['percentage']) }} % </span>
                {{$customerRegistraduria['fuenteFallo']}}
                Falló</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
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
            <canvas id="areaChart3" style="height:250px; min-height:250px"></canvas>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
@endsection
@include('layouts.admin.dashboard_imports')
@include('customers.dashboardJS')