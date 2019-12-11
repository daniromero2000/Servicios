<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-phone-alt mr-2"></i> TELEFONOS
    </h2>
  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Móvil</th>
          <th class="text-center" scope="col">Teléfono Fijo</th>
          <th class="text-center" scope="col">Teléfono Empresa</th>
        </tr>
      </thead>
      <tbody class="body-table">
        <tr>
          <td class="text-center">{{ $customer->CELULAR }}</td>
          <td class="text-center">{{ $customer->TELFIJO }}</td>
          <td class="text-center">{{ $customer->TEL_EMP }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>