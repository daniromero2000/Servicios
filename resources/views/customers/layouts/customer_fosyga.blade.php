<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i>Resultado Fosyga
    </h2>
  </div>
  @if($customer->customerFosygas->isNotEmpty())
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
          <th class="text-center" scope="col">Fuente de fallo?</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @foreach ($fosygas as $fosyga )
        <tr>
          <td class="text-center">{{ $fosyga->entidad }}</td>
          <td class="text-center">{{ $fosyga->regimen }}</td>
          <td class="text-center">{{ $fosyga->estado }}</td>
          <td class="text-center">{{ $fosyga->tipoAfiliado }}</td>
          <td class="text-center">{{ $fosyga->fechaAfiliacion }}</td>
          <td class="text-center">{{ $fosyga->departamento }}</td>
          <td class="text-center">{{ $fosyga->ciudad }}</td>
          <td class="text-center">{{ $fosyga->created_at }}</td>
          <td class="text-center">{{ $fosyga->fuenteFallo }}</td>
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