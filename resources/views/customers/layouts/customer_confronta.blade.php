<div class="container-fluid card card-table-reset">
    <div class="card-header">
        <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i>Resultado Confronta
        </h2>
    </div>
    @if($confrontaCustomers->isNotEmpty())
    <div class="card-body table-responsive pt-1">
        <div class="row">
            <div class="col-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h2 class="title-table"><i class="fas fa-home mr-3"></i>Resultado Principal
                        </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped leadTable">
                            <thead class="header-table">
                                <tr>
                                    <th class="text-center" scope="col">Aciertos</th>
                                    <th class="text-center" scope="col">Respuesta</th>
                                </tr>
                            </thead>
                            <tbody class="body-table">
                                @foreach ($confrontaCustomers as $confronta )
                                <tr>
                                    <td class="text-center"> @if ($confronta->aciertos) {{ $confronta->aciertos }} @else
                                        NA
                                        @endif</td>
                                    <td class="text-center"> @if ($confronta->respuesta) {{ $confronta->respuesta }}
                                        @else
                                        NA
                                        @endif</td>
                                </tr>
                                @endforeach
                            </tbody class="body-table">
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h2 class="title-table"><i class="fas fa-history mr-3"></i>Historial de Consultas
                        </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped leadTable">
                            <thead class="header-table">
                                <tr>
                                    <th class="text-center" scope="col">Fecha de Consulta</th>
                                    <th class="text-center" scope="col">Entidad</th>
                                    <th class="text-center" scope="col">Resultado</th>
                                </tr>
                            </thead>
                            <tbody class="body-table">
                                @foreach ($confrontaFootprint as $footprint )
                                <tr>
                                    <td class="text-center"> @if ($footprint->fechaconsulta)
                                        {{ $footprint->fechaconsulta }}
                                        @else
                                        NA
                                        @endif</td>
                                    <td class="text-center"> @if ($footprint->entidad)
                                        {{ $footprint->entidad }}
                                        @else
                                        NA
                                        @endif</td>
                                    <td class="text-center"> @if ($footprint->resultado)
                                        {{ $footprint->resultado }}
                                        @else
                                        NA
                                        @endif</td>
                                </tr>
                                @endforeach
                            </tbody class="body-table">
                        </table>
                    </div>
                </div>
            </div>
        </div>
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