@extends(' layouts.admin.app')
@section('header')
    <div class="header pb-2">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item " active aria-current="page">Empleados</li>
                                <li class="breadcrumb-item active">Crear Empleado</li>
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
        @include(' layouts.errors-and-messages')
        <form action="{{ route('admin.document-categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Crear Documento </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Información</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">Nombre</label>
                                    <input type="text" id="input-name" name="name" required class="form-control"
                                        placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">Estado</label>
                                  <select class="form-control" name="is_active" >
                                      <option value="1">Activo</option>
                                      <option value="0">Desactivado</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                    <div class="row mx-0">
                        <button class="btn btn-primary ml-auto" type="submit">Crear</button>
                    </div>
                </div>
            </div>

        </form>

    </section>
@endsection
@section('scripts')
@endsection
