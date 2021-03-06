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
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/Administrator/simulador#!/parametros">Simulador
                            Libranza</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div ng-app="simulatorApp" class="containerleads container">

    <div class="row" style="margin-top: 50px;">
        <div class="col-12 col-sm-4 text-center">
            <a href="#!/">
                <img src="{{ asset('images/parametersIcon.png') }}" alt="" class="img-fluid">
                <p>PARÁMETROS</p>
            </a>
        </div>
        <div class="col-12 col-sm-4 text-center">
            <a href="#!/pagaduria">
                <img src="{{ asset('images/pagaduriaIcon.png') }}" alt="" class="img-fluid">
                <p>PAGADURIAS</p>
            </a>
        </div>
        <div class="col-12 col-sm-4 text-center">
            <a href="/Administrator/dashboard">
                <img src="{{ asset('images/lines.png') }}" alt="" class="img-fluid">
                <p>salir</p>
            </a>
        </div>
    </div>

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
<script src="{{ asset('js/appSimulator/app.js') }}"></script>
<script src="{{ asset('js/appSimulator/services/myService.js') }}"></script>
<script src="{{ asset('js/appSimulator/controllers/simulatorController.js') }}"></script>
<script src="{{ asset('js/appSimulator/controllers/pagaduriaController.js') }}"></script>
<script src="{{ asset('js/appSimulator/bower_components/angularMultipleSelect/build/multiple-select.min.js')}}">
</script>
<link href="{{ asset('js/appSimulator/bower_components/angularMultipleSelect/build/multiple-select.min.css')}}"
    rel="stylesheet">
@stop
@section('scriptsJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angucomplete-alt/3.0.0/angucomplete-alt.min.js"></script>
<script src="{{asset('js/appSimulator/nya-files/nya-bs-select.js')}}"></script>
<link rel="stylesheet" href="{{asset('js/appSimulator/nya-files/nya-bs-select.css')}}">

@endsection