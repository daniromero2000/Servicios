<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"> Listas </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                    class="fas fa-minus color-black"></i>
            </button>
        </div>
    </div>
    <div class="card-body" style="display: block;">
        <div class="row">
            <div class="col-12">
                {{-- <tags-input ng-model="tags"></tags-input> --}}


            </div>
        </div>
        <div class="table table-responsive">
            <table class="table table-hover table-stripped leadTable">
                <thead class="headTableLeads small">
                    <tr>
                        <th scope="col">Nombre</th>
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
                        <td>
                            <span ng-if="productList.checked == '1'">
                                <span class="badge badge-success badge-reset"> Activo </span>
                            </span>
                            <span ng-if="productList.checked == '0'">
                                <span class="badge badge-danger badge-reset"> Inactivo </span>
                            </span>
                        </td>
                        <td>@{{ productList.user_checked.name }}</td>
                        <td>@{{ productList.start_date }}</td>
                        <td>@{{ productList.end_date }}</td>
                        <td>@{{ productList.zone }}</td>
                        <td>
                            <i class="fas fa-edit cursor" title="Actualizar"
                                ng-click="showUpdateDialog(productList)"></i>
                            <i class="fas fa-times cursor" title="Eliminar" ng-click="showDialogDelete(productList)"
                                ng-if="activ"></i>
                            <i class="fas fa-eye cursor" title="Ver Lista"
                                ng-click="showDialogViewProductList(productList)"></i>

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
            <button class="btn btn-primary btn-sm" ng-click="addProductList()">Agregar Lista</button>
        </div>
    </div>
</div>