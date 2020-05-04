<!-- Modal Create -->
<div class="modal fade" id="addListProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title">Nuevo Producto</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert" id="alertListProduct"><span id="p"></span></div>
                <form ng-submit="createListProduct()">
                    <div class=" row pl-0 pr-0">
                        <div class="col-12 col-sm-6 form-group">
                            <label for="itemCreateListProduct">Articulo</label>
                            <input type="text" ng-model="listProduct.item" id="itemCreateListProduct"
                                name="itemCreateListProduct" class="form-control">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="sku">SKU:</label>
                            <input type="text" ng-model="listProduct.sku" id="sku"
                                name="sku" class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="baseCreateListProduct">Costo Base *</label>
                            <input type="text" class="form-control" ng-model="listProduct.base_cost"
                                id="baseCreateListProduct" name="baseCreateListProduct" required>
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="IvaCreateListProduct">Costo + IVA *</label>
                            <input type="text" ng-model="listProduct.iva_cost" id="IvaCreateListProduct"
                                name="IvaCreateListProduct" class="form-control" required>
                        </div>
                        <div class="col-12  form-group">
                            <label for="protectionCreateListProduct">Proteccion</label>
                            <input type="text" id="protectionCreateListProduct" name="protectionCreateListProduct"
                                ng-model="listProduct.protection" class="form-control">
                        </div>
                        <div class="col-12  form-group">
                            <label for="minToleranceCreateListProduct">Valor min</label>
                            <input type="text" id="minToleranceCreateListProduct" name="minToleranceCreateListProduct"
                                ng-model="listProduct.min_tolerance" class="form-control">
                        </div>
                        <div class="col-12  form-group">
                            <label for="maxToleranceCreateListProduct">Valor max</label>
                            <input type="text" id="maxToleranceCreateListProduct" name="maxToleranceCreateListProduct"
                                ng-model="listProduct.max_tolerance" class="form-control">
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
<div class="modal fade" id="DeleteListProduct" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Desea eliminar este Producto?</h5>
            </div>
            <div class="modal-footer">
                <form ng-submit="deletelistProduct(listProduct.id)">

                    <button class="btn btn-danger">Eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal show -->
<div class="modal fade" id="ShowListProduct" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perfil</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Articulo</label>
                    <textarea rows="2" class="form-control textareaReadOnly" ng-model="listProduct.item"
                        readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update -->
<div class="modal fade" id="UpdateListProduct" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Producto</h5>
            </div>
            <div class="modal-body">
                <form ng-submit="UpdateListProduct()">
                    <div class="alert alert-danger" role="alert" id="alertUpdateListProduct"><span id="update"></span>
                    </div>
                    <div class=" row pl-0 pr-0">
                        <div class="col-12 col-sm-8 form-group">
                            <label for="itemUpdateListProduct">Articulo <span class="text-danger">*</span> </label>
                            <input type="text" ng-model="listProduct.item" id="itemUpdateListProduct"
                                name="itemUpdateListProduct" class="form-control">
                        </div>
                        <div class="col-12 col-sm-4 form-group">
                            <label for="baseUpdateListProduct">Costo Base <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" ng-model="listProduct.base_cost"
                                id="baseUpdateListProduct" name="baseUpdateListProduct">
                        </div>
                        <div class="col-12  form-group">
                            <label for="IvaUpdateListProduct">IVA <span class="text-danger">*</span></label>
                            <input type="text" ng-model="listProduct.iva_cost" id="IvaUpdateListProduct"
                                name="IvaUpdateListProduct" class="form-control" required>
                        </div>
                        <div class="col-12  form-group">
                            <label for="protectionUpdateListProduct">Proteccion <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="protectionUpdateListProduct" name="protectionUpdateListProduct"
                                ng-model="listProduct.protection" class="form-control" required>
                        </div>
                        <div class="col-12  form-group">
                            <label for="minToleranceUpdateListProduct">Valor min <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="minToleranceUpdateListProduct" name="minToleranceUpdateListProduct"
                                ng-model="listProduct.min_tolerance" class="form-control" required>
                        </div>
                        <div class="col-12  form-group">
                            <label for="maxToleranceUpdateListProduct">Valor max <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="maxToleranceUpdateListProduct" name="maxToleranceUpdateListProduct"
                                ng-model="listProduct.max_tolerance" class="form-control" required>
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