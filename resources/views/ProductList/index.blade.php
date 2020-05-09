@extends('layouts.admin.app')

@section('linkStyleSheets')
    <link rel="stylesheet" href="{{ asset('css/productList/productList.css') }}">
 @endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb bradcrumb-reset float-sm-right">
                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/Administrator/ProductList#!/">Administrador de Listas</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div ng-app="productListApp">
    <div class="container-fluid">
        <ng-view>
        </ng-view>
    </div>
</div>
    @section('scriptsJs')
    <script src="{{ asset('js/appProductList/app.js') }}"></script>
    <script src="{{ asset('js/appProductList/services/myService.js') }}"></script>
    <script src="{{ asset('js/appProductList/controllers/productListController.js') }}"></script>
    <script src="{{ asset('js/libsJs/flow.js') }}"></script>
    <script src="{{ asset('js/libsJs/fusty-flow.js') }}"></script>
    <script src="{{ asset('js/libsJs/fusty-flow-factory.js') }}"></script>
    <script src="{{ asset('js/libsJs/ng-flow.js') }}"></script>
    <script src="{{ asset('js/libsJs/ng-flow.js') }}"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angucomplete-alt/3.0.0/angucomplete-alt.min.js"></script>
    @endsection
@stop