@extends('layouts.admin.app')
@section('content')

<section class="content border-0">
    @include('layouts.errors-and-messages')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
                </div>
                <div class="col-sm-8">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/Administrator/dashboard/customers">Dashboard Clientes</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="/Administrator/customers">Clientes</a></li>
                        <li class="breadcrumb-item active"><a href="">Detalle Cliente</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card border-0 mt-5">
        <ul class="nav nav-tabs border-0" id="tablist" role="tablist">
            <li class="active" role="presentation">
                <a class="nav-link active " data-toggle="tab" href="#info" role="tab" aria-controls="home">Cliente</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#arrears" role="tab" aria-controls="arrears">Moras</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#uptoday" role="tab" aria-controls="profile">Obligaciones Al
                    Día</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#extints" role="tab" aria-controls="profile">Obligaciones
                    Extintas</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#factoryrequests" role="tab"
                    aria-controls="profile">Solicitudes Fábrica</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#seguimiento" role="tab"
                    aria-controls="profile">Seguimiento</a>
            </li>
        </ul>
        <div class="tab-content mt-4" id="tabcontent">
            <div role="tabpanel" class="tab-pane container-fluid active" id="info">
                @include('customers.layouts.generals')
                @include('customers.layouts.ids')
                @include('customers.layouts.phones')
                @include('customers.layouts.emails')
            </div>
            <div role="tabpanel" class="tab-pane" id="uptoday">
                @include('customers.layouts.customer_cifin_fin_uptodate', ['cifin_uptodate_fins' =>
                $customer->UpToDateCifinFins])
                @include('customers.layouts.customer_cifin_real_uptodate', ['cifin_uptodate_reals' =>
                $customer->UpToDateCifinReals])
            </div>
            <div role="tabpanel" class="tab-pane container-fluid" id="arrears">
                @include('customers.layouts.customer_cifin_real_mora', ['cifin_reals' =>
                $customer->cifinReals])
                @include('customers.layouts.customer_cifin_fin_mora', ['cifin_fins' =>
                $customer->cifinFins])
            </div>
            <div role="tabpanel" class="tab-pane container-fluid" id="extints">
                @include('customers.layouts.customer_cifin_real_ext', ['cifin_real_extints' =>
                $customer->extintsCifinReals])
                @include('customers.layouts.customer_cifin_fin_ext', ['cifin_fin_extints' =>
                $customer->extintsCifinFins])
            </div>
            <div role="tabpanel" class="tab-pane" id="factoryrequests">
                @include('customers.layouts.customer_factory_requests', ['factory_requests' =>
                $customer->customersfactoryRequests])
            </div>
            <div role="tabpanel" class="tab-pane" id="seguimiento">
                @include('customers.layouts.commentaries', ['datas' => $customer->customerCommentaries])
                @include('customers.layouts.statusesLog', ['datas' => $customer->customerStatusesLog])
            </div>
            <div class="row row-reset border-0">
                <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
            </div>
        </div>
</section>
@endsection