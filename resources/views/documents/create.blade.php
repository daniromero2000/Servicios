@extends(' layouts.admin.app')
@section('content')
    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb bradcrumb-reset float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="/Administrator/documents">Indicadores</a></li>
                        </ol>
                    </div>
                    <div class="col-12">
                        <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 btn-sm-reset">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
        @include(' layouts.errors-and-messages')
        <form action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mx-0 px-2">
                <div class="col-xl-4 order-xl-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8 mt-4">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Categoria</h6>
                            <div class="row justify-content-center">
                                @foreach ($categories as $category)
                                    <div class="px-2">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="role{{ $category->id }}" type="checkbox"
                                                name="categories[]" value="{{ $category->id }}">
                                            <label class="custom-control-label"
                                                for="role{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1">
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-name">Mes</label>
                                            <input type="text" id="input-name" name="name" required class="form-control"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-name">Documento</label>
                                            <input type="file" id="input-name" name="src" required class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Descripción</label>
                                    <textarea rows="4" class="form-control" required name="description"></textarea>
                                </div>
                            </div>
                            <div class="row mx-0">
                                <button class="btn btn-primary ml-auto" type="submit">Crear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </section>
@endsection
@section('scripts')
@endsection
