@extends('layouts.admin.app')
@section('linkStyleSheets')
<style>
  .main-header {
    min-width: 540px !important;
  }
</style>
@endsection
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/Administrator/dashboard/">Dashboard </a></li>
          <li class="breadcrumb-item active"><a href="/Administrator/dashboard/factoryrequestTurns">Dashboard
              Solicitudes
              Fábrica</a>
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div style="min-width: 540px">
  <div class="container-fluid">
    <div class="row mt-2">
      <div class="order-md-last  col-md-7 col-lg-8">
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
              @include('layouts.admin.date_filter', ['route' => route('factoryTurns_dashboard')])
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 col-md-6 col-xl-3">
            <!-- /.info-box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h2 class="titleCardNumber titleCardNumberForTotals">@if ($valuesOfStatusesAprobados !=0 )
                  ${{number_format( $valuesOfStatusesAprobados )}} @else $0
                  @endif </h2>
                @if ($_GET && $_GET['from'] != '' && $_GET['to'] != '')
                <p class="textCardNumber textCardNumberForTotals">Total Vendidos</p>
                @else
                <p class="textCardNumber textCardNumberForTotals">Total Vendidos en este mes</p>
                @endif
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-6 col-xl-3">
            <!-- /.info-box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h2 class="titleCardNumber titleCardNumberForTotals">@if ($valuesOfStatusesNegados !=0 )
                  ${{number_format( $valuesOfStatusesNegados )}}@else $0
                  @endif </h2>
                @if ($_GET && $_GET['from'] != '' && $_GET['to'] != '')
                <p class="textCardNumber textCardNumberForTotals">Total Negados</p>
                @else
                <p class="textCardNumber textCardNumberForTotals">Total Negados en este mes</p>
                @endif
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-6 col-xl-3">
            <!-- /.info-box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h2 class="titleCardNumber titleCardNumberForTotals">@if ($valuesOfStatusesDesistidos !=0 )
                  ${{number_format( $valuesOfStatusesDesistidos )}} @else $0 @endif </h2>
                @if ($_GET && $_GET['from'] != '' && $_GET['to'] != '')
                <p class="textCardNumber textCardNumberForTotals">Total Desistidos</p>
                @else
                <p class="textCardNumber textCardNumberForTotals">Total Desistidos en este mes</p>
                @endif
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-6 col-xl-3">
            <!-- /.info-box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h2 class="titleCardNumber titleCardNumberForTotals">@if ($valuesOfStatusesPendientes !=0 )
                  ${{number_format( $valuesOfStatusesPendientes )}} @else $0 @endif</h2>
                @if ($_GET && $_GET['from'] != '' && $_GET['to'] != '')
                <p class="textCardNumber textCardNumberForTotals">Total Pendientes</p>
                @else
                <p class="textCardNumber textCardNumberForTotals">Total Pendientes en este mes</p>
                @endif
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
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
      <div class="order-md-first col-sm-12 col-md-5 col-lg-4">
        <div class="col-12 col-sm-12">
          <div class="row">
            <div class="col-12">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h2 class="titleCardNumber ">{{ $totalStatuses }}</h2>
                  @if ($_GET && $_GET['from'] != '')
                  <p class="textCardNumber textCardNumberForTotals">Total Solicitudes</p>
                  @else
                  <p class="textCardNumber textCardNumberForTotals">Solicitudes Crédito en este mes</p>
                  @endif
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <div class="text-right mr-2">
                  <span class="info-box-text text-right">
                    <a href="/Administrator/factoryrequestTurns" style="color: white; !important">Ver
                      Más</a></span>
                </div>
              </div>
            </div>
            <div class="col-12 ">
              <div class="small-box bg-success">
                <div class="inner">
                  <h4 class="titleCardNumber titleCardNumberForTotals">${{ number_format ($factoryRequestsTotal) }}
                  </h4>
                  @if ($_GET && $_GET['from'] != '')
                  <p class="textCardNumber textCardNumberForTotals">Total </p>
                  @else
                  <p class="textCardNumber textCardNumberForTotals">Total en este mes</p>
                  @endif
                </div>
                <div class="icon">
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="text-right mr-2">
                  <span class="info-box-text text-right">
                    <a href="/Administrator/factoryrequestTurns" style="color: white; !important">Ver
                      Más</a></span>
                </div>
              </div>
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
          <div class="card-body px-1">
            <div class="row ">
              <div class="col-12 col-sm-6 col-md-12">
                <!-- Card 1 -->
                <div class="col-12">
                  <div class="info-box ">
                    <span class="info-box-icon"><i class="fas fa-thumbs-up"></i></span>
                    <div class="info-box-content">
                      <div class="row">
                        <div class="col-6">
                          <span class="info-box-text">Aprobados</span>
                          <span class="info-box-number">@if (empty($statusesAprobadosValues))
                            0 @else
                            {{ number_format($statusesAprobadosValues) }}
                            @endif</span>
                        </div>
                        <div class="col-6">
                          <span class="info-box-text text-right"><a href="/Administrator/factoryrequestTurns"
                              style="color: black; !important">Ver
                              Más</a></span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                      </div>
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
                          <span class="info-box-number">@if (empty($statusesPendientesValues))
                            0 @else
                            {{ number_format($statusesPendientesValues) }}
                            @endif
                          </span>
                        </div>
                        <div class="col-6">
                          <span class="info-box-text text-right"><a href="/Administrator/factoryrequestTurns"
                              style="color: black; !important">Ver
                              Más</a></span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                      </div>
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
                          <span class="info-box-number">
                            @if (empty($statusesDesistidosValues))
                            0 @else
                            {{ number_format($statusesDesistidosValues[0]) }}
                            @endif</span>
                        </div>
                        <div class="col-6">
                          <span class="info-box-text text-right"><a href="/Administrator/factoryrequestTurns"
                              style="color: black; !important">Ver
                              Más</a></span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-12">
                <!-- Card 3 -->
                <div class="col-12">
                  <div class="info-box ">
                    <span class="info-box-icon"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                      <div class="row">
                        <div class="col-6">
                          <span class="info-box-text">En Comite</span>
                          <span class="info-box-number">
                            @if (empty($statusesComitesValues))
                            0 @else
                            {{ number_format($statusesComitesValues[0]) }}
                            @endif</span>
                        </div>
                        <div class="col-6">
                          <span class="info-box-text text-right"><a href="/Administrator/factoryrequestTurns"
                              style="color: black; !important">Ver
                              Más</a></span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                      </div>
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
                          <span class="info-box-number">@if (empty($statusesNegadoValues))
                            0 @else
                            {{ number_format($statusesNegadoValues[0]) }}
                            @endif</span>
                        </div>
                        <div class="col-6">
                          <span class="info-box-text text-right"><a href="/Administrator/factoryrequestTurns"
                              style="color: black; !important">Ver
                              Más</a></span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
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
        </div>

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
            <div>
              <canvas id="pieChart2" style="height:302px; min-height:auto"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
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
</div>

@endsection
@include('layouts.admin.dashboard_imports')
@include('factoryrequestsTurns.dashboardJS')

@endsection