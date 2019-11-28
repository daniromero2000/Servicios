@extends('layouts.admin.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<!-- Main content -->
<div class="container-fluid">

  <div class="row mt-2">
    <!-- /.col (RIGHT) -->
    <div class="col-md-4">
      <div class="col-12 col-sm-6 col-md-12">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6">
            <!-- /.info-box -->
            <div class="small-box ">
              <div class="inner">
                {{-- <h2>{{ $totalStatuses }}</h2> --}}
                <h2>23 </h2>
                <p>Solicitudes</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-6">
            <div class="small-box ">
              <div class="inner">
                <h2>Total</h2>
                <p>1000000</p>
                {{-- <p>${{ number_format ($factoryRequestsTotal) }}</p> --}}
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
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
                <span class="info-box-text text-right"><a href="" style="color: black; !important">Ver
                    Mas</a></span>
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
                <span class="info-box-text text-right"><a href="" style="color: black; !important">Ver
                    Mas</a></span>
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
                <span class="info-box-text text-right"><a href="" style="color: black; !important">Ver
                    Mas</a></span>
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

      <!-- Card 4 -->
      <div class="col-12">
        <div class="info-box ">
          <span class="info-box-icon"><i class="fas fa-thumbs-down"></i></span>}
          <div class="info-box-content">
            <div class="row">
              <div class="col-6">
                <span class="info-box-text">Negados</span>
                <span class="info-box-number">41,410</span>
              </div>
              <div class="col-6">
                <span class="info-box-text text-right"><a href="" style="color: black; !important">Ver
                    Mas</a></span>
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


      <div class="card">
        <div class="card-header">
          {{-- <h3 class="card-title"> {{ $totalWeb }} Solicitudes Web</h3> --}}
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
    </div>


    <!-- /.col (LEFT) -->
    <div class="col-md-8">
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
      <!-- /.card -->

      <!-- TORTA -->
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
              @include('layouts.admin.date_filter', ['route' => route('factory_dashboard')])
            </div>
            <div class="col-12">
              <canvas id="pieChart" style="height:605px; min-height:600px"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
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
      <!-- /.card -->

      <!-- Card 1 -->

    </div>
    <!-- /.col (LEFT) -->
    <div class="col-md-12">
      <!-- PORCENTAJES -->
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title">Bar Chart</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <!-- /.card-header -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Pie Chart</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="pieChart" style="height:230px; min-height:230px"></canvas>
        </div>
      </div>
    </div>
    </section>
  </div>
</div>


@endsection
@section('scriptsJs')

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard3.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- FLOT CHARTS -->
<script src="{{ asset('plugins/flot/jquery.flot.js') }}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{ asset('plugins/flot-old/jquery.flot.resize.min.js') }}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{ asset('plugins/flot-old/jquery.flot.pie.min.js') }}"></script>
<!-- Page script -->

@endsection