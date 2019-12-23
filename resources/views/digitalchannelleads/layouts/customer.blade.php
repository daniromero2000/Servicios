<div class="container-fluid card mt-4 card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fa fa-user"></i> Cliente</h2>
  </div>
  <div class="card-body table-responsive pt-0 header-table-responsive">
    @if(!empty($intention->intention))
    <table class="table table-head-fixed table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Cedula</th>
          <th class="text-center" scope="col">Apellido</th>
          <th class="text-center" scope="col">Nombre</th>
          <th class="text-center" scope="col">Celular</th>
          <th class="text-center" scope="col">Ciudad</th>
          <th class="text-center" scope="col">Email</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @include('layouts.admin.tables.intention_eps_noheaders_table', ['data' => $intention->intention])
      </tbody>
    </table>
    @else
    <table class="table table-hover table-stripped leadTable">
      <tbody class="body-table">
        <tr>
          <td>
            Aún no tiene Eps
          </td>
        </tr>
      </tbody>
    </table>
    @endif
  </div>
</div>