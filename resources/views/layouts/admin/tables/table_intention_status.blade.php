<div class="table " style="font-size: 10pt;">
    <table id="example2" class="table table-responsive table-stripped  table-hover">
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
                <td>{{ $data->id}}</td>
                <td>{{ $data->CEDULA}} </td>
                <td>{{ $data->FECHA_INTENCION}}</td>
                <td>{{ $data->customer['ACTIVIDAD']}}</td>
                <td>@if ($data->ESTADO_OBLIGACIONES == 1)OK @endif
                    @if ($data->ESTADO_OBLIGACIONES == 0)NO OK @endif</td>
                    <td> @if($data->customer) {{ $data->customer->latestCifinScore['score']}} @endif</td>
                <td>{{ $data->PERFIL_CREDITICIO}}</td>
                <td>@if ($data->HISTORIAL_CREDITO == 1)OK @endif
                    @if ($data->HISTORIAL_CREDITO == 0)NO OK @endif</td>
                <td>{{ $data->TARJETA}}</td>
                <td>{{ $data->ZONA}}</td>
                <td>@if ($data->EDAD == 1)OK @endif
                    @if ($data->EDAD == 0)NO @endif</td>
                <td>@if ($data->TIEMPO_LABOR == 1)OK @endif
                    @if ($data->TIEMPO_LABOR == 0)NO OK @endif</td>
                <td>@if ($data->TIPO_5_ESPECIAL == 1)SI @endif
                    @if ($data->TIPO_5_ESPECIAL == 0)NO @endif</td>
                <td>@if ($data->INSPECCION_OCULAR == 1)SI @endif
                    @if ($data->INSPECCION_OCULAR == 0)NO @endif</td>
                <td>{{ $data->definition['DESCRIPCION']}}</td>
                <td>{{ $data->customer['ESTADO']}}</td>
            </tr>
            @endforeach
        <tbody>
    </table>
</div>