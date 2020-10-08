<div class="col-lg-6 col-xl-8 mx-auto">
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
                                <li class="mt-2 small d-flex justify-content-between">
                                    <span class="fa-li"><i class="fas fa-percent"></i></span>
                                    Total
                                    Descuentos: <b> $
                                        @{{quotations[key][2] | number:0 }}</b>
                                </li>
                                <li class="mt-2 small d-flex justify-content-between">
                                    <span class="fa-li"><i class="fas fa-money-bill-wave-alt"></i></span>
                                    Valor cuotas:
                                    <b> $
                                        @{{quotations[key][3].value_fee | number:0}}</b>
                                </li>
                                <li class="mt-2 small d-flex justify-content-between">
                                    <span class="fa-li"><i class="fas fa-store-alt"></i></span>
                                    Aval+Iva:
                                    <b> $
                                        @{{quotations[key][4].total_aval | number:0}}</b>
                                </li>
                                <li class="mt-2 small d-flex justify-content-between">
                                    <span class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                    Subtotal:
                                    <b> $
                                        @{{quotations[key][5].subtotal | number:0}}</b>
                                </li>
                                <li class="mt-2 small d-flex justify-content-between">
                                    <span class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                    Iva:
                                    <b> $
                                        @{{quotations[key][5].iva | number:0}}</b>
                                </li>
                                <li class="mt-2 small d-flex justify-content-between">
                                    <span class="fa-li"><i class="fas fa-dollar-sign"></i></span>
                                    Total:
                                    <b> $
                                        @{{quotations[key][5].total | number:0}}</b>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>