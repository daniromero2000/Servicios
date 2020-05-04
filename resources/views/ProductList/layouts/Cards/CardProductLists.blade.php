<div class="card bg-white shadow border-0">
    <div class="card-header">
        <div class="row resetRow">
            <div class=" col-5 col-sm-8 col-md-8">
                <h4 class="mb-2">
                    Listas
                </h4>
            </div>
            <div class=" col-7 col-sm-4 col-md-4">
                <!--<div class="input-group input-group-sm">
                    <input type="text" ng-model="q.q" name="table_search" class="form-control float-right"
                        aria-describedby="searchIcon" placeholder="Buscar">
                    <div class="input-group-append">
                        <button type="button" ng-click="search()" class="btn btn-default"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table table-responsive">
            <table class="table table-hover table-stripped leadTable">
                <thead class="headTableLeads small">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Verificado por:</th>
                        <th scope="col">Fecha de inicio</th>
                        <th scope="col">Fecha de Finalización</th>
                        <th scope="col">Zona</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <tr ng-repeat="productList in productLists">
                        <td>@{{ productList.name }}</td>
                        <td>@{{ productList.checked }}</td>
                        <td>@{{ productList.checked_user_id }}</td>
                        <td>@{{ productList.start_date }}</td>
                        <td>@{{ productList.end_date }}</td>
                        <td>@{{ productList.zone }}</td>
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
            <button class="btn btn-primary btn-sm" ng-click="addProductList()">Agregar Lista</button>
        </div>
    </div>

</div>