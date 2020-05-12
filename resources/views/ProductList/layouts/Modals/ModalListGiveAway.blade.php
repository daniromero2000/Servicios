<!-- Modal Create -->
<div class="modal fade" id="addListGiveAwayModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title">Nuevo Obsequio</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert" id="alertListGiveAway"><span id="p"></span></div>
                <form ng-submit="createListGiveAway()">
                    <div class=" row pl-0 pr-0">
                        <div class="col-12 col-sm-8 form-group">
                            <label for="base_give_awaysCreateListGiveAway">Base de Obsequio< <span class="text-danger">
                                    *</span>
                            </label>
                            <input type="text" ng-model="listGiveAway.base_give_aways"
                                id="base_give_awaysCreateListGiveAway" name="base_give_awaysCreateListGiveAway"
                                class="form-control">
                        </div>
                        <div class="col-12 col-sm-4 form-group">
                            <label for="incrementCreateListGiveAway">Incremento <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" ng-model="listGiveAway.increment"
                                id="incrementCreateListGiveAway" name="incrementCreateListGiveAway">
                        </div>
                        <div class="col-12  form-group">
                            <label for="totalCreateListGiveAway">Total <span class="text-danger">*</span></label>
                            <input type="text" ng-model="listGiveAway.total" id="totalCreateListGiveAway"
                                name="totalCreateListGiveAway" class="form-control" required>
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
<div class="modal fade" id="deleteListGiveAway" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Desea eliminar este Producto?</h5>
            </div>
            <div class="modal-footer">
                <button ng-click="deleteListGiveAway(listGiveAway.id)" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update -->
<div class="modal fade" id="updateListGiveAway" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Obsequio</h5>
            </div>
            <div class="modal-body">
                <form ng-submit="updateListGiveAway()">
                    <div class="alert alert-danger" role="alert" id="alertUpdateListGiveAway"><span id="update"></span>
                    </div>
                    <div class=" row pl-0 pr-0">
                        <div class="col-12 col-sm-8 form-group">
                            <label for="base_give_awaysUpdateListGiveAway">Base de Obsequio <span
                                    class="text-danger">*</span>
                            </label>
                            <input type="text" ng-model="listGiveAway.base_give_aways"
                                id="base_give_awaysUpdateListGiveAway" name="base_give_awaysUpdateListGiveAway"
                                class="form-control">
                        </div>
                        <div class="col-12 col-sm-4 form-group">
                            <label for="incrementUpdateListGiveAway">Incremento <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" ng-model="listGiveAway.increment"
                                id="incrementUpdateListGiveAway" name="incrementUpdateListGiveAway">
                        </div>
                        <div class="col-12  form-group">
                            <label for="totalUpdateListGiveAway">Total <span class="text-danger">*</span></label>
                            <input type="text" ng-model="listGiveAway.total" id="totalUpdateListGiveAway"
                                name="totalUpdateListGiveAway" class="form-control" required>
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