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
            <form action="{{ route('admin.invoiceManagement.update', $billPayment->id) }}" method="post" enctype="multipart/form-data"
                class="form">
                <div class="card-body">
                    @method('PUT')
                    @csrf
                    <h2 class="mb-4">Editar recordatorio de factura</h2>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Proveedor<span
                                        class="text-danger">*</span></label>
                                <div class="input-group  mb-3">
                                    <select name="type_of_invoice" id="type_of_invoice" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        @foreach ($typeInvoices as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $billPayment->type_of_invoice == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
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
                                        <option value="Internet"
                                            {{ $billPayment->type_of_service == 'Internet' ? 'selected' : '' }}>Internet
                                        </option>
                                        <option value="Telefonia (Fijo)"
                                            {{ $billPayment->type_of_service == 'Telefonia (Fijo)' ? 'selected' : '' }}>
                                            Telefonia (Fijo)</option>
                                        <option value="Telefonia (Movil)"
                                            {{ $billPayment->type_of_service == 'Telefonia (Movil)' ? 'selected' : '' }}>
                                            Telefonia (Movil)</option>
                                        <option value="Energia"
                                            {{ $billPayment->type_of_service == 'Energia' ? 'selected' : '' }}>Energia
                                        </option>
                                        <option value="Agua"
                                            {{ $billPayment->type_of_service == 'Agua' ? 'selected' : '' }}>Agua</option>
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
                                        validation-pattern="name" class="form-control"
                                        value="{{ $billPayment->payment_reference }}" required>
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
                                        <option value="{{ $item->CODIGO }}"
                                            {{ $billPayment->subsidiary_id == $item->CODIGO ? 'selected' : '' }}>
                                            {{ $item->CODIGO }}</option>
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
                                    <input type="number" max="31" name="payment_deadline" id="payment_deadline"
                                        placeholder="Nombre" validation-pattern="name" class="form-control"
                                        value="{{ $billPayment->payment_deadline }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Descripción<span class="">
                                        <small>(opcional)</small> </span></label>
                                <div class="input-group  mb-3">
                                    <textarea name="description" class="form-control" id="description" cols="10"
                                        rows="4">{{ $billPayment->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mx-3">
                            <h6 class="heading-small text-muted mb-4">Correos asociados</h6>
                        </div>
                        <div class="field_wrapper row mx-0 w-100">
                            <div class="col-12 mb-3 ">
                                <span class=" heading-small text-muted">Agregar correo</span>
                                <a href="javascript:void(0);" class="add_button" title="Add field"> <i
                                        class="fas fa-plus-circle"></i></a>
                            </div>

                            @foreach ($billPayment->mailBillPayment as $item)
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">Correo</label>
                                        <input type="text" class="form-control" name="emails[]" required value="{{$item->email}}" />
                                        <a href="javascript:void(0);" class=" ml-auto remove_button" title="Remove field"><i class="fas fa-minus-circle"></i></a>
                                    </div>
                                </div>
                            @endforeach

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
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML =
                `<div class="col-sm-6">
                         <div class="form-group">
                         <label class="form-control-label" for="name">Correo</label>
                           <input type="text" class="form-control" name="emails[]" value="" required />
                           <a href="javascript:void(0);" class=" ml-auto remove_button" title="Remove field"><i class="fas fa-minus-circle"></i></a>
                         </div>
                     </div>`; //New input field html 
            var x = 1; //Initial field counter is 1
            $(addButton).click(function() { //Once add button is clicked
                if (x < maxField) { //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
            $(wrapper).on('click', '.remove_button', function(e) { //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

    </script>
@endsection
