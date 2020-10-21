<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h2 class=" title-table mt-2"><i class="fas fa-map-marker-alt"></i> Información de ubicación
        </h2>
      </div>
    </div>
  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Tipo de población</th>
          <th class="text-center" scope="col">Dirección</th>
          <th class="text-center" scope="col">Ciudad de ubicación</th>
        </tr>
      </thead>
      <tbody class="body-table">
        <tr>
          <td class="text-center">{{ $customer->DIRECCION3 }}</td>
          <td class="text-center">{{ $customer->DIRECCION }} Años</td>
          <td class="text-center">{{ $customer->CIUD_UBI }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>