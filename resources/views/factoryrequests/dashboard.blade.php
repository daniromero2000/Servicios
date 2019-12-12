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
                <p>Solicitudes Crédito</p>
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
              @include('layouts.admin.date_filter', ['route' => route('factory_dashboard')])
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
        <div class="card-body">
          <div class="chart">
            <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
          </div>
        </div>
      </div>
    </div>
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
      var estados = [];
        var values = [];


        var estados = [<?php echo '"'.implode('","', $statusesNames).'"' ?>];
        var values = [<?php echo '"'.implode('","', $statusesValues).'"' ?>];

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

 /*
       * DONUT CHART
       * -----------
       */

       var donutData = [
        {
          label: 'Aprobados',
          data: 30,
          color: '#3c8dbc'
        },
        {
          label: 'Pendientes',
          data: 20,
          color: '#0073b7'
        },
        {
          label: 'Series4',
          data: 50,
          color: '#00c0ef'
        }
      ]
      $.plot('#donut-chart', donutData, {
        series: {
          pie: {
            show: true,
            radius: 1,
            innerRadius: 0.0,
            label: {
              show: true,
              radius: 2 / 3,
              formatter: labelFormatter,
              threshold: 0.1
            }

          }
        },
        legend: {
          show: false
        }
      })
      /*
       * END DONUT CHART
       */
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
    var statusesColors = [];
    var webValues = [];
    var webNames = [];
    var webColors = [];

    var estados = [<?php echo '"'.implode('","', $statusesNames).'"' ?>];
    var values = [<?php echo '"'.implode('","', $statusesValues).'"' ?>];
    var webNames = [<?php echo '"'.implode('","', $webNames).'"' ?>];
    var webValues = [<?php echo '"'.implode('","', $webValues).'"' ?>];
    var StatusesColors = [<?php echo '"'.implode('","', $statusesColors).'"' ?>];
    var webColors = [<?php echo '"'.implode('","', $webColors).'"' ?>];

    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : estados,
      datasets: [
        {
          label               : 'Estados',
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
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
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
          backgroundColor : ['#215ACE', '#E62E08','#008F00','#F00909','#FF9100','#007BFF',  '#9E0097', '#DD4477', '#E6194B', '#F58231', '#3CB44B','#08DED4','#C9EA00','#FBBA03','#F856CE','#001BC2','#732E18', ],
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
      //- DONUT CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.

      var donutData2 = {
      labels: webNames,
      datasets: [
      {
      data: webValues,
      backgroundColor : ['#215ACE', '#E62E08','#008F00','#F00909','#FF9100','#007BFF',  '#9E0097', '#DD4477', '#E6194B', '#F58231', '#3CB44B','#08DED4','#C9EA00','#FBBA03','#F856CE','#001BC2','#732E18', ],

      }
      ]
      }
      var donutOptions2 = {
      maintainAspectRatio : false,
      responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var donutChart2 = new Chart(donutChartCanvas, {
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
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
    var pieData        = donutData2;
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
      maintainAspectRatio     : true,
      datasetFill             : true
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions,
    })
  })
</script>
@endsection