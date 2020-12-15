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
    @if($countries)
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <h1>{{$countries->count()}} Países</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col-md-1">Nombre</th>
                                <th class="text-center" scope="col-md-1">ISO</th>
                                <th class="text-center" scope="col-md-1">ISO-3</th>
                                <th class="text-center" scope="col-md-1">Numcode</th>
                                <th class="text-center" scope="col-md-1">Phone Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($countries as $country)
                            <tr>
                                <td class="text-center">
                                    <a href="{{ route('admin.countries.show', $country->id) }}">{{ $country->name }}</a>
                                </td>
                                <td class="text-center">{{ $country->iso }}</td>
                                <td class="text-center">{{ $country->iso3 }}</td>
                                <td class="text-center">{{ $country->numcode }}</td>
                                <td class="text-center">{{ $country->phonecode }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection