<div class="container-fluid card card-table-reset">
    <div class="card-header">
        <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i>Resultado Ubica
        </h2>
    </div>
    @if($ubicaCustomers->isNotEmpty())
    <div class="card-body table-responsive pt-1">
        <div class="row">
            <div class=" col-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h2 class="title-table"><i class="fas fa-mobile mr-3"></i>Resultado Celular
                        </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped leadTable">
                            <thead class="header-table">
                                <tr>
                                    <th class="text-center" scope="col">Cédula</th>
                                    <th class="text-center" scope="col">Celular</th>
                                    <th class="text-center" scope="col">Activo</th>
                                    <th class="text-center" scope="col">Primer Reporte</th>
                                    <th class="text-center" scope="col">Último Reporte</th>
                                </tr>
                            </thead>
                            <tbody class="body-table">
                                @foreach ($ubicaCustomers as $ubica )
                                <tr>
                                    <td class="text-center">{{ $ubica->cedula }}</td>
                                    @if ($ubica->ubicaLastCellPhone)
                                    <td class="text-center">{{ $ubica->ubicaLastCellPhone->ubicelular }}</td>
                                    <td class="text-center">{{ $ubica->ubicaLastCellPhone->ubiprodactivo }}</td>
                                    <td class="text-center">{{ $ubica->ubicaLastCellPhone->ubiprimerrep }}</td>
                                    <td class="text-center">{{ $ubica->ubicaLastCellPhone->ubiultimorep }}</td>
                                    @endif
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
                        <h2 class="title-table"><i class="fas fa-phone-alt mr-3"></i>Resultado Teléfono
                        </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped leadTable">
                            <thead class="header-table">
                                <tr>
                                    <th class="text-center" scope="col">Cédula</th>
                                    <th class="text-center" scope="col">Teléfono</th>
                                    <th class="text-center" scope="col">Activo</th>
                                    <th class="text-center" scope="col">Primer Reporte</th>
                                    <th class="text-center" scope="col">Último Reporte</th>
                                    <th class="text-center" scope="col">Ciudad</th>
                                </tr>
                            </thead>
                            <tbody class="body-table">
                                @foreach ($ubicaCustomers as $ubica )
                                <tr>
                                    @if ($ubica->ubicaLastPhone)
                                    <td class="text-center">{{ $ubica->cedula }}</td>
                                    <td class="text-center">{{ $ubica->ubicaLastPhone->ubitelefono }}</td>
                                    <td class="text-center">{{ $ubica->ubicaLastPhone->ubiprodactivo }}</td>
                                    <td class="text-center">{{ $ubica->ubicaLastPhone->ubiprimerrep }}</td>
                                    <td class="text-center">{{ $ubica->ubicaLastPhone->ubiultimorep }}</td>
                                    <td class="text-center">{{ $ubica->ubicaLastPhone->ubiciudad }}</td>
                                    @endif
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
                        <h2 class="title-table"><i class="fas fa-home mr-3"></i>Resultado Dirección
                        </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped leadTable">
                            <thead class="header-table">
                                <tr>
                                    <th class="text-center" scope="col">Cédula</th>
                                    <th class="text-center" scope="col">Activo</th>
                                    <th class="text-center" scope="col">Primer Reporte</th>
                                    <th class="text-center" scope="col">Último Reporte</th>
                                    <th class="text-center" scope="col">Dirección</th>
                                    <th class="text-center" scope="col">Ciudad</th>
                                </tr>
                            </thead>
                            <tbody class="body-table">
                                @foreach ($ubicaCustomers as $ubica )
                                <tr>
                                    @if ($ubica->ubicAddress)
                                    <td class="text-center">{{ $ubica->cedula }}</td>
                                    <td class="text-center">{{ $ubica->ubicAddress->ubiprodactivo }}</td>
                                    <td class="text-center">{{ $ubica->ubicAddress->ubiprimerrep }}</td>
                                    <td class="text-center">{{ $ubica->ubicAddress->ubiultimorep }}</td>
                                    <td class="text-center">{{ $ubica->ubicAddress->ubidireccion }}</td>
                                    <td class="text-center">{{ $ubica->ubicAddress->ubiciudad }}</td>
                                    @endif
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