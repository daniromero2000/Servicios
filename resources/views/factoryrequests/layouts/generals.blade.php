<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title"><i class="fas fa-user mr-2"></i> <strong>Solicitud</strong> {{ $factoryRequest->SOLICITUD }}
      <strong>Sucursal</strong> {{ $factoryRequest->SUCURSAL }} <strong>Asesor</strong> {{ $factoryRequest->CODASESOR }}</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus text-dark"></i>
      </button>
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="table-responsive pt-1">
      <table class="table table-hover table-stripped leadTable">
        <thead class="header-table">
          <tr>
            <th class="text-center" scope="col">Fecha de Solicitud</th>
            <th class="text-center" scope="col">Cliente</th>
            <th class="text-center" scope="col">Codeudores</th>
            <th class="text-center" scope="col">Gran Total</th>
            <th class="text-center" scope="col">Intención</th>
            <th class="text-center" scope="col">Estado</th>
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
            <td class="text-center">${{  number_format($factoryRequest->GRAN_TOTAL) }}</td>
            <td class="text-center"><a data-toggle="tooltip" title="Ver Cliente"
                  href="{{ route('customers.show', $factoryRequest->CLIENTE) }}">
                  {{ str_replace(' ', '', $factoryRequest->SOLICITUD_WEB) }} </a>
              </td>
            <td class="text-center"><span class="badge badge-primary">
                {{ $factoryRequest->factoryRequestStatus->name }}</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card-body -->
</div>
{{-- <div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-12 col-sm-8">
        <h4 class="title-table">
        </h4>
      </div>
      <div class="col-12 col-sm-4 text-right">
</div>
</div>
</div>

</div> --}}