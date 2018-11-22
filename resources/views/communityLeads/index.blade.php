@extends('layouts.app')
@section('linkStyleSheets')
    <link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection
@section('content')
    <div ng-app="communityLeadsApp" class="containerleads container">
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
    <script src="{{ asset('js/appCommunityLeads/app.js') }}"></script>
    <script src="{{ asset('js/appCommunityLeads/services/myService.js') }}"></script>
    <script src="{{ asset('js/appCommunityLeads/controllers/communityController.js') }}"></script>
@stop
@section('scriptsJs')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
        <script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
@endsection