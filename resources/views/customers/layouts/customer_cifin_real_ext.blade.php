<div class="container-fluid card mt-2 card-table-reset ">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-external-link-alt mr-2"></i> Obligaciones Extintas Sector Real
    </h2>
  </div>
  @if($cifin_real_extints->isNotEmpty())
  <div class="card-body table-responsive header-table-responsive pt-0">
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
        @foreach ($cifin_real_extints as $cifin_real_extint )
        <tr>
          <td class="text-center">{{ $cifin_real_extint->rexnumob }}</td>
          <td class="text-center">{{ $cifin_real_extint->rexcalid }}</td>
          <td class="text-center">{{ $cifin_real_extint->rexnoment }}</td>
          <td class="text-center">{{ $cifin_real_extint->rexestob }}</td>
          <td class="text-center">
            @if (!empty($cifin_real_extint->rexvrinic)){{ number_format (($cifin_real_extint->rexvrinic*1000)) }} @endif
            0
          </td>
          <td class="text-center"> @if (!empty($cifin_real_extint->rexsaldob))
            {{ number_format (($cifin_real_extint->rexsaldob*1000)) }} @endif 0</td>
          <td class="text-center"> @if (!empty($cifin_real_extint->rexvrmora))
            {{ number_format (($cifin_real_extint->rexvrmora*1000)) }} @endif 0</td>
          <td class="text-center"> @if (!empty($cifin_real_extint->rexvrcuot))
            {{ number_format (($cifin_real_extint->rexvrcuot*1000)) }} @endif 0</td>
          <td class="text-center">{{ $cifin_real_extint->rexcompor }}</td>
          <td class="text-center">{{ $cifin_real_extint->rexcorte }}</td>
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