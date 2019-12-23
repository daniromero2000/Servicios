<!--Delete modal-->
<div class="modal fade" id="deleteleadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-center">
      <div class="modal-header text-center">
        <h4 class="modal-title" id="myModalLabel">Eliminar Lead</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row resetRow ">
            <div class="col-12 text-center">
              <p>¿Estás seguro que deseas eliminar este registro?</p>
            </div>
            <div class="col-12">
              <div class="row resetRow">

                <div class=" offset-4 col-4 form-group float-right">
                  <form ng-submit="confirmDelete()">
                    <div class="form-group text-right">
                      <button class="btn btn-primary">Eliminar</button>
                    </div>
                  </form>
                </div>
                <div class="col-4 form-group float-right">
                  <form ng-submit="cancelDelete()">
                    <div class="form-group text-right">
                      <button class="btn btn-danger">Cancelar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>