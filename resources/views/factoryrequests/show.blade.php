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
                <a class="nav-link " data-toggle="tab" href="#references" role="tab"
                    aria-controls="home">Referencias Solicitud</a>
            </li>
            <li class="active" role="presentation">
                <a class="nav-link" data-toggle="tab" href="#seguimiento" role="tab"
                    aria-controls="profile">Seguimiento</a>
            </li>
        </ul>
        <div class="tab-content mt-4" id="tabcontent">
            <div role="tabpanel" class="tab-pane container-fluid active" id="info">
                @include('factoryrequests.layouts.generals')
                @include('factoryrequests.layouts.creditcard')
            </div>
            <div role="tabpanel" class="tab-pane" id="references">
                @include('factoryrequests.layouts.references', [ 'references' => $factoryRequest->references ])
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
    </div>
</section>
@endsection