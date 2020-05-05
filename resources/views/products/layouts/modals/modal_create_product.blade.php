<!--AddCommunityLead modal-->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="productCreateModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('products.store') }}" method="post" class="form" enctype="multipart/form-data">
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-7 col-xl-6">
                            <div class="w-100">
                                <h5>Datos del producto</h5>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-8">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" name="reference" id="reference" class="form-control"
                                            value="{{ old('reference') }}" required>
                                    </div>
                                    <div class="col-4">
                                        <label for="sku">Código <span class="text-danger">*</span></label>
                                        <input type="text" name="sku" id="sku" class="form-control"
                                            value="{{ old('sku') }}" required>
                                    </div>

                                    <div class="col-8">
                                        <label for="name">Nombre <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name') }}" required>
                                    </div>

                                    <div class="col-4">
                                        @if(!$brands->isEmpty())

                                        <label for="brands_id">Marca </label>
                                        <select name="brands_id" id="brands_id" class=" form-control " required>
                                            <option value=""> Seleccione</option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>

                                    <div class="col-6">
                                        <label for="price">Precio <span class="text-danger">*</span></label>
                                        <input type="text" name="price" id="price" class="form-control"
                                            value="{{ old('price') }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="price">Precio de Oferta <span class="text-danger">*</span></label>
                                        <input type="text" name="sale_price" id="sale_price" class="form-control"
                                            value="{{ old('sale_price') }}" required>
                                    </div>

                                    <div class="col-6">
                                        <label for="months">Meses a Pagar<span class="text-danger">*</span></label>
                                        <select name="months" id="months" class=" form-control " required>
                                            <option value=""> Seleccione</option>
                                            <option value="12"> 12 meses</option>
                                            <option value="15"> 15 meses</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="pays">Valor Cuota Mensual<span class="text-danger">*</span></label>
                                        <input type="text" name="pays" id="pays" class="form-control"
                                            value="{{ old('pays') }}" required>
                                    </div>
                                </div>

                                <div class="col-12 px-0">
                                    <label for="description">Descripción <span class="text-danger">*</span></label>
                                    <textarea class="form-control ckeditor" name="description" id="description" rows="6"
                                        required>{{ old('description') }}</textarea>
                                </div>

                                <input id="product_status_id" type="hidden" class="form-control"
                                    name="product_status_id" value="2">
                                <input type="hidden" name="status" id="status" class="form-control" value="1">

                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-6">
                            <div class="w-100">
                                <h5>Imagenes</h5>

                                <div class="card collapsed-card">
                                    <div class="card-header bg-primary ">
                                        <h3 class="card-title">Imagenes del producto</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-plus text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body " style="display: none;">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <label for="cover">Cover Principal <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="cover"
                                                            id="cover">
                                                        <label class="custom-file-label" for="cover"
                                                            required>Seleccionar
                                                            imagen</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="image">Images secundarias <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="image[]"
                                                            id="image" multiple required>
                                                        <label class="custom-file-label" for="image"
                                                            style="overflow: hidden;">Seleccionar
                                                            imagenes</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card collapsed-card">
                                    <div class="card-header bg-success ">
                                        <h3 class="card-title">Imagenes de descripción</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-plus text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body " style="display: none;">
                                        <div class="row">

                                            <div class="col-xl-6">
                                                <label for="description_image1">Imagen de descripcion 1<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            name="description_image1" id="description_image1" required>
                                                        <label class="custom-file-label"
                                                            for="description_image1">Seleccionar
                                                            imagen</label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-xl-6">

                                                <label for="description_image2">Imagen de descripcion 2<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            name="description_image2" id="description_image2" required>
                                                        <label class="custom-file-label"
                                                            for="description_image2">Seleccionar
                                                            imagen</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">

                                                <label for="description_image3">Imagen de descripcion 3<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            name="description_image3" id="description_image3" required>
                                                        <label class="custom-file-label"
                                                            for="description_image3">Seleccionar
                                                            imagen</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">

                                                <label for="description_image4">Imagen de descripcion 4<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            name="description_image4" id="description_image4" required>
                                                        <label class="custom-file-label"
                                                            for="description_image4">Seleccionar
                                                            imagen</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card collapsed-card">
                                    <div class="card-header bg-secondary ">
                                        <h3 class="card-title">Imagen de especificaciones</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-plus text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body " style="display: none;">
                                        <label for="specification_image">Imagen de especificaciones<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="specification_image"
                                                    id="specification_image" required>
                                                <label class="custom-file-label" for="specification_image">Seleccionar
                                                    imagen</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                            </div>

                        </div>

                    </div>

                    {{-- <div class="form-group text-right mb-0 mt-2">
                        <button class="btn btn-primary">Agregar</button>
                        <button class=" btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>