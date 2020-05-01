<!--AddCommunityLead modal-->
<div class="modal fade" id="updateProduct{{ $product->id }}" tabindex="-1" role="dialog"
    aria-labelledby="productCreateModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('products.update', $product->id) }}" method="post" class="form"
                enctype="multipart/form-data">
                <div class="modal-body">
                    @method('PUT')
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-6">
                            <div class="w-100">
                                <h5>Datos del producto</h5>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-8">
                                        <label for="reference_update">Referencia <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="reference" id="reference_update" class="form-control"
                                            value="{{ $product->reference }}" required>
                                    </div>
                                    <div class="col-4">
                                        <label for="sku_update">Código <span class="text-danger">*</span></label>
                                        <input type="text" name="sku" id="sku_update" class="form-control"
                                            value="{{ $product->sku }}" required>
                                    </div>

                                    <div class="col-8">
                                        <label for="name_update">Nombre <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name_update" class="form-control"
                                            value="{{ $product->name }}" required>
                                    </div>

                                    <div class="col-4">
                                        @if(!$brands->isEmpty())

                                        <label for="brands_id_update">Marca </label>
                                        <select name="brands_id" id="brands_id_update" class=" form-control ">
                                            <option value=""></option>
                                            @foreach($brands as $brand)
                                            <option @if($brand->id == $product->brands_id->id) selected="selected"
                                                @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>

                                    <div class="col-6">
                                        <label for="price_update">Precio <span class="text-danger">*</span></label>
                                        <input type="text" name="price" id="price_update" class="form-control"
                                            value="{{ $product->price }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="price_update">Precio Oferta <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="sale_price" id="sale_price_update" class="form-control"
                                            value="{{ $product->sale_price }}" required>
                                    </div>

                                    <div class="col-6">
                                        <label for="months">Meses a Pagar<span class="text-danger">*</span></label>
                                        <select name="months" id="months" class=" form-control " required>
                                            <option value=""> Seleccione</option>
                                            <option value="12" @if ($product->months == 12) selected @endif> 12 meses
                                            </option>
                                            <option value="15" @if ($product->months == 15) selected @endif> 15 meses
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label for="pays_update">Cuotas Mensuales<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="pays" id="pays_update" class="form-control"
                                            value="{{ $product->pays }}" required>
                                    </div>
                                </div>
                                <div class="col-12 px-0">
                                    <label for="months">Estado<span class="text-danger">*</span></label>
                                    <select name="status" id="status_update" class=" form-control " required>
                                        <option value=""> Seleccione</option>
                                        <option value="0" @if ($product->status == 0) selected @endif> Inactivo
                                        </option>
                                        <option value="1" @if ($product->status == 1) selected @endif> Activo
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 px-0">
                                    <label for="description_update">Descripción <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="description_update" rows="4"
                                        required>{{ $product->description }}</textarea>
                                </div>

                                <input id="product_status_id_update" type="hidden" class="form-control"
                                    name="product_status_id" value="2">
                                <input type="hidden" name="status" id="status_update" class="form-control" value="1">

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="w-100">
                                <h5>Imagenes</h5>

                                <label for="cover_update">Cover Principal <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="cover" id="cover_update">
                                        <label class="custom-file-label" for="cover_update" required>Seleccionar
                                            imagen</label>
                                    </div>
                                </div>

                                <label for="image_update">Images secundarias <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image[]" id="image_update"
                                            multiple required>
                                        <label class="custom-file-label" for="image_update">Seleccionar imagenes</label>
                                    </div>
                                </div>



                                <label for="description_image1_update">Imagen de descripcion 1<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="description_image1"
                                            id="description_image1_update" required>
                                        <label class="custom-file-label" for="description_image1_update">Seleccionar
                                            imagen</label>
                                    </div>
                                </div>

                                <label for="description_image2_update">Imagen de descripcion 2<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="description_image2"
                                            id="description_image2_update" required>
                                        <label class="custom-file-label" for="description_image2_update">Seleccionar
                                            imagen</label>
                                    </div>
                                </div>

                                <label for="description_image3_update">Imagen de descripcion 3<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="description_image3"
                                            id="description_image3_update" required>
                                        <label class="custom-file-label" for="description_image3_update">Seleccionar
                                            imagen</label>
                                    </div>
                                </div>


                                <label for="description_image4_update">Imagen de descripcion 4<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="description_image4"
                                            id="description_image4_update" required>
                                        <label class="custom-file-label" for="description_image4_update">Seleccionar
                                            imagen</label>
                                    </div>
                                </div>


                                <label for="specification_image_update">Imagen de especificaciones<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="specification_image"
                                            id="specification_image_update" required>
                                        <label class="custom-file-label" for="specification_image_update">Seleccionar
                                            imagen</label>
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
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>

        </div>
    </div>
</div>