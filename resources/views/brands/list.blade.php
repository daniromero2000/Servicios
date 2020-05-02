@extends('layouts.admin.app')
@section('content')
<!-- Main content -->
<section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->
    @if(!is_null($brands))
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h1>Marcas</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Nombre</th>
                        <th class="text-center" scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                    <tr>
                        <td class="text-center">
                           {{ $brand->name }}</a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('brands.destroy', $brand->id) }}" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <div class="btn-group">
                                    <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Editar</a>
                                    <button onclick="return confirm('¿Estás Seguro?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Borrar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @else
    <p class="alert alert-warning">No hay marcas creadas aun. <a href="{{ route('brands.create') }}">Crea una!</a></p>
    @endif
</section>
<!-- /.content -->
@endsection