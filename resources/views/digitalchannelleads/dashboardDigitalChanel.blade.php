@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="digitalChanels-tab" data-toggle="pill"
                                    href="#digitalChanels" role="tab" aria-controls="custom-tabs-three-settings"
                                    aria-selected="true">Canal
                                    Digital</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel"
                                aria-labelledby="custom-tabs-three-home-tab">
                            </div>
                            <div class="tab-pane fade active show" id="digitalChanels" role="tabpanel"
                                aria-labelledby="digitalChanels-tab">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="col-12 col-sm-12">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-12 ">
                                                    <div class="row">
                                                        <div class="col-12 ">
                                                            @include('digitalchannelleads.layouts.card_total_leads_digitalChanel')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @include('digitalchannelleads.layouts.pie_statuses.pie_statuses_digitalChanel')
                                    </div>
                                    <div class="col-12 col-md-8">
                                        @include('digitalchannelleads.layouts.pie_services.pie_service_digitalChanel')
                                        @include('digitalchannelleads.layouts.pie_products.pie_products_digitalChanel')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
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
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
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
@endsection
@include('layouts.admin.dashboard_imports')
@include('digitalchannelleads.dashboardJS')
@endsection