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
                    <td class="text-center">{{ $data->SUCURSAL }}</td>
                    <td class="text-center">
                        <a data-toggle="tooltip" title="Ver Solicitud"
                            href="{{ route('factoryrequests.show', $data->SOLICITUD) }}">{{ $data->SOLICITUD }}</a></td>
                    <td class="text-center">{{ $data->FECHASOL }} </td>
                    <td class="text-center">{{ $data->factoryRequestStatusesLogsFirst ? $data->factoryRequestStatusesLogsFirst->created_at : '' }} </td>
                    <td class="text-center"> {{ $data->factoryRequestStatus->name }} </td>
                    <td class="text-center"><a data-toggle="tooltip" title="Ver Cliente"
                            href="{{ route('customers.show', $data->CLIENTE) }}">
                            {{ str_replace(' ', '', $data->CLIENTE) }} </a>
                    </td>
                    <td class="text-center">
                        @if ($data->turnoTradicional && !empty($data->turnoTradicional->TIPO))
                        {{ $data->turnoTradicional->TIPO }}
                        @else
                        @if ($data->turnoOportuya && !empty($data->turnoOportuya->TIPO))
                        {{ $data->turnoOportuya->TIPO }}
                        @else NA @endif @endif
                    </td>
                    <td class="text-center">
                        @if ($data->turnoTradicional && !empty($data->turnoTradicional->SUB_TIPO))
                        {{ $data->turnoTradicional->SUB_TIPO }}
                        @else @if ($data->turnoOportuya && !empty($data->turnoOportuya->SUB_TIPO))
                        {{ $data->turnoOportuya->SUB_TIPO }}
                        @else NA @endif @endif
                    </td>
                    <td class="text-center">
                        @if ($data->turnoTradicional && !empty($data->turnoTradicional->USUARIO))
                        {{ $data->turnoTradicional->USUARIO }} @else
                        @if ($data->turnoOportuya && !empty($data->turnoOportuya->USUARIO))
                        {{ $data->turnoOportuya->USUARIO }}
                        @else NA @endif @endif
                    </td>
                    <td class="text-center">
                        @if ($data->turnoTradicional && !empty($data->turnoTradicional->FECHA))
                        {{ $data->turnoTradicional->FECHA }}
                        @else
                        @if ($data->turnoOportuya && !empty($data->turnoOportuya->FECHA))
                        {{ $data->turnoOportuya->FECHA }}
                        @else NA @endif @endif
                    </td>
                    <td class="text-center">
                        @if ($data->turnoTradicional && !empty($data->turnoTradicional->FEC_ASIG))
                        {{ $data->turnoTradicional->FEC_ASIG }}
                        @else
                        @if ($data->turnoOportuya && !empty($data->turnoOportuya->FEC_ASIG))
                        {{ $data->turnoOportuya->FEC_ASIG }}
                        @else NA @endif @endif
                    </td>

                    <td class="text-center">
                        @if ($data->turnoTradicional && !empty($data->turnoTradicional->TIPO_CLI))
                        {{ $data->turnoTradicional->TIPO_CLI }}
                        @else
                        @if ($data->turnoOportuya && !empty($data->turnoOportuya->TIPO_CLI))
                        {{ $data->turnoOportuya->TIPO_CLI }}
                        @else NA @endif @endif
                    </td>
                    <td class="text-center"> ${{ number_format  ($data->GRAN_TOTAL) }} </td>
                    <td class="text-center">
                        @if ($data->turnoTradicional && !empty($data->turnoTradicional->PRIORIDAD))
                        {{ $data->turnoTradicional->PRIORIDAD }} @else
                        @if ($data->turnoOportuya && !empty($data->turnoOportuya->PRIORIDAD))
                        {{ $data->turnoOportuya->PRIORIDAD }}
                        @else NA @endif @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->