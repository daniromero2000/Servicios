<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-12 col-sm-8">
        <h4 class="title-table"><i class="fas fa-user mr-2"></i> Solicitud {{ $factoryRequest->SOLICITUD }}
          Sucursal {{ $factoryRequest->SUCURSAL }} </span>
        </h4>
      </div>
      <div class="col-12 col-sm-4 text-right"><span class="badge title-table-status badge-primary">
          {{ $factoryRequest->ESTADO }}
      </div>
    </div>
  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Fecha de Solicitud</th>
          <th class="text-center" scope="col">Cliente</th>
          <th class="text-center" scope="col">Codeudores</th>
          <th class="text-center" scope="col">Asesor</th>
          <th class="text-center" scope="col">Gran Total</th>
          <th class="text-center" scope="col">Crédito</th>
          <th class="text-center" scope="col">Avance</th>
          <th class="text-center" scope="col">Lead</th>
        </tr>
      </thead>
      <tbody class="body-table">
        <tr>
          <td class="text-center">{{ $factoryRequest->FECHASOL }}</td>
          <td class="text-center"><a data-toggle="tooltip" title="Ver Cliente"
              href="{{ route('customers.show', $factoryRequest->CLIENTE) }}">
              {{ str_replace(' ', '', $factoryRequest->CLIENTE) }} </a>
          </td>
          <td class="text-center">
            {{ $factoryRequest->CODEUDOR1 }}/{{ $factoryRequest->CODEUDOR2 }}/{{ $factoryRequest->CODEUDOR3 }}</td>
          <td class="text-center">{{ $factoryRequest->CODASESOR }}</td>
          <td class="text-center">$ {{  number_format($factoryRequest->GRAN_TOTAL) }}</td>
          <td class="text-center">{{ $factoryRequest->PRODUC_W }}</td>
          <td class="text-center">{{ $factoryRequest->AVANCE_W }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>