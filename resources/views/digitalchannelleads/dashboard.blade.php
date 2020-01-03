@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
  <section class="content">
    <div class="row mt-2">
      <!-- /.col (RIGHT) -->
      <div class="col-sm-12 col-md-5 col-lg-4">
        <div class="col-12 col-sm-12">
          <div class="row d-flex justify-content-center">
            <div class="col-12 ">
              <!-- /.info-box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h2>{{ $totalStatuses }}</h2>
                  <p style="margin-bottom: -4px !important;">Leads</p>
                </div>
                <div class="icon mt-3">
                  <i class="ion ion-stats-bars" style="color: white;"></i>
                </div>
                <div class="text-right mr-2">
                  <span class="info-box-text text-right"><a href="/Administrator/digitalchannelleads"
                      style="color: white; !important">Ver
                      Mas</a></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('digitalchannelleads.layouts.pie_channels')
        @include('digitalchannelleads.layouts.pie_statuses')
      </div>
      @include('digitalchannelleads.layouts.bar_statuses')
    </div>
    <div class="row">
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
        </div>
      </div>
    </div>
    @include('digitalchannelleads.layouts.pie_assessors')
</div>
@endsection
@include('layouts.admin.dashboard_imports')
@include('digitalchannelleads.dashboardJS')
@endsection