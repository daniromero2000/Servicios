<!-- Phones -->
<div class="container-fluid card mt-4 card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-credit-card mr-3"></i> Tarjeta de Crédito</h2>
  </div>
  <div class="card-body table-responsive pt-0 header-table-responsive">
    @if(!empty($customer->creditCard))
    <table class="table table-head-fixed table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Número</th>
          <th class="text-center" scope="col">Estado</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @include('layouts.admin.tables.noheaders_noloop_table', ['data' => $customer->creditCard])
      </tbody>
    </table>
    @else
    <table class="table table-hover table-stripped leadTable">
      <tbody class="body-table">
        <tr>
          <td>
            Aún no tiene Tarjetas
          </td>
        </tr>
      </tbody>
    </table>
    @endif
  </div>
</div>