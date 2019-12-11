
<div class="card-header">
  <h2><i class="fas fa-tags" aria-hidden="true"></i> Moras Sector Financiero
  </h2>
</div>
@if($customer->cifinFins->isNotEmpty())
<div class="card-body table-responsive pt-1">
  <table class="table table-hover table-stripped leadTable">
    <thead>
      <tr>
        <th class="text-center" scope="col">Entidad</th>
        <th class="text-center" scope="col">Estado</th>
        <th class="text-center" scope="col">Saldo Inicial</th>
        <th class="text-center" scope="col">Saldo Actual</th>
        <th class="text-center" scope="col">Mora</th>
        <th class="text-center" scope="col">Cuota</th>
        <th class="text-center" scope="col">Vector</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cifin_fins as $cifin_fin )
      <tr>
        <td class="text-center">{{ $cifin_fin->rmnoment }}</td>
        <td class="text-center">{{ $cifin_fin->rmestob }}</td>
        <td class="text-center">{{ number_format (($cifin_fin->rmvrinic*1000)) }}</td>
        <td class="text-center">{{ number_format (($cifin_fin->rmsaldob*1000)) }}</td>
        <td class="text-center">{{ number_format (($cifin_fin->rmvrmora*1000)) }}</td>
        <td class="text-center">{{ number_format (($cifin_fin->rmvrcuot*1000)) }}</td>
        <td class="text-center">{{ $cifin_fin->rmcompor }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>@else
<span>No tiene Moras en el sector Financiero</span><br>
@endif
@section('scriptsJs')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jsGrid -->
<script src="{{ asset('plugins/jsgrid/demos/db.js') }}"></script>
<script src="{{ asset('plugins/jsgrid/jsgrid.min.js') }}"></script>
@endsection