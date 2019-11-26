<div class="card-header">
  <h2><i class="fas fa-credit-card" aria-hidden="true"></i> Solicitud {{ $customer->SOLICITUD }} Sucursal
    {{ $customer->SUCURSAL }} {{ $customer->ESTADO }}
  </h2>
</div>
<div class="card-body table-responsive pt-1">
  <table class="table table-hover table-stripped leadTable">
    <thead>
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
    <tbody>
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