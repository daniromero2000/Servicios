@extends('layouts.app')
@section('title', 'testConfronta')
@section('metaTags')
@endsection
@section('linkStyleSheets')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/front/ConfrontaCustomers/app.css')}}">
{{-- @php
dd($customer);
@endphp --}}
@endsection
@section('content')

<input type="text" value="{{$notification}}" id="notification" hidden>
@include('layouts.form.ConfrontaCustomersUpdate')

@endsection
@section('scriptsJs')
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ asset('js/front/ConfrontaCustomers/app.js') }}"></script>
@endsection