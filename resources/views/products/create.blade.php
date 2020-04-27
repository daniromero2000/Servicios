@extends('layouts.admin.app')
@section('content')
<!-- Main content -->
<section class="content">
    @include('layouts.errors-and-messages')
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('products.store') }}" method="post" class="form" enctype="multipart/form-data">
            <div class="box-body">
                {{ csrf_field() }}
                <h1>Crear Producto</h1>
                <div class="col-md-8">
                    <h1>Producto</h1>
                    <div class="form-group">
                        <label for="sku">Código <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-barcode"></i>
                            </div>
                            <input type="text" name="sku" id="sku" placeholder="xxxxx" class="form-control"
                                value="{{ old('sku') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-at"></i>
                            </div>
                            <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                                value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description" id="description" rows="5"
                            placeholder="Descripción" required>{{ old('description') }}</textarea>
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
                    <div class="form-group">
                        <label for="image">Images</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-picture-o"></i>
                            </div>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                        </div>
                        <small class="text-warning">Puedes usar ctr (cmd) para seleccionar multiples imagenes</small>
                    </div>
                    <input type="hidden" name="quantity" id="quantity" placeholder="Cantidad" class="form-control"
                        value="1" required>
                    <div class="form-group">
                        <label for="price">Precio <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="price" id="price" placeholder="Precio" class="form-control"
                                value="{{ old('price') }}" required>
                        </div>
                    </div>
                    @if(!$brands->isEmpty())
                    <div class="form-group">
                        <label for="brands_id">Marca </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-building-o "></i>
                            </div>
                            <select name="brands_id" id="brands_id" class="form-control select2">
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <input id="product_status_id" type="hidden" class="form-control" name="product_status_id" value="2">
                    <input type="hidden" name="status" id="status" class="form-control" value="1">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('products.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection