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
                                    <td class="text-center">{{ $confronta->aciertos }}</td>
                                    <td class="text-center">{{ $confronta->respuesta }}</td>
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
                                    <td class="text-center">{{ $footprint->fechaconsulta }}</td>
                                    <td class="text-center">{{ $footprint->entidad }}</td>
                                    <td class="text-center">{{ $footprint->resultado }}</td>
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