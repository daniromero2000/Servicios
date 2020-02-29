<div class="container-fluid card card-table-reset">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h2 class="title-table"><i class="fas fa-user mr-2"></i> Resultado: Simulador Libranza
                    </span>
                </h2>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive pt-1">
        @if($liquidators->isNotEmpty())
        <table class="table table-hover table-stripped leadTable">
            <thead class="header-table">
                <tr>
                    <th class="text-center" scope="col">Pagaduría</th>
                    <th class="text-center" scope="col">Tipo de Cliente</th>
                    <th class="text-center" scope="col">Línea de Crédito</th>
                    <th class="text-center" scope="col">Edad</th>
                    <th class="text-center" scope="col">Salario</th>
                    <th class="text-center" scope="col">Monto seleccionado</th>
                    <th class="text-center" scope="col">Plazo seleccionado</th>
                    <th class="text-center" scope="col">Ocupación</th>
                </tr>
            </thead>
            <tbody class="body-table">

                @foreach ($liquidators as $liquidator)
                <tr>
                    <td class="text-center">{{ $liquidator->pagaduriaName }}</td>
                    <td class="text-center">{{ $liquidator->customerType }}</td>
                    <td class="text-center">{{ $liquidator->creditLineName }}</td>
                    <td class="text-center">{{ $liquidator->age }}</td>
                    <td class="text-center">${{ number_format($liquidator->salary) }}</td>
                    <td class="text-center">${{ number_format($liquidator->amount) }}</td>
                    <td class="text-center">{{ $liquidator->timeLimit }}</td>
                    <td class="text-center">{{ $liquidator->occupation }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <table class="table table-hover table-stripped leadTable">
            <tbody class="body-table">
                <tr>
                    <td>
                        Aún no tiene simulaciónes
                    </td>
                </tr>
            </tbody>

        </table>

        @endif
    </div>
</div>


@include('digitalchannelleads.layouts.add_lead_price_modal')