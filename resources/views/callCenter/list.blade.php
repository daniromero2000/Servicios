@extends('layouts.admin.app')
@section('content')

<section>
  @include('layouts.errors-and-messages')
  @if(!is_null($customers))
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 d-flex justify-content-end">
            <ol class="breadcrumb bradcrumb-reset float-sm-right">
              <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="/Administrator/dashboard/callCenter">Dashboard CallCenter</a>
              </li>
              <li class="breadcrumb-item active"><a href="/Administrator/callCenter">CallCenter</a></li>
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
              @include('layouts.admin.filter_callCenter', ['route' => route('callCenter.index')])
            </div>
            <div class=" mt-2 col-12 col-sm-12 col-md-12">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-6">
                  <!-- /.info-box -->
                  <div class="small-box ">
                    <div class="inner">
                      <h2>{{ $listCount }}</h2>
                      <p>Clientes </p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body text-center pt-0 pb-0 ">
              @if($customers)
              @include('layouts.admin.tables.tables_customer_status', [$headers, 'datas' => $customers ])
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