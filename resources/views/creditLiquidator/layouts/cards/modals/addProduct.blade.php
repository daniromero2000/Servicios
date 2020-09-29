  <div id="addItem@{{key}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="my-modal-title">Agregar Producto</h5>
                  <button class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form ng-submit="createItemLiquidator()">
                      <div class=" row pl-0 pr-0">
                          <div class="col-8 form-group">
                              <label for="name">Tipo <span class="text-danger">*</span></label>
                              <select ng-if="tab[0].length != 0" ng-model="items.COD_PROCESO" id="action" name="action" class="form-control" required>
                                  <option selected value> Seleccione </option>
                                  <option value="2">Cargo</option>
                                  <option value="3" ng-if="tab[0][0].PRECIO >= 900000 && liquidator[key][3].apply_gift == 1">
                                      Obsequio</option>
                                  <option value="4">Combo</option>
                              </select>
                              <select ng-if="tab[0].length == 0" ng-model="items.COD_PROCESO" id="action" name="action" class="form-control" required>
                                  <option selected value> Seleccione </option>
                                  <option value="1">Articulo</option>
                                  <option value="4">Combo</option>
                              </select>
                          </div>
                          <div class="col-4">
                              <div class="form-group">
                                  <label for="name">Selecciona lista<span class="text-danger">*</span></label>
                                  <select ng-model="items.LISTA" id="typeLists" name="typeLists" class="form-control select2" required>
                                      <option selected value> Selecciona </option>
                                      <option ng-repeat="list in lists" value="@{{list.name}}">
                                          @{{list.name}}</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div ng-if="items.COD_PROCESO && items.LISTA">
                          <div class=" row pl-0 pr-0">
                              <div class="col-4 form-group">
                                  <label for="codeProduct">Codigo <span class="text-danger">*</span></label>
                                  <input required type="text" class="form-control" ng-model="items.CODIGO" ng-blur="getProduct()" id="codeProduct" name="codeProduct">
                              </div>
                              <div class="col-8 form-group">
                                  <label for="nameProduct">Nombre</label>
                                  <input required type="text" ng-model="items.ARTICULO" readonly id="nameProduct" name="nameProduct" class="form-control">
                              </div>
                              <div class="col-4 form-group">
                                  <label for="quanty">Cantidad <span class="text-danger">*</span></label>
                                  <input required type="text" class="form-control" ng-model="items.CANTIDAD" id="quanty" name="quanty">
                              </div>
                              <div class="col-8 form-group">
                                  <label for="value">Valor</label>
                                  <input required type="text" ng-model="items.PRECIO " ng-currency ng-disabled="(items.COD_PROCESO == 1) || (items.COD_PROCESO == 4) || (items.COD_PROCESO == 2 && (items.CODIGO == 'IVAV' || items.CODIGO == 'AV10' || items.CODIGO == 'AV12' || items.CODIGO == 'AV15'))" id="value" name="value" class="form-control">
                              </div>
                              <div class="col-4 form-group">
                                  <label for="selection">Seleccion <span class="text-danger">*</span></label>
                                  <input required type="text" class="form-control" ng-model="items.SELECCION" id="selection" name="selection">
                              </div>
                          </div>
                          <div class="text-right mt-2">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="submit" ng-disabled="buttonDisabled" class="btn btn-primary">Agregar</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
