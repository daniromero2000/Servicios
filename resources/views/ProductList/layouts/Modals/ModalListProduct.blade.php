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
                            <label for="itemCreateListProduct">Articulo <span class="text-danger">*</span></label>
                            <input type="text" ng-model="listProduct.item" id="itemCreateListProduct"
                                name="itemCreateListProduct" class="form-control">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="sku">SKU <span class="text-danger">*</span></label>
                            <input type="text" ng-model="listProduct.sku" id="sku" name="sku" class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="baseCreateListProduct">Costo Base <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" ng-model="listProduct.base_cost"
                                id="baseCreateListProduct" name="baseCreateListProduct" required>
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="IvaCreateListProduct">Costo + IVA <span class="text-danger">*</span></label>
                            <input type="text" ng-model="listProduct.iva_cost" id="IvaCreateListProduct"
                                name="IvaCreateListProduct" class="form-control" required>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="minToleranceCreateListProduct">Valor min </label>
                            <input type="text" id="minToleranceCreateListProduct" name="minToleranceCreateListProduct"
                                ng-model="listProduct.min_tolerance" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="maxToleranceCreateListProduct">Valor max</label>
                            <input type="text" id="maxToleranceCreateListProduct" name="maxToleranceCreateListProduct"
                                ng-model="listProduct.max_tolerance" class="form-control">
                        </div>
                        <div class="col-sm-6 col-12  form-group">
                            <label for="protectionCreateListProduct">Protección sin IVA</label>
                            <input type="text" id="protectionCreateListProduct" name="protectionCreateListProduct"
                                ng-model="listProduct.protection" class="form-control">
                        </div>
                        <div class="col-sm-6 col-12  form-group">
                            <label for="protectionCreateListProduct">Contado</label>
                            <input type="text" id="protectionCreateListProduct" name="protectionCreateListProduct"
                                ng-model="listProduct.cash_cost" class="form-control">
                        </div>
                        <div class="col-sm-6 col-12  form-group">
                            <label for="typeProductCreateListProduct">Tipo de producto</label>
                            <select ng-model="listProduct.type_product" id="typeProductCreateListProduct"
                                name="typeProductCreateListProduct" class="form-control select2" required>
                                <option selected value> Seleccione</option>
                                <option value="1"> Articulo o Cargo </option>
                                <option value="2"> Seguro </option>
                                <option value="3"> Garantía </option>
                                <option value="4"> Obsequio </option>
                            </select>
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

<div class="modal fade" id="addMassiveListProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title">Cargar productos masivamente</h5>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="text-center mx-auto card-download-excel">
                        <a href="/productsTemplate/plantilla_productos.csv">
                            <img src="https://image.flaticon.com/icons/svg/732/732220.svg" alt=""
                                style="max-width: 48px;">
                            <br>
                            <span class="productList-file-text">Descargue la plantila aqui</span>
                        </a>
                    </div>
                </div>

                <form ng-submit="createMassiveListProduct()">
                    <div flow-init flow-files-submitted="$flow.upload()"
                        flow-file-added="!!{csv:1}[$file.getExtension()]" flow-name="product.list">

                        <div class="row mb-2">
                            <div ng-repeat="file in $flow.files" class="col-12 test-center">
                                <span class="title">@{{file.name}}</span>
                                <div class="progress progress-bar-striped mb-1" ng-class="{active: file.isUploading()}">
                                    <div class="progress-bar progress-bar-striped" role="progressbar"
                                        aria-valuenow="@{{file.progress() * 100}}" aria-valuemin="0" aria-valuemax="100"
                                        ng-style="{width: (file.progress() * 100) + '%'}">
                                        <span class="sr-only">@{{file.progress()}}% Complete</span>
                                    </div>
                                </div>
                                <a class="productList-file-cancel" ng-click="file.cancel()">Cancelar archivo</a>
                            </div>
                        </div>
                        <div class="row mb-2 justify-content-center" g-class="dropClass">
                            <div class="btn-group mr-2" role="group" aria-label="Basic example">
                                <button ng-hide="$flow.files[0]" type="button" class="btn btn-secondary" flow-btn>Añadir
                                    Archivo</button>
                            </div>
                            <div class="btn-group " role="group" aria-label="Basic example">
                                <button ng-disabled="$flow.files[0].progress() < 1" type="submit"
                                    class="btn  btn-outline-success ">Subir Archivo</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal DELETE-->
<div class="modal fade" id="deleteListProduct" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Desea eliminar este Producto?</h5>
            </div>
            <div class="modal-footer">
                <button ng-click="deleteListProduct(listProduct.id)" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update -->
<div class="modal fade" id="updateListProduct" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Producto</h5>
            </div>
            <div class="modal-body">
                <form ng-submit="updateListProduct()">
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
                            <label for="IvaUpdateListProduct">Costo + IVA <span class="text-danger">*</span></label>
                            <input type="text" ng-model="listProduct.iva_cost" id="IvaUpdateListProduct"
                                name="IvaUpdateListProduct" class="form-control" required>
                        </div>

                        <div class="col-sm-6  form-group">
                            <label for="minToleranceUpdateListProduct">Valor min <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="minToleranceUpdateListProduct" name="minToleranceUpdateListProduct"
                                ng-model="listProduct.min_tolerance" class="form-control" required>
                        </div>
                        <div class="col-sm-6  form-group">
                            <label for="maxToleranceUpdateListProduct">Valor max <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="maxToleranceUpdateListProduct" name="maxToleranceUpdateListProduct"
                                ng-model="listProduct.max_tolerance" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-12  form-group">
                            <label for="protectionUpdateListProduct">Proteccion sin IVA <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="protectionUpdateListProduct" name="protectionUpdateListProduct"
                                ng-model="listProduct.protection" class="form-control" required>
                        </div>

                        <div class="col-sm-6 col-12  form-group">
                            <label for="protectionUpdateListProduct">Contado</label>
                            <input type="text" id="protectionUpdateListProduct" name="protectionUpdateListProduct"
                                ng-model="listProduct.cash_cost" class="form-control">
                        </div>
                        <div class="col-sm-6 col-12  form-group">
                            <label for="typeProductUpdateListProduct">Tipo de producto</label>
                            <select ng-model="listProduct.type_product" id="typeProductUpdateListProduct"
                                name="typeProductUpdateListProduct" class="form-control" required>
                                <option selected value> Seleccione</option>
                                <option value="1"> Articulo o Cargo </option>
                                <option value="2"> Seguro </option>
                                <option value="3"> Garantía </option>
                                <option value="4"> Obsequio </option>
                            </select>
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