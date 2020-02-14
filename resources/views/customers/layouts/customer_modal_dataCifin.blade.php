<!-- Modal -->
<div class="modal fade bd-example-modal-xl" id="customerDataCifin{{$cifinWebService->consec}}" tabindex="-1"
    role="dialog" aria-labelledby="customerDataCifinTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerDataCifinTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        @include('customers.layouts.customer_cifin_real_mora', ['cifin_reals' =>
                        $cifinWebService->cifinRealArrear])
                    </div>
                    <div class="col-12">
                        @include('customers.layouts.customer_cifin_fin_mora', ['cifin_fins' =>
                        $cifinWebService->cifinFinancialArrear])
                    </div>
                    <div class="col-12">
                        @include('customers.layouts.customer_cifin_fin_uptodate', ['cifin_uptodate_fins' =>
                        $cifinWebService->upToDateFinancialCifin])
                    </div>
                    <div class="col-12">
                        @include('customers.layouts.customer_cifin_real_uptodate', ['cifin_uptodate_reals' =>
                        $cifinWebService->upToDateRealCifin])
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>