@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet"
    href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Bienvenido</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/Administrator/libranzaLeads#!/">Leads Libranza</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div ng-app="libranzaLeadsApp" class="containerleads container">
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
<script src="{{ asset('js/appLibranza/app.js') }}"></script>
<script src="{{ asset('js/appLibranza/services/myService.js') }}"></script>
<script src="{{ asset('js/appLibranza/controllers/libranzaLeadsController.js') }}"></script>
@stop
@section('scriptsJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
@endsection