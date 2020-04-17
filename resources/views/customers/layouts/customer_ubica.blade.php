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
                        <h2 class="title-table"><i class="fas fa-bookmark mr-3"></i>Resultado Principal
                        </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped leadTable">
                            <thead class="header-table">
                                <tr>
                                    <th class="text-center" scope="col">Cédula</th>
                                    <th class="text-center" scope="col">Nombre y Apellido</th>
                                    <th class="text-center" scope="col">Sexo</th>
                                    <th class="text-center" scope="col">Fecha de Consulta</th>
                                </tr>
                            </thead>
                            <tbody class="body-table">
                                @foreach ($ubicaCustomers as $ubica )
                                <tr>
                                    @if ($ubica->ubicPrincipal)
                                    <td class="text-center"> @if ($ubica->ubicPrincipal->ubicedula)
                                        {{ $ubica->ubicPrincipal->ubicedula }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubica->ubicPrincipal->ubinombre)
                                        {{ $ubica->ubicPrincipal->ubinombre }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubica->ubicPrincipal->genero)
                                        {{ $ubica->ubicPrincipal->genero }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubica->ubicPrincipal->ubifeccons)
                                        {{ $ubica->ubicPrincipal->ubifeccons }}
                                        @else NA
                                        @endif</td>
                                    @else
                                    <td>
                                        No tiene Consultas
                                    </td>
                                    @endif
                                </tr>

                                @endforeach
                            </tbody class="body-table">
                        </table>
                    </div>
                </div>
            </div>

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
                                    <th class="text-center" scope="col">Celular</th>
                                    <th class="text-center" scope="col">Activo</th>
                                    <th class="text-center" scope="col">Primer Reporte</th>
                                    <th class="text-center" scope="col">Último Reporte</th>
                                </tr>
                            </thead>

                            <tbody class="body-table">
                                @foreach ($ubicaCustomers as $ubica )
                                <tr>
                                    @if ($ubica->ubicaLastCellPhone)
                                    <td class="text-center"> @if ($ubica->ubicaLastCellPhone->ubicelular)
                                        {{ $ubica->ubicaLastCellPhone->ubicelular }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubica->ubicaLastCellPhone->ubiprodactivo)
                                        {{ $ubica->ubicaLastCellPhone->ubiprodactivo }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubica->ubicaLastCellPhone->ubiprimerrep)
                                        {{ $ubica->ubicaLastCellPhone->ubiprimerrep }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubica->ubicaLastCellPhone->ubiultimorep)
                                        {{ $ubica->ubicaLastCellPhone->ubiultimorep }}
                                        @else NA
                                        @endif</td>
                                    @else
                                    <td>
                                        No tiene Consultas
                                    </td>
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
                                    <th class="text-center" scope="col">Teléfono</th>
                                    <th class="text-center" scope="col">Ciudad</th>
                                    <th class="text-center" scope="col">Activo</th>
                                    <th class="text-center" scope="col">Primer Reporte</th>
                                    <th class="text-center" scope="col">Último Reporte</th>
                                </tr>
                            </thead>
                            <tbody class="body-table">
                                @foreach ($ubicaCustomers as $ubica )
                                <tr>
                                    @if ($ubica->ubicaLastPhone)
                                    <td class="text-center"> @if ($ubica->ubicaLastPhone->ubitelefono)
                                        {{ $ubica->ubicaLastPhone->ubitelefono }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubica->ubicaLastPhone->ubiciudad)
                                        {{ $ubica->ubicaLastPhone->ubiciudad }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubica->ubicaLastPhone->ubiprodactivo)
                                        {{ $ubica->ubicaLastPhone->ubiprodactivo }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubica->ubicaLastPhone->ubiprimerrep)
                                        {{ $ubica->ubicaLastPhone->ubiprimerrep }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubica->ubicaLastPhone->ubiultimorep)
                                        {{ $ubica->ubicaLastPhone->ubiultimorep }}
                                        @else NA
                                        @endif</td>
                                    @else
                                    <td>
                                        No tiene Consultas
                                    </td>
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
                                    <th class="text-center" scope="col">Dirección</th>
                                    <th class="text-center" scope="col">Ciudad</th>
                                    <th class="text-center" scope="col">Activo</th>
                                    <th class="text-center" scope="col">Primer Reporte</th>
                                    <th class="text-center" scope="col">Último Reporte</th>
                                </tr>
                            </thead>
                            <tbody class="body-table">
                                @foreach ($ubicaCustomers as $ubica )
                                @foreach ($ubica->ubicAddress as $ubicaAddress )
                                <tr>
                                    @if ($ubica)
                                    <td class="text-center"> @if ($ubicaAddress->cedula)
                                        {{ $ubicaAddress->cedula }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubicaAddress->ubidireccion )
                                        {{ $ubicaAddress->ubidireccion  }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubicaAddress->ubiciudad )
                                        {{ $ubicaAddress->ubiciudad  }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubicaAddress->ubiprodactivo )
                                        {{ $ubicaAddress->ubiprodactivo  }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubicaAddress->ubiprimerrep )
                                        {{ $ubicaAddress->ubiprimerrep  }}
                                        @else NA
                                        @endif</td>
                                    <td class="text-center"> @if ($ubicaAddress->ubiultimorep )
                                        {{ $ubicaAddress->ubiultimorep  }}
                                        @else NA
                                        @endif</td>
                                    @else
                                    <td>
                                        No tiene Consultas
                                    </td>
                                    @endif

                                </tr>
                                @endforeach
                                @endforeach
                            </tbody class="body-table">
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h2 class="title-table"><i class="fas fa-home mr-3"></i>Resultado Email
                        </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped leadTable">
                            <thead class="header-table">
                                <tr>
                                    <th class="text-center" scope="col">Email</th>
                                    <th class="text-center" scope="col">Primer Reporte</th>
                                    <th class="text-center" scope="col">Último Reporte</th>
                                </tr>
                            </thead>
                            <tbody class="body-table">
                                @foreach ($ubicaCustomers as $ubica )
                                <tr>
                                    @if ($ubica->ubicEmails)
                                    <td class="text-center">{{ $ubica->ubicEmails->ubicorreo }}</td>
                                    <td class="text-center">{{ $ubica->ubicEmails->ubiprimerrep }}</td>
                                    <td class="text-center">{{ $ubica->ubicEmails->ubiultimorep }}</td>
                                    @else
                                    <td>
                                        No tiene Consultas
                                    </td>
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