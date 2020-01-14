@if($warranties)
<div class="container-fluid card card-table-reset pb-5">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-cart-arrow-down mr-2"></i></i> Garantiías
    </h2>
  </div>
  <div class="card-body table-responsive header-table-responsive pt-0">
    <table class="table table-head-fixed table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Fecha Solicitud</th>
          <th class="text-center" scope="col">Sucursal</th>
          <th class="text-center" scope="col">Factura</th>
          <th class="text-center" scope="col">Artículo</th>
          <th class="text-center" scope="col">Marca</th>
          <th class="text-center" scope="col">Diagnostico</th>
          <th class="text-center" scope="col">Observaciones</th>
          <th class="text-center" scope="col">Taller</th>
          <th class="text-center" scope="col">Solución</th>
          <th class="text-center" scope="col">Fecha entrega</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @foreach ($warranties as $warranty )
        <tr>
          <td class="text-center">{{ date('M d, Y h:i a', strtotime($warranty->FEC_LLEGA)) }}</td>
          <td class="text-center">{{ $warranty->COD_SUC }}</td>
          <td class="text-center">{{ $warranty->FACTURA }}</td>
          <td class="text-center">{{ $warranty->FECHAFAC }}</td>
          <td class="text-center">{{ $warranty->VALOR }}</td>
          <td class="text-center">{{ $warranty->COD_ARTIC }} / {{ $warranty->NOM_ARTIC }}</td>
          <td class="text-center">{{ $warranty->MARCA }}</td>
          <td class="text-center">{{ $warranty->DIAGNOSTIC }}</td>
          <td class="text-center">{{ $warranty->OBSERVAC }}</td>
          <td class="text-center">{{ $warranty->NOM_TALLER }}</td>
          <td class="text-center">{{ $warranty->SOLUCION }}</td>
          <td class="text-center">{{ date('M d, Y h:i a', strtotime($warranty->FEC_ENTREG)) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@else
  <table class="table table-hover table-stripped leadTable">
    <tbody class="body-table">
      <tr>
        <td>
          No tiene Obligaciones en el sector Financiero
        </td>
      </tr>
    </tbody>
  </table>
  @endif
