<div class="row">
    <div class="col-12 col-sm-8 col-lg-5 mx-auto">
        <label for="product">Buscar producto</label>
        <input required type="text" class="form-control" ng-model="code" ng-blur="getDataPriceProduct()"
            id="codeProduct" name="codeProduct">
    </div>
</div>

<div class="row" ng-show="viewProductPrices" style="padding: 20px;">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card card-primary shadow-sm ">
                    <div class="card-header">
                        <h3 class="card-title">@{{productPrices.price.list}} </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus color-black"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="display: block;">
                        <div class="small-box">
                            <div class="inner">
                                <div class="productlist-card-container">
                                    <div class="table-responsive">
                                        <table class="table table-light text-sm table-bordered"
                                            style="min-width: 900px;">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Artículo</th>
                                                    <th>Precio público</th>
                                                    <th>Descuento precio público</th>
                                                    <th>Descuento precio tarjeta blue</th>
                                                    <th>Descuento precio tarjeta black</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>@{{ productPrices.product[0].sku }}</td>
                                                    <td>@{{ productPrices.product[0].item }}</td>
                                                    <td>$@{{ productPrices.price.normal_public_price | number:0 }}</td>
                                                    <td>@{{ productPrices.price.percentage_promotion_public_price | number:2 }}%
                                                    </td>
                                                    <td>@{{ productPrices.price.percentage_blue_public_price | number:2 }}%
                                                    </td>
                                                    <td>@{{ productPrices.price.percentage_black_public_price | number:2 }}%
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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