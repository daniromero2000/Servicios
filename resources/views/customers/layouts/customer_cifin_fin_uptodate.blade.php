<div class="container-fluid card mt-2 card-table-reset pb-5">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-hand-holding-usd mr-3"></i> Obligaciones Al Día Sector Financiero
    </h2>
  </div>
  @if($cifin_uptodate_fins->isNotEmpty())
  <div class="card-body table-responsive pt-0 header-table-responsive">
    <table class="table table-head-fixed table-hover table-stripped leadTable">
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
          <th class="text-center" scope="col">Fecha de Corte</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @foreach ($cifin_uptodate_fins as $cifin_uptodate_fin )
        <tr>
          <td class="text-center">{{ $cifin_uptodate_fin->fdnumob }}</td>
          <td class="text-center">{{ $cifin_uptodate_fin->fdcalid }}</td>
          <td class="text-center">{{ $cifin_uptodate_fin->fdnoment }}</td>
          <td class="text-center">{{ $cifin_uptodate_fin->fdestob }}</td>
          <td class="text-center"> @if (!empty($cifin_uptodate_fin->fdvrinic))
            {{ number_format (($cifin_uptodate_fin->fdvrinic*1000)) }} @endif 0</td>
          <td class="text-center"> @if (!empty($cifin_uptodate_fin->fdsaldob))
            {{ number_format (($cifin_uptodate_fin->fdsaldob*1000)) }} @endif 0</td>
          <td class="text-center"> @if (!empty($cifin_uptodate_fin->fdvrmora))
            {{ number_format (($cifin_uptodate_fin->fdvrmora*1000)) }} @endif 0</td>
          <td class="text-center"> @if (!empty($cifin_uptodate_fin->fdvrcuot))
            {{ number_format (($cifin_uptodate_fin->fdvrcuot*1000)) }} @endif 0</td>
          <td class="text-center">{{ $cifin_uptodate_fin->fdcompor }}</td>
          <td class="text-center">{{ $cifin_uptodate_fin->fdcorte }}</td>
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