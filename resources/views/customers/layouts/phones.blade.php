<div class="card-header">
  <h2><i class="fas fa-tags" aria-hidden="true"></i> Telefonos
  </h2>
</div>
<div class="card-body table-responsive pt-1">
  <table class="table table-hover table-stripped leadTable">
    <thead>
      <tr>
        <th class="text-center" scope="col">Móvil</th>
        <th class="text-center" scope="col">Teléfono Fijo</th>
        <th class="text-center" scope="col">Teléfono Empresa</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-center">{{ $customer->CELULAR }}</td>
        <td class="text-center">{{ $customer->TELFIJO }}</td>
        <td class="text-center">{{ $customer->TEL_EMP }}</td>
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