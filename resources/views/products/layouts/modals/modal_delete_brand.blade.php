<!--AddCommunityLead modal-->
<div class="modal fade" id="deletebrand{{ $brand->id }}" tabindex="-1" role="dialog"
    aria-labelledby="productCreateModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form style="display:inline-block" action="{{  route('brands.destroy', $brand->id) }}" method="post"
                class="form-horizontal">
                <input type="hidden" name="_method" value="delete">
                @csrf
                <input type="hidden" name="_method" value="delete">
                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Estas Seguro ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>