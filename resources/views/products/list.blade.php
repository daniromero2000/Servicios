@extends('layouts.admin.app')
@section('linkStyleSheets')
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
@endsection
@section('content')
<section class="content">
    @include('layouts.errors-and-messages')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Productos</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(!is_null($products))
                            <div class=" table-responsive p-0 height-table">

                                <table class="table text-center table-hover table-head-fixed">
                                    <thead class="header-table">
                                        <tr>
                                            <th scope="col">Código</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Marca</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="body-table">
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->sku }}</td>
                                            <td> <a
                                                    href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                            </td>

                                            <td>{{ $product->brands_id->name }}</td>
                                            <td>$ {{ number_format($product->price, 0, '.', ',') }}</td>
                                            <td>
                                                @if ($product->status == 1)
                                                <span class="badge badge-success">Activo</span>
                                                @else
                                                <span class="badge badge-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <i class="fas fa-trash-alt cursor" data-toggle="modal"
                                                    data-target="#deleteLead"></i>
                                                <i class="fas fa-edit cursor" data-toggle="modal"
                                                    data-target="#updateProduct{{ $product->id }}"></i>
                                                <i class="fas fa-eye cursor" data-toggle="modal"
                                                    data-target="#showProduct{{ $product->id }}"></i>
                                            </td>
                                        </tr>

                                        @include('products.layouts.modals.modal_update_product')
                                        @include('products.layouts.modals.modal_show_product')

                                        @endforeach

                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <div class="text-right mt-2">
                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#addProduct">Agregar
                                    Producto</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Marcas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(!is_null($brands))
                            <div class=" table-responsive p-0 height-table">

                                <table class="table text-center table-hover table-head-fixed">
                                    <thead class="header-table">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="body-table">
                                        @foreach ($brands as $brand)

                                        <tr>
                                            <td>
                                                {{ $brand->name }}</a>
                                            </td>
                                            <td>
                                                <i class="fas fa-trash-alt cursor" data-toggle="modal"
                                                    data-target="#deleteLead"></i>
                                                <i class="fas fa-edit cursor" data-toggle="modal" onclick="dataLead()"
                                                    data-target="#editLead"></i>
                                                <i class="fas fa-comments cursor" data-toggle="modal"
                                                    data-target="#addComment"></i>
                                                {{-- <form action="{{ route('brands.destroy', $brand->id) }}"
                                                method="post"
                                                class="form-horizontal">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                                <div class="btn-group">
                                                    <a href="{{ route('brands.edit', $brand->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-edit"
                                                            aria-hidden="true"></i> Editar</a>
                                                    <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                                        class="btn btn-danger btn-sm"><i class="fa fa-times"
                                                            aria-hidden="true"></i> Borrar</button>
                                                </div>
                                                </form> --}}
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            @else

                            <p class="alert alert-warning">No hay marcas creadas aun. <a
                                    href="{{ route('brands.create') }}">Crea una!</a></p>
                            @endif
                            <div class="text-right mt-2">
                                <button class="btn btn-primary btn-sm" ng-click="addListGiveAway()">Agregar
                                    Marca</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('products.layouts.modals.modal_create_product')

</section>
@endsection
@section('scriptsJs')
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
</script>
@endsection