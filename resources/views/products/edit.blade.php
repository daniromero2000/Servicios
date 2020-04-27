@extends('layouts.admin.app')
@section('content')
<!-- Main content -->
<section class="content">
    @include('layouts.errors-and-messages')
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('products.update', $product->id) }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
                <div class="row">
                    {{ csrf_field() }}
                    <h1>Editar Producto</h1>
                    <input type="hidden" name="_method" value="put">
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="tablist">
                            <li role="presentation" @if(!request()->has('combination')) class="active" @endif><a
                                    href="#info" aria-controls="home" role="tab" data-toggle="tab">Info</a></li>

                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content" id="tabcontent">
                            <div role="tabpanel" class="tab-pane @if(!request()->has('combination')) active @endif"
                                id="info">
                                <div cla    ss="row">
                                    <div class="col-md-8">
                                        <h2>{{ ucfirst($product->name) }}</h2>
                                        <div class="form-group">
                                            <label for="sku">Código <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-barcode"></i>
                                                </div>
                                                <input type="text" name="sku" id="sku" placeholder="xxxxx"
                                                    class="form-control" value="{!! $product->sku !!}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nombre <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-at"></i>
                                                </div>
                                                <input type="text" name="name" id="name" placeholder="Nombre"
                                                    class="form-control" value="{!! $product->name !!}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Descripción <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" name="description" id="description" rows="5"
                                                required
                                                placeholder="Descripción">{!! $product->description  !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <img src="{{ asset("storage/$product->cover") }}" alt=""
                                                        class="img-responsive img-thumbnail">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"></div>
                                        <div class="form-group">
                                            <label for="cover">Cover </label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-picture-o"></i>
                                                </div>
                                                <input type="file" name="cover" id="cover" class="form-control">
                                            </div>
                                            <small class="text-warning">El cover del producto es obligatorio</small>
                                        </div>
                                        <div class="form-group">
                                            @foreach($images as $image)
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <img src="{{ asset("storage/$image->src") }}" alt="" class="img-responsive
                                                    img-thumbnail"> <br /> <br>
                                                    <a onclick="return confirm('¿Estás Seguro?')"
                                                        href="{{ route('product.remove.image', ['src' => $image->src]) }}"
                                                        class="btn btn-danger btn-sm btn-block">¿Eliminar?</a><br />
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="row"></div>
                                        <div class="form-group">
                                            <label for="image">Imagenes </label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-picture-o"></i>
                                                </div>
                                                <input type="file" name="image[]" id="image" class="form-control"
                                                    multiple>
                                            </div>
                                            <span class="text-warning">Puedes usar ctr (cmd) para seleccionar multiples
                                                imagenes</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Precio</label>

                                            <div class="input-group">
                                                <span
                                                    class="input-group-addon">{{ config('cart.currency_symbol') }}</span>
                                                <input type="text" name="price" id="price" placeholder="Precio"
                                                    class="form-control" value="{{ $product->price, 0}}" required>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="sale_price">Precio Oferta</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-addon">{{ config('cart.currency_symbol') }}</span>
                                                <input type="text" name="sale_price" id="sale_price"
                                                    placeholder="Precio Oferta" class="form-control"
                                                    value="{{ $product->sale_price }}">
                                            </div>
                                        </div>
                                        @if(!$brands->isEmpty())
                                        <div class="form-group">
                                            <label for="brands_id">Marca </label>
                                            <select name="brands_id" id="brands_id" class="form-control select2">
                                                <option value=""></option>
                                                @foreach($brands as $brand)
                                                <option @if($brand->id == $product->brands_id->id) selected="selected"
                                                    @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                        <input type="hidden" name="status" id="status" class="form-control" value="1">
                                        <!-- /.box-body -->
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="box-footer">
                                        <div class="btn-group">
                                            <a href="{{ route('products.index') }}"
                                                class="btn btn-default btn-sm">Regresar</a>
                                            <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
@endsection