<div class="card-header">
  <h2><i class="fas fa-tags" aria-hidden="true"></i> Obligaciones Extintas Sector Real
  </h2>
</div>
@if($customer->extintsCifinFins->isNotEmpty())
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
      @foreach ($cifin_fin_extints as $cifin_fin_extint )
      <tr>
        <td class="text-center">{{ $cifin_fin_extint->extnoment }}</td>
        <td class="text-center">{{ $cifin_fin_extint->extestob }}</td>
        <td class="text-center">{{ number_format (($cifin_fin_extint->extvrinic*1000)) }}</td>
        <td class="text-center">{{ number_format (($cifin_fin_extint->extsaldob*1000)) }}</td>
        <td class="text-center">{{ number_format (($cifin_fin_extint->extvrmora*1000)) }}</td>
        <td class="text-center">{{ number_format (($cifin_fin_extint->extvrcuot*1000)) }}</td>
        <td class="text-center">{{ $cifin_fin_extint->extcompor }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>@else
<span>No tiene Obligaciones en el sector Financiero</span><br>
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