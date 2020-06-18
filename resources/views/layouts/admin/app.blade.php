<!DOCTYPE html>
<html>

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
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-animate.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-aria.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.12/angular-material.min.js"></script>

  <script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
  </script>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel='shortcut icon' type='image/x-icon' href='{{ asset('images/oportunidadesServicios.ico') }}' />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
</head>

<body onload="cargar()" class="hold-transition sidebar-mini sidebar-collapse">
  @include('layouts.admin.loader')
  <div class="wrapper home">
    @include('layouts.admin.header')
    @include('layouts.admin.sidebar')
    <div class="content-wrapper bg-white">
      <div class="container-responsive">
        @yield('content')
      </div>
    </div>
    @include('layouts.admin.footer')
  </div>
</body>

@yield('scriptsJs')
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('js/validateV2.js') }}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/sweetAlert.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="{{ asset('js/front/loader.js') }}"></script>
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
<script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<script>
  $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
  
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask3').inputmask('yyyy/mm/dd', { 'placeholder': 'mm/dd/yyyy' })

      //Money Euro
      $('[data-mask]').inputmask()
  
       //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })
       $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
  
    })
</script>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
@if ($user->lead_area_id > 0)
@include('layouts.admin.notifications')
@endif
<script src="{{ asset('js/leadsNotifications.js') }}"></script>

</html>