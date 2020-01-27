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
                <div class="col-12 ">
                  @include('digitalchannelleads.layouts.card_total_leads')
                </div>
                <div class="col-12 ">
                  @include('digitalchannelleads.layouts.card_total_quotes')
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
                  <span class="info-box-text text-right"><a href="/Administrator/digitalchannelleads"
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
        <div>
          @include('digitalchannelleads.layouts.pie_channels')
        </div>
        @include('digitalchannelleads.layouts.pie_statuses')
        @include('digitalchannelleads.layouts.pie_assessors')
      </div>
      <div class="col-md-8">
        @include('digitalchannelleads.layouts.bar_statuses')
        <div class="row">
          <div class="col-12 ">
            @include('digitalchannelleads.layouts.pie_products')
            @include('digitalchannelleads.layouts.pie_service')
            <div hidden>
              @include('digitalchannelleads.layouts.pie_products_warranties')
              @include('digitalchannelleads.layouts.pie_products_wallets')
              @include('digitalchannelleads.layouts.pie_products_Insurance')
              @include('digitalchannelleads.layouts.pie_products_oportuya')
              @include('digitalchannelleads.layouts.pie_products_callCenter')
              {{-- @include('digitalchannelleads.layouts.pie_products_advanceUnit') --}}
            </div>

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