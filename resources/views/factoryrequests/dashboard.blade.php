@extends('layouts.admin.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<!-- Main content -->
<div class="container-fluid">

  <div class="row">
    <!-- /.col (RIGHT) -->
    <div class="col-md-4">
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
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Card 1 -->
      <div class="card ">
        <div class="card-header ">
          <h3 class="card-title ">Solicitudes Pendientes</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="areaChart" style="height:150px; min-height:150px"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Card 2 -->
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title">Solicitudes Fuera de Linea</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="areaChart" style="height:150px; min-height:150px"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- TORTA -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pie Chart</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="pieChart" style="height:330px; min-height:420px"></canvas>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      {{-- <!-- BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Bar Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card --> --}}



    </div>
    <!-- /.col (RIGHT) -->
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
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Card 1 -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Solicitudes Pendientes</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="areaChart" style="height:225px; min-height:225px"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->


    </div>
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
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

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
      <div class="card card-primary card-outline">
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
        <!-- /.card-body-->
      </div>
      <!-- /.card -->

    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->

  <!-- /.row -->


  <!-- /.content -->

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
</div><!-- /.container-fluid -->

<!-- /.content -->

<!-- /.content-wrapper -->
@endsection
@section('scriptsJs')
<!-- jQuery -->

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
<script>
  $(function () {
      /*
       * Flot Interactive Chart
       * -----------------------
       */
      // We use an inline data source in the example, usually data would
      // be fetched from a server
      var data = [],
        totalPoints = 100

      function getRandomData() {

        if (data.length > 0) {
          data = data.slice(1)
        }

        // Do a random walk
        while (data.length < totalPoints) {

          var prev = data.length > 0 ? data[data.length - 1] : 50,
            y = prev + Math.random() * 10 - 5

          if (y < 0) {
            y = 0
          } else if (y > 100) {
            y = 100
          }

          data.push(y)
        }

        // Zip the generated y values with the x values
        var res = []
        for (var i = 0; i < data.length; ++i) {
          res.push([i, data[i]])
        }

        return res
      }

      var interactive_plot = $.plot('#interactive', [
        {
          data: getRandomData(),
        }
      ],
        {
          grid: {
            borderColor: '#f3f3f3',
            borderWidth: 1,
            tickColor: '#f3f3f3'
          },
          series: {
            color: '#3c8dbc',
            lines: {
              lineWidth: 2,
              show: true,
              fill: true,
            },
          },
          yaxis: {
            min: 0,
            max: 100,
            show: true
          },
          xaxis: {
            show: true
          }
        }
      )

      var updateInterval = 500 //Fetch data ever x milliseconds
      var realtime = 'on' //If == to on then fetch data every x seconds. else stop fetching
      function update() {

        interactive_plot.setData([getRandomData()])

        // Since the axes don't change, we don't need to call plot.setupGrid()
        interactive_plot.draw()
        if (realtime === 'on') {
          setTimeout(update, updateInterval)
        }
      }

      //INITIALIZE REALTIME DATA FETCHING
      if (realtime === 'on') {
        update()
      }
      //REALTIME TOGGLE
      $('#realtime .btn').click(function () {
        if ($(this).data('toggle') === 'on') {
          realtime = 'on'
        }
        else {
          realtime = 'off'
        }
        update()
      })
      /*
       * END INTERACTIVE CHART
       */


      /*
       * LINE CHART
       * ----------
       */
      //LINE randomly generated data

      var sin = [],
        cos = []
      for (var i = 0; i < 14; i += 0.5) {
        sin.push([i, Math.sin(i)])
        cos.push([i, Math.cos(i)])
      }
      var line_data1 = {
        data: sin,
        color: '#3c8dbc'
      }
      var line_data2 = {
        data: cos,
        color: '#00c0ef'
      }
      $.plot('#line-chart', [line_data1, line_data2], {
        grid: {
          hoverable: true,
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor: '#f3f3f3'
        },
        series: {
          shadowSize: 0,
          lines: {
            show: true
          },
          points: {
            show: true
          }
        },
        lines: {
          fill: false,
          color: ['#3c8dbc', '#f56954']
        },
        yaxis: {
          show: true
        },
        xaxis: {
          show: true
        }
      })
      //Initialize tooltip on hover
      $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
        position: 'absolute',
        display: 'none',
        opacity: 0.8
      }).appendTo('body')
      $('#line-chart').bind('plothover', function (event, pos, item) {

        if (item) {
          var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2)

          $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
            .css({
              top: item.pageY + 5,
              left: item.pageX + 5
            })
            .fadeIn(200)
        } else {
          $('#line-chart-tooltip').hide()
        }

      })
      /* END LINE CHART */

      /*
       * FULL WIDTH STATIC AREA CHART
       * -----------------
       */
      var areaData = [[2, 88.0], [3, 93.3], [4, 102.0], [5, 108.5], [6, 115.7], [7, 115.6],
      [8, 124.6], [9, 130.3], [10, 134.3], [11, 141.4], [12, 146.5], [13, 151.7], [14, 159.9],
      [15, 165.4], [16, 167.8], [17, 168.7], [18, 169.5], [19, 168.0]]
      $.plot('#area-chart', [areaData], {
        grid: {
          borderWidth: 0
        },
        series: {
          shadowSize: 0, // Drawing is faster without shadows
          color: '#00c0ef',
          lines: {
            fill: true //Converts the line chart to area chart
          },
        },
        yaxis: {
          show: false
        },
        xaxis: {
          show: false
        }
      })

      /* END AREA CHART */

      /*
       * BAR CHART
       * ---------
       */

      var bar_data = {
        data: [[1, 10], [2, 8], [3, 4], [4, 13], [5, 17], [6, 9]],
        bars: { show: true }
      }
      $.plot('#bar-chart', [bar_data], {
        grid: {
          borderWidth: 1,
          borderColor: '#f3f3f3',
          tickColor: '#f3f3f3'
        },
        series: {
          bars: {
            show: true, barWidth: 0.5, align: 'center',
          },
        },
        colors: ['#3c8dbc'],
        xaxis: {
          ticks: [[1, 'January'], [2, 'February'], [3, 'March'], [4, 'April'], [5, 'May'], [6, 'June']]
        }
      })
      /* END BAR CHART */



    })

    /*
     * Custom Label formatter
     * ----------------------
     */
    function labelFormatter(label, series) {
      return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
        + label
        + '<br>'
        + Math.round(series.percent) + '%</div>'
    }
</script>

<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Page script -->
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
    var estados = [];
    var values = [];


var estados = [<?php echo '"'.implode('","', $statusesNames).'"' ?>];
var values = [<?php echo '"'.implode('","', $statusesValues).'"' ?>];

    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : estados,
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                :values
        }
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
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: estados,
      datasets: [
        {
          data: values,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#d2d6de'],
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

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]


    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions,
    })


  })
</script>
@endsection