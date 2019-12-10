<div class="card-header">
  <h2><i class="fas fa-tags" aria-hidden="true"></i> Identificación
  </h2>
</div>
<div class="card-body table-responsive pt-1">
  <table class="table table-hover table-stripped leadTable">
    <thead>
      <tr>
        <th class="text-center" scope="col">Cédula</th>
        <th class="text-center" scope="col">Fecha Expedición</th>
        <th class="text-center" scope="col">Ciudad De Expedición</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-center">{{ $customer->CEDULA }}</td>
        <td class="text-center">{{ $customer->FEC_EXP }}</td>
        <td class="text-center">{{ $customer->CIUD_EXP }}</td>

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