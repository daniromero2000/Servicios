<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-7">
        @include('ProductList.layouts.Cards.CardListProducts')
      </div>
      <div class="col-5">
        @include('ProductList.layouts.Cards.CardProductLists')
        @include('ProductList.layouts.Cards.CardListGiveAway')
        @include('ProductList.layouts.Cards.CardFactors')
      </div>
    </div>
  </div>
</div>
<div> @include('ProductList.layouts.Modals.ModalFactors') </div>
<div> @include('ProductList.layouts.Modals.ModalProductLists')</div>
<div> @include('ProductList.layouts.Modals.ModalListProduct') </div>
<div> @include('ProductList.layouts.Modals.ModalListGiveAway') </div>