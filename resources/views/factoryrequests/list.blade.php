@extends('layouts.admin.app')
@section('content')

<section>
    @include('layouts.errors-and-messages')

    @if(!is_null($customers))
    <div >
            <div class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8">
                                    <h1 class="ml-3"> {{ $listCount }} Solicitudes</h1>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @include('layouts.admin.search', ['route' => route('factoryrequests.index')])
                                        </div>

                                    </div>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><a href="/Administrator/communityLeads#!/"></a></li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>

        <div class="container">
            <div class="card  mb-4 border-0 shadow-lg">
                <div class="row form-group" ng-if="filtros">
                    <div class="col-12">

                        <div class="card-body text-center pt-0 pb-0 ">

                            @if($customers)
                            @include('layouts.admin.tables.tables_lead_status', [$headers, 'datas' => $customers ])
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

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jsGrid -->
<script src="{{ asset('plugins/jsgrid/demos/db.js') }}"></script>
<script src="{{ asset('plugins/jsgrid/jsgrid.min.js') }}"></script>
@endsection