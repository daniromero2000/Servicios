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
                @include('customers.layouts.generals')
                @include('customers.layouts.ids')
            </div>

            <div role="tabpanel" class="tab-pane container-fluid" id="contact">
                @include('customers.layouts.phones')
                @include('customers.layouts.emails')
            </div>

            <div role="tabpanel" class="tab-pane container-fluid" id="uptoday">
                {{-- @include('customers.layouts.customer_cifin_fin_uptodate', ['cifin_uptodate_fins' => $customer->UpToDateCifinFins])--}}
                {{-- @include('customers.layouts.customer_cifin_real_uptodate', ['cifin_uptodate_reals' => $customer->UpToDateCifinReals])--}}
            </div>

            <div role="tabpanel" class="tab-pane container-fluid" id="arrears">
                @include('customers.layouts.customer_cifin_real_mora', ['cifin_reals' => $customer->cifinReals])
                @include('customers.layouts.customer_cifin_fin_mora', ['cifin_fins' => $customer->cifinFins])
            </div>

            <div role="tabpanel" class="tab-pane container-fluid" id="factoryrequests">
                @include('customers.layouts.customer_factory_requests', ['factory_requests' =>
                $customer->customersfactoryRequests])
            </div>

            <div role="tabpanel" class="tab-pane container-fluid" id="seguimiento">
                {{-- @include('layouts.admin.commentaries', ['datas' => $customer->customerCommentaries])
                    @include('customers::layouts.statusesLog', ['datas' => $customer->customerStatusesLog]) --}}
            </div>

            <div class="row border-0">
                <a href="{{ route('factoryrequests.index') }}" class="btn btn-primary ml-auto mr-3 mb-3 ">Regresar</a>
            </div>
        </div>
</section>
@endsection