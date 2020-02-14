<div class="container-fluid mt-5 card card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-hand-holding-usd mr-3"></i> Obligaciones Al Día Sector Real
    </h2>
  </div>
  @if($cifin_uptodate_reals->isNotEmpty())
  <div class="card-body table-responsive pt-0">
    <table class="table table-head-fixed table-hover  table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Código</th>
          <th class="text-center" scope="col">Calidad</th>
          <th class="text-center" scope="col">Entidad</th>
          <th class="text-center" scope="col">Estado</th>
          <th class="text-center" scope="col">Saldo Inicial</th>
          <th class="text-center" scope="col">Saldo Actual</th>
          <th class="text-center" scope="col">Mora</th>
          <th class="text-center" scope="col">Cuota</th>
          <th class="text-center" scope="col">Vector</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @foreach ($cifin_uptodate_reals as $cifin_uptodate_real )
        <tr>
          <td class="text-center">{{ $cifin_uptodate_real->rdnumob }}</td>
          <td class="text-center">{{ $cifin_uptodate_real->rdcalid }}</td>
          <td class="text-center">{{ $cifin_uptodate_real->rdnoment }}</td>
          <td class="text-center">{{ $cifin_uptodate_real->rdestob }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_real->rdvrinic*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_real->rdsaldob*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_real->rdvrmora*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_real->rdvrcuot*1000)) }}</td>
          <td class="text-center">{{ $cifin_uptodate_real->rdcompor }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>@else
  <table class="table table-hover table-stripped leadTable">
    <tbody class="body-table">
      <tr>
        <td>
          No tiene Obligaciones en el sector Financiero
        </td>
      </tr>
    </tbody>
  </table>
  @endif
</div>