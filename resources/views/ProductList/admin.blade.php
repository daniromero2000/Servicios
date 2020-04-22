<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-7">


        <div class="card bg-white shadow border-0">
          <div class="card-header">
            <div class="row resetRow">
              <div class=" col-5 col-sm-8 col-md-8">
                <h4 class="mb-2">
                  Listas
                </h4>
              </div>
              <div class=" col-7 col-sm-4 col-md-4">
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
                <thead class="headTableLeads small">
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">% P.P</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Verificado por:</th>
                    <th scope="col">Fecha de inicio</th>
                    <th scope="col">Fecha de Finalización</th>
                    <th scope="col">Zona</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody class="small">
                  <tr ng-repeat="productList in productLists">
                    <td>@{{ productList.name }}</td>
                    <td>@{{ productList.public_price_percentage }}</td>
                    <td>@{{ productList.checked }}</td>
                    <td>@{{ productList.checked_user_id }}</td>
                    <td>@{{ productList.start_date }}</td>
                    <td>@{{ productList.end_date }}</td>
                    <td>@{{ productList.zone }}</td>
                    <td>
                      <i class="fas fa-eye cursor" title="Ver" ng-click="showDialog(productList)"></i>
                      <i class="fas fa-edit cursor" title="Actualizar" ng-click="showUpdateDialog(productList)"></i>
                      <i class="fas fa-times cursor" title="Eliminar" ng-click="showDialogDelete(productList)"
                        ng-if="activ"></i>

                    </td>
                  </tr>
                </tbody>
              </table>

            </div>
            <div class="row">
              <div class="col-12 text-center">
                <button class="btn btn-secondary btn-sm" ng-disabled="cargando" ng-click="moreRegister()">Cargar
                  Más</button>
              </div>
            </div>
            <div class="text-right mt-2">
              <button class="btn btn-primary btn-sm" ng-click="addProductList()">Agregar Lista</button>
            </div>
          </div>

        </div>

        <div class="card mt-5 bg-white shadow border-0">
          <div class="card-header">
            <div class="row resetRow">
              <div class=" col-5 col-sm-8 col-md-8">
                <h4 class="mb-2">
                  Factores
                </h4>
              </div>
              <div class=" col-7 col-sm-4 col-md-4">
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
                <thead class="headTableLeads small">
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Verificado por:</th>
                    <th scope="col">Fecha de inicio</th>
                    <th scope="col">Fecha de Finalización</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody class="small">
                  <tr ng-repeat="factor in factors">
                    <td>@{{ factor.name }}</td>
                    <td>@{{ factor.value }}</td>
                    <td>@{{ factor.checked }}</td>
                    <td>@{{ factor.checked_user_id }}</td>
                    <td>@{{ factor.start_date }}</td>
                    <td>@{{ factor.end_date }}</td>
                    <td>
                      <i class="fas fa-eye cursor" title="Ver" ng-click="showDialogFactor(factor)"></i>
                      <i class="fas fa-edit cursor" title="Actualizar" ng-click="showUpdateDialogFactor(factor)"></i>
                      <i class="fas fa-times cursor" title="Eliminar" ng-click="showDialogDeleteFactor(factor)"
                        ng-if="activ"></i>

                    </td>
                  </tr>
                </tbody>
              </table>

            </div>
            <div class="row">
              <div class="col-12 text-center">
                {{-- <button class="btn btn-secondary btn-sm" ng-disabled="cargando" ng-click="moreRegister()">Cargar
                  Más</button> --}}
              </div>
            </div>
            <div class="text-right mt-2">
              <button class="btn btn-primary btn-sm" ng-click="addFactor()">Agregar Factor</button>
            </div>
          </div>

        </div>
        <!-- Modal Create -->
        <div class="modal fade" id="addFactorModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header pb-2">
                <h5 class="modal-title">Nuevo Factor</h5>
              </div>
              <div class="modal-body">
                <div class="alert alert-danger" role="alert" id="alertFactor"><span id="p"></span></div>
                <form ng-submit="createFactor()">
                  <div class=" row pl-0 pr-0">
                    <div class="col-12 col-sm-8 form-group">
                      <label for="nameCreateFactor">Nombre <span class="text-danger">*</span> </label>
                      <input type="text" ng-model="factor.name" id="nameCreateFactor" name="nameCreateFactor"
                        class="form-control">
                    </div>
                    <div class="col-12 col-sm-4 form-group">
                      <label for="valueCreateFactor">Valor <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" ng-model="factor.value" id="valueCreateFactor"
                        name="valueCreateFactor">
                    </div>
                    <div class="col-12  form-group">
                      <label for="start_date_create_factor">Fecha de inicio <span class="text-danger">*</span></label>
                      <input type="date" ng-model="factor.start_date" id="start_date_create_factor"
                        name="start_date_create_factor" class="form-control" required>
                    </div>
                    <div class="col-12  form-group">
                      <label for="end_date_create_factor">Fecha de Finalización <span
                          class="text-danger">*</span></label>
                      <input type="date" id="end_date_create_factor" name="end_date_create_factor"
                        ng-model="factor.end_date" class="form-control" required>
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
        <div class="modal fade" id="DeleteFactor" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">¿Desea eliminar este perfil?</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre</label>
                  <textarea class="form-control textareaReadOnly" name="question" ng-model="factor.name"
                    readonly></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <form ng-submit="deletefactor(factor.id)">

                  <button class="btn btn-danger">Eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal show -->
        <div class="modal fade" id="ShowFactor" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Perfil</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre</label>
                  <textarea rows="2" class="form-control textareaReadOnly" ng-model="factor.name" readonly></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Update -->
        <div class="modal fade" id="UpdateFactor" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Actualizar Perfil</h5>
              </div>
              <div class="modal-body">
                <form ng-submit="UpdateFactor()">
                  <div class="alert alert-danger" role="alert" id="alertUpdateFactor"><span id="update"></span></div>
                  <div class=" row pl-0 pr-0">
                    <div class="col-12 col-sm-8 form-group">
                      <label for="nameUpdateFactor">Nombre <span class="text-danger">*</span> </label>
                      <input type="text" ng-model="factor.name" id="nameUpdateFactor" name="nameUpdateFactor"
                        class="form-control">
                    </div>
                    <div class="col-12 col-sm-4 form-group">
                      <label for="valueUpdateFactor">Valor<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" ng-model="factor.value" id="valueUpdateFactor"
                        name="valueUpdateFactor">
                    </div>
                    <div class="col-12  form-group">
                      <label for="start_date_update_factor">Fecha de inicio <span class="text-danger">*</span></label>
                      <input type="date" ng-model="factor.start_date" id="start_date_update_factor"
                        name="start_date_update_factor" class="form-control" required>
                    </div>
                    <div class="col-12  form-group">
                      <label for="end_date_update_factor">Fecha de Finalización <span
                          class="text-danger">*</span></label>
                      <input type="date" id="end_date_update_factor" name="end_date_update_factor"
                        ng-model="factor.end_date" class="form-control" required>
                    </div>

                  </div>
                  <div class="text-right mt-2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>

                </form>
              </div>
            </div>
          </div>
        </div>


        <div class="card mt-5 bg-white shadow border-0">
          <div class="card-header">
            <div class="row resetRow">
              <div class=" col-5 col-sm-8 col-md-8">
                <h4 class="mb-2">
                  Factores
                </h4>
              </div>
              <div class=" col-7 col-sm-4 col-md-4">
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
                <thead class="headTableLeads small">
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Verificado por:</th>
                    <th scope="col">Fecha de inicio</th>
                    <th scope="col">Fecha de Finalización</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody class="small">
                  <tr ng-repeat="factor in factors">
                    <td>@{{ factor.name }}</td>
                    <td>@{{ factor.value }}</td>
                    <td>@{{ factor.checked }}</td>
                    <td>@{{ factor.checked_user_id }}</td>
                    <td>@{{ factor.start_date }}</td>
                    <td>@{{ factor.end_date }}</td>
                    <td>
                      <i class="fas fa-eye cursor" title="Ver" ng-click="showDialogFactor(factor)"></i>
                      <i class="fas fa-edit cursor" title="Actualizar" ng-click="showUpdateDialogFactor(factor)"></i>
                      <i class="fas fa-times cursor" title="Eliminar" ng-click="showDialogDeleteFactor(factor)"
                        ng-if="activ"></i>

                    </td>
                  </tr>
                </tbody>
              </table>

            </div>
            <div class="row">
              <div class="col-12 text-center">
                {{-- <button class="btn btn-secondary btn-sm" ng-disabled="cargando" ng-click="moreRegister()">Cargar
                  Más</button> --}}
              </div>
            </div>
            <div class="text-right mt-2">
              <button class="btn btn-primary btn-sm" ng-click="addFactor()">Agregar Factor</button>
            </div>
          </div>

        </div>
        <!-- Modal Create -->
        <div class="modal fade" id="addFactorModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header pb-2">
                <h5 class="modal-title">Nuevo Factor</h5>
              </div>
              <div class="modal-body">
                <div class="alert alert-danger" role="alert" id="alertFactor"><span id="p"></span></div>
                <form ng-submit="createFactor()">
                  <div class=" row pl-0 pr-0">
                    <div class="col-12 col-sm-8 form-group">
                      <label for="nameCreateFactor">Nombre <span class="text-danger">*</span> </label>
                      <input type="text" ng-model="factor.name" id="nameCreateFactor" name="nameCreateFactor"
                        class="form-control">
                    </div>
                    <div class="col-12 col-sm-4 form-group">
                      <label for="valueCreateFactor">Valor <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" ng-model="factor.value" id="valueCreateFactor"
                        name="valueCreateFactor">
                    </div>
                    <div class="col-12  form-group">
                      <label for="start_date_create_factor">Fecha de inicio <span class="text-danger">*</span></label>
                      <input type="date" ng-model="factor.start_date" id="start_date_create_factor"
                        name="start_date_create_factor" class="form-control" required>
                    </div>
                    <div class="col-12  form-group">
                      <label for="end_date_create_factor">Fecha de Finalización <span
                          class="text-danger">*</span></label>
                      <input type="date" id="end_date_create_factor" name="end_date_create_factor"
                        ng-model="factor.end_date" class="form-control" required>
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
        <div class="modal fade" id="DeleteFactor" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">¿Desea eliminar este perfil?</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre</label>
                  <textarea class="form-control textareaReadOnly" name="question" ng-model="factor.name"
                    readonly></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <form ng-submit="deletefactor(factor.id)">

                  <button class="btn btn-danger">Eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal show -->
        <div class="modal fade" id="ShowFactor" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Perfil</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre</label>
                  <textarea rows="2" class="form-control textareaReadOnly" ng-model="factor.name" readonly></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Update -->
        <div class="modal fade" id="UpdateFactor" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Actualizar Perfil</h5>
              </div>
              <div class="modal-body">
                <form ng-submit="UpdateFactor()">
                  <div class="alert alert-danger" role="alert" id="alertUpdateFactor"><span id="update"></span></div>
                  <div class=" row pl-0 pr-0">
                    <div class="col-12 col-sm-8 form-group">
                      <label for="nameUpdateFactor">Nombre <span class="text-danger">*</span> </label>
                      <input type="text" ng-model="factor.name" id="nameUpdateFactor" name="nameUpdateFactor"
                        class="form-control">
                    </div>
                    <div class="col-12 col-sm-4 form-group">
                      <label for="valueUpdateFactor">Valor<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" ng-model="factor.value" id="valueUpdateFactor"
                        name="valueUpdateFactor">
                    </div>
                    <div class="col-12  form-group">
                      <label for="start_date_update_factor">Fecha de inicio <span class="text-danger">*</span></label>
                      <input type="date" ng-model="factor.start_date" id="start_date_update_factor"
                        name="start_date_update_factor" class="form-control" required>
                    </div>
                    <div class="col-12  form-group">
                      <label for="end_date_update_factor">Fecha de Finalización <span
                          class="text-danger">*</span></label>
                      <input type="date" id="end_date_update_factor" name="end_date_update_factor"
                        ng-model="factor.end_date" class="form-control" required>
                    </div>

                  </div>
                  <div class="text-right mt-2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>




<!-- Modal Create -->
<div class="modal fade" id="addProductListModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header pb-2">
        <h5 class="modal-title">Nueva Lista</h5>
      </div>
      <div class="modal-body">
        {{-- <input type="text" ng-model="productList.creation_user_id" id="creation_user_id" value="{{ auth()->user()->id}}"
        hidden name="creation_user_id"> --}}
        <div class="alert alert-danger" role="alert" id="alertProductList"><span id="p"></span></div>
        <form ng-submit="createProductList()">
          <div class=" row pl-0 pr-0">
            <div class="col-12 col-sm-8 form-group">
              <label for="name">Nombre <span class="text-danger">*</span> </label>
              <input type="text" ng-model="productList.name" id="name" name="name" class="form-control">
            </div>
            <div class="col-12 col-sm-4 form-group">
              <label for="public_price_percentage">% P.P <span class="text-danger">*</span></label>
              <input type="text" class="form-control" ng-model="productList.public_price_percentage"
                id="public_price_percentage" name="public_price_percentage">
            </div>
            <div class="col-12  form-group">
              <label for="name">Zona <span class="text-danger">*</span></label>
              <select ng-model="productList.zone" id="zone" name="zone" class="form-control select2" required>
                <option selected value> Selecciona Ciudad </option>
                <option value="1"> Zona 1 </option>

              </select>
            </div>
            <div class="col-12  form-group">
              <label for="name">Fecha de inicio <span class="text-danger">*</span></label>
              <input type="date" ng-model="productList.start_date" id="start_date" name="start_date"
                class="form-control" required>
            </div>
            <div class="col-12  form-group">
              <label for="end_date">Fecha de Finalización <span class="text-danger">*</span></label>
              <input type="date" id="end_date" name="end_date" ng-model="productList.end_date" class="form-control"
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
          <textarea class="form-control textareaReadOnly" name="question" ng-model="productList.name"
            readonly></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <form ng-submit="deleteProductList(productList.id)">

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
        <div class="form-group">
          <label>Nombre</label>
          <textarea rows="2" class="form-control textareaReadOnly" ng-model="productList.name" readonly></textarea>
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
        <form ng-submit="UpdateProductList()">
          <div class="alert alert-danger" role="alert" id="alertUpdate"><span id="update"></span></div>
          <div class=" row pl-0 pr-0">
            <div class="col-12 col-sm-8 form-group">
              <label for="nameUpdateProductList">Nombre <span class="text-danger">*</span> </label>
              <input type="text" ng-model="productList.name" id="nameUpdateProductList" name="nameUpdateProductList"
                class="form-control">
            </div>
            <div class="col-12 col-sm-4 form-group">
              <label for="public_price_percentageUpdate">% P.P <span class="text-danger">*</span></label>
              <input type="text" class="form-control" ng-model="productList.public_price_percentage"
                id="public_price_percentageUpdate" name="public_price_percentageUpdate">
            </div>
            <div class="col-12  form-group">
              <label for="zoneUpdateProductList">Zona <span class="text-danger">*</span></label>
              <select ng-model="productList.zone" id="zoneUpdateProductList" name="zoneUpdateProductList"
                class="form-control select2" required>
                <option selected value> Selecciona Ciudad </option>
                <option value="1"> Zona 1 </option>

              </select>
            </div>
            <div class="col-12  form-group">
              <label for="start_dateUpdateProductList">Fecha de inicio <span class="text-danger">*</span></label>
              <input type="date" ng-model="productList.start_date" id="start_dateUpdateProductList"
                name="start_dateUpdateProductList" class="form-control" required>
            </div>
            <div class="col-12  form-group">
              <label for="end_dateProductList">Fecha de Finalización <span class="text-danger">*</span></label>
              <input type="date" id="end_dateProductList" name="end_dateProductList" ng-model="productList.end_date"
                class="form-control" required>
            </div>

          </div>
          <div class="text-right mt-2">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>

        </form>
      </div>
    </div>
  </div>
</div>