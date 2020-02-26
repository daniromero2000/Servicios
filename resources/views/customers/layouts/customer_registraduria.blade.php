<div class="container-fluid card card-table-reset">
    @if($registradurias->isNotEmpty())
    <div class="card-header">
        <div class="row">
            <div class="col-11">
                <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i>Resultado Registraduría
                </h2>
            </div>
            <div class="col-1 text-center" data-toggle="tooltip" data-placement="top" title="Consultar">
                @if ($registradurias[0]->fuenteFallo == 'SI')
                <a href="{{route('customer_registraduriaConsult', $customer->CEDULA) }}"> <i class="fas fa-search-plus"
                        data-toggle="modal" data-target="#proccessConsult" style="
                    font-size: 22px;
                    margin: auto;
                    color: #007bff;
                "></i></a>
                @endif
            </div>
        </div>

    </div>
    <div class="card-body table-responsive pt-1">
        <table class="table table-hover table-stripped leadTable">
            <thead class="header-table">
                <tr>

                    <th class="text-center" scope="col">Nombre</th>
                    <th class="text-center" scope="col">Tipo de Documento</th>
                    <th class="text-center" scope="col">Pais</th>
                    <th class="text-center" scope="col">Fecha de Expedición</th>
                    <th class="text-center" scope="col">Lugar de Expedición</th>
                    <th class="text-center" scope="col">Estado</th>
                    <th class="text-center" scope="col">Fecha de Consulta</th>
                    <th class="text-center" scope="col">Falló?</th>
                </tr>
            </thead>
            <tbody class="body-table">
                @foreach ($registradurias as $registraduria )
                <tr>
                    <td class="text-center">
                        {{$registraduria->primerNombre}}
                    </td>
                    <td class="text-center"> @if ($registraduria->tipoDocumento)
                        @if ($registraduria->tipoDocumento == 01) Cédula @endif @else NA @endif
                    </td>
                    <td class="text-center"> @if ($registraduria->pais) {{ $registraduria->pais }} @else NA @endif</td>
                    <td class="text-center"> @if ($registraduria->fechaExpedicion) {{ $registraduria->fechaExpedicion }}
                        @else NA @endif</td>
                    <td class="text-center"> @if ($registraduria->lugarExpedicion) {{ $registraduria->lugarExpedicion }}
                        @else NA @endif</td>
                    <td class="text-center"> @if ($registraduria->estado) {{ $registraduria->estado }} @else NA @endif
                    </td>
                    <td class="text-center"> @if ($registraduria->fechaConsulta) {{ $registraduria->fechaConsulta }}
                        @else NA @endif</td>
                    <td class="text-center"> @if ($registraduria->fuenteFallo) <span
                            class="badge @if($registraduria->fuenteFallo == 'NO') badge-success @else badge-danger  @endif">{{ $registraduria->fuenteFallo }}</span>
                        @else
                        NA
                        @endif</td>
                </tr>
                @endforeach
            </tbody class="body-table">
        </table>
    </div>@else
    <table class="table table-hover table-stripped leadTable">
        <tbody class="body-table">
            <tr>
                <td>
                    No tiene Consultas
                </td>
            </tr>
        </tbody>
    </table>
    @endif
</div>