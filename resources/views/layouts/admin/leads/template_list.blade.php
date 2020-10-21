<div class="container-fluid">
    <div class="card  mb-4 border-0 shadow-lg">
        <div class="row form-group" ng-if="filtros">
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
                                        <h2 class="titleCardNumber titleCardNumberForTotals">{{ $listCount }}
                                        </h2>
                                        @if (request()->input() )
                                        <p class="textCardNumber ">Total de leads</p>
                                        @else
                                        <p class="textCardNumber">leads en este mes</p>
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
                        @include('layouts.admin.filter_digital_channel_leads', ['route' =>
                        route($route)])
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xl-9">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Leads</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        @if($data)
                        @include('layouts.admin.tables.table_digital_channel_leads_status', [$headers,
                        'datas' =>
                        $data, 'cities' => $cities, 'channels' => $channels, 'services' =>
                        $services,
                        'campaigns' => $campaigns, 'lead_products' => $lead_products, 'lead_statuses' =>
                        $lead_statuses, ])
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