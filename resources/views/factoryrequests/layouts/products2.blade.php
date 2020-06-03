<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title"><i class="fas fa-credit-card mr-3"></i> Productos</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus text-dark"></i>
      </button>
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="table-responsive pt-0 header-table-responsive">
      @if($factoryRequest->factoryRequestProducts2->isNotEmpty())
      <table class="table table-head-fixed table-hover table-stripped leadTable">
        <thead class="header-table">
          <tr>
            <th class="text-center" scope="col">Producto</th>
            <th class="text-center" scope="col">Total</th>
          </tr>
        </thead>
        <tbody class="body-table">
          @foreach ($factoryRequest->factoryRequestProducts2 as $factoryRequestProduct)
          <tr>
            <td class="text-center">{{ $factoryRequestProduct->ARTICULO}}</td>
            <td class="text-center">$ {{ number_format($factoryRequestProduct->PRECIO_P)}}</td>
          </tr>
          @endforeach
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
  <!-- /.card-body -->
</div>