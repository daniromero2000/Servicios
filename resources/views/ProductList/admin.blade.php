<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-7">

        @include('ProductList.layouts.Cards.CardProductLists')
        @include('ProductList.layouts.Cards.CardFactors')

        @include('ProductList.layouts.Modals.ModalFactors')

      </div>

    </div>
  </div>

  @include('ProductList.layouts.Modals.ModalProductLists')

</div>