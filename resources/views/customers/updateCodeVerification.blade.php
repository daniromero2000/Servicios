@extends('layouts.admin.app')
@section('linkStyleSheets')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<style>
    @media (max-width: 600px) {
        .tableReset {
            font-size: 12px;
        }
    }
</style>
@endsection
@section('content')
<section class="content border-0">

    <div class="mt-4 mx-auto" style="max-width: 560px">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Tokens</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus color-black"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <div class="form-group">
                    <label for="identificationNumber">Cédula</label>
                    <input type="text" class="form-control" id="identificationNumber">
                </div>
                <div class="w-100 text-right">
                    <button type="button" id="search" class="btn btn-primary">Buscar</button>
                </div>
            </div>

            <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="my-modal-title">Resultado</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <div class="table-responsive">
                                <table class="table table-hover tableReset ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Token</th>
                                            <th>Cédula</th>
                                            <th>Telefono</th>
                                            <th>Tipo</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataCode">
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>


</section>
@endsection
@section('scriptsJs')
<script src="{{ asset('js/getCodeVerification.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>

@endsection