<div class="container-fluid mt-5 card card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-tags" aria-hidden="true"></i> Obligaciones Sector Financiero
    </h2>
  </div>
  @if($customer->UpToDateCifinReals->isNotEmpty())
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
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
      <tbody class="body-table">
        @foreach ($cifin_uptodate_reals as $cifin_uptodate_real )
        <tr>
          <td class="text-center">{{ $cifin_uptodate_real->fdnoment }}</td>
          <td class="text-center">{{ $cifin_uptodate_real->fdestob }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_real->fdvrinic*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_real->fdsaldob*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_real->fdvrmora*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_real->fdvrcuot*1000)) }}</td>
          <td class="text-center">{{ $cifin_uptodate_real->fdcompor }}</td>
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
