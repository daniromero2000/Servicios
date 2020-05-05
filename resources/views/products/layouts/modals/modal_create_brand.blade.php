<!--AddCommunityLead modal-->
<div class="modal fade" id="addbrand" tabindex="-1" role="dialog" aria-labelledby="productCreateModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Marca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('brands.store') }}" method="post" class="form" enctype="multipart/form-data">
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="nameBrand">Nombre <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="name" id="nameBrand" placeholder="Nombre" class="form-control"
                                value="{{ old('name') }}" required>

                        </div>

                        <label for="coverBrand">Logo <span class="text-danger">*</span></label>

                        <div class="custom-file">
                            <input class="custom-file-input" type="file" name="cover" id="coverBrand" required>
                            <label class="custom-file-label" for="coverBrand">Seleccionar
                                imagen</label>
                        </div>


                    </div>
                    <div class="modal-footer pb-0">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
            </form>

        </div>
    </div>
</div>