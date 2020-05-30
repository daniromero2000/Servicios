@extends('layouts.admin.app')
@section('linkStyleSheets')
<style>
  .main-header {
    min-width: 540px !important;
  }
</style>
@endsection
@section('content')
<section style="min-width: 540px">
  @include('layouts.errors-and-messages')
  @if(!is_null($factoryRequests))
  <div class="mx-auto" style="max-width: 1450px;">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-9 order-sm-last">
            <ol class="breadcrumb bradcrumb-reset float-sm-right">
              <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="/Administrator/dashboard/factoryrequestTurns">Dashboard
                  Turnos Fábrica</a>
              <li class="breadcrumb-item active"><a href="/Administrator/factoryrequestTurns">Turnos Fábrica</a></li>
            </ol>
          </div>
          <div class="col-sm-3 mt-2 order-sm-first">
            <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 btn-sm-reset">Regresar</a>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="card">
      <div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">Reportes</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6 col-sm-6 col-md-6">
                      <!-- /.info-box -->
                      <div class="small-box ">
                        <div class="inner">
                          <h2 class="titleCardNumber">{{ $listCount }}</h2>
                          @if (request()->input('from') != '')
                          <p class="textCardNumber">Total de Solicitudes</p>
                          @else
                          <p class="textCardNumber">Solicitudes en este mes</p>
                          @endif
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                      <div class="small-box ">
                        <div class="inner">
                          <h2 class="titleCardNumber">Total</h2>
                          <p>${{ number_format ($factoryRequestsTotal) }}</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-shopping-cart"></i>
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
                  @include('layouts.admin.search_turns', ['route' => route('factoryrequestTurns.index')])
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
                  @include('layouts.admin.tables.tables_factory_request_turns_status', [$headers, 'datas' =>
                  $factoryRequests ])
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

    </div>
  </div>
  @endif
</section>
@endsection

@section('scriptsJs')


@endsection