<script>
  $(function () {

    var estados = [];
    var values = [];

    var estados = [<?php echo '"'.implode('","', $creditProfilesNames).'"' ?>];
    var values = [<?php echo '"'.implode('","', $creditProfilesValues).'"' ?>];


    var statuses = [];
    var valores = [];

    var statuses = [<?php echo '"'.implode('","', $intentionStatusesNames).'"' ?>];
    var valores = [<?php echo '"'.implode('","', $intentionStatusesValues).'"' ?>];

    var deviceNames = [];
    var deviceValues = [];

    var deviceNames = [<?php echo '"'.implode('","', $deviceNames).'"' ?>];
    var deviceValues = [<?php echo '"'.implode('","', $deviceValues).'"' ?>];

    var browserNames = [];
    var browserValues = [];

    var browserNames = [<?php echo '"'.implode('","', $browserNames).'"' ?>];
    var browserValues = [<?php echo '"'.implode('","', $browserValues).'"' ?>];

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
      labels: statuses,
      datasets: [
        {
          data: valores,
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
    });

    var donutData3 = {
      labels: deviceNames,
      datasets: [
      {
      data: deviceValues,
      backgroundColor : ['#215ACE', '#E62E08','#008F00','#F00909','#FF9100','#007BFF',  '#9E0097', '#DD4477', '#E6194B', '#F58231', '#3CB44B','#08DED4','#C9EA00','#FBBA03','#F856CE','#001BC2','#732E18', ],

      }
      ]
      }
      var donutOptions3 = {
      maintainAspectRatio : false,
      responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var donutChart3 = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData3,
      options: donutOptions
      })


    //-------------
    //- PIE CHART4 -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart3').get(0).getContext('2d')
    var pieData3        = donutData3;
    var pieOptions3     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart3 = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData3,
      options: pieOptions3
    })   


    var donutData4 = {
      labels: browserNames,
      datasets: [
      {
      data: browserValues,
      backgroundColor : ['#215ACE', '#E62E08','#008F00','#F00909','#FF9100','#007BFF',  '#9E0097', '#DD4477', '#E6194B', '#F58231', '#3CB44B','#08DED4','#C9EA00','#FBBA03','#F856CE','#001BC2','#732E18', ],

      }
      ]
      }
      var donutOptions4 = {
      maintainAspectRatio : false,
      responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var donutChart4 = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData4,
      options: donutOptions
      })


    //-------------
    //- PIE CHART3 -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart4').get(0).getContext('2d')
    var pieData4        = donutData4;
    var pieOptions4     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart4 = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData4,
      options: pieOptions4
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