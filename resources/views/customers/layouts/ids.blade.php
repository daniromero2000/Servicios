<div class="container-fluid mt-5 card-table-reset card">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-address-card mr-2"></i> IDENTIFICACIÓN
    </h2>
  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Cédula</th>
          <th class="text-center" scope="col">Fecha Expedición</th>
          <th class="text-center" scope="col">Ciudad De Expedición</th>

        </tr>
      </thead>
      <tbody class="body-table">
        <tr>
          <td class="text-center">{{ $customer->CEDULA }}</td>
          <td class="text-center">{{ $customer->FEC_EXP }}</td>
          <td class="text-center">{{ $customer->CIUD_EXP }}</td>

        </tr>
      </tbody>
    </table>
  </div>
</div>