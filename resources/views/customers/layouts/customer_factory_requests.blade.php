@if($factory_requests)
<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-tags" aria-hidden="true"></i> Solicitudes Fábrica
    </h2>
  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Fecha Solicitud</th>
          <th class="text-center" scope="col">Solicitud</th>
          <th class="text-center" scope="col">Sucursal</th>
          <th class="text-center" scope="col">Estado</th>
          <th class="text-center" scope="col">Total</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @foreach ($factory_requests as $factory_request )
        <tr>
          <td class="text-center">{{ date('M d, Y h:i a', strtotime($factory_request->FECHASOL)) }}</td>
          <td class="text-center"><a
              href="{{ route('factoryrequests.show', $factory_request->SOLICITUD) }}">{{ $factory_request->SOLICITUD }}</a>
          </td>
          <td class="text-center">{{ $factory_request->SUCURSAL }}</td>
          <td class="text-center">{{ $factory_request->ESTADO }}</td>
          <td class="text-center">{{ $factory_request->GRAN_TOTAL }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif