<div class="row">
    <div class="col-12 col-sm-8 col-lg-5 mx-auto px-3">
        <label for="product">Buscar producto</label>
        <input required type="text" class="form-control" ng-model="code" ng-blur="getDataPriceProduct()"
            id="codeProduct" name="codeProduct">
    </div>
</div>

<div class="col-12 mt-3" ng-show="viewProductPrices">
    <div class="row justify-content-center">
        <div style=" max-width: 450px; width: 100%;">
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

                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">
                            @{{ productPrices.product[0].item }}
                        </div>
                        <div class="card-body pt-0" style="padding: 1.25rem !important;">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="lead"><b>@{{ productPrices.product[0].sku }}</b></h2>
                                    <p class="text-muted text-sm">Precio público:
                                        <b>$@{{ productPrices.price.normal_public_price | number:0 }}</b> </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                            Descuento
                                            precio
                                            público:
                                            <b>@{{ productPrices.price.percentage_promotion_public_price | number:2 }}%</b>
                                        </li>
                                        <li class="small"><span class="fa-li"><i class="far fa-credit-card"></i></span>
                                            Descuento
                                            precio tarjeta
                                            blue:
                                            <b>@{{ productPrices.price.percentage_blue_public_price | number:2 }}%</li>
                                        </b>
                                        <li class="small"><span class="fa-li"><i class="far fa-credit-card"></i></span>
                                            Descuento
                                            precio tarjeta
                                            black:
                                            <b>@{{ productPrices.price.percentage_black_public_price | number:2 }}%</b>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 text-center mt-4" ng-show="viewProductImg">
                                    <img src="/storage/@{{productImg.cover}}" alt="" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>