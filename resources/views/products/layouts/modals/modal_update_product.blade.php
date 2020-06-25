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
                        <div class="col-lg-7 col-xl-6">
                            <div class="w-100">
                                <h5>Datos del producto</h5>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="sku_update{{ $product->id }}">Código <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="sku" id="sku_update{{ $product->id }}"
                                            class="form-control" value="{{ $product->sku }}"
                                            onfocusout="idproduct({{$product->id}})" required>
                                    </div>
                                    <div class="col-8">
                                        <label for="reference_update{{ $product->id }}">Referencia <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="reference" id="reference_update{{ $product->id }}"
                                            class="form-control" value="{{ $product->reference }}" required>
                                    </div>
                                    <div class="col-4">
                                        @if(!$brands->isEmpty())

                                        <label for="brand_id_update{{ $product->id }}">Marca </label>
                                        <select name="brand_id" id="brand_id_update{{ $product->id }}"
                                            class=" form-control ">
                                            <option value=""></option>
                                            @foreach($brands as $brand)
                                            <option @if($brand->id == $product->brand_id->id) selected="selected"
                                                @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>

                                    <div class="col-8">
                                        <label for="name_update{{ $product->id }}">Nombre <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name_update{{ $product->id }}"
                                            class="form-control" readonly value="{{ $product->name }}" required>
                                    </div>


                                    <div class="col-6">
                                        <label for="months_update{{ $product->id }}">Meses a Pagar<span
                                                class="text-danger">*</span></label>
                                        <select name="months" id="months_update{{ $product->id }}"
                                            class=" form-control " required>
                                            <option value=""> Seleccione</option>
                                            <option value="12" @if ($product->months == 12) selected @endif> 12 meses
                                            </option>
                                            <option value="15" @if ($product->months == 15) selected @endif> 15 meses
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label for="discount_update{{ $product->id }}">% de descuento<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="discount" id="discount_update{{ $product->id }}"
                                            class="form-control" value="{{ $product->discount }}" required>
                                    </div>
                                </div>
                                <div class="col-12 px-0">
                                    <label for="status_update_{{ $product->id }}">Estado<span
                                            class="text-danger">*</span></label>
                                    <select name="status" id="status_update_{{ $product->id }}" class=" form-control "
                                        required>
                                        <option value=""> Seleccione</option>
                                        <option value="0" @if ($product->status == 0) selected @endif> Inactivo
                                        </option>
                                        <option value="1" @if ($product->status == 1) selected @endif> Activo
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 px-0">
                                    <label for="description_update{{ $product->id }}">Descripción <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control ckeditor" name="description"
                                        id="description_update{{ $product->id }}" rows="4"
                                        required>{{ $product->description }}</textarea>
                                </div>
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
                                        <label for="cover_update{{ $product->id }}">Cover Principal <span
                                                class="text-danger">*</span></label>
                                        <div>
                                            <img class="img-fluid img-show-products lazy"
                                                src="{{ asset('images/blank.jpg')}}"
                                                data-src="{{asset("storage/$product->cover")}}" alt="">

                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="cover"
                                                    id="cover_update{{ $product->id }}">
                                                <label class="custom-file-label"
                                                    for="cover_update{{ $product->id }}">Cambiar imagen</label>
                                            </div>
                                        </div>
                                        <label for="image_update{{ $product->id }}">Images secundarias <span
                                                class="text-danger">*</span></label>
                                        <div style="max-height: 100px;overflow: auto;">
                                            <div class="row mx-0">
                                                @foreach($product->images()->get(['src']) as $image)
                                                <div class="col-4">

                                                    <img class="img-fluid img-show-products lazy"
                                                        src="{{ asset('images/blank.jpg')}}"
                                                        data-src="{{asset("storage/$image->src")}}" alt="">

                                                    <a onclick="return confirm('¿Estás Seguro?')"
                                                        href="{{ route('product.remove.image', ['src' => $image->src]) }}"
                                                        class="btn btn-danger btn-sm btn-block">¿Eliminar?</a><br />

                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image[]"
                                                    id="image_update{{ $product->id }}" multiple>
                                                <label class="custom-file-label" for="image_update{{ $product->id }}"
                                                    style="overflow: hidden;">Cambiar magenes</label>
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
                                        <div class="row mx-0">
                                            <div class="col-sm-6 col-lg-11 col-xl-6">

                                                <label for="description_image1_update{{ $product->id }}">Imagen de
                                                    descripcion 1<span class="text-danger">*</span></label>
                                                <div class="mb-2">
                                                    <img class="img-fluid img-show-products lazy"
                                                        src="{{ asset('images/blank.jpg')}}"
                                                        data-src="{{asset("storage/$product->description_image1")}}"
                                                        alt="">

                                                </div>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            name="description_image1"
                                                            id="description_image1_update{{ $product->id }}">
                                                        <label class="custom-file-label"
                                                            for="description_image1_update{{ $product->id }}">Cambiar
                                                            imagen</label>
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="col-sm-6 col-lg-11 col-xl-6">

                                                <label for="description_image2_update{{ $product->id }}">Imagen de
                                                    descripcion 2<span class="text-danger">*</span></label>
                                                <div class="mb-2">
                                                    <img class="img-fluid img-show-products lazy"
                                                        src="{{ asset('images/blank.jpg')}}"
                                                        data-src="{{asset("storage/$product->description_image2")}}"
                                                        alt="">
                                                </div>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            name="description_image2"
                                                            id="description_image2_update{{ $product->id }}">
                                                        <label class="custom-file-label"
                                                            for="description_image2_update{{ $product->id }}">Cambiar
                                                            imagen</label>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="col-sm-6 col-lg-11 col-xl-6">

                                                <label for="description_image3_update{{ $product->id }}">Imagen de
                                                    descripcion 3<span class="text-danger">*</span></label>
                                                <div class="mb-2">
                                                    <img class="img-fluid img-show-products lazy"
                                                        src="{{ asset('images/blank.jpg')}}"
                                                        data-src="{{asset("storage/$product->description_image3")}}"
                                                        alt="">
                                                </div>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            name="description_image3"
                                                            id="description_image3_update{{ $product->id }}">

                                                        <label class="custom-file-label"
                                                            for="description_image3_update{{ $product->id }}">Cambiar
                                                            imagen</label>
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="col-sm-6 col-lg-11 col-xl-6">
                                                <label for="description_image4_update{{ $product->id }}">Imagen de
                                                    descripcion 4<span class="text-danger">*</span></label>
                                                <div class="mb-2">

                                                    <img class="img-fluid img-show-products lazy"
                                                        src="{{ asset('images/blank.jpg')}}"
                                                        data-src="{{asset("storage/$product->description_image4")}}"
                                                        alt="">

                                                </div>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            name="description_image4"
                                                            id="description_image4_update{{ $product->id }}">
                                                        <label class="custom-file-label"
                                                            for="description_image4_update{{ $product->id }}">Cambiar
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
                                    <div class="card-body" style="display: none;">
                                        <label for="specification_image_update{{ $product->id }}">Imagen de
                                            especificaciones<span class="text-danger">*</span></label>
                                        <div>

                                            <img class="img-fluid img-show-products lazy"
                                                src="{{ asset('images/blank.jpg')}}"
                                                data-src="{{asset("storage/$product->specification_image")}}" alt="">

                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="specification_image"
                                                    id="specification_image_update{{ $product->id }}">
                                                <label class="custom-file-label"
                                                    for="specification_image_update{{ $product->id }}">Cambiar
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
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>

        </div>
    </div>
</div>