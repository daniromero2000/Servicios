@extends('generals::layouts.admin.app')
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" active aria-current="page">Países</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')
    @if($province)
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <h2>{{ $province->province }}</h2>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <h2>Ciudades / Municipios</h2>
                    @include('generals::admin.shared.cities')
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection