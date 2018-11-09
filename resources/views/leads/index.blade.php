@extends('layouts.app')
@section('content')

    <div ng-app="leadsApp" class="containerleads container">
        <br>
        @if (Session::get('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        <div class="container">
            <ng-view></ng-view>
        </div>

    </div>
    <script src="{{ asset('/appCanalDigital/app.js') }}"></script>
    <script src="{{ asset('/appCanalDigital/services/myService.js') }}"></script>
    <script src="{{ asset('/appCanalDigital/controllers/leadsController.js') }}"></script>
@stop