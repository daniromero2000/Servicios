    <!--
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DIGITAL
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: view for render PRODUCT CRUD
    **Fecha: 13/12/2018
     -->
@extends('layouts.admin.app')
@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="/Administrator/Catalog#!/Products/">Catalógo</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div ng-app="catalogApp" class="containerleads container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-12 col-sm-4 text-center">
                <a href="#!/Products">
                    <img src="{{ asset('images/catalog.png') }}" alt="" class="img-fluid">
                    <p>Productos</p>
                </a>
            </div>
            <div class="col-12 col-sm-4 text-center">
                <a href="#!/Brands">
                    <img src="{{ asset('images/brands.png') }}" alt="" class="img-fluid">
                    <p>Marcas</p>
                </a>
            </div>
            <div class="col-12 col-sm-4 text-center">
                <a href="#!/Lines">
                    <img src="{{ asset('images/lines.png') }}" alt="" class="img-fluid">
                    <p>Líneas</p>
                </a>
            </div>
        </div>
        <div class="container">
               
            <ng-view>
            </ng-view>
        </div>

    </div>
    <script src="{{ asset('js/libsJs/bootbox.js') }}"></script>
    <script src="{{ asset('js/appCatalog/app.js') }}"></script>
    <script src="{{ asset('js/appCatalog/controllers/productsEdtController.js') }}"></script>
    <script src="{{ asset('js/appCatalog/controllers/productsController.js') }}"></script>
    <script src="{{ asset('js/appCatalog/controllers/linesController.js') }}"></script>
    <script src="{{ asset('js/appCatalog/controllers/brandsController.js') }}"></script>
    <script src="{{ asset('js/libsJs/flow.js') }}"></script>
    <script src="{{ asset('js/libsJs/fusty-flow.js') }}"></script>
    <script src="{{ asset('js/libsJs/fusty-flow-factory.js') }}"></script>
    <script src="{{ asset('js/libsJs/ng-flow.js') }}"></script>
    <script src="{{ asset('js/libsJs/ng-flow.js') }}"></script>
    
    <script src="https://rawgithub.com/angular-ui/ui-sortable/master/src/sortable.js"></script>
    


@stop