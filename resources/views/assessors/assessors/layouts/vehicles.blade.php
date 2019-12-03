<!-- Vehicles -->
<div class="col-md-6">
  <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
    <div class="box-body">
      <h1><i class="fa fa-car" aria-hidden="true"></i> Vehículos</h1>
      @if($customer->customerVehicles->isNotEmpty())
      <table class="table table-borderless table-hover table-sm">
        <thead>
          <tr>
            <th class="text-center" scope="col">Fecha Registro</th>
            <th class="text-center" scope="col">Tipo de Vehículo</th>
            <th class="text-center" scope="col">Marca</th>
          </tr>
        </thead>
        <tbody>
          @include('layouts.admin.tables.vehicle_type_noheaders_table', ['datas' =>
          $customer->customerVehicles])
        </tbody>
      </table>
      @else
      <span>Aún no tiene Emails</span><br>
      @endif
      <div class="row">
        <div class="col">
          <a href="#" data-toggle="modal" data-target="#vehiclemodal" <i class="btn btn-primary btn-sm"><i
              class="fa fa-edit"></i>
            Agregar Vehículo</a>
        </div>
      </div>
    </div>
  </div>
</div>