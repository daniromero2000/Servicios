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
          <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
              <!-- /.info-box -->
              <div class="small-box ">
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

        <div class="col-md-6">
          <!-- DEBE IR OCULTA-->
          <div hidden class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Line Chart</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                    class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px; min-height:250px"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
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
                    70% Increase in 30 Days
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
                @include('layouts.admin.date_filter', ['route' => route('intention_dashboard')])
              </div>
              <div class="col-12">
                <canvas id="pieChart" style="height:370px; min-height:300px"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- /.col (RIGTH) -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Solicitudes Web</h3>
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

      <!-- /.col (LEFT) -->
      <div class="col-md-8">
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
    </div>
    {{--
    <div class="row">
      <div class="col-12">
        <!-- interactive chart -->
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="far fa-chart-bar"></i>
              Interactive Area Chart
            </h3>

            <div class="card-tools">
              Real time
              <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="interactive" style="height: 300px;"></div>
          </div>
          <!-- /.card-body-->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-6">
        <!-- Line chart -->
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="far fa-chart-bar"></i>
              Line Chart
            </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div id="line-chart" style="height: 300px;"></div>
          </div>
          <!-- /.card-body-->
        </div>
        <!-- /.card -->

        <!-- Area chart -->
        <div hidden class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="far fa-chart-bar"></i>
              Area Chart
            </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div id="area-chart" style="height: 338px;" class="full-width-chart"></div>
          </div>
          <!-- /.card-body-->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->
      <div class="col-md-6">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="far fa-chart-bar"></i>
              Donut Chart
            </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div id="donut-chart" style="height: 300px;"></div>
          </div>
          <!-- /.card-body-->
        </div>
      </div>
      <div class="col-md-6">
        <!-- Bar chart -->
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="far fa-chart-bar"></i>
              Bar Chart
            </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div id="bar-chart" style="height: 300px;"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Online Store Visitors</h3>
              <a href="javascript:void(0);">View Report</a>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <span class="text-bold text-lg">820</span>
                <span>Visitors Over Time</span>
              </p>
              <p class="ml-auto d-flex flex-column text-right">
                <span class="text-success">
                  <i class="fas fa-arrow-up"></i> 12.5%
                </span>
                <span class="text-muted">Since last week</span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="visitors-chart" height="200"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
              <span class="mr-2">
                <i class="fas fa-square text-primary"></i> This Week
              </span>

              <span>
                <i class="fas fa-square text-gray"></i> Last Week
              </span>
            </div>
          </div>
        </div>
        <!-- /.card -->


      </div>
    </div>  --}}


    <!-- /.content-wrapper -->
    <!-- Content Wrapper. Contains page content -->

    {{-- <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>ChartJS</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">ChartJS</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">

            @foreach ($estados as $estado)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"> {{$estado->ESTADO }} </span>
    <span class="info-box-number">
      {{ $estado->total}}
    </span>
</div>
<!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
@endforeach

<!-- /.col -->
<!-- Main row -->
<div class="row">
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
    <!-- /.card-body -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div>
<!--/. container-fluid -->
</section> --}}

<!-- Main content -->
</div>
<!-- /.container-fluid -->

<!-- /.content -->

<!-- /.content-wrapper -->
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

<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
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

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
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