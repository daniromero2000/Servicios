@extends('layouts.admin.app')
@section('content')

<section class="content">
    @include('layouts.errors-and-messages')

    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <ul class="nav nav-tabs" role="tablist" id="tablist">
            <li role="presentation" @if(!request()->has('info')) class="active" @endif><a href="#info"
                    aria-controls="home" role="tab" data-toggle="tab">Cliente</a></li>
            <li role="presentation" @if(request()->has('contact')) class="active" @endif><a href="#contact"
                    aria-controls="profile" role="tab" data-toggle="tab">Contacto</a></li>
            <li role="presentation" @if(request()->has('seguimiento')) class="active" @endif><a href="#seguimiento"
                    aria-controls="profile" role="tab" data-toggle="tab">Seguimiento</a></li>
        </ul>
        <div class="tab-content" id="tabcontent">
            <div role="tabpanel" class="tab-pane active" id="info">
                @include('factoryrequests.layouts.generals')

            </div>
            <div role="tabpanel" class="tab-pane" id="contact">
                <div class="row">
                    @include('factoryrequests.layouts.phones')

                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="seguimiento">
                <div class="row">
                    {{-- @include('layouts.admin.commentaries', ['datas' => $customer->customerCommentaries])
                    @include('customers::layouts.statusesLog', ['datas' => $customer->customerStatusesLog]) --}}
                </div>
            </div>
        </div>
        <div class="row">
            <a href="{{ route('admin.customers.index') }}" class="btn btn-default btn-sm">Regresar</a>
        </div>

    </div>
</section>
@endsection