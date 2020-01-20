@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
  <section class="content">
    <div class="row mt-3">
      <div class="col-sm-12 col-md-5 col-lg-4">
        <div class="col-12 col-sm-12">
          <div class="row d-flex justify-content-center">
            <div class="col-12 ">
              <div class="row">

                <!-- /.info-box -->
                <div class="col-12 ">
                  <div class="small-box bg-primary">
                    <div class="inner">
                      <h2>{{ $totalStatuses }}</h2>
                      <p style="margin-bottom: -4px !important;">Leads en los últimos 30 días</p>
                    </div>
                    <div class="icon mt-3">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    <div class="text-right mr-2">
                      <span class="info-box-text text-right">
                        <a href="/Administrator/digitalchannelleads" style="color: white; !important">Ver
                          Más</a></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 ">
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h4 class="mt-2">${{ number_format ($pricesTotal) }}</h3>
                        <p style="margin-bottom: -4px !important;">Total Cotizado </p>
                    </div>
                    <br>
                    <div class="icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div style="margin-top: -5px;" class="text-right mr-2">
                      <span class="info-box-text text-right">
                        <a href="/Administrator/digitalchannelleads" style="color: white; !important">Ver
                          Más</a></span>
                    </div>
                  </div>
                </div>
              </div>


            </div>

          </div>

        </div>

        <div class="col-12">
          <div class="info-box ">
            <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
              <div class="row">
                <div class="col-6">
                  <span class="info-box-text">Vendidos</span>
                  <span class="info-box-number"> ${{number_format($leadpriceTotal)}}</span>
                </div>
                <div class="col-6">
                  <span class="info-box-text text-right"><a href="{{ route('assessors.index') }}"
                      style="color: black; !important">Ver
                      Más</a></span>
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
        @include('digitalchannelleads.layouts.pie_channels')
        @include('digitalchannelleads.layouts.pie_statuses')
        @include('digitalchannelleads.layouts.pie_assessors')

      </div>
      <div class="col-md-8">
        @include('digitalchannelleads.layouts.bar_statuses')
        <div class="row">

          <div class="col-12 ">
            @include('digitalchannelleads.layouts.pie_products')
            @include('digitalchannelleads.layouts.pie_service')
          </div>


        </div>



      </div>
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

</div>
@endsection
@include('layouts.admin.dashboard_imports')
@include('digitalchannelleads.dashboardJS')
@endsection