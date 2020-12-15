@extends(' layouts.admin.app')
@section('content')
    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb bradcrumb-reset float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="/Administrator/document-categories">Categorias</a></li>
                        </ol>
                    </div>
                    <div class="col-12">
                        <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 btn-sm-reset">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
        @include(' layouts.errors-and-messages')
        <form action="{{ route('document-categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container">
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
                                        <select class="form-control" name="is_active">
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
            </div>
        </form>
    </section>
@endsection
@section('scripts')
@endsection
