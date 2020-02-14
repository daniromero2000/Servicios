<div class="container-fluid card card-table-reset">
    <div class="card-header">
        <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i>Resultado Registraduría
        </h2>
    </div>
    @if($registradurias->isNotEmpty())
    <div class="card-body table-responsive pt-1">
        <table class="table table-hover table-stripped leadTable">
            <thead class="header-table">
                <tr>
                    <th class="text-center" scope="col">Tipo de Documento</th>
                    <th class="text-center" scope="col">Pais</th>
                    <th class="text-center" scope="col">Fecha de Expedición</th>
                    <th class="text-center" scope="col">Lugar de Expedición</th>
                    <th class="text-center" scope="col">Estado</th>
                    <th class="text-center" scope="col">Fecha de Consulta</th>
                    <th class="text-center" scope="col">Fuente de fallo?</th>
                </tr>
            </thead>
            <tbody class="body-table">
                @foreach ($registradurias as $registraduria )
                <tr>
                    <td class="text-center">@if ($registraduria->tipoDocumento == 01)
                        Cédula
                        @endif</td>
                    <td class="text-center">{{ $registraduria->pais }}</td>
                    <td class="text-center">{{ $registraduria->fechaExpedicion }}</td>
                    <td class="text-center">{{ $registraduria->lugarExpedicion }}</td>
                    <td class="text-center">{{ $registraduria->estado }}</td>
                    <td class="text-center">{{ $registraduria->fechaConsulta }}</td>
                    <td class="text-center">{{ $registraduria->fuenteFallo }}</td>
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