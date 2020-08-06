<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <nav>
            <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">
                <a class="nav-item nav-link cursor" id="nav-general-tab@{{key}}" ng-repeat="(key, tab) in liquidator"
                    ng-click="alterTab(key)" ng-class="{ 'active': tabItem == key }" data-toggle="tab" role="tab"
                    aria-controls="nav-general@{{key}}">Item <td class="d-flex">
                        <button class="close mx-auto text-danger" ng-click="removeItem(key)">
                            <span>×</span>
                        </button>
                    </td>
                    @{{key + 1}}</a>
            </div>
        </nav>
    </div>
    <div class="card-body" ng-if="key != 0">
        <div class="overlay" data-ng-show="loader">
            <div class="loader-products">
            </div>
            <div class="text-loader">
                Cargando...
            </div>
        </div>
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
                                <div class="table-responsive">
                                    <table class="table text-sm" ng-if="tab[0] != ''" style="min-width: 800px;">
                                        <thead class="">
                                            <tr>
                                                <th>Cantidad </th>
                                                <th>Lista</th>
                                                <th>Código</th>
                                                <th>Seleccion</th>
                                                <th>Articulo</th>
                                                <th>Valor</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="item in tab[0]">
                                                <td>@{{ item.CANTIDAD }}</td>
                                                <td>@{{ item.LISTA }}</td>
                                                <td>@{{ item.CODIGO}}</td>
                                                <td>@{{ item.SELECCION }}</td>
                                                <td>@{{ item.ARTICULO }}</td>
                                                <td>@{{ item.PRECIO | currency }}</td>
                                                <td class="d-flex">
                                                    <button class="close mx-auto text-danger"
                                                        ng-click="removeProduct(item)">
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
                    <div class="col-12">
                        <div class="mb-2 text-right" data-toggle="tooltip" data-placement="top"
                            title="Actualizar liquidación">
                            <a class="mr-3" href ng-click="refreshLiquidator(key)">
                                <i class="fas fa-sync-alt rotate"></i>
                            </a>
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
                                                    <button class="close mx-auto text-danger"
                                                        ng-click="removeDiscount(item)">
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
                    <div class="col-lg-6 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                {{-- <div class="row"> --}}

                                <div class="form-group ">
                                    <label for="name">Plan <span class="text-danger">*</span></label>
                                    <select ng-model="liquidator[key][3].COD_PLAN" id="plan" ng-blur="createPlan(key)"
                                        name="plan" class="form-control " required>
                                        <option selected value> Selecciona Plan </option>
                                        <option ng-repeat="plan in plans" value="@{{plan.CODIGO}}">
                                            @{{plan.PLAN}}</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="initialFee">Cuota inicial</label>
                                    <input required type="text" class="form-control" id="initialFee"
                                        ng-model="liquidator[key][3].CUOTAINI" ng-currency
                                        aria-describedby="initialFee">
                                </div>
                                <div class="form-group ">
                                    <label for="name">N° de Cuotas <span class="text-danger">*</span></label>
                                    <select ng-model="liquidator[key][3].PLAZO" id="feeInitial" ng-blur="addFee(key)"
                                        name="feeInitial" class="form-control " required>
                                        <option selected value> Selecciona una Cuota </option>
                                        <option ng-repeat="fees in numberOfFees" value="@{{fees.CUOTA}}">
                                            @{{fees.CUOTA}}</option>
                                    </select>
                                </div>


                                {{-- </div> --}}
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
                                        <div class="form-group ">
                                            <label>Aplica IVA?
                                                <input type="checkbox" ng-model="liquidator[key][3].check">
                                            </label>
                                        </div>
                                        <div class="row mx-0">
                                            <div class="col-12">
                                                <ul class="ml-4 mb-0 fa-ul text-muted mx-auto"
                                                    style=" max-width: 280px; padding: 0px 20px;">
                                                    <li class="mt-2 small d-flex justify-content-between"><span
                                                            class="fa-li"><i class="fas fa-percent"></i></span>
                                                        Total
                                                        Descuentos: <b> $
                                                            @{{liquidator[key][2] | number:0 }}</b>
                                                    </li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span
                                                            class="fa-li"><i
                                                                class="fas fa-money-bill-wave-alt"></i></span>
                                                        Valor cuotas:
                                                        <b> $ @{{liquidator[key][3].VRCUOTA | number:0}}</b></li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span
                                                            class="fa-li"><i
                                                                class="fas fa-money-bill-wave-alt"></i></span>
                                                        Pago
                                                        oportuno:
                                                        <b> $ @{{liquidator[key][3].timelyPayment | number:0}}</b>
                                                    </li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span
                                                            class="fa-li"><i class="far fa-credit-card"></i></span>
                                                        Cuota de
                                                        manejo:
                                                        <b> $ @{{liquidator[key][3].MANEJO | number:0}}</b></li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span
                                                            class="fa-li"><i class="fas fa-shield-alt"></i></span>
                                                        Seguro:
                                                        <b> $ @{{liquidator[key][3].SEGURO | number:0}}</b></li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span
                                                            class="fa-li"><i class="fas fa-store-alt"></i></span>
                                                        Aval+Iva:
                                                        <b> $ @{{liquidator[key][4].TOTAL_AVAL | number:0}}</b></li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span
                                                            class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                                        Subtotal:
                                                        <b> $ @{{liquidator[key][5].SUBTOTAL | number:0}}</b></li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span
                                                            class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                                        Iva:
                                                        <b> $ @{{liquidator[key][5].IVA | number:0}}</b></li>
                                                    <li class="mt-2 small d-flex justify-content-between"><span
                                                            class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                                        Total:
                                                        <b> $ @{{liquidator[key][5].TOTAL | number:0}}</b></li>
                                                </ul>
                                            </div>
                                            {{-- <div class="col-5 text-center">
                                                    <img src="../../dist/img/user1-128x128.jpg" alt=""
                                                        class="img-circle img-fluid">
                                                </div> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="card-footer">
                                        <div class="text-right">
                                            <a href="#" class="btn btn-sm btn-primary">
                                                <i class="fas fa-print"></i> Ver amortización
                                            </a>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- <div class="col-6">
                                        <div class="form-group">
                                            <label for="totalDiscount">Total Descuentos</label>
                                            <input required readonly type="text" class="form-control" id="totalDiscount"
                                                aria-describedby="totalDiscount" ng-model="liquidator[key][2] "
                                                ng-currency>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="valueFees">Valor cuotas</label>
                                            <input required readonly type="text" class="form-control" id="SALARIO_CONYU"
                                                ng-model="liquidator[key][3].VRCUOTA " ng-currency
                                                aria-describedby="valueFees">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="timelyPayment">Pago oportuno</label>
                                            <input required readonly type="text" class="form-control"
                                                ng-model="liquidator[key][3].timelyPayment " ng-currency
                                                id="timelyPayment" aria-describedby="timelyPayment">
                                        </div>
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mx-0">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="handlingFee">Cuota de manejo</label>
                                            <input required readonly type="text" class="form-control" id="handlingFee"
                                                ng-model="liquidator[key][3].MANEJO " ng-currency
                                                aria-describedby="handlingFee">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="insurance">Seguro</label>
                                            <input required readonly type="text" class="form-control" id="insurance"
                                                ng-model="liquidator[key][3].SEGURO " ng-currency
                                                aria-describedby="insurance">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="aval">Aval+Iva</label>
                                            <input required readonly type="text" class="form-control"
                                                ng-model="liquidator[key][4].TOTAL_AVAL " ng-currency id="aval"
                                                aria-describedby="aval">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Subtotal">Subtotal</label>
                                            <input required readonly type="text" class="form-control"
                                                ng-model="liquidator[key][5].SUBTOTAL " ng-currency id="Subtotal"
                                                aria-describedby="Subtotal">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="iva">Iva</label>
                                            <input required readonly type="text" class="form-control"
                                                ng-model="liquidator[key][5].IVA " ng-currency id="iva"
                                                aria-describedby="iva">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="total">Total</label>
                                            <input required readonly type="text" class="form-control"
                                                ng-model="liquidator[key][5].TOTAL " ng-currency id="total"
                                                aria-describedby="total">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>

            <div id="addItem@{{key}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                aria-hidden="true">
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
                                    <div class="col-12 form-group">
                                        <label for="name">Tipo <span class="text-danger">*</span></label>
                                        <select ng-if="tab[0].length != 0" ng-model="items.COD_PROCESO" id="action"
                                            name="action" class="form-control" required>
                                            <option selected value> Seleccione </option>
                                            <option value="2">Cargo</option>
                                            <option value="3">Obsequio</option>
                                        </select>
                                        <select ng-if="tab[0].length == 0" ng-model="items.COD_PROCESO" id="action"
                                            name="action" class="form-control" required>
                                            <option selected value> Seleccione </option>
                                            <option value="1">Articulo</option>
                                            <option value="4">Combo</option>
                                        </select>
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="codeProduct">Codigo <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" ng-model="items.CODIGO"
                                            ng-blur="getProduct()" id="codeProduct" name="codeProduct">
                                    </div>
                                    <div class="col-8 form-group">
                                        <label for="nameProduct">Nombre</label>
                                        <input required type="text" ng-model="items.ARTICULO" readonly id="nameProduct"
                                            name="nameProduct" class="form-control">
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="quanty">Cantidad <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" ng-model="items.CANTIDAD"
                                            id="quanty" name="quanty">
                                    </div>
                                    <div class="col-8 form-group">
                                        <label for="value">Valor</label>
                                        <input required type="text" ng-model="items.PRECIO " ng-currency
                                            ng-disabled="(items.COD_PROCESO == 1) || (items.COD_PROCESO == 4) || (items.COD_PROCESO == 2 && (items.CODIGO == 'IVAV' || items.CODIGO == 'AV10' || items.CODIGO == 'AV12' || items.CODIGO == 'AV15'))"
                                            id="value" name="value" class="form-control">
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="list">Lista <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" readonly ng-model="items.LISTA"
                                            id="list" name="list">
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="selection">Seleccion <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" ng-model="items.SELECCION"
                                            id="selection" name="selection">
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

            <div id="addDiscount@{{key}}" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="my-modal-title" aria-hidden="true">
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
                                            <label for="name">Tipo de descuento <span
                                                    class="text-danger">*</span></label>
                                            <select ng-model="discount.type" id="discountType" name="discountType"
                                                class="form-control select2" required>
                                                <option selected value> Selecciona Tipo de descuento </option>
                                                <option ng-repeat="type in typeDiscount" value="@{{type.type}}">
                                                    @{{type.type}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Descuento % <span class="text-danger">*</span></label>
                                            <select ng-model="discount.value" id="discountValue" name="discountValue"
                                                class="form-control" required>
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

{{-- @include('creditLiquidator.layouts.cards.amortizacion') --}}