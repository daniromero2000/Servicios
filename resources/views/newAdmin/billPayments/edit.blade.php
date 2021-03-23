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
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                        href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i
                            class="fas fa-file-invoice-dollar mr-2"></i>Factura</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab"
                        href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i
                            class="ni ni-calendar-grid-58 mr-2"></i>Seguimiento</a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                        aria-labelledby="tabs-icons-text-1-tab">
                        <div class="row">
                            <div class="col-6">
                                <h2 class="mb-4">Editar recordatorio de factura</h2>
                            </div>
                            <div class="col-6 text-right">
                                @if ($billPayment->src_invoice)
                                    <form action="{{ route('admin.downloadDocument', $billPayment->id) }}"
                                        enctype="multipart/form-data" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Descargar Factura</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <form action="{{ route('admin.invoiceManagement.update', $billPayment->id) }}" method="post"
                            enctype="multipart/form-data" class="form">
                            <div class="card-body">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">Proveedor<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group  mb-3">
                                                <select name="type_of_invoice" id="type_of_invoice" class="form-control"
                                                    required>
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
                                                <select name="type_of_service" id="type_of_service" class="form-control"
                                                    required>
                                                    <option value="Internet"
                                                        {{ $billPayment->type_of_service == 'Internet' ? 'selected' : '' }}>
                                                        Internet
                                                    </option>
                                                    <option value="Telefonia (Fijo)"
                                                        {{ $billPayment->type_of_service == 'Telefonia (Fijo)' ? 'selected' : '' }}>
                                                        Telefonia (Fijo)</option>
                                                    <option value="Telefonia (Movil)"
                                                        {{ $billPayment->type_of_service == 'Telefonia (Movil)' ? 'selected' : '' }}>
                                                        Telefonia (Movil)</option>
                                                    <option value="Energia"
                                                        {{ $billPayment->type_of_service == 'Energia' ? 'selected' : '' }}>
                                                        Energia
                                                    </option>
                                                    <option value="Agua"
                                                        {{ $billPayment->type_of_service == 'Agua' ? 'selected' : '' }}>
                                                        Agua</option>
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
                                                <input type="text" name="payment_reference" id="payment_reference"
                                                    placeholder="Nombre" validation-pattern="name" class="form-control"
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
                                                    <option value="{{ $item->id }}"
                                                        {{ $billPayment->subsidiary_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->code }}</option>
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
                                            <label class="form-control-label" for="name">Fecha de vigencia<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group  mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-check"></i></span>
                                                </div>
                                                <input type="date" name="time_of_validity" id="time_of_validity"
                                                    validation-pattern="name" class="form-control"
                                                    value="{{ $billPayment->time_of_validity }}">
                                            </div>
                                        </div>
                                    </div>
                                    @if (auth()->user()->idProfile == 28 || auth()->user()->idProfile == 31)
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="name">Estado<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group  mb-3">
                                                    <select name="status" id="status" class="form-control" required>
                                                        <option value="0"
                                                            {{ $billPayment->status == '0' ? 'selected' : '' }}>Pendiente
                                                        </option>
                                                        <option value="1"
                                                            {{ $billPayment->status == '1' ? 'selected' : '' }}>
                                                            Gestionado</option>
                                                        <option value="3"
                                                            {{ $billPayment->status == '3' ? 'selected' : '' }}>
                                                            Aprobado</option>
                                                        <option value="4"
                                                            {{ $billPayment->status == '4' ? 'selected' : '' }}>
                                                            Revisado por contabilidad</option>
                                                        <option value="2"
                                                            {{ $billPayment->status == '2' ? 'selected' : '' }}>
                                                            Pagado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(auth()->user()->idProfile == 29)
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="name">Estado<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group  mb-3">
                                                    <select name="status" id="status" class="form-control" required>
                                                        <option value="3"
                                                            {{ $billPayment->status == '3' ? 'selected' : '' }}>
                                                            Aprobado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(auth()->user()->idProfile == 30)
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="name">Estado<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group  mb-3">
                                                    <select name="status" id="status" class="form-control" required>
                                                        <option value="4"
                                                            {{ $billPayment->status == '4' ? 'selected' : '' }}>
                                                            Revisado por contabilidad</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">Cargar Factura</label>
                                            <div class="input-group  mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-check"></i></span>
                                                </div>
                                                <input type="file" name="src_invoice" id="src_invoice"
                                                    validation-pattern="name" class="form-control" value="">
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
                                    <div class="col-12">
                                        <hr>
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
                                                    <input type="text" class="form-control" name="emails[]" required
                                                        value="{{ $item->email }}" />
                                                    <a href="javascript:void(0);" class=" ml-auto remove_button"
                                                        title="Remove field"><i class="fas fa-minus-circle"></i></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-12">
                                        <h6 class="heading-small text-muted mb-4">Números de teléfono asociados</h6>
                                    </div>
                                    <div class="field_wrapper2 row mx-0 w-100">
                                        <div class="col-12 mb-3 ">
                                            <span class=" heading-small text-muted">Agregar número</span>
                                            <a href="javascript:void(0);" class="add_button2" title="Add field"> <i
                                                    class="fas fa-plus-circle"></i></a>
                                        </div>
                                        @foreach ($billPayment->telephoneBillPayment as $item)
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="name">Número</label>
                                                    <input type="text" class="form-control" name="telephones[]" required
                                                        value="{{ $item->telephone }}" />
                                                    <a href="javascript:void(0);" class=" ml-auto remove_button"
                                                        title="Remove field"><i class="fas fa-minus-circle"></i></a>
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
                                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div class="card-header bg-transparent">
                                <h3 class="mb-0">Historial</h3>
                            </div>
                            @if (!empty($billPayment->statusLogs))
                                <div class="card-body" style=" max-height: 500px; overflow: auto; ">
                                    @foreach ($billPayment->statusLogs as $data)
                                        @php
                                            if ($data->status == 0) {
                                                $data->statuses = ['status' => 'Pendiente', 'color' => '#FFFFFF', 'background' => '#ff8d00'];
                                            } elseif ($data->status == 1) {
                                                $data->statuses = ['status' => 'Gestionado', 'color' => '#FFFFFF', 'background' => '#007bff'];
                                            } elseif ($data->status == 2) {
                                                $data->statuses = ['status' => 'Pagado', 'color' => '#FFFFFF', 'background' => '#2ec76b'];
                                            } elseif ($data->status == 3) {
                                                $data->statuses = ['status' => 'Aprobado', 'color' => '#FFFFFF', 'background' => '#2ec76b'];
                                            } elseif ($data->status == 4) {
                                                $data->statuses = ['status' => 'Revisado por contabilidad', 'color' => '#FFFFFF', 'background' => '#ff8d00'];
                                            } else {
                                                $data->statuses = ['status' => 'Habilitado para pago', 'color' => '#FFFFFF', 'background' => '#c72ebb'];
                                            }
                                        @endphp
                                        <div class="timeline timeline-one-side" data-timeline-content="axis"
                                            data-timeline-axis-style="dashed">
                                            <div class="timeline-block">
                                                <span class="timeline-step"
                                                    style="color: {{ $data->statuses['color'] }}; background:{{ $data->statuses['background'] }}">
                                                    <i class="fa fa-clock"></i>
                                                </span>
                                                <div class="timeline-content">
                                                    <small
                                                        class="text-muted font-weight-bold">{{ $data->created_at->format('M d, Y h:i a') }}</small>
                                                    <h5 class=" mt-3 mb-0"><span class="badge"
                                                            style="color: {{ $data->statuses['color'] }}; background:{{ $data->statuses['background'] }}">{{ $data->statuses['status'] }}</span>
                                                    </h5>
                                                    <p class=" text-sm mt-1 mb-0"><b>Usuario:</b>
                                                        {{ $data->user->name }}</p>
                                                    <div class="mt-3 mb-3">
                                                        @if ($data->diffTime)
                                                            <span class="badge badge-pill "
                                                                style="color: {{ $data->statuses['color'] }}; background:{{ $data->statuses['background'] }}">
                                                                {{ $data->diffTime }}
                                                                Después </span>
                                                        @endif
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 mx-auto">
                            <div class="card-header bg-transparent">
                                <h3 class="mb-0">Historial de documentos cargados</h3>
                            </div>
                            @if (!empty($billPayment->statusLogs))
                                <div class="card-body" style=" max-height: 500px; overflow: auto; ">
                                    @foreach ($billPayment->documentAttachment as $data)
                                        <div class="timeline timeline-one-side" data-timeline-content="axis"
                                            data-timeline-axis-style="dashed">
                                            <div class="timeline-block">
                                                <span class="timeline-step" style="color: #fff; background: #007bff">
                                                    <i class="fa fa-clock"></i>
                                                </span>
                                                <div class="timeline-content">
                                                    <small
                                                        class="text-muted font-weight-bold">{{ $data->created_at->format('M d, Y h:i a') }}</small>
                                                    <form
                                                        action="{{ route('admin.downloadDocumentLog', $data->id) }}"
                                                        enctype="multipart/form-data" method="GET">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm mt-3 mb-2">Descargar
                                                            archivo</button>
                                                    </form>
                                                    <p class=" text-sm mt-1 mb-0"><b>Usuario:</b>
                                                        {{ $data->user->name }}</p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10; 
            var addButton = $('.add_button'); 
            var wrapper = $('.field_wrapper');
            var fieldHTML =
                `<div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="form-control-label" for="name">Correo</label>
                                      <input type="text" class="form-control" name="emails[]" value="" required />
                                      <a href="javascript:void(0);" class=" ml-auto remove_button" title="Remove field"><i class="fas fa-minus-circle"></i></a>
                                    </div>
                                </div>`; 
            var x = 1; 
            $(addButton).click(function() { 
                if (x < maxField) { 
                    x++;
                    $(wrapper).append(fieldHTML); 
                }
            });
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--; 
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10; 
            var addButton = $('.add_button2'); 
            var wrapper = $('.field_wrapper2');
            var fieldHTML =
                `<div class="col-sm-6">
                                 <div class="form-group">
                                 <label class="form-control-label" for="name">Correo</label>
                                   <input type="text" class="form-control" name="telephones[]" value="" required />
                                   <a href="javascript:void(0);" class=" ml-auto remove_button2" title="Remove field"><i class="fas fa-minus-circle"></i></a>
                                 </div>
                              </div>`; 
            var x = 1; 
            $(addButton).click(function() { 
                if (x < maxField) { 
                    x++;
                    $(wrapper).append(fieldHTML); 
                }
            });
            $(wrapper).on('click', '.remove_button2', function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--; 
            });
        });

    </script>
@endsection
