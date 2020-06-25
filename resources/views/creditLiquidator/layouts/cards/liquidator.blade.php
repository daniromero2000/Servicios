<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <nav>
            <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">
                <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabItem  == 1 }"
                    ng-click="tabItem  = 1" data-toggle="tab" role="tab" aria-controls="nav-general">Item 1</a>
                {{-- <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': item  == 2 }"
                    ng-click="item  = 2" data-toggle="tab" role="tab" aria-controls="nav-general">Item 2</a>
                <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': item  == 3 }"
                    ng-click="item  = 3" data-toggle="tab" role="tab" aria-controls="nav-general">Item 3</a> --}}
            </div>
        </nav>
    </div>
    <div class="card-body">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
                ng-class="{ 'show active': tabItem  == 1 }">
                <div class="card" ng-if="showLiquidator">
                    <div class="card-body">
                        <table class="table">
                            <thead class="">
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Lista</th>
                                    <th>Código</th>
                                    <th>Seleccion</th>
                                    <th>Articulo</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="liquidator in infoLiquidator">
                                    <td>@{{ liquidator.CANTIDAD }}</td>
                                    <td>@{{ liquidator.LISTA }}</td>
                                    <td>@{{ liquidator.CODIGO}}</td>
                                    <td>@{{ liquidator.SELECCION }}</td>
                                    <td>@{{ liquidator.ARTICULO }}</td>
                                    <td>@{{ liquidator.VALOR }}</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#my-modal">
                            Launch demo modal
                        </button>
                    </div>


                </div>
            </div>

            <div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
                ng-class="{ 'show active': item  == 2 }">
            </div>

            <div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
                ng-class="{ 'show active': item  == 3 }">

            </div>
        </div>
    </div>

</div>

<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Title</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form ng-submit="createFactor()">
                    <div class=" row pl-0 pr-0">
                        <div class="col-12 col-sm-4 form-group">
                            <label for="codeProduct">Codigo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" validation-pattern="number"
                                ng-model="liquidator.CODIGO" ng-blur="getProduct()" id="codeProduct" name="codeProduct">
                        </div>
                        <div class="col-12 col-sm-8 form-group">
                            <label for="nameProduct">Nombre</label>
                            <input type="text" ng-model="liquidator.ARTICULO" ng-blur="getProduct()" readonly
                                id="nameProduct" name="nameProduct" class="form-control">
                        </div>
                        <div class="col-12 col-sm-8 form-group">
                            <label for="value">Valor</label>
                            <input type="text" ng-model="liquidator.VALOR" readonly id="value" name="value"
                                class="form-control">
                        </div>
                        <div class="col-12 col-sm-4 form-group">
                            <label for="quanty">Cantidad <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" ng-model="liquidator.CANTIDAD" id="quanty"
                                name="quanty">
                        </div>
                        <div class="col-12 col-sm-4 form-group">
                            <label for="list">Lista <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" ng-model="liquidator.LISTA" id="list" name="list">
                        </div>
                        <div class="col-12 col-sm-4 form-group">
                            <label for="selection">Seleccion <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" ng-model="liquidator.SELECCION" id="selection"
                                name="selection">
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