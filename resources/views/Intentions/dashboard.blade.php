@extends('layouts.admin.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<!-- Main content -->
<div class="container-fluid">
  <section class="content">
    <div class="row mt-2">
      <!-- /.col (RIGHT) -->
      <div class="col-sm-12 col-md-5 col-lg-4">
        <div class="col-12 col-sm-12">
          <div class="row d-flex justify-content-center">
            <div class="col-12 ">
              <!-- /.info-box -->
              <div class="small-box">
                <div class="inner">
                  <h2>{{ $totalStatuses }}</h2>
                  <p>Intenciones</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class=" col-md-8 col-lg-12">
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
          <div class="col-12 col-sm-6 col-md-12">
            <!-- Card 1 -->
            <div class="col-12">
              <div class="info-box ">
                <span class="info-box-icon"><i class="fas fa-thumbs-up"></i></span>
                <div class="info-box-content">
                  <div class="row">
                    <div class="col-6">
                      <span class="info-box-text"> {{ $creditCard['TARJETA'] }} </span>
                      <span class="info-box-number">{{ $creditCard['total'] }}</span>
                    </div>
                    <div class="col-6">
                      <span class="info-box-text text-right"><a href="{{ route('intentions.index') }}"
                          style="color: black; !important">Ver
                          Mas</a></span>
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
        <!-- PORCENTAJES -->
        <div class="card ">
          <div class="card-header">
            <h3 class="card-title">Perfiles Crediticios</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="col-12">
              @include('layouts.admin.date_filter', ['route' => route('intention_dashboard')])
            </div>
            <div class="chart">
              <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
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
      <!-- Card 1 -->
      <!-- /.col (LEFT) -->
    </div>
@endsection
@section('scriptsJs')

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard3.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- FLOT CHARTS -->
<script src="{{ asset('plugins/flot/jquery.flot.js') }}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{ asset('plugins/flot-old/jquery.flot.resize.min.js') }}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{ asset('plugins/flot-old/jquery.flot.pie.min.js') }}"></script>

<script>
  $(function () {

    var estados = [];
        var values = [];

        var estados = [<?php echo '"'.implode('","', $creditProfilesNames).'"' ?>];
        var values = [<?php echo '"'.implode('","', $creditProfilesValues).'"' ?>];

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  :estados,
      datasets: [
        {
          label               : 'Perfil Crediticio',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                :values
        },
        {

        },
      ]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    barChartData.datasets[0] = temp0

    var barChartOptions = {
    responsive : true,
    maintainAspectRatio : false,
    datasetFill : false
    }

    var barChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: estados,
      datasets: [
        {
          data: values,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })


    //- PIE CHART2 -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })


    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>


@endsection