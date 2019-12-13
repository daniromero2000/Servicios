<div class="mb-4">
    <!-- /.card-header -->
    <div class=" table-responsive p-0" style="height: 500px;">
        <table class="table table-head-fixed">
            <thead class="text-center">
                <tr>
                    @foreach ($headers as $header)
                    <th scope="col">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                <tr>
                    <td>{{ date('M d, Y h:i a', strtotime($data->CREACION))}} </td>
                    <td><a data-toggle="tooltip" title="Ver Cliente" href="{{ route('customers.show', $data->CEDULA) }}">{{ $data->CEDULA}}</a></td>
                    <td>{{ $data->APELLIDOS}}</td>
                    <td>{{ $data->NOMBRES}} </td>
                    <td>{{ $data->TIPOCLIENTE}} </td>
                    <td>{{ $data->SUBTIPO}} </td>
                    <td>{{ $data->ORIGEN}} </td>
                    <td>{{ $data->CELULAR}} </td>
                    <td>{{ $data->PASO}} </td>
                    <td>{{ $data->ESTADO}} </td>
                </tr>
                @endforeach
            <tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->