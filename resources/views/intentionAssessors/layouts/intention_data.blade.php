<div class="container-fluid card mt-4 card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fa fa-user"></i> Datos Intención</h2>
  </div>
  <div class="card-body table-responsive pt-0 header-table-responsive">
    @if(!empty($intention->dataIntentionRequest))
    <table class="table table-head-fixed table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Id</th>
          <th class="text-center" scope="col">Intención</th>
          <th class="text-center" scope="col">Ciudad</th>
          <th class="text-center" scope="col">Dispositivo</th>
          <th class="text-center" scope="col">Navegador</th>
          <th class="text-center" scope="col">Sistema Operativo</th>
          <th class="text-center" scope="col">Dirección IP</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @include('layouts.admin.tables.noheaders_table', ['data' => $intention->dataIntentionRequest])
      </tbody>
    </table>
    @else
    <table class="table table-hover table-stripped leadTable">
      <tbody class="body-table">
        <tr>
          <td>
            Sin data
          </td>
        </tr>
      </tbody>
    </table>
    @endif
  </div>
</div>