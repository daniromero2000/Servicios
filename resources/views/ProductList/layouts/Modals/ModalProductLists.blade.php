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
                            <select ng-model="productList.zone" id="zone" name="zone" class="form-control select2"
                                required>
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
                            <input type="date" id="end_date" name="end_date" ng-model="productList.end_date"
                                class="form-control" required>
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
                    <textarea rows="2" class="form-control textareaReadOnly" ng-model="productList.name"
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
                            <input type="text" ng-model="productList.name" id="nameUpdateProductList"
                                name="nameUpdateProductList" class="form-control">
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
                            <label for="start_dateUpdateProductList">Fecha de inicio <span
                                    class="text-danger">*</span></label>
                            <input type="date" ng-model="productList.start_date" id="start_dateUpdateProductList"
                                name="start_dateUpdateProductList" class="form-control" required>
                        </div>
                        <div class="col-12  form-group">
                            <label for="end_dateProductList">Fecha de Finalización <span
                                    class="text-danger">*</span></label>
                            <input type="date" id="end_dateProductList" name="end_dateProductList"
                                ng-model="productList.end_date" class="form-control" required>
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