@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet"
    href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection
@section('content')
<div ng-app="directorApp" class="containerleads container">
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
<script src="{{ asset('js/libsJs/bootbox.js') }}"></script>
<script src="{{ asset('js/appDirectores/app.js') }}"></script>
<script src="{{ asset('js/appDirectores/services/myService.js') }}"></script>
<script src="{{ asset('js/appDirectores/controllers/directorController.js') }}"></script>
@stop
@section('scriptsJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
@endsection