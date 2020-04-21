<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <div class="card mt-4">
          <div class="card-header">
            <div class="row resetRow">

              <div class="col-5 col-sm-8 col-md-8">
                <button class="btn btn-primary btn-sm-reset" ng-click="addResource()">Agregar Lista</button>
              </div>
              <div class="col-7 col-sm-4 col-md-4">
                <div class="input-group input-group-sm">
                  <input type="text" ng-model="q.q" name="table_search" class="form-control float-right"
                    aria-describedby="searchIcon" placeholder="Buscar">

                  <div class="input-group-append">
                    <button type="button" ng-click="search()" class="btn btn-default"><i
                        class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table table-responsive">
              <table class="table table-hover table-stripped leadTable">
                <thead class="headTableLeads header-table">
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">% P.P</th>
                    <th scope="col">Comprobado</th>
                    <th scope="col">Verificado por</th>
                    <th scope="col">Fecha de inicio</th>
                    <th scope="col">Fecha de Finalización</th>
                  </tr>
                </thead>
                <tbody class="body-table">
                  <tr ng-repeat="resource in resources">
                    <td>@{{ resource.name }}</td>
                    <td>
                      <i class="fas fa-eye cursor" title="Ver" ng-click="showDialog(resource)"></i>
                      <i class="fas fa-edit cursor" title="Actualizar" ng-click="showUpdateDialog(resource)"></i>
                      <i class="fas fa-times cursor" title="Eliminar" ng-click="showDialogDelete(resource)"
                        ng-if="activ"></i>

                    </td>
                  </tr>
                </tbody>
              </table>

            </div>
            <div class="row">
              <div class="col-12 text-center">
                <button class="btn btn-secondary btn-sm-reset" ng-disabled="cargando" ng-click="moreRegister()">Cargar
                  Más</button>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

</div>


{{-- <div class="card">
  <div class="card-header">
    <h3 class="card-title">Agregar Lista</h3>

    <div class="card-tools">
      <div class="input-group input-group-sm" style="width: 150px;">
        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

        <div class="input-group-append">
          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Date</th>
          <th>Status</th>
          <th>Reason</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>183</td>
          <td>John Doe</td>
          <td>11-7-2014</td>
          <td><span class="tag tag-success">Approved</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
        <tr>
          <td>219</td>
          <td>Alexander Pierce</td>
          <td>11-7-2014</td>
          <td><span class="tag tag-warning">Pending</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
        <tr>
          <td>657</td>
          <td>Bob Doe</td>
          <td>11-7-2014</td>
          <td><span class="tag tag-primary">Approved</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
        <tr>
          <td>175</td>
          <td>Mike Doe</td>
          <td>11-7-2014</td>
          <td><span class="tag tag-danger">Denied</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div> --}}
<!-- Modal Create -->
<div class="modal fade" id="addResourceModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header pb-2">
        <h5 class="modal-title">Nueva Lista</h5>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert" id="alertResource"><span id="p"></span></div>
        <form ng-submit="createResource()">
          <div class=" row pl-0 pr-0">
            <div class="col-12 col-sm-8 form-group">
              <label for="nameList">Nombre <span class="text-danger">*</span> </label>
              <input type="text" ng-model="resource.name" id="nameList" name="nameList" class="form-control">
            </div>
            <div class="col-12 col-sm-4 form-group">
              <label for="pp_percentage">% P.P <span class="text-danger">*</span></label>
              <input type="text" class="form-control" ng-model="resource.pp_percentageCreate" id="pp_percentageCreate"
                name="pp_percentage">
            </div>

            <div class="col-12  col-sm-6 form-group">
              <label for="name">Fecha de inicio <span class="text-danger">*</span></label>
              <input type="date" ng-model="resource.start_date" id="start_date" name="start_date" class="form-control"
                required>
            </div>
            <div class="col-12 col-sm-6  form-group">
              <label for="end_date">Fecha de Finalización <span class="text-danger">*</span></label>
              <input type="date" id="end_date" name="end_date" ng-model="resource.end_date" class="form-control"
                required>
            </div>

          </div>
          <div class="text-right mt-2">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal DELETE-->

<div class="modal fade" id="Delete" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Desea eliminar este perfil?</h5>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nombre</label>
          <textarea class="form-control textareaReadOnly" name="question" ng-model="resource.name" readonly></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <form ng-submit="deleteResource(resource.id)">

          <button class="btn btn-danger">Eliminar</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal show -->

<div class="modal fade" id="Show" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Perfil</h5>
      </div>
      <div class="modal-body">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" ng-true-value="1" ng-false-value="0" ng-model="resource.city"
            disabled>
          <label class="form-check-label">¿Es un perfil de ciudad?</label>
        </div>
        <div class="form-group">
          <label>Nombre</label>
          <textarea rows="2" class="form-control textareaReadOnly" ng-model="resource.name" readonly></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Update -->
<div class="modal fade" id="Update" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar Perfil</h5>
      </div>
      <div class="modal-body">
        <form ng-submit="UpdateResource()">
          <div class="alert alert-danger" role="alert" id="alertUpdate"><span id="update"></span></div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" ng-true-value="1" ng-false-value="0"
              ng-model="resource.city">
            <label class="form-check-label">¿Es un perfil de ciudad?</label>
          </div>
          <div class="form-group">
            <label>Nombre</label>
            <textarea rows="2" class="form-control" name="question" ng-model="resource.name" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>