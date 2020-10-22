<div class="container-fluid card card-table-reset">
    <div class="card-header">
        <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i>Consultas Cifin
        </h2>
    </div>
    @if($cifinWebServices->isNotEmpty())
    <div class="card-body table-responsive pt-1">
        <table class="table table-hover table-stripped leadTable">
            <thead class="header-table">
                <tr>
                    <th class="text-center" scope="col">Consulta</th>
                    <th class="text-center" scope="col">Fecha de Consulta</th>
                    <th class="text-center" scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody class="body-table">
                @foreach ($cifinWebServices as $cifinWebService)

                <tr>
                    <td class="text-center"><a href="" data-toggle="modal"
                            data-target="#customerDataCifin{{$cifinWebService->consec}}">
                            {{$cifinWebService->consec }}</a>
                    </td>
                    <td class="text-center">{{ $cifinWebService->fecha  }}</td>
                    <td class="text-center"><a target="_blank"
                            href="/Administrator/customer/printCifin/{{$cifinWebService->consec}}"
                            class="badge badge-primary">Imprimir</a></td>
                </tr>
                @endforeach
            </tbody class="body-table">
        </table>

        @foreach ($cifinWebServices as $cifinWebService)

        @include('customers.layouts.customer_modal_dataCifin')
        @endforeach
    </div>
    @else
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