<div class="card-header">
  <h2><i class="fas fa-tags" aria-hidden="true"></i> {{ $customer->NOMBRES }}
    {{ $customer->APELLIDOS }} {{ $customer->ESTADO }}
  </h2>
</div>
<div class="card-body table-responsive pt-1">
  <table class="table table-hover table-stripped leadTable">
    <thead>
      <tr>
        <th class="text-center" scope="col">Tipo Cliente / Subtipo</th>
        <th class="text-center" scope="col">Edad</th>
        <th class="text-center" scope="col">Sexo</th>
        <th class="text-center" scope="col">Fecha de Nacimiento</th>
        <th class="text-center" scope="col">Estado Civil</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-center">{{ $customer->TIPOCLIENTE }}/{{ $customer->SUBTIPO }}</td>
        <td class="text-center">{{ $customer->EDAD }} Años</td>
        <td class="text-center">{{ $customer->SEXO }}</td>
        <td class="text-center">{{ $customer->FEC_NAC }}</td>
        <td class="text-center">{{ $customer->ESTADOCIVIL }}</td>
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