@extends('layouts.admin.app')
@section('content')

<section>
    {{-- @include('layouts.errors-and-messages') --}}
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 ">Regresar</a>
                    </div>
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard/customers">Dashboard
                                    Clientes</a></li>
                            <li class="breadcrumb-item active"><a href="/Administrator/customers">Clientes</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <div class="card shadow-lg">
                        <div class="card-header border-0">
                            <h3>Lista de errores</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($errors as $error)
                                    <tr class="text-center">
                                        <td> {{ $error->id }}</td>
                                        <td>{{ $error->created_at }}</td>
                                        <td>{{ $error->status }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scriptsJs')

@endsection