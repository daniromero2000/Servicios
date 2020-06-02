<!-- Modal Create -->
<div class="modal fade" id="addProductListModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title">Nueva Lista</h5>
            </div>
            <div class="modal-body">
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
                                <option selected value> Selecciona Zona </option>
                                <option value="ALTA"> ALTA </option>
                                <option value="MEDIA"> MEDIA </option>
                                <option value="BAJA"> BAJA </option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 form-group">
                            <label for="bond_traditional">Bono tradicional <span class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.bond_traditional" id="bond_traditional"
                                name="bond_traditional" class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="cash_margin">Margen contado <span class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.cash_margin" id="cash_margin" name="cash_margin"
                                class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="percentage_credit_card_blue">Porcentaje tarjeta blue <span
                                    class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.percentage_credit_card_blue"
                                id="percentage_credit_card_blue" name="percentage_credit_card_blue"
                                class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="bond_blue">Bono tarjeta blue <span class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.bond_blue" id="bond_blue" name="bond_blue"
                                class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="percentage_credit_card_black">Porcentaje tarjeta black <span
                                    class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.percentage_credit_card_black"
                                id="percentage_credit_card_black" name="percentage_credit_card_black"
                                class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="bond_black">Bono tarjeta black <span class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.bond_black" id="bond_black" name="bond_black"
                                class="form-control">
                        </div>

                        <div class="col-12 form-group">
                            <label for="name">Fecha de inicio <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="start_date" name="start_date"
                                data-inputmask-alias="datetime" ng-model="productList.start_date"
                                data-inputmask-inputformat="yyyy-mm-dd" data-mask required>

                        </div>
                        <div class="col-12  form-group">
                            <label for="end_date">Fecha de Finalización <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="end_date" data-inputmask-alias="datetime"
                                ng-model="productList.end_date" id="end_date" data-inputmask-inputformat="yyyy-mm-dd"
                                data-mask>
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
                <h5 class="modal-title">¿Desea eliminar esta Lista?</h5>
            </div>
            <div class="modal-footer">
                <button ng-click="deleteProductList(productList.id)" class="btn btn-danger">Eliminar</button>
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
                <h5 class="modal-title">Actualizar Lista</h5>
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
                                class="form-control" required>
                                <option value="ALTA"> ALTA </option>
                                <option value="MEDIA"> MEDIA </option>
                                <option value="BAJA"> BAJA </option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 form-group">
                            <label for="bond_traditional">Bono tradicional <span class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.bond_traditional" id="bond_traditional_update"
                                name="bond_traditional" class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="cash_margin">Margen contado <span class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.cash_margin" id="cash_margin_update"
                                name="cash_margin" class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="percentage_credit_card_blue">Porcentaje tarjeta blue <span
                                    class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.percentage_credit_card_blue"
                                id="percentage_credit_card_blue_update" name="percentage_credit_card_blue"
                                class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="bond_blue">Bono tarjeta blue <span class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.bond_blue" id="bond_blue_update" name="bond_blue"
                                class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="percentage_credit_card_black">Porcentaje tarjeta black <span
                                    class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.percentage_credit_card_black"
                                id="percentage_credit_card_black_update" name="percentage_credit_card_black"
                                class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 form-group">
                            <label for="bond_black">Bono tarjeta black <span class="text-danger">*</span> </label>
                            <input type="text" ng-model="productList.bond_black" id="bond_black_update"
                                name="bond_black" class="form-control">
                        </div>

                        <div class="col-12  form-group">
                            <label for="start_dateUpdateProductList">Fecha de inicio <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                id=" start_dateUpdateProductList" name="start_dateUpdateProductList"
                                ng-model="productList.start_date" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                        </div>
                        <div class="col-12  form-group">
                            <label for="end_dateProductList">Fecha de Finalización <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                id="end_dateProductList" name="end_dateUpdateProductList"
                                ng-model="productList.end_date" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
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

<div class="modal fade" id="viewProductList" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Lista</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <tags-input ng-model="productListSubsidiaries" add-on-paste="true">
                            <auto-complete max-results-to-show="200" min-length="0" source="loadSubsidaries($query)">
                            </auto-complete>
                        </tags-input>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <button class="btn btn-primary" ng-disabled="disabledButtonAddSubsidiary" ng-click="addSubsidiariesToProductList()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>