<div class="row">
    <div class="col-12 col-sm-8 col-lg-5 mx-auto">
        <label for="product">Buscar producto</label>
        <angucomplete-alt id="product" pause="100" selected-object="selectedProduct" local-data="listProducts"
            search-fields="sku,item" title-field="sku" description-field='item' minlength="1"
            input-class="form-control form-control-small" input-name="sku" match-class="highlight" />
    </div>
</div>

<div class="row" ng-show="viewProductPrices" style="padding: 20px;">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-6 col-lg-4" ng-repeat="(key, price) in productPrices">
                <div class="card card-primary shadow-sm border-0">
                    <div class="card-header">
                        <h3 class="card-title"> @{{ key }} </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus color-black"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="display: block;">
                        <div class="small-box bg-gradient-light">
                            <div class="inner">
                                <div class="productlist-card-container">
                                    <label class="productlist-card-subtitle">Precio público normal:</label> <span
                                        class="productlist-card-price">$@{{ price.normal_public_price | number:0 }}</span>
                                    <label class="productlist-card-subtitle">Contado promoción:</label> <span
                                        class="productlist-card-price">$@{{ price.cash_promotion | number:0 }}</span>
                                    <label class="productlist-card-subtitle">Precio público promoción:</label> <span
                                        class="productlist-card-price">$@{{ price.promotion_public_price | number:0 }}</span>
                                    <label class="productlist-card-subtitle">Porcentaje precio público
                                        promoción:</label> <span
                                        class="productlist-card-price">@{{ price.percentage_promotion_public_price | number:2 }}%</span>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>

                        <div class="small-box bg-gradient-light">
                            <div class="inner">
                                <p class="productlist-card-title">Crédito tradicional</p>
                                <div class="card-body">
                                    <label class="productlist-card-subtitle">Valor 12 cuotas:</label> <span
                                        class="productlist-card-price">$@{{ price.traditional_credit_price | number:0 }}</span>
                                    <label class="productlist-card-subtitle">Valor 12 cuotas sin bono:</label> <span
                                        class="productlist-card-price">$@{{ price.traditional_credit_bond_price | number:0 }}</span>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart" style="font-size: 52px;"></i>
                            </div>
                        </div>

                        <div class="small-box bg-gradient-pink">
                            <div class="inner">
                                <p class="productlist-card-title text-white">Base cliente Oportuya</p>
                                <div class="card-body">
                                    <label class="productlist-card-subtitle" style="color: white">Precio público
                                        base:</label> <span
                                        class="productlist-card-price">$@{{ price.base_public_price_oportuya_customer | number:0 }}</span>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user" style="font-size: 52px;"></i>
                            </div>
                        </div>

                        <div class="small-box bg-gradient-primary">
                            <div class="inner">
                                <p class="productlist-card-title text-white">Tarjeta Blue</p>
                                <div class="card-body">
                                    <label class="productlist-card-subtitle" style="color: white">Precio público
                                        Blue A.F:</label> <span
                                        class="productlist-card-price">$@{{ price.blue_public_price | number:0 }}</span>
                                    <label class="productlist-card-subtitle" style="color: white">Porcentaje Precio
                                        público
                                        Blue A.F:</label> <span
                                        class="productlist-card-price">@{{ price.percentage_blue_public_price | number:2 }}%</span>
                                    <label class="productlist-card-subtitle" style="color: white">Valor 12 cuotas
                                        Blue sin bono:</label> <span
                                        class="productlist-card-price">$@{{ price.blue_bond_price | number:0 }}</span>
                                    <label class="productlist-card-subtitle" style="color: white">Valor 12 cuotas
                                        Blue con bono:</label> <span
                                        class="productlist-card-price">$@{{ price.blue_bond_on_price | number:0 }}</span>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-credit-card" style="font-size: 46px;"></i> </div>
                        </div>

                        <div class="small-box bg-gradient-dark">
                            <div class="inner">
                                <p class="productlist-card-title text-white">Tarjeta Black</p>
                                <div class="card-body">
                                    <label class="productlist-card-subtitle" style="color: white">Precio público
                                        Black A.F:</label> <span
                                        class="productlist-card-price">$@{{ price.black_public_price | number:0 }}</span>
                                    <label class="productlist-card-subtitle" style="color: white">Porcentaje precio
                                        público
                                        Black A.F:</label> <span
                                        class="productlist-card-price">@{{ price.percentage_black_public_price | number:2 }}%</span>
                                    <label class="productlist-card-subtitle" style="color: white">Valor 12 cuotas
                                        Black sin bono:</label> <span
                                        class="productlist-card-price">$@{{ price.black_bond_price | number:0 }}</span>
                                    <label class="productlist-card-subtitle" style="color: white">Valor 12 cuotas
                                        Black con bono:</label> <span
                                        class="productlist-card-price">$@{{ price.black_bond_on_price | number:0 }}</span>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-credit-card text-gray" style="font-size: 46px;"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- <div class="col-12 col-md-4" ng-repeat="(key, price) in productPrices">
                <div class="card productlist-card">
                    <div class="card-header">
                        <span class="productlist-card-title">@{{ key }}</span>
</div>
<div class="card-body" style="padding:0">
    <div class="productlist-card-container">
        <label class="productlist-card-subtitle">Precio público normal:</label> <span
            class="productlist-card-price">$@{{ price.normal_public_price | number:0 }}</span>
        <label class="productlist-card-subtitle">Contado promoción:</label> <span
            class="productlist-card-price">$@{{ price.cash_promotion | number:0 }}</span>
        <label class="productlist-card-subtitle">Precio público promoción:</label> <span
            class="productlist-card-price">$@{{ price.promotion_public_price | number:0 }}</span>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <span class="productlist-card-titleCard">Crédito tradicional</span>
                </div>
                <div class="card-body">
                    <label class="productlist-card-subtitle">Valor 12 cuotas con AVAL:</label> <span
                        class="productlist-card-price">$@{{ price.traditional_credit_price | number:0 }}</span>
                    <label class="productlist-card-subtitle">Valor 12 cuotas sin bono:</label> <span
                        class="productlist-card-price">$@{{ price.traditional_credit_bond_price | number:0 }}</span>
                </div>
            </div>
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">
                    <span class="productlist-card-titleCard">Tarjeta Blue</span>
                </div>
                <div class="card-body">
                    <label class="productlist-card-subtitle" style="color: white">Precio público
                        Blue A.F:</label> <span
                        class="productlist-card-price">$@{{ price.blue_public_price | number:0 }}</span>
                    <label class="productlist-card-subtitle" style="color: white">Valor 12 cuotas
                        Blue sin bono:</label> <span
                        class="productlist-card-price">$@{{ price.blue_bond_price | number:0 }}</span>
                </div>
            </div>
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">
                    <span class="productlist-card-titleCard">Tarjeta Black</span>
                </div>
                <div class="card-body">
                    <label class="productlist-card-subtitle" style="color: white">Precio público
                        Black A.F:</label> <span
                        class="productlist-card-price">$@{{ price.black_public_price | number:0 }}</span>
                    <label class="productlist-card-subtitle" style="color: white">Valor 12 cuotas
                        Black sin bono:</label> <span
                        class="productlist-card-price">$@{{ price.black_bond_price | number:0 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div> --}}