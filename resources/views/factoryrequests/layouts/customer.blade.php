<div class="card-header">
  <h1><i class="fa fa-user" aria-hidden="true"></i> Cliente</h1>
</div>
<div class="card-body table-responsive pt-1">
  @if(!empty($customer->customer))
  <table class="table table-hover table-stripped leadTable ">
    <thead>
      <tr>
        <th class="text-center" scope="col">Cedula</th>
        <th class="text-center" scope="col">Apellido</th>
        <th class="text-center" scope="col">Nombre</th>
        <th class="text-center" scope="col">Celular</th>
        <th class="text-center" scope="col">Ciudad</th>
        <th class="text-center" scope="col">Email</th>

      </tr>
    </thead>
    <tbody>
      @include('layouts.admin.tables.customer_eps_noheaders_table', ['data' => $customer->customer])
    </tbody>
  </table>
  @else
  <span>Aún no tiene Eps</span><br>
  @endif
</div>
