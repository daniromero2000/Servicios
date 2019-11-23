@extends('layouts.admin.app')
<style type="text/css">
  #header, #preHeader,#footer{
    display: none;
  }
</style>

@section('content')   

@endsection

@section('scriptsJs')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jsGrid -->
<script src="{{ asset('plugins/jsgrid/demos/db.js') }}"></script>
<script src="{{ asset('plugins/jsgrid/jsgrid.min.js') }}"></script>
@endsection
