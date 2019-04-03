@extends('layouts.app')
@section('linkStyleSheets')
    <link rel="stylesheet" href="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css">
@endsection
@section('content')
    <div ng-app="customersApp" class="containerleads container">
        <br>
        @if (Session::get('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif 

        
        @if(Auth::guard('assessor')->check())
            
            <div class="container">
                <ng-view></ng-view>
            </div> 

        @else

            <script type="text/javascript">
                window.location = "/assessor/login";
            </script>  

        @endif

    </div>
    <script src="{{ asset('js/appClientesAssessor/app.js') }}"></script>
    <script src="{{ asset('js/appClientesAssessor/services/myService.js') }}"></script>
    <script src="{{ asset('js/appClientesAssessor/controller/clientesAssessors.js') }}"></script>
@stop
@section('scriptsJs')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
        <script src="https://rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angucomplete-alt/3.0.0/angucomplete-alt.min.js"></script>
@endsection