<div class="col-md-4">
    <div class="card card-table-reset">
        <div class="card-body table-responsive pt-1">
            <h2 class="title-table" class="title-table"><i class="fas fa-comments" aria-hidden="true"></i> Notas Fábrica
            </h2>
            @if($datas->isNotEmpty())
            <table class="table table-hover table-stripped leadTable">
                <thead class="header-table">
                    <tr>
                        <th class="text-center" scope="col">Etapa</th>
                        <th class="text-center" scope="col">Nota</th>
                        <th class="text-center" scope="col">Usuario</th>
                        <th class="text-center" scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody class="body-table">
                    @foreach($datas as $data)
                    <tr>
                        <td class="text-center">
                            {{ $data->ETAPA }}
                        </td>
                        <td class="text-center">
                            {{ $data->DESCRIP }}
                        </td>
                        <td class="text-center">
                            {{ $data->USUARIO }}
                        </td>
                        <td class="text-center">
                            {{ $data->FECHA }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <table class="table table-hover table-stripped leadTable">
                <tbody class="body-table ">
                    <tr>
                        <td>
                            Aún no tiene Notas de Fábrica
                        </td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>