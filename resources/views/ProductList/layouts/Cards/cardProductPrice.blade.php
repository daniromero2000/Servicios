<div class="row">
    <div class="col-12 col-md-6 offset-md-3 mb-3">
        <label for="product">Buscar producto</label>
        <angucomplete-alt id="product" placeholder="Buscar Producto" pause="100"
        selected-object="selectedProduct" local-data="listProducts"
        search-fields="sku,item" title-field="sku" description-field='item'
        minlength="1" input-class="form-control form-control-small"
        input-name="sku" match-class="highlight" />
    </div>
</div>

<div class="row" ng-show="viewProductPrices" style="padding: 20px;">
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-md-4" ng-repeat="(key, price) in productPrices">
                <div class="card productlist-card">
                    <div class="card-header">
                        <span class="productlist-card-title">@{{ key }}</span>
                    </div>
                    <div class="card-body" style="padding:0">
                        <div class="productlist-card-container">
                            <label class="productlist-card-subtitle">Precio público normal:</label> <span class="productlist-card-price">$@{{ price.normal_public_price | number:0 }}</span>
                            <label class="productlist-card-subtitle">Contado promoción:</label> <span class="productlist-card-price">$@{{ price.cash_promotion | number:0 }}</span>
                            <label class="productlist-card-subtitle">Precio público promoción:</label> <span class="productlist-card-price">$@{{ price.promotion_public_price | number:0 }}</span>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <span class="productlist-card-titleCard">Crédito tradicional</span>
                                    </div>
                                    <div class="card-body">
                                        <label class="productlist-card-subtitle">Valor 12 cuotas con AVAL:</label> <span class="productlist-card-price">$@{{ price.traditional_credit_price | number:0 }}</span>
                                        <label class="productlist-card-subtitle">Valor 12 cuotas sin bono:</label> <span class="productlist-card-price">$@{{ price.traditional_credit_bond_price | number:0 }}</span>
                                    </div>
                                </div>
                                <div class="card text-white bg-dark mb-3">
                                    <div class="card-header">
                                        <span class="productlist-card-titleCard">Tarjeta Black</span>
                                    </div>
                                    <div class="card-body">
                                        <label class="productlist-card-subtitle" style="color: white">Precio público Black A.F:</label> <span class="productlist-card-price">$@{{ price.black_public_price | number:0 }}</span>
                                        <label class="productlist-card-subtitle" style="color: white">Valor 12 cuotas Black sin bono:</label> <span class="productlist-card-price">$@{{ price.black_bond_price | number:0 }}</span>
                                    </div>
                                </div>
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-header">
                                        <span class="productlist-card-titleCard">Tarjeta Blue</span>
                                    </div>
                                    <div class="card-body">
                                        <label class="productlist-card-subtitle" style="color: white">Precio público Blue A.F:</label> <span class="productlist-card-price">$@{{ price.blue_public_price | number:0 }}</span>
                                        <label class="productlist-card-subtitle" style="color: white">Valor 12 cuotas Blue sin bono:</label> <span class="productlist-card-price">$@{{ price.blue_bond_price | number:0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>