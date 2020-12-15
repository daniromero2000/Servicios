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
                            <li class="breadactive">{{ $country->name }}</li>
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
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h2>{{ $country->name }}</h2>
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.countries.index') }}" class="btn btn-default btn-sm">Regresar</a>
                </div>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="text-center" scope="col-md-2">ISO</th>
                        <th class="text-center" scope="col-md-2">ISO-3</th>
                        <th class="text-center" scope="col-md-2">Numcode</th>
                        <th class="text-center" scope="col-md-2">Phone Code</th>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td class="text-center">{{ $country->iso }}</td>
                        <td class="text-center">{{ $country->iso3 }}</td>
                        <td class="text-center">{{ $country->numcode }}</td>
                        <td class="text-center">{{ $country->phonecode }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h2>Departamentos</h2>
            @include('generals::admin.shared.provinces', ['country' => $country->id])
        </div>


    </div>

</section>

@endsection