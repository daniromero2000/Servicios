@extends('layouts.admin.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb bradcrumb-reset float-sm-right">
                    <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/Administrator/ProductList#!/">Administración de
                            Listas</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div ng-app="ProductListApp">
    <div class="container-fluid">
        <ng-view>
        </ng-view>
    </div>
</div>
<script src="{{ asset('js/appProductList/app.js') }}"></script>
<script src="{{ asset('js/appProductList/services/myService.js') }}"></script>
<script src="{{ asset('js/appProductList/controllers/Controller.js') }}"></script>
@stop