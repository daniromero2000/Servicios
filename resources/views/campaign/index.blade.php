@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet"
  href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">

@endsection
@section('content')
<div class="row mx-0">
  <div class="col-sm-6">
    <div class="row">
      <div class="col-md-12">
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right" style="background: white;">
      <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
      <li class="breadcrumb-item active"><a href="/Administrator/community">Campañas</a></li>
    </ol>
  </div>
</div>
<div ng-app="campaignsApp" class="containerleads container">

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
<script src="{{ asset('js/appCommunity/app.js') }}"></script>
<script src="{{ asset('js/appCommunity/services/myService.js') }}"></script>
<script src="{{ asset('js/appCommunity/controllers/campaignsController.js') }}"></script>
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