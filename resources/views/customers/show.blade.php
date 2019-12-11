@extends('layouts.admin.app')
@section('content')

<section class="content border-0">
    @include('layouts.errors-and-messages')

    <div class="card border-0 mt-5">
        <ul class="nav nav-tabs border-0" id="tablist" role="tablist">
            <li class="active" role="presentation">
                <a class="nav-link active " data-toggle="tab" href="#info" role="tab" aria-controls="home">Cliente</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#contact" role="tab" aria-controls="profile">Contacto</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#arrears" role="tab" aria-controls="profile">Moras</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#uptoday" role="tab" aria-controls="profile">Obligaciones Al
                    Día</a>
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
                <div class="container-fluid card">
                    @include('customers.layouts.generals')
                </div>
                <div class="container-fluid mt-5 card">
                    @include('customers.layouts.ids')
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="contact">
                <div class="row">
                    <div class="container-fluid mt-5 card">
                        @include('customers.layouts.phones')
                    </div>
                    <div class="container-fluid mt-5 card">
                        @include('customers.layouts.emails')
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="uptoday">
                <div class="row">
<div class="container-fluid mt-5 card">
    @include('customers.layouts.customer_cifin_fin_uptodate', ['cifin_uptodate_fins' =>
    $customer->UpToDateCifinFins])
</div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="arrears">
                <div class="row">
                    <div class="container-fluid mt-5 card">
                        @include('customers.layouts.customer_cifin_real_mora', ['cifin_reals' =>
                        $customer->cifinReals])
                    </div>

                    <div class="container-fluid mt-5 card">
                        @include('customers.layouts.customer_cifin_fin_mora', ['cifin_fins' =>
                        $customer->cifinFins])
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="factoryrequests">
                <div class="row">
                    <div class="container-fluid mt-5 card">
                        @include('customers.layouts.customer_factory_requests', ['factory_requests' =>
                        $customer->customersfactoryRequests])
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="seguimiento">
                <div class="row">
                    {{-- @include('layouts.admin.commentaries', ['datas' => $customer->customerCommentaries])
                    @include('customers::layouts.statusesLog', ['datas' => $customer->customerStatusesLog]) --}}
                </div>
            </div>
            <div class="row border-0">
                <a href="{{ route('factoryrequests.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
</section>
@endsection