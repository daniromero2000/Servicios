<div class="card bg-white shadow border-0">
    <div class="card-header">
        <div class="row resetRow">
            <div class=" col-5 col-sm-8 col-md-8">
                <h4 class="mb-2">
                    Productos
                </h4>
            </div>
            <!--<div class=" col-7 col-sm-4 col-md-4">
                <div class="input-group input-group-sm">
                    <input type="text" ng-model="q.q" name="table_search" class="form-control float-right"
                        aria-describedby="searchIcon" placeholder="Buscar">
                    <div class="input-group-append">
                        <button type="button" ng-click="search()" class="btn btn-default"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
    <div class="card-body">
        <div class="table table-responsive">
            <table class="table table-hover table-stripped leadTable">
                <thead class="headTableLeads small">
                    <tr>
                        <th scope="col">Articulo</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Costo Base</th>
                        <th scope="col">Costo + IVA</th>
                        <th scope="col">Proteccion</th>
                        <th scope="col">Valor min</th>
                        <th scope="col">Valor max</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <tr ng-repeat="listProduct in listProducts">
                        <td>@{{ listProduct.item }}</td>
                        <td>@{{ listProduct.sku }}</td>
                        <td>$@{{ listProduct.base_cost | number:0}}</td>
                        <td>$@{{ listProduct.iva_cost | number:0 }}</td>
                        <td>$@{{ listProduct.protection | number:0 }}</td>
                        <td>$@{{ listProduct.min_tolerance | number:0 }}</td>
                        <td>$@{{ listProduct.max_tolerance | number:0 }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="row">
            <div class="col-12 text-center">
                {{-- <button class="btn btn-secondary btn-sm" ng-disabled="cargando" ng-click="moreRegister()">Cargar
            Más</button> --}}
            </div>
        </div>
        <div class="text-right mt-2">
            <button class="btn btn-primary btn-sm" ng-click="addListProduct()">Agregar Producto</button>
        </div>
    </div>

</div>