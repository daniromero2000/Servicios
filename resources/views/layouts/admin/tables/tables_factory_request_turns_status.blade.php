<div class="container-fluid mb-4">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0 height-table">
        <table class="table table-head-fixed">
            <thead class="header-table">
                <tr>
                    @foreach ($headers as $header)
                    <th scope="col">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="body-table">
                @foreach($datas as $data)
                <tr>
                    <td class="text-center"><a data-toggle="tooltip" title="Ver Cliente"
                            href="{{ route('customers.show', $data->CLIENTE) }}">
                            {{ str_replace(' ', '', $data->CLIENTE) }} </a>
                    </td>
                    <td class="text-center">
                        <a data-toggle="tooltip" title="Ver Solicitud"
                            href="{{ route('factoryrequests.show', $data->SOLICITUD) }}">{{ $data->SOLICITUD }}</a></td>
                    <td class="text-center">@if ($data->factoryRequestaAssessors)
                        {{ $data->factoryRequestaAssessors->NOMBRE }}
                        @endif </td>
                    <td class="text-center">{{ $data->SUCURSAL }}</td>
                    <td class="text-center">{{ $data->FECHASOL }} </td>
                    <td class="text-center"> {{ $data->ESTADO }} </td>
                    <td class="text-center"> $ {{ number_format  ($data->GRAN_TOTAL) }} </td>
                    <td class="text-center">
                        @if ($data->turno && !empty($data->turno->USUARIO)) {{ $data->turno->USUARIO }} @else NA @endif
                    </td>
                    <td class="text-center">
                        @if ($data->turno && !empty($data->turno->PRIORIDAD)) {{ $data->turno->PRIORIDAD }} @else NA
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($data->turno && !empty($data->turno->TIPO)) {{ $data->turno->TIPO }} @else NA @endif
                    </td>
                    <td class="text-center">
                        @if ($data->turno && !empty($data->turno->SUB_TIPO)) {{ $data->turno->SUB_TIPO }} @else NA
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($data->turno && !empty($data->turno->FEC_ASIG)) {{ $data->turno->FEC_ASIG }} @else NA
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->