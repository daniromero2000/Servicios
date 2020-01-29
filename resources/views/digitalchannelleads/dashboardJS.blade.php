<script>
  $(function () {

    var estados = [];
        var values = [];

        var estados = [<?php echo '"'.implode('","', $leadStatusesNames).'"' ?>];
        var values = [<?php echo '"'.implode('","', $leadStatusesValues).'"' ?>];

        var channels = [<?php echo '"'.implode('","', $leadChannelNames).'"' ?>];
        var channelsValues = [<?php echo '"'.implode('","', $leadChannelValues).'"' ?>];

        var assessors = [<?php echo '"'.implode('","', $leadAssessorsNames).'"' ?>];
        var assessorsValues = [<?php echo '"'.implode('","', $leadAssessorsValues).'"' ?>];

        var products = [<?php echo '"'.implode('","', $leadProductsNames).'"' ?>];
        var productsValues = [<?php echo '"'.implode('","', $leadProductsValues).'"' ?>];

        var service = [<?php echo '"'.implode('","', $leadServicesNames).'"' ?>];
        var serviceValues = [<?php echo '"'.implode('","', $leadServicesValues).'"' ?>];


        var leadInsurance = [<?php echo '"'.implode('","', $leadProductInsurances[0]).'"' ?>];
        var productInsuranceValues = [<?php echo '"'.implode('","', $leadProductInsurances[1]).'"' ?>];

        var productWarranties = [<?php echo '"'.implode('","', $leadProductWarranties[0]).'"' ?>];
        var productWarrantiesValues = [<?php echo '"'.implode('","', $leadProductWarranties[1]).'"' ?>];
   
        var leadOportuya = [<?php echo '"'.implode('","', $leadProductOportuyas[0]).'"' ?>];
        var productOportuyaValues = [<?php echo '"'.implode('","', $leadProductOportuyas[1]).'"' ?>];

        var leadCallCenter = [<?php echo '"'.implode('","', $leadProductsCallCenter[0]).'"' ?>];
        var productCallCenterValues = [<?php echo '"'.implode('","', $leadProductsCallCenter[1]).'"' ?>];

        var leadAdvancedUnit = [<?php echo '"'.implode('","', $leadProductsAdvancedUnit[0]).'"' ?>];
        var productAdvancedUnitValues = [<?php echo '"'.implode('","', $leadProductsAdvancedUnit[1]).'"' ?>];
        
        var productWallets = [<?php echo '"'.implode('","', $leadProductWallets[0]).'"' ?>];
        var productWalletsValues = [<?php echo '"'.implode('","', $leadProductWallets[1]).'"' ?>];

        var leadJuridical = [<?php echo '"'.implode('","', $leadProductJuridicales[0]).'"' ?>];
        var productJuridicalValues = [<?php echo '"'.implode('","', $leadProductJuridicales[1]).'"' ?>];
        
        var leadLibranzas = [<?php echo '"'.implode('","', $leadProductLibranzas[0]).'"' ?>];
        var productLibranzasValues = [<?php echo '"'.implode('","', $leadProductLibranzas[1]).'"' ?>];

        var leadEcommerces = [<?php echo '"'.implode('","', $leadProductEcommerces[0]).'"' ?>];
        var productEcommercesValues = [<?php echo '"'.implode('","', $leadProductEcommerces[1]).'"' ?>];
        

        var serviceInsurances = [<?php echo '"'.implode('","', $leadServiceInsurances[0]).'"' ?>];
        var serviceInsurancesValues = [<?php echo '"'.implode('","', $leadServiceInsurances[1]).'"' ?>];

        var serviceWarranties = [<?php echo '"'.implode('","', $leadServiceWarranties[0]).'"' ?>];
        var serviceWarrantiesValues = [<?php echo '"'.implode('","', $leadServiceWarranties[1]).'"' ?>];

        var serviceOportuyas = [<?php echo '"'.implode('","', $leadServiceOportuyas[0]).'"' ?>];
        var serviceOportuyasValues = [<?php echo '"'.implode('","', $leadServiceOportuyas[1]).'"' ?>];

        var serviceCallCenter = [<?php echo '"'.implode('","', $leadServicesCallCenter[0]).'"' ?>];
        var serviceCallCenterValues = [<?php echo '"'.implode('","', $leadServicesCallCenter[1]).'"' ?>];

        var serviceAdvancedUnit = [<?php echo '"'.implode('","', $leadServicesAdvancedUnit[0]).'"' ?>];
        var serviceAdvancedUnitValues = [<?php echo '"'.implode('","', $leadServicesAdvancedUnit[1]).'"' ?>];
        
        var serviceWallets = [<?php echo '"'.implode('","', $leadServiceWallets[0]).'"' ?>];
        var serviceWalletsValues = [<?php echo '"'.implode('","', $leadServiceWallets[1]).'"' ?>];

        var serviceJuridicales = [<?php echo '"'.implode('","', $leadServiceJuridicales[0]).'"' ?>];
        var serviceJuridicalesValues = [<?php echo '"'.implode('","', $leadServiceJuridicales[1]).'"' ?>];
        
        var serviceLibranzas = [<?php echo '"'.implode('","', $leadServiceLibranzas[0]).'"' ?>];
        var serviceLibranzasValues = [<?php echo '"'.implode('","', $leadServiceLibranzas[1]).'"' ?>];
        
        var serviceEcommerces = [<?php echo '"'.implode('","', $leadServiceEcommerces[0]).'"' ?>];
        var serviceEcommercesValues = [<?php echo '"'.implode('","', $leadServiceEcommerces[1]).'"' ?>];
 

        
        var statusInsurances = [<?php echo '"'.implode('","', $leadStatusInsurances[0]).'"' ?>];
        var statusInsurancesValues = [<?php echo '"'.implode('","', $leadStatusInsurances[1]).'"' ?>];

        var statusWarranties = [<?php echo '"'.implode('","', $leadStatusWarranties[0]).'"' ?>];
        var statusWarrantiesValues = [<?php echo '"'.implode('","', $leadStatusWarranties[1]).'"' ?>];

        var statusOportuyas = [<?php echo '"'.implode('","', $leadStatusOportuyas[0]).'"' ?>];
        var statusOportuyasValues = [<?php echo '"'.implode('","', $leadStatusOportuyas[1]).'"' ?>];

        var statusCallCenter = [<?php echo '"'.implode('","', $leadStatusCallCenter[0]).'"' ?>];
        var statusCallCenterValues = [<?php echo '"'.implode('","', $leadStatusCallCenter[1]).'"' ?>];

        var statusAdvancedUnit = [<?php echo '"'.implode('","', $leadStatusAdvancedUnit[0]).'"' ?>];
        var statusAdvancedUnitValues = [<?php echo '"'.implode('","', $leadStatusAdvancedUnit[1]).'"' ?>];
        
        var statusWallets = [<?php echo '"'.implode('","', $leadStatusWallets[0]).'"' ?>];
        var statusWalletsValues = [<?php echo '"'.implode('","', $leadStatusWallets[1]).'"' ?>];

        var statusJuridicales = [<?php echo '"'.implode('","', $leadStatusJuridicales[0]).'"' ?>];
        var statusJuridicalesValues = [<?php echo '"'.implode('","', $leadStatusJuridicales[1]).'"' ?>];
        
        var statusLibranzas = [<?php echo '"'.implode('","', $leadStatusLibranzas[0]).'"' ?>];
        var statusLibranzasValues = [<?php echo '"'.implode('","', $leadStatusLibranzas[1]).'"' ?>];
        
        var statusEcommerces = [<?php echo '"'.implode('","', $leadStatusEcommerces[0]).'"' ?>];
        var statusEcommercesValues = [<?php echo '"'.implode('","', $leadStatusEcommerces[1]).'"' ?>];

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  :estados,
      datasets: [
        {
          label               : 'Estados',
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
          backgroundColor : ['#007BFF', '#E62E08','#008F00','#F00909','#FF9100', '#9E0097','#215ACE', '#DD4477', '#E6194B', '#F58231', '#3CB44B','#08DED4','#C9EA00','#FBBA03','#F856CE','#001BC2','#732E18', ],
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
    var donutChartCanvas2 = $('#donutChart2').get(0).getContext('2d')
    var donutData2 = {
    labels: channels,
    datasets: [
    {
    data: channelsValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions2 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart2 = new Chart(donutChartCanvas2, {
    type: 'doughnut',
    data: donutData2,
    options: donutOptions2
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas3 = $('#donutChart3').get(0).getContext('2d')
    var donutData3 = {
    labels: assessors,
    datasets: [
    {
    data: assessorsValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions3 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart3 = new Chart(donutChartCanvas3, {
    type: 'doughnut',
    data: donutData3,
    options: donutOptions3
    })

    
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas4 = $('#donutChart4').get(0).getContext('2d')
    var donutData4 = {
    labels: products,
    datasets: [
    {
    data: productsValues,
    backgroundColor : ['#007BFF', '#E62E08','#008F00','#F00909','#FF9100', '#9E0097','#215ACE', '#DD4477', '#E6194B', '#F58231', '#3CB44B','#08DED4','#C9EA00','#FBBA03','#F856CE','#001BC2','#732E18', ],
    }
    ]
    }
    var donutOptions4 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart4 = new Chart(donutChartCanvas4, {
    type: 'doughnut',
    data: donutData4,
    options: donutOptions4
    })

    
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas5 = $('#donutChart5').get(0).getContext('2d')
    var donutData5 = {
    labels: service,
    datasets: [
    {
    data: serviceValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions5 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart5 = new Chart(donutChartCanvas5, {
    type: 'doughnut',
    data: donutData5,
    options: donutOptions5
    })

        //-------------
    //- DONUT CHART  - productWarranties
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas6 = $('#donutChart6').get(0).getContext('2d')
    var donutData6 = {
    labels: productWarranties,
    datasets: [
    {
    data: productWarrantiesValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions6 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart6 = new Chart(donutChartCanvas6, {
    type: 'doughnut',
    data: donutData6,
    options: donutOptions6
    })


        //-------------
    //- DONUT CHART - productWallets
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas7 = $('#donutChart7').get(0).getContext('2d')
    var donutData7 = {
    labels: productWallets,
    datasets: [
    {
    data: productWalletsValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions7 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart7 = new Chart(donutChartCanvas7, {
    type: 'doughnut',
    data: donutData7,
    options: donutOptions7
    })

       //-------------
    //- DONUT CHART - leadInsurance
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas8 = $('#donutChart8').get(0).getContext('2d')
    var donutData8 = {
    labels: leadInsurance,
    datasets: [
    {
    data: productInsuranceValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions8 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart8 = new Chart(donutChartCanvas8, {
    type: 'doughnut',
    data: donutData8,
    options: donutOptions8
    })

      //-------------
    //- DONUT CHART -  leadOportuya
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas9 = $('#donutChart9').get(0).getContext('2d')
    var donutData9 = {
    labels: leadOportuya,
    datasets: [
    {
    data: productOportuyaValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions9 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart9 = new Chart(donutChartCanvas9, {
    type: 'doughnut',
    data: donutData9,
    options: donutOptions9
    })

     //-------------
    //- DONUT CHART - leadCallCenter
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas10 = $('#donutChart10').get(0).getContext('2d')
    var donutData10 = {
    labels: leadCallCenter,
    datasets: [
    {
    data: productCallCenterValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions10 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart10 = new Chart(donutChartCanvas10, {
    type: 'doughnut',
    data: donutData10,
    options: donutOptions10
    })

    //-------------
    //- DONUT CHART - leadAdvancedUnit
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas11 = $('#donutChart11').get(0).getContext('2d')
    var donutData11 = {
    labels: leadAdvancedUnit,
    datasets: [
    {
    data: productAdvancedUnitValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions11 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart11 = new Chart(donutChartCanvas11, {
    type: 'doughnut',
    data: donutData11,
    options: donutOptions11
    })

      //-------------
    //- DONUT CHART - leadJuridical
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas12 = $('#donutChart12').get(0).getContext('2d')
    var donutData12 = {
    labels: leadJuridical,
    datasets: [
    {
    data: productJuridicalValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions12 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart12 = new Chart(donutChartCanvas12, {
    type: 'doughnut',
    data: donutData12,
    options: donutOptions12
    });

     //-------------
    //- DONUT CHART -  leadLibranzas
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas13 = $('#donutChart13').get(0).getContext('2d')
    var donutData13 = {
    labels: leadLibranzas,
    datasets: [
    {
    data: productLibranzasValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions13 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart13 = new Chart(donutChartCanvas13, {
    type: 'doughnut',
    data: donutData13,
    options: donutOptions13
    });

     //-------------
    //- DONUT CHART - leadEcommerces
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas14 = $('#donutChart14').get(0).getContext('2d')
    var donutData14 = {
    labels: leadEcommerces,
    datasets: [
    {
    data: productEcommercesValues,
    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
    }
    ]
    }
    var donutOptions14 = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart14 = new Chart(donutChartCanvas14, {
    type: 'doughnut',
    data: donutData14,
    options: donutOptions14
    });

        //- PIE CHART3 -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart3').get(0).getContext('2d')
        var pieData = donutData3;
        var pieOptions = {
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

         //- PIE CHART4 -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart4').get(0).getContext('2d')
        var pieData = donutData4;
        var pieOptions = {
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

         //- PIE CHART5 -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart5').get(0).getContext('2d')
        var pieData = donutData5;
        var pieOptions = {
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

        
         //- PIE CHART - 6
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart6').get(0).getContext('2d')
        var pieData = donutData6;
        var pieOptions = {
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

        //- PIE CHART - 7
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart7').get(0).getContext('2d')
        var pieData = donutData7;
        var pieOptions = {
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

        //- PIE CHART - 8
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart8').get(0).getContext('2d')
        var pieData = donutData8;
        var pieOptions = {
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

         //- PIE CHART - 9
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart9').get(0).getContext('2d')
        var pieData = donutData9;
        var pieOptions = {
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

          //- PIE CHART - 10
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart10').get(0).getContext('2d')
        var pieData = donutData10;
        var pieOptions = {
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

          //- PIE CHART - 11
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart11').get(0).getContext('2d')
        var pieData = donutData11;
        var pieOptions = {
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


        //- PIE CHART - 12
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart12').get(0).getContext('2d')
        var pieData = donutData12;
        var pieOptions = {
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

        //- PIE CHART - 13
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart13').get(0).getContext('2d')
        var pieData = donutData13;
        var pieOptions = {
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

        
        //- PIE CHART - 14
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart14').get(0).getContext('2d')
        var pieData = donutData14;
        var pieOptions = {
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

        
        //- PIE CHART - 15
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart15').get(0).getContext('2d')
        var pieData = donutData15 = {
        labels: serviceInsurances,
        datasets: [
        {
        data: serviceInsurancesValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

         
        //- PIE CHART - 16
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart16').get(0).getContext('2d')
        var pieData = donutData16 = {
        labels: serviceWarranties,
        datasets: [
        {
        data: serviceWarrantiesValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

         
        //- PIE CHART - 17
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart17').get(0).getContext('2d')
        var pieData = donutData17 = {
        labels: serviceOportuyas,
        datasets: [
        {
        data: serviceOportuyasValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

         //- PIE CHART - 18
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart18').get(0).getContext('2d')
        var pieData = donutData18 = {
        labels: serviceCallCenter,
        datasets: [
        {
        data: serviceCallCenterValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

         //- PIE CHART - 19
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart19').get(0).getContext('2d')
        var pieData = donutData19 = {
        labels: serviceAdvancedUnit,
        datasets: [
        {
        data: serviceAdvancedUnitValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

         //- PIE CHART - 20
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart20').get(0).getContext('2d')
        var pieData = donutData20 = {
        labels: serviceWallets,
        datasets: [
        {
        data: serviceWalletsValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

            //- PIE CHART - 21
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart21').get(0).getContext('2d')
        var pieData = donutData21 = {
        labels: serviceJuridicales,
        datasets: [
        {
        data: serviceJuridicalesValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

          //- PIE CHART - 22
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart22').get(0).getContext('2d')
        var pieData = donutData22 = {
        labels: serviceLibranzas,
        datasets: [
        {
        data: serviceLibranzasValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

          //- PIE CHART - 23
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart23').get(0).getContext('2d')
        var pieData = donutData23 = {
        labels: serviceEcommerces,
        datasets: [
        {
        data: serviceEcommercesValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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


         //- PIE CHART - 24
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart24').get(0).getContext('2d')
        var pieData = donutData24 = {
        labels: statusInsurances,
        datasets: [
        {
        data: statusInsurancesValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

        
         //- PIE CHART - 25
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart25').get(0).getContext('2d')
        var pieData = donutData25 = {
        labels: statusWarranties,
        datasets: [
        {
        data: statusWarrantiesValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

         //- PIE CHART - 26
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart26').get(0).getContext('2d')
        var pieData = donutData26 = {
        labels: statusOportuyas,
        datasets: [
        {
        data: statusOportuyasValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

        //- PIE CHART - 27
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart27').get(0).getContext('2d')
        var pieData = donutData27 = {
        labels: statusCallCenter,
        datasets: [
        {
        data: statusCallCenterValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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


        //- PIE CHART - 28
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart28').get(0).getContext('2d')
        var pieData = donutData28 = {
        labels: statusAdvancedUnit,
        datasets: [
        {
        data: statusAdvancedUnitValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

        
        //- PIE CHART - 29
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart29').get(0).getContext('2d')
        var pieData = donutData29 = {
        labels: statusWallets,
        datasets: [
        {
        data: statusWalletsValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

         //- PIE CHART - 30
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart30').get(0).getContext('2d')
        var pieData = donutData30 = {
        labels: statusJuridicales,
        datasets: [
        {
        data: statusJuridicalesValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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


        //- PIE CHART - 31
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart31').get(0).getContext('2d')
        var pieData = donutData31 = {
        labels: statusLibranzas,
        datasets: [
        {
        data: statusLibranzasValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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


       //- PIE CHART - 32
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart32').get(0).getContext('2d')
        var pieData = donutData32 = {
        labels: statusEcommerces,
        datasets: [
        {
        data: statusEcommercesValues,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007BFF', '#E62E08'],
        }
        ]
        };
        var pieOptions = {
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

    //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
      var pieData = donutData2;
      var pieOptions2 = {
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