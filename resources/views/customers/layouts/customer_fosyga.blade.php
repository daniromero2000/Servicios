<div class="container-fluid card card-table-reset">

  @if($fosygas->isNotEmpty())
  <div class="card-header">
    <div class="row">

      <div class="col-11">
        <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i>Resultado Fosyga
        </h2>
      </div>
      <div class="col-1 text-center" data-toggle="tooltip" data-placement="top" title="Consultar">
        @if ($fosygas[0]->fuenteFallo == 'SI')
        <i class="fas fa-search-plus" style="
        font-size: 22px;
        margin: auto;
        color: #007bff;
    "></i>
        @endif
      </div>
    </div>

  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Entidad</th>
          <th class="text-center" scope="col">Regimen</th>
          <th class="text-center" scope="col">Estado</th>
          <th class="text-center" scope="col">Tipo de Afiliado</th>
          <th class="text-center" scope="col">Fecha de Afiliación</th>
          <th class="text-center" scope="col">Departamento</th>
          <th class="text-center" scope="col">Ciudad</th>
          <th class="text-center" scope="col">Fecha de Consulta</th>
          <th class="text-center" scope="col">Falló??</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @foreach ($fosygas as $fosyga )
        <tr>
          <td class="text-center"> @if ($fosyga->entidad) {{ $fosyga->entidad }} @else NA @endif</td>
          <td class="text-center"> @if ($fosyga->regimen) {{ $fosyga->regimen }} @else NA @endif</td>
          <td class="text-center"> @if ($fosyga->estado) {{ $fosyga->estado }} @else NA @endif</td>
          <td class="text-center"> @if ($fosyga->tipoAfiliado) {{ $fosyga->tipoAfiliado }} @else NA @endif</td>
          <td class="text-center"> @if ($fosyga->fechaAfiliacion) {{ $fosyga->fechaAfiliacion }} @else NA @endif</td>
          <td class="text-center"> @if ($fosyga->departamento) {{ $fosyga->departamento }} @else NA @endif</td>
          <td class="text-center"> @if ($fosyga->ciudad) {{ $fosyga->ciudad }} @else NA @endif</td>
          <td class="text-center"> @if ($fosyga->created_at) {{ $fosyga->created_at }} @else NA @endif</td>
          <td class="text-center"> @if ($fosyga->fuenteFallo) <span
              class="badge @if($fosyga->fuenteFallo == 'NO') badge-success @else badge-danger  @endif">{{ $fosyga->fuenteFallo }}</span>
            @else
            NA
            @endif</td>
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