<div class="container-fluid card card-table-reset">
    <div class="card-header">
        <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i>Resultado Confronta
        </h2>
    </div>
    @if($confrontaCustomers->isNotEmpty())
    <div class="card-body table-responsive pt-1">
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