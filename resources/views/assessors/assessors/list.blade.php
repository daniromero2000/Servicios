@extends('layouts.admin.app')
@section('content')

<section>
  @include('layouts.errors-and-messages')
  @if(!is_null($factoryRequests))
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">

            <div class="row">
              <div class="col-md-12">

              </div>

            </div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="/Administrator/assessors">Solicitudes</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container">
      <div class="card  mb-4 border-0 shadow-lg">
        <div class="row form-group" ng-if="filtros">
          <div class="col-12">
            <div class="card-header">
              @include('layouts.admin.filter_assessors', ['route' => route('assessors.index')])
            </div>
            <div class=" mt-2 col-12 col-sm-6 col-md-12">
              <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                  <!-- /.info-box -->
                  <div class="small-box ">
                    <div class="inner">
                      <h2>{{ $listCount }}</h2>
                      <p>Solicitudes</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                  <div class="small-box ">
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
            <div class="card-body text-center pt-0 pb-0 ">
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
  </div>
  @endif
</section>
@endsection

@section('scriptsJs')


@endsection