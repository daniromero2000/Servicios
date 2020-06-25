<!--AddCommunityLead modal-->
<div class="modal fade" id="showProduct{{ $product->id }}" tabindex="-1" role="dialog"
    aria-labelledby="productCreateModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$product->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-7 col-xl-6">
                        <div class="w-100">
                            <h5>Datos del producto</h5>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label for="sku_show{{ $product->id }}">Código <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="sku" id="sku_show{{ $product->id }}" class="form-control"
                                        value="{{ $product->sku }}" required>
                                </div>

                                <div class="col-8">
                                    <label for="reference_show{{ $product->id }}">Referencia <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="reference" id="reference_show{{ $product->id }}"
                                        class="form-control" value="{{ $product->reference }}" required>
                                </div>

                                <div class="col-4">
                                    @if(!$brands->isEmpty())
                                    <label for="brand_id_show{{ $product->id }}">Marca </label>
                                    <select name="brand_id" id="brand_id_show{{ $product->id }}" class=" form-control ">
                                        <option value=""></option>
                                        @foreach($brands as $brand)
                                        <option @if($brand->id == $product->brand_id->id) selected="selected"
                                            @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>

                                <div class="col-8">
                                    <label for="name_show{{ $product->id }}">Nombre <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name_show{{ $product->id }}" class="form-control"
                                        value="{{ $product->name }}" required>
                                </div>

                                <div class="col-6">
                                    <label for="months_show{{ $product->id }}">Meses a Pagar<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="months" id="months_show{{ $product->id }}"
                                        class="form-control" value="{{ $product->months }}" required>
                                </div>
                                <div class="col-6">
                                    <label for="discount_show{{ $product->id }}">% de descuento<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="discount" id="discount_show{{ $product->id }}"
                                        class="form-control" value="{{ $product->discount }}" required>
                                </div>
                            </div>

                            <div class="col-12 px-0">
                                <label for="description_show{{ $product->id }}">Descripción <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control ckeditor" name="description"
                                    id="description_show{{ $product->id }}" rows="6"
                                    required>{{ $product->description }}</textarea>
                            </div>

                            {{-- <input id="product_status_id_show{{ $product->id }}" type="hidden" class="form-control"
                            name="product_status_id" value="2">
                            <input type="hidden" name="status" id="status_show{{ $product->id }}" class="form-control"
                                value="1"> --}}

                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-6">
                        <div class="w-100">
                            <h5>Imagenes</h5>

                            <div class="card collapsed-card">
                                <div class="card-header bg-primary ">
                                    <h3 class="card-title"> Imagenes del producto
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-plus text-white"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body container-list-img-product" style="display: none;">
                                    <label for="cover_show{{ $product->id }}">Cover Principal </label>
                                    <div class="w-100 ">
                                        <img class="img-fluid img-show-products lazy"
                                            src="{{ asset('images/blank.jpg')}}"
                                            data-src="{{asset("storage/$product->cover")}}" alt="">
                                    </div>

                                    <label for="image_show{{ $product->id }}">Images secundarias </label>
                                    <div class="w-100 ">
                                        @foreach($product->images()->get(['src']) as $image)
                                        <img class="img-fluid img-show-products lazy"
                                            src="{{ asset('images/blank.jpg')}}"
                                            data-src="{{asset("storage/$image->src")}}" alt="">
                                        @endforeach
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
                                        <div class="col-4">
                                            <label for="description_image1_show{{ $product->id }}">Imagen de
                                                descripcion 1</label>
                                            <img class="img-fluid img-show-products lazy"
                                                src="{{ asset('images/blank.jpg')}}"
                                                data-src="{{asset("storage/$product->description_image1")}}" alt="">
                                        </div>
                                        <div class="col-4">
                                            <label for="description_image2_show{{ $product->id }}">Imagen de
                                                descripcion 2</label>
                                            <img class="img-fluid img-show-products lazy"
                                                src="{{ asset('images/blank.jpg')}}"
                                                data-src="{{asset("storage/$product->description_image2")}}" alt="">
                                        </div>

                                        <div class="col-4">
                                            <label for="description_image3_show{{ $product->id }}">Imagen de
                                                descripcion 3</label>
                                            <img class="img-fluid img-show-products lazy"
                                                src="{{ asset('images/blank.jpg')}}"
                                                data-src="{{asset("storage/$product->description_image3")}}" alt="">
                                        </div>

                                        <div class="col-4">
                                            <label for="description_image4_show{{ $product->id }}">Imagen de
                                                descripcion 4</label>
                                            <img class="img-fluid img-show-products lazy"
                                                src="{{ asset('images/blank.jpg')}}"
                                                data-src="{{asset("storage/$product->description_image4")}}" alt="">
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
                                    <label for="specification_image_show{{ $product->id }}">Imagen de
                                        especificaciones<span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-4">
                                            <img class="img-fluid img-show-products lazy"
                                                src="{{ asset('images/blank.jpg')}}"
                                                data-src="{{asset("storage/$product->specification_image")}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            </div>

            {{-- <div id="cover_product_{{ $product->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <img class="img-fluid" src="{{ asset('images/blank.jpg')}}"
                            data-src="{{asset("storage/$product->cover")}}" alt="">
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>