
<div class="col-md-12">
  <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
    <div class="box-body">
      <h1><i class="fa fa-stethoscope" aria-hidden="true"></i> Cliente</h1>
      @if(!empty($customer->customer))
      <table class="table table-borderless table-hover table-sm">
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
  </div>
</div>