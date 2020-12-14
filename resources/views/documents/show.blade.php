@extends(' layouts.admin.app')
@section('header')
    @include(' admin.layouts.breadcrumb.breadcrumb',['data' => $breadcrumb])
@endsection
@section('content')
    <section class="content">
        @include(' layouts.errors-and-messages')
        <div class="card-body">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Indicador</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center mb-3">
                                <div class="col">
                                    <h3 class="mb-0">{{ $document->name }}
                                    </h3>
                                </div>
                                <div class="col text-right">
                                    <a data-toggle="modal" data-target="#modal{{ $document->id }}"
                                        class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush table-hover text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Descargas</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Ver documento</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <tr>
                                                <td>{{ $document->name }}</td>
                                                  <td> @include(' layouts.status', ['status' => $document->is_active])</td>
                                                <td>{{ $document->downloads }}</td>
                                                <td>{{ $document->created_at }}</td>
                                                <td><a target="_blank" href="{{ asset("storage/$document->src") }}"><i class="far fa-eye"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row mt-3 mx-0">
                                        <div class="col text-right">
                                            <form action="{{ route('admin.employees.destroy', $document['id']) }}"
                                                method="post" class="form-horizontal">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete">
                                                <div class="btn-group">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <a href="{{ route('admin.employees.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
    </section>
@endsection
