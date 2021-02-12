@extends('newAdmin.template.app')
@section('header')
    <div class="header pb-2">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" active aria-current="page">Crear Solicitud</li>
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
        @include('newAdmin.layouts.errors-and-messages')
        <div class="card">
            <form action="{{ route('admin.invoiceManagement.store') }}" method="post" enctype="multipart/form-data"
                class="form">
                <div class="card-body">
                        @csrf
                    <h2 class="mb-4">Crear recordatorio de factura</h2>
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Tipo de factura<span
                                        class="text-danger">*</span></label>
                                <div class="input-group  mb-3">
                                    <select name="type_of_invoice" id="type_of_invoice" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        @foreach ($typeInvoices as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Tipo de servicio<span
                                        class="text-danger">*</span></label>
                                <div class="input-group  mb-3">
                                    <select name="type_of_service" id="type_of_service" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        <option value="Internet">Internet</option>
                                        <option value="Telefonia (Fijo)">Telefonia (Fijo)</option>
                                        <option value="Telefonia (Movil)">Telefonia (Movil)</option>
                                        <option value="Energia">Energia</option>
                                        <option value="Agua">Agua</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Referencia de pago<span
                                        class="text-danger">*</span></label>
                                <div class="input-group  mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-check"></i></span>
                                    </div>
                                    <input type="text" name="payment_reference" id="payment_reference" placeholder="Nombre"
                                        validation-pattern="name" class="form-control" value="{{ old('payment_reference') }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="description">Sucursal <span
                                        class="text-danger">*</span></label>
                                <select name="subsidiary_id" id="subsidiary_id" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    @foreach ($subsidiaries as $item)
                                        <option value="{{ $item->CODIGO }}">{{ $item->CODIGO }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Dia limite de pago<span
                                        class="text-danger">*</span></label>
                                <div class="input-group  mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-check"></i></span>
                                    </div>
                                    <input type="number" max="31" name="payment_deadline" id="payment_deadline" placeholder="Nombre"
                                        validation-pattern="name" class="form-control" value="{{ old('payment_deadline') }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Descripción<span
                                        class=""> <small>(opcional)</small> </span></label>
                                <div class="input-group  mb-3">
                                  <textarea name="description" class="form-control" id="description" cols="10" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <div class="btn-group">
                            <a href="{{ route('admin.invoiceManagement.index') }}"
                                class="btn btn-sm btn-default">Regresar</a>
                            <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
