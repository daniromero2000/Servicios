<div class="container-fluid card card-table-reset">
    <div class="card-header">
        <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i>Resultado Confronta
        </h2>
    </div>
    @if($customer->customerRegistraduria->isNotEmpty())
    <div class="card-body table-responsive pt-1">
        <table class="table table-hover table-stripped leadTable">
            <thead class="header-table">
                <tr>
                    <th class="text-center" scope="col">Fecha de Consulta</th>
                    <th class="text-center" scope="col">Secuencia</th>
                    <th class="text-center" scope="col">Respuesta</th>
                    <th class="text-center" scope="col">Estado</th>
                </tr>
            </thead>
            <tbody class="body-table">
                @foreach ($confrontaCustomers as $confronta )
                <tr>
                    <td class="text-center">{{ $confronta->fecha }}</td>
                    <td class="text-center">{{ $confronta->secuencia }}</td>
                    <td class="text-center">{{ $confronta->respuesta }}</td>
                    <td class="text-center">{{ $confronta->estadoid }}</td>
                </tr>
                @endforeach
            </tbody class="body-table">
        </table>
    </div>@else
    <table class="table table-hover table-stripped leadTable">
        <tbody class="body-table">
            <tr>
                <td>
                    No tiene Moras en el sector Real
                </td>
            </tr>
        </tbody>
    </table>
    @endif
</div>