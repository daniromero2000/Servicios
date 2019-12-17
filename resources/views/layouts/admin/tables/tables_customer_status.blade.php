<div class="mb-4">

    <!-- /.card-header -->
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
                @foreach($datas as $data)
                <tr>
                    <td>{{ $data->CREACION}} </td>
                    <td>{{ $data->CEDULA}} </td>
                    <td>{{ $data->APELLIDOS}}</td>
                    <td>{{ $data->NOMBRES}} </td>
                    <td>{{ $data->TIPOCLIENTE}} </td>
                    <td>{{ $data->SUBTIPO}} </td>
                    <td>{{ $data->ORIGEN}} </td>
                    <td>{{ $data->CELULAR}} </td>
                    <td><span @if ($data->PASO == "PASO3")
                        class="badge badge-success"
                        @endif 
                        @if ($data->PASO == "PASO2")
                            class="badge badge-primary"
                            @endif
                            @if ($data->PASO == "PASO1")
                            class="badge badge-warning"
                            @endif style="font-size: 11px;">{{ $data->PASO}}</span> </td>
                    <td>{{ $data->ESTADO}} </td>
                </tr>
                @endforeach

            <tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->