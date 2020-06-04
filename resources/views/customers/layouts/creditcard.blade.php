<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title"><i class="fas fa-credit-card mr-3"></i> Tarjeta</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus text-dark"></i>
      </button>
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="table-responsive pt-0 header-table-responsive">
      @if(!empty($customer->creditCard))
      <table class="table table-head-fixed table-hover table-stripped leadTable">
        <thead class="text-center header-table">
          <tr>
            <th class="text-center" scope="col">Número</th>
            <th class="text-center" scope="col">Solicitud</th>
            <th class="text-center" scope="col">Cupo Inicial</th>
            <th class="text-center" scope="col">Cupo Compra</th>
            <th class="text-center" scope="col">Cupo Compra Actual</th>
            <th class="text-center" scope="col">Cupo Efectivo</th>
            <th class="text-center" scope="col">Cupo Actual</th>
            <th class="text-center" scope="col">Cupo Maximo</th>
            <th class="text-center" scope="col">Sucursal</th>
            <th class="text-center" scope="col">Estado</th>
            <th class="text-center" scope="col">Activación</th>
            <th class="text-center" scope="col">Tipo de Tarjeta</th>
          </tr>
        </thead>
        <tbody class="body-table">
          @include('layouts.admin.tables.noheaders_noloop_table', ['data' => $customer->creditCard])
          {{-- @php
          dd($factoryRequest->creditCard)
          @endphp --}}
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
  <!-- /.card-body -->
</div>