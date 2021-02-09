<!DOCTYPE html>
<html>

<head>
    @include('newAdmin.template.styles')
    @yield('styles')
</head>

<body>
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light" id="sidenav-main"
        style="background-color: #ffffff !important;">
        <div class="scrollbar-inner scroll-content scroll-scrollx_visible scroll-scrolly_visible">
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand" href="/admin">
                    {{-- <img
                        src="{{ asset('modules/generals/argonTemplate/img/brand/logo_smart.png') }}"
                        class="navbar-brand-img" alt="Logo"> --}}
                </a>
                <div class="ml-auto">
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line "></i>
                            <i class="sidenav-toggler-line "></i>
                            <i class="sidenav-toggler-line "></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    @include('newAdmin.template.sidebar')
                </div>
            </div>
        </div>
    </nav>
    <div class="main-content" id="panel">
        @include('newAdmin.template.nav')
        {{-- <div id="notification">
            <app-header :user="{{ auth()->guard('notification')->user() }}"></app-header>
        </div> --}}
        @yield('header')
        <div class="container-fluid" id="reset">
            @yield('content')
            @include('newAdmin.template.footer')
        </div>
    </div>

    @include('newAdmin.template.scriptInclude')
    @yield('scripts')

</body>

</html>
