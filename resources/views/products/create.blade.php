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
                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-at"></i>
                            </div>
                            <input type="text" name="reference" id="reference" placeholder="Referencia"
                                class="form-control" value="{{ old('reference') }}" required>
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
                        <label for="cover">Cover Principal <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-picture-o"></i>
                            </div>
                            <input type="file" name="cover" id="cover" class="form-control" required>
                        </div>
                        <small class="text-warning">El cover del producto es obligatorio</small>
                    </div>
                    <div class="form-group">
                        <label for="image">Images secundarias</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-picture-o"></i>
                            </div>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                        </div>
                        <small class="text-warning">Puedes usar ctr (cmd) para seleccionar multiples imagenes</small>
                    </div>
                    <div class="form-group">
                        <label for="description_image1">Imagen de descripcion 1<span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-picture-o"></i>
                            </div>
                            <input type="file" name="description_image1" id="description_image1" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description_image2">Imagen de descripcion 2<span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-picture-o"></i>
                            </div>
                            <input type="file" name="description_image2" id="description_image2" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description_image3">Imagen de descripcion 3<span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-picture-o"></i>
                            </div>
                            <input type="file" name="description_image3" id="description_image3" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description_image4">Imagen de descripcion 4<span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-picture-o"></i>
                            </div>
                            <input type="file" name="description_image4" id="description_image4" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="specification_image">Imagen de especificaciones<span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-picture-o"></i>
                            </div>
                            <input type="file" name="specification_image" id="specification_image" class="form-control"
                                required>
                        </div>
                    </div>
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
                    <div class="form-group">
                        <label for="price">Precio Oferta <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="sale_price" id="sale_price" placeholder="Precio Oferta"
                                class="form-control" value="{{ old('sale_price') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="months">Meses a Pagar<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="months" id="months" placeholder="Meses a Pagar"
                                class="form-control" value="{{ old('months') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pays">Cuotas Mensuales<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="pays" id="pays" placeholder="Cuotas Mensuales" class="form-control"
                                value="{{ old('pays') }}" required>
                        </div>
                    </div>
                    @if(!$brands->isEmpty())
                    <div class="form-group">
                        <label for="brand_id">Marca </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-building-o "></i>
                            </div>
                            <select name="brand_id" id="brand_id" class="form-control select2">
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