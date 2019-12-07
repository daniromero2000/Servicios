<div class="container-fluid mb-4">

    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 500px;">
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
                    <td>{{ $data->CREACION}} </td>
                    <td>{{ $data->CEDULA}} </td>
                    <td>{{ $data->APELLIDOS}}</td>
                    <td>{{ $data->NOMBRES}} </td>
                    <td>{{ $data->CELULAR}} </td>
                    <td>{{ $data->TIPOCLIENTE}} </td>
                    <td>{{ $data->SUBTIPO}} </td>
                    <td>{{ $data->ORIGEN}} </td>
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