@extends('layouts.admin.app')
@section('content')

<section class="content">
    @include('layouts.errors-and-messages')
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"> <i class="fa fa-home"></i> Dashboard</a><span
                        class="divider"></span>
                </li>
                <li><a href="{{ route('admin.customers.index') }}">Clientes</a><span class="divider"></span>
                <li class="breadactive">Editar {{$customer->name}}</li>
            </ol>
        </div>
    </div>
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('admin.customers.update', $customer->id) }}" method="post" class="form">
            <div class="box-body">
               @csrf
                <h1>Editar Cliente</h1>
               @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre" class="form-control"
                            value="{!! $customer->name ?: old('name')  !!}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="last_name">Apellido <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" name="last_name" id="last_name" validation-pattern="name" placeholder="Apellido" class="form-control"
                            value="{!! $customer->last_name ?: old('last_name')  !!}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city_id">Ciudad de Nacimiento <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <select name="city_id" id="city_id" class="form-control select2">
                            @foreach($cities as $city)
                            <option @if($customer_city==$city->id) selected="selected" @endif
                                value="{{ $city->id }}">{{ $city->city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="scholarity_id">Escolaridad <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <select name="scholarity_id" id="scholarity_id" class="form-control select2">
                            @foreach($scholarities as $scholarity)
                            <option @if($customer_scholarity==$scholarity->id) selected="selected" @endif
                                value="{{ $scholarity->id }}">{{ $scholarity->scholarity }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="customer_status_id">Estado <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <select name="customer_status_id" id="customer_status_id" class="form-control select2">
                            @foreach($statuses as $status)
                            <option @if($currentStatus==$status->id) selected="selected" @endif
                                value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="customer_lead_id">Estado <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <select name="customer_lead_id" id="customer_lead_id" class="form-control select2">
                            @foreach($customer_leads as $customer_lead)
                            <option @if($customer_lead->id == $lead) selected="selected" @endif
                                value="{{ $customer_lead->id }}">{{ $customer_lead->lead }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="status" id="status" class="form-control" value="1">
            </div>

            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-default btn-sm">Regresar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection
