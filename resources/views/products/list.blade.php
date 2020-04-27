@extends('layouts.admin.app')
@section('content')
<!-- Main content -->
<section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->

    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h1>Productos en Venta</h1>
            @if(!is_null($products))

        <table class="table">
            <thead>
                <tr>
                    <th class="text-center" scope="col">Código</th>
                    <th class="text-center" scope="col">Nombre</th>
                    <th class="text-center" scope="col">Cantidad</th>
                    <th class="text-center" scope="col">Precio</th>

                    <th class="text-center" scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td class="text-center">{{ $product->sku }}</td>
                    <td class="text-center">

                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                    </td>
                    <td class="text-center">{{ $product->quantity }}</td>
                    <td class="text-center">{{ config('cart.currency_symbol') }}
                        {{ number_format($product->price, 0, '.', ',') }}</td>

                    <td class="text-center">
                        <form action="{{ route('products.destroy', $product->id) }}" method="post"
                            class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="delete">
                            <div class="btn-group">
                              <a
                                    href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-edit"></i> Editar</a>
                                <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                    class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Borrar</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
@endsection