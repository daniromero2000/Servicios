@php
$fechaActual = strtotime(date("Y-m-d"));
$fechaMayorEdad = date("Y-m-d", strtotime("-18 years", $fechaActual));
@endphp
@extends('layouts.admin.app')
@section('content')

<section class="content">
    @include('layouts.errors-and-messages')
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"> <i class="fa fa-home"></i> Dashboard</a><span class="divider"></span>
                </li>
                <li><a href="{{ route('admin.customers.index') }}">Clientes</a><span class="divider"></span>
                <li class="breadactive">Crear Cliente</li>
            </ol>
        </div>
    </div>
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('admin.customers.store') }}" method="post" class="form">
            <div class="box-body">
                @csrf
                <h1>Crear Cliente</h1>
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre"
                            class="form-control" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="last_name">Apellido <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" name="last_name" id="last_name" validation-pattern="name"
                            placeholder="Apellido" class="form-control" value="{{ old('last_name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthday">Fecha de Nacimiento<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" name="birthday" min="1900-01-01" max="<?php echo $fechaMayorEdad;?>"
                            id="birthday" placeholder="Fecha Nacimiento" class="form-control"
                            value="{{ old('birthday') }}">
                    </div>
                </div>
                <div id="cities" class="form-group">
                    <label for="city_id">Ciudad de Nacimiento<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </div>
                        <select name="city_id" id="city_id" class="form-control" enabled>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="scholarity_id" class="">Escolaridad <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <select name="scholarity_id" id="scholarity_id" class="form-control select2">
                            @if(!empty($scholarities))
                            @foreach($scholarities as $scholarity)
                            <option value="{{ $scholarity->id }}">{{ $scholarity->scholarity }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="genre_id">Genero <span class="text-danger">*</span></label>
                    <ul class="list-unstyled list-inline">
                        @if(!empty($genres))
                        @foreach($genres as $genre)
                        <li>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="genre_id" id="genre_id" value="{{ $genre->id }}">
                                    {{ $genre->genre }}
                                </label>
                            </div>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="form-group">
                    <label for="civil_status_id" class="">Estado Civil <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <select name="civil_status_id" id="civil_status_id" class="form-control select2">
                            @foreach($civil_statuses as $civil_status)
                            <option value="{{ $civil_status->id }}">{{ $civil_status->civil_status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="customer_lead_id" class="">Lead <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <select name="customer_lead_id" id="customer_lead_id" class="form-control select2">
                            @foreach($customer_leads as $customer_lead)
                            <option value="{{ $customer_lead->id }}">{{ $customer_lead->lead }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection