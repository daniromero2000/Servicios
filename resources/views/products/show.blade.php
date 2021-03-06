@extends('layouts.admin.app')
@section('content')
<!-- Main content -->
<section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->
    @if($product)
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h2>{{ $product->name }}
            </h2>
            <img src="{{ asset("storage/$product->cover" )}}" alt="">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Cover</th>
                        <th class="text-center" scope="col">Descripción</th>
                        <th class="text-center" scope="col">Cantidad</th>
                        <th class="text-center" scope="col">Precio</th>
                        <th class="text-center" scope="col">Sucursal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"> <img src="{{ asset("storage/$product->cover") }}" alt=""
                                class="img-responsive img-thumbnail" width="100">
                        </td>
                        <td class="text-center">{{ $product->description }}</td>
                        <td class="text-center">{{ $product->quantity }}</td>
                        <td class="text-center">{{ config('cart.currency_symbol') }} {{ number_format($product->price)}}
                        </td>

                    </tr>
                </tbody>
            </table>

            <div class="row">
                <div class="col">
                    <form action="{{ route('products.destroy', $product->id) }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <div class="btn-group">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-edit"></i> Editar</a>

                            <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Borrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="btn-group">
                <a href="{{ route('products.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
    </div>
    <!-- /.box -->
    @endif

</section>
<!-- /.content -->
@endsection