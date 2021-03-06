@if($factory_requests)
<div class="container-fluid card card-table-reset pb-5">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-cart-arrow-down mr-2"></i></i> Solicitudes Fábrica
    </h2>
  </div>
  <div class="card-body table-responsive header-table-responsive pt-0">
    <table class="table table-head-fixed table-hover table-stripped leadTable">
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
          <td class="text-center"><a data-toggle="tooltip" title="Ver Solicitud"
              href="{{ route('factoryrequests.show', $factory_request->SOLICITUD) }}">{{ $factory_request->SOLICITUD }}</a>
          </td>
          <td class="text-center">{{ $factory_request->SUCURSAL }}</td>
          <td class="text-center">{{ $factory_request->FactoryRequestStatus->name }}</td>
          <td class="text-center">$ {{ number_format ($factory_request->GRAN_TOTAL) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @include('customers.layouts.creditcard')
</div>
@endif