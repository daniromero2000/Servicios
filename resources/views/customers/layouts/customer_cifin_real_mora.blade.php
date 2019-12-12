<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i>Moras Sector Real
    </h2>
  </div>
  @if($customer->cifinReals->isNotEmpty())
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Codigo</th>
          <th class="text-center" scope="col">Entidad</th>
          <th class="text-center" scope="col">Estsdo</th>
          <th class="text-center" scope="col">Saldo Inicial</th>
          <th class="text-center" scope="col">Saldo Actual</th>
          <th class="text-center" scope="col">Mora</th>
          <th class="text-center" scope="col">Cuota</th>
          <th class="text-center" scope="col">Vector</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @foreach ($cifin_reals as $cifin_real )
        <tr>
          <td class="text-center">{{ $cifin_real->rmnumob }}</td>
          <td class="text-center">{{ $cifin_real->rmnoment }}</td>
          <td class="text-center">{{ $cifin_real->rmestob }}</td>
          <td class="text-center">{{ number_format (($cifin_real->rmvrinic*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_real->rmsaldob*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_real->rmvrmora*1000)) }}</td>
          <td class="text-center">{{ number_format (($cifin_real->rmvrcuot*1000)) }}</td>
          <td class="text-center">{{ $cifin_real->rmcompor }}</td>
        </tr>
        @endforeach
      </tbody class="body-table">
    </table>
  </div>@else
  <table class="table table-hover table-stripped leadTable">
    <tbody class="body-table">
      <tr>
        <td>
          No tiene Moras en el sector Real
        </td>
      </tr>
    </tbody>
  </table>
  @endif
</div>