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
                            <table class="table table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($errors as $error)
                                    <tr class="text-center">
                                        <td> {{ $error->id }}</td>
                                        <td>{{ $error->created_at }}</td>
                                        <td>{{ $error->status }}</td>
                                        <td><i class="fas fa-eye cursor" data-toggle="modal"
                                                data-target="#modelId{{$error->id}}"></i>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modelId{{$error->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"> Error details</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Error</h5>
                                                            <p class="card-text"> @if ($error->data)
                                                                {{-- @php
                                                                $error = json_decode($error->data,true );
                                                                @endphp --}}
                                                                {{ $error->data}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
{"mensaje":"
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'CODIGOd' in 'field list' (SQL: SELECT CODIGOd as
value, CIUDAD as label FROM SUCURSALES WHERE PRINCIPAL = 1 ORDER BY CIUDAD ASC)","
archivo":"E:\\MIS
DATOS\\Documents\\proyectos\\dev1.serviciosoportunidades\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Connection.php",
"linea":664,
"cedula":""}
@endsection