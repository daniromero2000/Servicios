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
                    <div class="col-6">
                        <div class="w-100">
                            <h5>Datos del producto</h5>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    <label for="reference_show">Referencia <span class="text-danger">*</span></label>
                                    <input type="text" name="reference" id="reference_show" class="form-control"
                                        value="{{ $product->reference }}" required>
                                </div>
                                <div class="col-4">
                                    <label for="sku_show">Código <span class="text-danger">*</span></label>
                                    <input type="text" name="sku" id="sku_show" class="form-control"
                                        value="{{ $product->sku }}" required>
                                </div>

                                <div class="col-8">
                                    <label for="name_show">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name_show" class="form-control"
                                        value="{{ $product->name }}" required>
                                </div>

                                <div class="col-4">
                                    @if(!$brands->isEmpty())

                                    <label for="brands_id_show">Marca </label>
                                    <select name="brands_id" id="brands_id_show" class=" form-control ">
                                        <option value=""></option>
                                        @foreach($brands as $brand)
                                        <option @if($brand->id == $product->brands_id->id) selected="selected"
                                            @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <label for="price_show">Precio <span class="text-danger">*</span></label>
                                    <input type="text" name="price" id="price_show" class="form-control"
                                        value="{{ $product->price }}" required>
                                </div>
                                <div class="col-6">
                                    <label for="price_show">Precio Oferta <span class="text-danger">*</span></label>
                                    <input type="text" name="sale_price" id="sale_price_show" class="form-control"
                                        value="{{ $product->sale_price }}" required>
                                </div>

                                <div class="col-6">
                                    <label for="months_show">Meses a Pagar<span class="text-danger">*</span></label>
                                    <input type="text" name="months" id="months_show" class="form-control"
                                        value="{{ $product->months }}" required>
                                </div>
                                <div class="col-6">
                                    <label for="pays_show">Cuotas Mensuales<span class="text-danger">*</span></label>
                                    <input type="text" name="pays" id="pays_show" class="form-control"
                                        value="{{ $product->pays }}" required>
                                </div>
                            </div>

                            <div class="col-12 px-0">
                                <label for="description_show">Descripción <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description_show" rows="6"
                                    required>{{ $product->description }}</textarea>
                            </div>

                            <input id="product_status_id_show" type="hidden" class="form-control"
                                name="product_status_id" value="2">
                            <input type="hidden" name="status" id="status_show" class="form-control" value="1">

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="w-100">
                            <h5>Imagenes</h5>

                            <label for="cover_show">Cover Principal <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-4">
                                    <img class="img-fluid" src="{{asset("storage/$product->cover")}}" alt="">
                                </div>
                            </div>


                            <label for="image_show">Images secundarias <span class="text-danger">*</span></label>
                            <div class="row">
                                @foreach($product->images()->get(['src']) as $image)
                                <div class="col-4">
                                    <img class="img-fluid" src="{{asset("storage/$image->src")}}" alt="">
                                </div>
                                @endforeach
                            </div>




                            <label for="description_image1_show">Imagen de descripcion 1<span
                                    class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-4">
                                    <img class="img-fluid" src="{{asset("storage/$product->description_image1")}}"
                                        alt="">
                                </div>
                            </div>


                            <label for="description_image2_show">Imagen de descripcion 2<span
                                    class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-4">
                                    <img class="img-fluid" src="{{asset("storage/$product->description_image2")}}"
                                        alt="">
                                </div>
                            </div>

                            <label for="description_image3_show">Imagen de descripcion 3<span
                                    class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-4">
                                    <img class="img-fluid" src="{{asset("storage/$product->description_image3")}}"
                                        alt="">
                                </div>
                            </div>


                            <label for="description_image4_show">Imagen de descripcion 4<span
                                    class="text-danger">*</span></label>

                            <div class="row">
                                <div class="col-4">
                                    <img class="img-fluid" src="{{asset("storage/$product->description_image4")}}"
                                        alt="">
                                </div>
                            </div>


                            <label for="specification_image_show">Imagen de especificaciones<span
                                    class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-4">
                                    <img class="img-fluid" src="{{asset("storage/$product->specification_image")}}"
                                        alt="">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>