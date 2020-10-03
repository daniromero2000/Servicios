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
                                    @if(auth()->user()->Assessor->ID_EMPRESA != '3')
                                    <button type="button" class="btn btn-primary btn-sm" ng-click="addDiscount(key)">
                                        Agregar Descuento
                                    </button>
                                    @endif
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
                                <div class="form-group ">
                                    <label>Aplica IVA?
                                        <input type="checkbox" ng-model="liquidator[key][3].check"
                                            ng-click="refreshLiquidator(key)">
                                    </label>
                                </div>
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
                                    <label>Desea incrementar la cuota inicial?
                                        <input type="checkbox" ng-model="liquidator[key][3].checkInitialFee"
                                            ng-click="refreshLiquidator(key)">
                                    </label>
                                </div>
                                <div class="form-group ">
                                    <label for="initialFee">Cuota inicial</label>
                                    <input required type="text" class="form-control" id="initialFee"
                                        ng-model="liquidator[key][3].CUOTAINI" ng-currency aria-describedby="initialFee"
                                        ng-blur="refreshLiquidator(key)">
                                    <div ng-if="liquidator[key][3].initialFeeFeedback" class="text-danger small">
                                        El monto minimo para la cuota inicial es de:
                                        @{{liquidator[key][3].initialFeeFeedback | currency}}.
                                    </div>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input class="form-control" type="hidden" id="typeLiquidator"
                value="{{auth()->user()->Assessor->ID_EMPRESA}}">
            @if(auth()->user()->Assessor->ID_EMPRESA == '3')
            @include('creditLiquidator.layouts.cards.modals.addProductAgreement')
            @else
            @include('creditLiquidator.layouts.cards.modals.addProduct')
            @endif
            @include('creditLiquidator.layouts.cards.modals.addDiscount')


        </div>
    </div>

</div>

{{-- @include('creditLiquidator.layouts.cards.amortizacion') --}}