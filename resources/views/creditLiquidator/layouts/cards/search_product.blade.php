<div class="row">
    <div class="col-12 col-sm-8 col-lg-5 mx-auto">
        <div class="card">
            <label for="product">Buscar producto</label>
            <input required type="text" class="form-control" ng-model="code" ng-blur="getDataPriceProduct()"
                id="codeProduct" name="codeProduct">
        </div>

    </div>
</div>

<div class="row" ng-show="viewProductPrices" style="padding: 20px;">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-6 col-lg-4">
                <div class="card card-primary shadow-sm border-0">
                    <div class="card-header">
                        <h3 class="card-title">@{{productPrices.price.list}} </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus color-black"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="display: block;">
                        <div class="small-box bg-gradient-light">
                            <div class="inner">
                                <p class="productlist-card-title">Tradicional</p>
                                <div class="productlist-card-container">
                                    <label class="productlist-card-subtitle">Precio público normal:</label>
                                    <span
                                        class="productlist-card-price">$@{{ productPrices.price.normal_public_price | number:0 }}</span>

                                    <label class="productlist-card-subtitle">Precio público promoción:</label>
                                    <span
                                        class="productlist-card-price">$@{{ productPrices.price.promotion_public_price | number:0 }}</span>
                                    <label class="productlist-card-subtitle">Porcentaje precio público
                                        promoción:</label> <span
                                        class="productlist-card-price">@{{ productPrices.price.percentage_promotion_public_price | number:2 }}%</span>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-10 col-md-6 col-lg-4">
                <div class="card card-primary shadow-sm border-0">
                    <div class="card-header">
                        <h3 class="card-title">@{{productPrices.price.list}} </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus color-black"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="display: block;">

                        <div class="small-box bg-gradient-primary">
                            <div class="inner">
                                <p class="productlist-card-title text-white">Tarjeta Blue</p>
                                <div class="card-body">
                                    <label class="productlist-card-subtitle" style="color: white">Precio público
                                        Blue A.F:</label> <span
                                        class="productlist-card-price">$@{{ productPrices.price.blue_public_price | number:0 }}</span>
                                    <label class="productlist-card-subtitle" style="color: white">Porcentaje
                                        Precio
                                        público
                                        Blue A.F:</label> <span
                                        class="productlist-card-price">@{{ productPrices.price.percentage_blue_public_price | number:2 }}%</span>

                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-credit-card" style="font-size: 46px;"></i> </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-10 col-md-6 col-lg-4">
                <div class="card card-primary shadow-sm border-0">
                    <div class="card-header">
                        <h3 class="card-title">@{{productPrices.price.list}} </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus color-black"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="display: block;">
                        <div class="small-box bg-gradient-dark">
                            <div class="inner">
                                <p class="productlist-card-title text-white">Tarjeta Black</p>
                                <div class="card-body">

                                    <label class="productlist-card-subtitle" style="color: white">Precio público
                                        Black A.F:</label> <span
                                        class="productlist-card-price">$@{{ productPrices.price.black_public_price | number:0 }}</span>
                                    <label class="productlist-card-subtitle" style="color: white">Porcentaje
                                        precio
                                        público
                                        Black A.F:</label> <span
                                        class="productlist-card-price">@{{ productPrices.price.percentage_black_public_price | number:2 }}%</span>

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