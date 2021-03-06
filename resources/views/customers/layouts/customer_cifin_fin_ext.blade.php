<div class="container-fluid card mt-2 card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-external-link-alt mr-2"></i> Obligaciones Extintas Sector Financiero
    </h2>
  </div>
  @if($cifin_fin_extints->isNotEmpty())
  <div class="card-body table-responsive pt-0 ">
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
        @foreach ($cifin_fin_extints as $cifin_fin_extint )
        <tr>
          <td class="text-center">{{ $cifin_fin_extint->extnumob }}</td>
          <td class="text-center">{{ $cifin_fin_extint->extcalid }}</td>
          <td class="text-center">{{ $cifin_fin_extint->extnoment }}</td>
          <td class="text-center">{{ $cifin_fin_extint->extestob }}</td>
          <td class="text-center"> @if (!empty($cifin_fin_extint->extvrinic))
            {{ number_format (($cifin_fin_extint->extvrinic*1000)) }} @endif 0</td>
          <td class="text-center"> @if (!empty($cifin_fin_extint->extsaldob))
            {{number_format (($cifin_fin_extint->extsaldob*1000)) }} @endif 0</td>
          <td class="text-center"> @if (!empty($cifin_fin_extint->extvrmora))
            {{ number_format (($cifin_fin_extint->extvrmora*1000)) }} @endif 0</td>
          <td class="text-center">
            @if (!empty($cifin_fin_extint->extvrcuot)){{ number_format (($cifin_fin_extint->extvrcuot*1000)) }} @endif 0
          </td>
          <td class="text-center">{{ $cifin_fin_extint->extcompor }}</td>
          <td class="text-center">{{ $cifin_fin_extint->extcorte }}</td>
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