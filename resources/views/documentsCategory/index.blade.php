@extends(' layouts.admin.app')
@section('content')
<section class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb bradcrumb-reset float-sm-right">
                            <li class="breadcrumb-item"><a href="/Administrator/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="/Administrator/documents">Documentos</a></li>
                        </ol>
                    </div>
                    <div class="col-12">
                        <a href="{{ URL::previous() }}" class="btn btn-primary ml-auto mr-3 mb-2 btn-sm">Regresar</a>
                        <a href="/Administrator/document-categories/create" class="btn btn-primary ml-auto mr-3 mb-2 btn-sm">Crear Categoria</a>
                    </div>
                </div>
            </div>
        </div>
        @include(' layouts.errors-and-messages')

       <div class="p-3" style="max-width: 1450px;margin: auto;">
                <div class="row" ng-if="filtros">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Indicadores</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body px-0">
                                @if (!empty($documentCategory->toArray()))
                                    <div class="mb-4">
                                        <div class=" table-responsive p-0 height-table">
                                            <table class="table table-head-fixed">
                                                <thead class="text-center header-table">
                                                    <tr>
                                                        @foreach ($headers as $header)
                                                            <th scope="col">{{ $header }}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody class="body-table">
                                                    @foreach ($documentCategory as $data)
                                                        <tr>
                                                            <td class="text-center"> {{ $data->id }} </td>
                                                            <td class="text-center"> {{ $data->name }} </td>
                                                            <td class="text-center"> {{ $data->created_at }} </td>
                                                            <td class="text-center"> @include('layouts.status', ['status' =>
                                                                $data->is_active])
                                                            </td>
                                                            <td class="text-center">
                                                                <i class="fas fa-trash-alt cursor" data-toggle="modal"
                                                                    data-target="#deleteLead{{ $data->id }}"></i>
                                                                <i class="fas fa-edit cursor" data-toggle="modal"
                                                                    onclick="dataLead({{ $data->id }})"
                                                                    data-target="#modal{{ $data->id }}"></i>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="deleteLead{{ $data->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <form style="display:inline-block"
                                                                        action="{{ route('documents.destroy', $data->id) }}"
                                                                        method="post" class="form-horizontal">
                                                                        <input type="hidden" name="_method" value="delete">
                                                                        @csrf
                                                                        <input type="hidden" name="_method" value="delete">
                                                                        <div class="modal-body">

                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            Estas Seguro ?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Eliminar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @include('layouts.modals.modal_update')
                                                    @endforeach
                                                <tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @include('layouts.admin.pagination.pagination', [$skip])
                                @else
                                    <div class="px-2">
                                        @include('layouts.admin.pagination.pagination_null', [$skip, $optionsRoutes])
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
</section>
@endsection