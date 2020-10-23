<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Oportudata</title>
        @php
        $user = auth()->user();
        @endphp
        <input type="text" id="idProfile" hidden value="{{$user->idProfile}}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
            integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        @yield('linkStyleSheets')
        <link rel="stylesheet" href="{{ asset('css/front/analisis/cardCustomer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/front/loader.css') }}" id="link">
        <link rel="stylesheet" href="{{ asset('css/layouts/show.css') }}">
        <link rel="stylesheet" href="{{ asset('css/front/main.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet"
            href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/jsgrid/jsgrid.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/jsgrid/jsgrid-theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link href="https://rawgit.com/rzajac/angularjs-slider/master/dist/rzslider.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://gitcdn.xyz/cdn/angular/bower-material/master/angular-material.css">
        <link rel="stylesheet" href="{{ asset('css/app2.css') }}">
    </head>

    <body style="min-width: 1200px">
        <div class="row">
            <div class="col-12">
                @include('customers.layouts.customer_cifin_real_mora', ['cifin_reals' =>
                $cifinWebService->cifinRealArrear])
            </div>
            <div class="col-12">
                @include('customers.layouts.customer_cifin_fin_mora', ['cifin_fins' =>
                $cifinWebService->cifinFinancialArrear])
            </div>
            <div class="col-12">
                @include('customers.layouts.customer_cifin_fin_uptodate', ['cifin_uptodate_fins' =>
                $cifinWebService->upToDateFinancialCifin])
            </div>
            <div class="col-12">
                @include('customers.layouts.customer_cifin_real_uptodate', ['cifin_uptodate_reals' =>
                $cifinWebService->upToDateRealCifin])
            </div>
            <div class="col-12">
                @include('customers.layouts.customer_cifin_real_ext', ['cifin_real_extints' =>
                $cifinWebService->extintRealCifin])
            </div>
            <div class="col-12">
                @include('customers.layouts.customer_cifin_fin_ext', ['cifin_fin_extints' =>
                $cifinWebService->extintFinancialCifin])
            </div>
            <div class="col-12">
                @include('customers.layouts.customer_cifin_footprints', ['cifin_footprints' =>
                $cifinWebService->cifinFrootprint])
            </div>
        </div>
    </body>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>

</html>