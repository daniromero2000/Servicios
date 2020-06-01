<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-comments" aria-hidden="true"></i> Comentarios
            Canal Digital</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                    class="fas fa-minus text-dark"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="max-height: 360px; overflow: auto;">
        @if($datas->isNotEmpty())
        <table class="table table-hover table-stripped leadTable">
            <thead class="header-table">
                <tr>
                    <th class="text-center" scope="col">Fecha de Creación</th>
                    <th class="text-center" scope="col">Solicitud</th>
                    <th class="text-center" scope="col">Comentario</th>
                </tr>
            </thead>
            <tbody class="body-table">
                @foreach($datas as $data)
                <tr>
                    <td class="text-center">
                        {{ $data->created_at }}
                    </td>
                    <td class="text-center">
                        {{ $data->solicitud }}
                    </td>
                    <td class="text-center">
                        {{ $data->comment }}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <table class="table table-hover table-stripped leadTable">
            <tbody class="body-table">
                <tr>
                    <td>
                        Aún no tiene comentarios
                    </td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
    <!-- /.card-body -->
</div>