<div class="container-fluid mt-2 card card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i> Moras Sector Financiero
    </h2>
  </div>
  @if($cifin_fins->isNotEmpty())
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
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
        @foreach ($cifin_fins as $cifin_fin )
        <tr>
          <td class="text-center">{{ $cifin_fin->finnumob }}</td>
          <td class="text-center">{{ $cifin_fin->fincalid }}</td>
          <td class="text-center">{{ $cifin_fin->finnoment }}</td>
          <td class="text-center">{{ $cifin_fin->finestob }}</td>
          <td class="text-center">
            @if ($cifin_fin->finvrinic)
            {{ number_format (($cifin_fin->finvrinic*1000)) }}
            @endif
          </td>
          <td class="text-center">
            @if ($cifin_fin->finsaldob)
            {{ number_format (($cifin_fin->finsaldob*1000)) }}
            @endif
          </td>
          <td class="text-center">
            @if ($cifin_fin->finvrmora)
            {{ number_format (($cifin_fin->finvrmora*1000)) }}
            @endif
          </td>
          <td class="text-center">
            @if ($cifin_fin->finvrcuot)
            {{ number_format (($cifin_fin->finvrcuot*1000)) }}
            @endif
          </td>
          <td class="text-center">{{ $cifin_fin->fincompor }}</td>
          <td class="text-center">{{ $cifin_fin->fincorte }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <table class="table table-hover table-stripped leadTable">
    <tbody class="body-table">
      <tr>
        <td>
          No tiene Moras en el sector Financiero
        </td>
      </tr>
    </tbody>
  </table>
  @endif
</div>