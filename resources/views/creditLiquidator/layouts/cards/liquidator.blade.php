<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <nav>
            <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">
                <a class="nav-item nav-link cursor" id="nav-general-tab@{{key}}" ng-repeat="(key, tab) in liquidator"
                    ng-click="alterTab(key)" ng-class="{ 'active': tabItem == key }" data-toggle="tab" role="tab"
                    aria-controls="nav-general@{{key}}">Item
                    @{{key + 1}}</a>
                {{-- <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': item  == 2 }"
                    ng-click="item  = 2" data-toggle="tab" role="tab" aria-controls="nav-general">Item 2</a>
                <a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': item  == 3 }"
                    ng-click="item  = 3" data-toggle="tab" role="tab" aria-controls="nav-general">Item 3</a> --}}
            </div>
        </nav>
    </div>
    <div class="card-body">
        <div class="tab-content" id="nav-tabContent@{{key}}" ng-repeat="(key, tab) in liquidator">
            <div class="tab-pane mb-4 border-0" id="nav-general@{{key}}" role="tabpanel"
                aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabItem  == key }">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between ">
                                <div>Negocio</div>
                                <div class="text-right ml-auto">
                                    <button type="button" class="btn btn-primary btn-sm" ng-click="addProduct(key)">
                                        Agregar producto
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="">
                                        <tr>
                                            <th>Cantidad @{{tab.value}}</th>
                                            <th>Lista</th>
                                            <th>Código</th>
                                            <th>Seleccion</th>
                                            <th>Articulo</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in tab[0]">
                                            <td>@{{ item.CANTIDAD }}</td>
                                            <td>@{{ item.LISTA }}</td>
                                            <td>@{{ item.CODIGO}}</td>
                                            <td>@{{ item.SELECCION }}</td>
                                            <td>@{{ item.ARTICULO }}</td>
                                            <td>@{{ item.VALOR }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between ">
                                <div>Descuentos</div>
                                <div class="text-right ml-auto">
                                    <button type="button" class="btn btn-primary btn-sm" ng-click="addDiscount(key)">
                                        Agregar Descuento
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="">
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in tab[1]">
                                            <td>@{{ item.type }}</td>
                                            <td>@{{ item.value }}</td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
                ng-class="{ 'show active': item  == 2 }">
            </div>

            <div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
                ng-class="{ 'show active': item  == 3 }">

            </div> --}}
        </div>
    </div>

</div>

<div id="addItem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Title</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form ng-submit="createItemLiquidator()">
                    <div class=" row pl-0 pr-0">
                        <div class="col-12 col-sm-4 form-group">
                            <label for="codeProduct">Codigo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" validation-pattern="number" ng-model="items.CODIGO"
                                ng-blur="getProduct()" id="codeProduct" name="codeProduct">
                        </div>
                        <div class="col-12 col-sm-8 form-group">
                            <label for="nameProduct">Nombre</label>
                            <input type="text" ng-model="items.ARTICULO" ng-blur="getProduct()" readonly
                                id="nameProduct" name="nameProduct" class="form-control">
                        </div>
                        <div class="col-12 col-sm-8 form-group">
                            <label for="value">Valor</label>
                            <input type="text" ng-model="items.VALOR" readonly id="value" name="value"
                                class="form-control">
                        </div>
                        <div class="col-12 col-sm-4 form-group">
                            <label for="quanty">Cantidad <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" ng-model="items.CANTIDAD" id="quanty" name="quanty">
                        </div>
                        <div class="col-12 col-sm-4 form-group">
                            <label for="list">Lista <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly ng-model="items.LISTA" id="list"
                                name="list">
                        </div>
                        <div class="col-12 col-sm-4 form-group">
                            <label for="selection">Seleccion <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" ng-model="items.SELECCION" id="selection"
                                name="selection">
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

<div id="addDiscount" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Title</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form ng-submit="createDiscountLiquidator()">
                    <div class=" row pl-0 pr-0">
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                <label for="name">Tipo de descuento <span class="text-danger">*</span></label>
                                <select ng-model="discount.type" id="type" name="type" class="form-control select2"
                                    required>
                                    <option selected value> Selecciona Plan </option>
                                    <option ng-repeat="type in typeDiscount" value="@{{type.type}}">
                                        @{{type.type}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="name">Descuento % <span class="text-danger">*</span></label>
                                <select ng-model="discount.value" id="value" name="value" class="form-control" required>
                                    <option selected value> Selecciona Plan </option>
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