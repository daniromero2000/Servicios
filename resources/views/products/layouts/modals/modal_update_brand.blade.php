<!--AddCommunityLead modal-->
<div class="modal fade" id="updatebrand{{$brand->id}}" tabindex="-1" role="dialog"
    aria-labelledby="productCreateModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Marca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('brands.update', $brand->id) }}" method="post" class="form"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="_method" value="put">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="nameBrand">Nombre <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="name" id="nameBrand{{$brand->id}}" placeholder="Nombre"
                                class="form-control" value="{{ $brand->name }}" required>

                        </div>

                        <label for="coverBrand">Logo <span class="text-danger">*</span></label>
                        <div>
                            <img class="img-fluid img-show-products" src="{{asset("storage/$brand->cover")}}" alt="">
                        </div>
                        <div class="custom-file">
                            <input class="custom-file-input" type="file" name="cover" id="coverBrand{{$brand->cover}}">
                            <label class="custom-file-label" for="coverBrand{{$brand->id}}">Cambiar imagen</label>
                        </div>


                    </div>
                    <div class="modal-footer pb-0">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
            </form>

        </div>
    </div>
</div>