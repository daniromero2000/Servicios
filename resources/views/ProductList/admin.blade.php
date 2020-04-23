<div class="card card-primary card-outline card-outline-tabs">
  <div class="card-header p-0 border-bottom-0">
    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link " id="custom-tabs-four-home-tab" data-toggle="pill" href="#Products" role="tab"
          aria-controls="Products" aria-selected="true">Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#Lists" role="tab"
          aria-controls="Lists" aria-selected="true">Listas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#Factors" role="tab"
          aria-controls="Factors" aria-selected="true">Factores</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="custom-tabs-four-tabContent">
      <div class="tab-pane fade active show" id="Products" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
        <div class="card">
          <div class="card-body">

          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="Lists" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">

        <div class="row">
          <div class="col-7">
            @include('ProductList.layouts.Cards.CardListProducts')
          </div>
          <div class="col-5">
            @include('ProductList.layouts.Cards.CardProductLists')
          </div>
        </div>

      </div>
      <div class="tab-pane fade" id="Factors" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">

        <div class="row">
          <div class="col-6">
            @include('ProductList.layouts.Cards.CardListGiveAway')
          </div>
          <div class="col-6">
            @include('ProductList.layouts.Cards.CardFactors')
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- /.card -->
</div>


{{-- <div class="card">
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
</div> --}}
<div> @include('ProductList.layouts.Modals.ModalFactors') </div>
<div> @include('ProductList.layouts.Modals.ModalProductLists')</div>
<div> @include('ProductList.layouts.Modals.ModalListProduct') </div>
<div> @include('ProductList.layouts.Modals.ModalListGiveAway') </div>