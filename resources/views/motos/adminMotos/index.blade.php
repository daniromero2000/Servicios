@extends('layouts.app')
@section('linkStyleSheets')
    <link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection
@section('content')
    <div ng-app="motosApp" class="containerleads container">
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
    <script src="{{ asset('js/appMotos/app.js') }}"></script>
    <script src="{{ asset('js/appMotos/services/myService.js') }}"></script>
    <script src="{{ asset('js/appMotos/controllers/motosController.js') }}"></script>
@stop
@section('scriptsJs')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
        <script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
        <script src="{{ asset('js/libsJs/flow.js') }}"></script>
        <script src="{{ asset('js/libsJs/fusty-flow.js') }}"></script>
        <script src="{{ asset('js/libsJs/fusty-flow-factory.js') }}"></script>
        <script src="{{ asset('js/libsJs/ng-flow.js') }}"></script>
        <script src="{{ asset('js/libsJs/ng-flow.js') }}"></script>
@endsection