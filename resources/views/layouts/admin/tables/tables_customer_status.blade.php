<div class="table ">

    <table id="example2" class="table table-responsive-lg table-stripped  table-hover">
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

