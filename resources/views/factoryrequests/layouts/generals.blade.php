<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-8">
        <h2 class="title-table"><i class="fas fa-user mr-2"></i> Solicitud {{ $customer->SOLICITUD }}
          Sucursal {{ $customer->SUCURSAL }} </span>
        </h2>
      </div>
      <div class="col-4 text-right"><span class="badge title-table-status badge-primary">
          {{ $customer->ESTADO }}
      </div>
    </div>
  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Fecha de Solicitud</th>
          <th class="text-center" scope="col">Codeudores</th>
          <th class="text-center" scope="col">Asesor</th>
          <th class="text-center" scope="col">Gran Total</th>
          <th class="text-center" scope="col">Credito</th>
          <th class="text-center" scope="col">Avance</th>
          <th class="text-center" scope="col">Lead</th>
        </tr>
      </thead>
      <tbody class="body-table">
        <tr>
          <td class="text-center">{{ $customer->FECHASOL }}</td>
          <td class="text-center">{{ $customer->CODEUDOR1 }}/{{ $customer->CODEUDOR2 }}/{{ $customer->CODEUDOR3 }}</td>
          <td class="text-center">{{ $customer->CODASESOR }}</td>
          <td class="text-center">{{ $customer->GRAN_TOTAL }}</td>
          <td class="text-center">{{ $customer->PRODUC_W }}</td>
          <td class="text-center">{{ $customer->AVANCE_W }}</td>
        </tr>
      </tbody>
    </table>
  </div>





  @section('scriptsJs')
  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- jsGrid -->
  <script src="{{ asset('plugins/jsgrid/demos/db.js') }}"></script>
  <script src="{{ asset('plugins/jsgrid/jsgrid.min.js') }}"></script>
  @endsection