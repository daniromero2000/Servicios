<<<<<<< HEAD
<div class="card-header">
  <h2><i class="fas fa-tags" aria-hidden="true"></i> Obligaciones Sector Financiero
  </h2>
</div>
@if($customer->UpToDateCifinReals->isNotEmpty())
<div class="card-body table-responsive pt-1">
=======
<div class="container-fluid mt-5 card card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-tags" aria-hidden="true"></i> Obligaciones Sector Financiero
    </h2>
  </div>
  @if($customer->UpToDateCifinFins->isNotEmpty())
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
        @foreach ($cifin_uptodate_fins as $cifin_uptodate_fin )
        <tr>
          <td class="text-center">{{ $cifin_uptodate_fin->fdnoment }}</td>
          <td class="text-center">{{ $cifin_uptodate_fin->fdestob }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_fin->fdvrinic*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_fin->fdsaldob*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_fin->fdvrmora*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_uptodate_fin->fdvrcuot*1000)) }}</td>
          <td class="text-center">{{ $cifin_uptodate_fin->fdcompor }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>@else
>>>>>>> 2cbb10ad7f835502816b9c5fad1d27e4602a8274
  <table class="table table-hover table-stripped leadTable">
    <tbody class="body-table">
      <tr>
        <td>
          No tiene Obligaciones en el sector Financiero
        </td>
      </tr>
<<<<<<< HEAD
    </thead>
    <tbody>
      @foreach ($cifin_uptodate_reals as $cifin_uptodate_real )
      <tr>
        <td class="text-center">{{ $cifin_uptodate_real->rdnoment }}</td>
        <td class="text-center">{{ $cifin_uptodate_real->rdestob }}</td>
        <td class="text-center">{{ number_format (($cifin_uptodate_real->rdvrinic*1000)) }}</td>
        <td class="text-center">{{ number_format (($cifin_uptodate_real->rdsaldob*1000)) }}</td>
        <td class="text-center">{{ number_format (($cifin_uptodate_real->rdvrmora*1000)) }}</td>
        <td class="text-center">{{ number_format (($cifin_uptodate_real->rdvrcuot*1000)) }}</td>
        <td class="text-center">{{ $cifin_uptodate_real->rdcompor }}</td>
      </tr>
      @endforeach
=======
>>>>>>> 2cbb10ad7f835502816b9c5fad1d27e4602a8274
    </tbody>
  </table>
  @endif
</div>
