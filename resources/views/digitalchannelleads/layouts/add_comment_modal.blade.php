<!-- The Comment Modal -->
<div id="commentmodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa el comentario</h4>
      </div>
      <div class="modal-body">
        <div class="box">
          <form action="{{ route('Comments.store') }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
              @csrf
              <input name="idLead" id="idLead" hidden value="{{ $digitalChannelLead->id }}">
              <div class="form-group">

                <label for="comment">Comentario <span class="text-danger">*</span></label>
                <input type="text" name="comment" validation-pattern="text" id="comment" placeholder="Comentario"
                  class="form-control" value="{{ old('comment') }}" required autofocus>
              </div>
            </div>
            <div class="box-footer">
              <div class="btn-group">
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>