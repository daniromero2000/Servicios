@extends('layouts.admin.app')
@section('content')

<section style="min-width: 420px; margin: auto;">
  @include('layouts.errors-and-messages')
  @if(!is_null($customers))
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <ol class="breadcrumb bradcrumb-reset float-sm-right">
              <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="/Administrator/dashboard/customers">Dashboard Clientes</a></li>
              <li class="breadcrumb-item active"><a href="/Administrator/customers">Clientes</a></li>
            </ol>
          </div><!-- /.col -->
          <div class="col-12">
            <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 btn-sm-reset">Regresar</a>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div>
      <div class="p-3" style="max-width: 1450px;margin: auto;">
        <div class="row" ng-if="filtros">
          {{-- <div class="card-header">
              @include('layouts.admin.filter_customers', ['route' => route('customers.index')])
            </div> --}}
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
                <div class="row">
                  <div class="col-6 col-md-6">
                    <!-- /.info-box -->
                    <div class="small-box ">
                      <div class="inner">
                        <h2 class="titleCardNumber titleCardNumberForTotals">{{ $listCount }}</h2>
                        @if (request()->input() )
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
                @include('layouts.admin.filter_customers', ['route' => route('customers.index')])
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
                @if($customers)
                @include('layouts.admin.tables.customer_status_table', [$headers, 'datas' => $customers ])
                @include('layouts.admin.pagination.pagination', [$skip])
                @else
                @include('layouts.admin.pagination.pagination_null', [$skip])
                @endif
              </div>
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