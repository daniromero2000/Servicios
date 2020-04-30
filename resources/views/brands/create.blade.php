@extends('layouts.admin.app')
@section('content')
<!-- Main content -->
<section class="content">
    @include('layouts.errors-and-messages')
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('brands.store') }}" method="post" class="form" enctype="multipart/form-data">
            <div class="box-body">
                {{ csrf_field() }}
                <h1>Crear Marca</h1>
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-building-o" aria-hidden="true"></i>
                            </div>
                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="cover">Imagen <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-picture-o"></i>
                        </div>
                        <input type="file" name="cover" id="cover" class="form-control" required>
                    </div>
                    <small class="text-warning">El cover del producto es obligatorio</small>
                </div>
            </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('brands.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
@endsection