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
                            <label for="start_date_create_factor">Fecha de inicio <span
                                    class="text-danger">*</span></label>
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
                            <label for="start_date_update_factor">Fecha de inicio <span
                                    class="text-danger">*</span></label>
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