<div class="card card-primary card-outline card-outline-tabs">
	<div class="card-header p-0 border-bottom-0">
		<nav>
			<div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">
				<a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 1 }"
					ng-click="tabs = 1" data-toggle="tab" role="tab" aria-controls="nav-general">Listas</a>
				<a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 2 }"
					ng-click="tabs = 2" data-toggle="tab" role="tab" aria-controls="nav-general">General</a>
				<a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 3 }"
					ng-click="tabs = 3" data-toggle="tab" role="tab" aria-controls="nav-general">Calcular precio</a>
			</div>
		</nav>
	</div>
	<div class="card-body">
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
				ng-class="{ 'show active': tabs == 1 }">
				<div class="row">
					<div class="col-7">
						@include('ProductList.layouts.Cards.CardListProducts')
					</div>
					<div class="col-5">
						@include('ProductList.layouts.Cards.CardProductLists')
					</div>
				</div>
			</div>

			<div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
				ng-class="{ 'show active': tabs == 2 }">
				<div class="row">
					<div class="col-6">
						@include('ProductList.layouts.Cards.CardListGiveAway')
					</div>
					<div class="col-6">
						@include('ProductList.layouts.Cards.CardFactors')
					</div>
				</div>
			</div>

			<div class="tab-pane mb-4 border-0" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
				ng-class="{ 'show active': tabs == 3 }">
				<div class="row">
					<div class="col-12">
						@include('ProductList.layouts.Cards.cardProductPrice')
					</div>
				</div>
			</div>
		</div>
	</div>
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