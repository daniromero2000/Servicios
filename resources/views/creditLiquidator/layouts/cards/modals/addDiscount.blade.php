  <div id="addDiscount@{{key}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="my-modal-title">Ingresar Descuento</h5>
                  <button class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form ng-submit="createDiscountLiquidator()">
                      <div class=" row pl-0 pr-0">
                          <div class="col-8">
                              <div class="form-group">
                                  <label for="name">Tipo de descuento <span class="text-danger">*</span></label>
                                  <select ng-model="discount.type" id="discountType" name="discountType" class="form-control select2" required>
                                      <option selected value> Selecciona Tipo de descuento </option>
                                      <option ng-repeat="type in typeDiscount" value="@{{type.type}}">
                                          @{{type.type}}</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-4">
                              <div class="form-group">
                                  <label for="name">Descuento % <span class="text-danger">*</span></label>
                                  <select ng-model="discount.value" id="discountValue" name="discountValue" class="form-control" required>
                                      <option selected value> Selecciona</option>
                                      <option ng-repeat="value in listValue" value="@{{value.value}}">
                                          @{{value.value}}</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="text-right mt-2">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Agregar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
