<div class="container-fluid card mt-2 card-table-reset pb-5">
    <div class="card-header">
        <h2 class="title-table"><i class="fas fa-hand-holding-usd mr-3"></i> Historial de Consultas</h2>
    </div>
    @if($cifin_footprints->isNotEmpty())
    <div class="card-body table-responsive pt-0 header-table-responsive">
        <table class="table table-head-fixed table-hover table-stripped leadTable">
            <thead class="header-table">
                <tr>
                    <th class="text-center" scope="col">Tipo de Entidad</th>
                    <th class="text-center" scope="col">Entidad</th>
                    <th class="text-center" scope="col">Sucursal</th>
                    <th class="text-center" scope="col">Ciudad</th>
                    <th class="text-center" scope="col">Fecha de Consulta</th>
                    <th class="text-center" scope="col">Motivo</th>
                </tr>
            </thead>
            <tbody class="body-table">
                @foreach ($cifin_footprints as $cifin_footprint )
                <tr>
                    <td class="text-center">{{ $cifin_footprint->huetipent }}</td>
                    <td class="text-center">{{ $cifin_footprint->hueentidad }}</td>
                    <td class="text-center">{{ $cifin_footprint->huesuc }}</td>
                    <td class="text-center">{{ $cifin_footprint->hueciud }}</td>
                    <td class="text-center">{{ $cifin_footprint->huefeccon }}</td>
                    <td class="text-center">{{ $cifin_footprint->huemotiv }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>@else
    <table class="table table-hover table-stripped leadTable">
        <tbody class="body-table">
            <tr>
                <td>
                    No tiene Obligaciones en el sector Financiero
                </td>
            </tr>
        </tbody>
    </table>
    @endif
</div>