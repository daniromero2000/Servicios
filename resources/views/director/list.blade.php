@extends('layouts.admin.app')
@section('content')

<section style="min-width: 420px; margin: auto;">
  @include('layouts.errors-and-messages')
  @if(!is_null($factoryRequests))
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 d-flex justify-content-end">
            <ol class="breadcrumb bradcrumb-reset float-sm-right">
              <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="/Administrator/dashboard/director">Dashboard Directores</a>
              </li>
              <li class="breadcrumb-item active"><a href="/Administrator/director">Director</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div style="max-width: 1450px;margin: auto;">

      <div class="row m-auto p-2">
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Reportes</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                    class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body p-2">
              <div class="row form-group">
                <div class="col-6 col-md-6">
                  <!-- /.info-box -->
                  <div class="small-box ">
                    <div class="inner">
                      <h2 class="titleCardNumber titleCardNumberForTotals">{{ $listCount }}</h2>
                      @if ($_GET )
                      <p class="textCardNumber ">Total de Solicitudes</p>
                      @else
                      <p class="textCardNumber">Solicitudes en este mes</p>
                      @endif
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-6">
                  <!-- /.info-box -->
                  <div class="small-box ">
                    <div class="inner">
                      <h2 class="titleCardNumber titleCardNumberForTotals">
                        ${{ number_format ($factoryRequestsTotal) }}</h2>
                      @if ($_GET )
                      <p class="textCardNumber">Total</p>
                      @else
                      <p class="textCardNumber">Total en este mes</p>
                      @endif
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3">
                  <!-- /.info-box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h2 class="titleCardNumber titleCardNumberForTotals">@if ($statusesAprobadosValues !=0 )
                        ${{number_format( $statusesAprobadosValues )}} @else $0
                        @endif </h2>
                      @if (request()->input('from') != '')
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
                <div class="col-6 col-md-6 col-lg-3">
                  <!-- /.info-box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h2 class="titleCardNumber titleCardNumberForTotals">@if ($statusesNegadosValues !=0 )
                        ${{number_format( $statusesNegadosValues )}}@else $0
                        @endif </h2>
                      @if (request()->input('from') != '')
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
                <div class="col-6 col-md-6 col-lg-3">
                  <!-- /.info-box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h2 class="titleCardNumber titleCardNumberForTotals">@if ($statusesDesistidosValues !=0 )
                        ${{number_format( $statusesDesistidosValues )}} @else $0 @endif </h2>
                      @if (request()->input('from') != '')
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
                <div class="col-6 col-md-6 col-lg-3">
                  <!-- /.info-box -->
                  <div class="small-box bg-secondary">
                    <div class="inner">
                      <h2 class="titleCardNumber titleCardNumberForTotals">@if ($statusesPendientesValues !=0 )
                        ${{number_format( $statusesPendientesValues )}} @else $0 @endif</h2>
                      @if (request()->input('from') != '')
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
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xl-3">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Filtros</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                    class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              @include('layouts.admin.filter_director', ['route' => route('director.index')])
            </div>
          </div>
        </div>
        <div class="col-md-8 col-xl-9">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Turnos</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                    class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body px-0">
              @if($factoryRequests)
              @include('layouts.admin.tables.tables_factory_requests_status', [$headers, 'datas' => $factoryRequests ])
              @include('layouts.admin.pagination.pagination', [$skip])
              @else
              @include('layouts.admin.pagination.pagination_null', [$skip])
              @endif
            </div>
          </div>

        </div>
      </div>
    </div>
    @include('layouts.admin.button_float')
  </div>

  @endif
</section>
@endsection

@section('scriptsJs')


@endsection