@if($factory_requests)

<div class="card-header">
  <h2><i class="fas fa-tags" aria-hidden="true"></i> Solicitudes Fábrica
  </h2>
</div>
<div class="card-body table-responsive pt-1">
  <table class="table table-hover table-stripped leadTable">
    <thead>
      <tr>
        <th class="text-center" scope="col">Fecha Solicitud</th>
        <th class="text-center" scope="col">Solicitud</th>
        <th class="text-center" scope="col">Sucursal</th>
        <th class="text-center" scope="col">Estado</th>
        <th class="text-center" scope="col">Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($factory_requests as $factory_request )
      <tr>
        <td class="text-center">{{ $factory_request->FECHASOL }}</td>
        <td class="text-center">{{ $factory_request->SOLICITUD }}</td>
        <td class="text-center">{{ $factory_request->SUCURSAL }}</td>
        <td class="text-center">{{ $factory_request->ESTADO }}</td>
        <td class="text-center">{{ $factory_request->GRAN_TOTAL }}</td>
      </tr>
      @endforeach
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
@endif