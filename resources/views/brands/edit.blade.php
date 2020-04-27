@extends('layouts.admin.app')
@section('content')
<!-- Main content -->
<section class="content">
    @include('layouts.errors-and-messages')
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('brands.update', $brand->id) }}" method="post" class="form" enctype="multipart/form-data">
            <div class="box-body">
                {{ csrf_field() }}
                <h1>Editar Marca</h1>
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-building-o" aria-hidden="true"></i>
                            </div>
                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-control" value="{{ $brand->name }}" required>
                </div>
            </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('brands.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection