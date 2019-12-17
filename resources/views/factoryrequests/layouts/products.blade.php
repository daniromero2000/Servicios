<div class="container-fluid card mt-4 card-table-reset">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-credit-card mr-3"></i> Productos</h2>
  </div>
  <div class="card-body table-responsive pt-0 header-table-responsive">
    @if($factoryRequest->factoryRequestProducts->isNotEmpty())
    <table class="table table-head-fixed table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Producto</th>
          <th class="text-center" scope="col">Total</th>
        </tr>
      </thead>
      <tbody class="body-table">
      <tbody>
        <tr>
          <td class="text-center">{{ $factoryRequest->factoryRequestProducts->ARTICULO}}</td>
          <td class="text-center">{{ $factoryRequest->factoryRequestProducts->TOTAL}}</td>
        </tr>
      <tbody>
      </tbody>
    </table>
    @else
    <table class="table table-hover table-stripped leadTable">
      <tbody class="body-table">
        <tr>
          <td>
            Aún no tiene Productos
          </td>
        </tr>
      </tbody>
    </table>
    @endif
  </div>
</div>