<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <nav>
            <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">
                <a class="nav-item nav-link cursor" id="nav-general-tab@{{key}}" ng-repeat="(key, tab) in quotations" ng-click="alterTab(key)" ng-class="{ 'active': tabItem == key }" data-toggle="tab" role="tab" aria-controls="nav-general@{{key}}">Item <td class="d-flex">
                        <button class="close mx-auto text-danger" ng-click="removeItem(key)">
                            <span>×</span>
                        </button>
                    </td>
                    @{{key + 1}}</a>
            </div>
        </nav>
    </div>
    <div class="card-body" ng-if="key != 0">

        <div class="tab-content" id="nav-tabContent@{{key}}" ng-repeat="(key, tab) in quotations">
            <div class="tab-pane mb-4 border-0" id="nav-general@{{key}}" role="tabpanel" aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabItem  == key }">
                <div class="mx-auto" style="max-width: 300px;">
                    <label for="name">Tipo de Cotización <span class="text-danger">*</span></label>
                    <select ng-model="typeQuotations[key].type" name="action" class="form-control" required>
                        <option selected value> Seleccione </option>
                        <option value="1">Tradicional</option>
                        <option value="2">Oportuya Blue</option>
                        <option value="3">Oportuya Gray</option>
                        <option value="4">Oportuya Black</option>
                        <option value="5">Contado</option>
                    </select>
                </div>

                <div class="row" ng-if="typeQuotations[key].type">
                    <div class="col-12">
                        <div class="mb-2 text-right" data-toggle="tooltip" data-placement="top" title="Actualizar liquidación">
                            <a class="mr-3" href ng-click="refreshLiquidator(key)">
                                <i class="fas fa-sync-alt rotate"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8">
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
                                <div class="table-responsive">
                                    <table class="table text-sm" ng-if="tab[0] != ''" style="min-width: 800px;">
                                        <thead class="">
                                            <tr>
                                                <th>Cantidad </th>
                                                <th>Lista</th>
                                                <th>Código</th>
                                                <th>Articulo</th>
                                                <th>Valor</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="item in tab[0]">
                                                <td>@{{ item.quantity }}</td>
                                                <td>@{{ item.list }}</td>
                                                <td>@{{ item.sku}}</td>
                                                <td>@{{ item.article }}</td>
                                                <td>@{{ item.price | currency }}</td>
                                                <td class="d-flex">
                                                    <button class="close mx-auto text-danger" ng-click="removeProduct(item)">
                                                        <span>×</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div ng-if="tab[0] == ''">
                                        <div class="alert alert-primary" role="alert">
                                            No hay productos
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-4">
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
                                <div class="table-responsive">
                                    <table class="table text-sm" ng-if="tab[1] != ''">
                                        <thead class="">
                                            <tr>
                                                <th>Tipo</th>
                                                <th>%</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="item in tab[1]">
                                                <td>@{{ item.type }}</td>
                                                <td>@{{ item.value }}</td>
                                                <td class="d-flex">
                                                    <button class="close mx-auto text-danger" ng-click="removeDiscount(item)">
                                                        <span>×</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                    <div ng-if="tab[1] == ''">
                                        <div class="alert alert-primary" role="alert">
                                            No hay descuentos
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-4">

                                        <label for="name">Plan <span class="text-danger">*</span></label>
                                        <select ng-model="quotations[key][3].plan_id" id="plan" ng-blur="createPlan(key)" name="plan" class="form-control " required>
                                            <option selected value> Selecciona Plan </option>
                                            <option ng-repeat="plan in plans" value="@{{plan.CODIGO}}">
                                                @{{plan.PLAN}}</option>
                                        </select>
                                        <div class="form-group mt-3">
                                            <label>Aplica IVA?
                                                <input type="checkbox" ng-model="quotations[key][3].check" ng-click="refreshLiquidator(key)">
                                            </label>
                                        </div>

                                    </div>
                                    <div class="form-group col-4">
                                        <label for="initialFee">Cuota inicial</label>
                                        <input required type="text" class="form-control" id="initialFee" ng-model="quotations[key][3].initial_fee" ng-currency ng-blur="refreshLiquidator(key)" aria-describedby="initialFee">
                                        <div ng-if="quotations[key][3].initialFeeFeedback" class="text-danger small">
                                            El monto minimo para la cuota inicial es de:
                                            @{{quotations[key][3].initialFeeFeedback | currency}}.
                                        </div>

                                        <div class="form-group mt-3">
                                            <label>Desea incrementar la cuota inicial?
                                                <input type="checkbox" ng-model="quotations[key][3].checkInitialFee" ng-click="refreshLiquidator(key)">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="name">N° de Cuotas <span class="text-danger">*</span></label>
                                        <select ng-model="quotations[key][3].term" id="feeInitial" ng-blur="addFee(key)" name="feeInitial" class="form-control " required>
                                            <option selected value> Selecciona una Cuota </option>
                                            <option ng-repeat="fees in numberOfFees" value="@{{fees.CUOTA}}">
                                                @{{fees.CUOTA}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10 col-md-7 col-lg-6 col-xl-4 mx-auto">
                        <div>
                            <div class="row mx-0">
                                <div class="card bg-white w-100">
                                    <div class="card-header text-muted border-bottom-0">
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row mx-0">
                                            <div class="col-12">
                                                <ul class="ml-4 mb-0 fa-ul text-muted mx-auto" style=" max-width: 280px; padding: 0px 20px;">
                                                    <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-percent"></i></span>
                                                        Total
                                                        Descuentos: <b> $
                                                            @{{quotations[key][2] | number:0 }}</b>
                                                    </li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-money-bill-wave-alt"></i></span>
                                                        Valor cuotas:
                                                        <b> $ @{{quotations[key][3].value_fee | number:0}}</b></li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-store-alt"></i></span>
                                                        Aval+Iva:
                                                        <b> $ @{{quotations[key][4].total_aval | number:0}}</b></li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                                        Subtotal:
                                                        <b> $ @{{quotations[key][5].subtotal | number:0}}</b></li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                                        Iva:
                                                        <b> $ @{{quotations[key][5].iva | number:0}}</b></li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                                        Total:
                                                        <b> $ @{{quotations[key][5].total | number:0}}</b></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="addItem@{{key}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="my-modal-title">Agregar Producto</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form ng-submit="createItemLiquidator()">
                                <div class=" row pl-0 pr-0">
                                    <div class="col-8 form-group">
                                        <label for="name">Tipo <span class="text-danger">*</span></label>
                                        <select ng-if="tab[0].length != 0" ng-model="items.cod_proceso" name="action" class="form-control" required>
                                            <option selected value> Seleccione </option>
                                            <option value="2">Cargo</option>
                                            <option value="3">Obsequio</option>
                                        </select>
                                        <select ng-if="tab[0].length == 0" ng-model="items.cod_proceso" name="action" class="form-control" required>
                                            <option selected value> Seleccione </option>
                                            <option value="1">Articulo</option>
                                            <option value="4">Combo</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Selecciona lista<span class="text-danger">*</span></label>
                                            <select ng-model="items.list" id="typeLists" name="typeLists" class="form-control select2" required>
                                                <option selected value> Selecciona </option>
                                                <option ng-repeat="list in lists" value="@{{list.name}}">
                                                    @{{list.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div ng-if="items.cod_proceso && items.list">
                                    <div class=" row pl-0 pr-0">
                                        <input required type="hidden" class="form-control" ng-model="items.product_id" id="product_id" name="product_id">
                                        <div class="col-4 form-group">
                                            <label for="codeProduct">Codigo <span class="text-danger">*</span></label>
                                            <input required type="text" class="form-control" ng-model="items.sku" ng-blur="getProduct()" id="codeProduct" name="codeProduct">
                                        </div>
                                        <div class="col-8 form-group">
                                            <label for="nameProduct">Nombre</label>
                                            <input required type="text" ng-model="items.article" readonly id="nameProduct" name="nameProduct" class="form-control">
                                        </div>
                                        <div class="col-4 form-group">
                                            <label for="quanty">Cantidad <span class="text-danger">*</span></label>
                                            <input required type="text" class="form-control" ng-model="items.quantity" id="quanty" name="quanty">
                                        </div>
                                        <div class="col-8 form-group">
                                            <label for="value">Valor</label>
                                            <input required type="text" ng-model="items.price " ng-currency ng-disabled="(items.cod_proceso == 1) || (items.cod_proceso == 4) || (items.cod_proceso == 2 && (items.sku == 'IVAV' || items.sku == 'AV10' || items.sku == 'AV12' || items.sku == 'AV15'))" id="value" name="value" class="form-control">
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary" ng-disabled="buttonDisabled">Agregar</button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
        </div>
    </div>

</div>
