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
                    <div class="card-body">
                        <label class="productlist-card-subtitle">Precio público normal:</label> <span class="productlist-card-price">$@{{ price.normal_public_price | number:0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>