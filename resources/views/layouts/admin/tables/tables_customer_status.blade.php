<div class="mb-4">

    <!-- /.card-header -->
    <div class=" table-responsive p-0 height-table">
        <table class="table table-head-fixed">
            <thead class="text-center header-table">
                <tr>
                    @foreach ($headers as $header)
                    <th scope="col">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="body-table">
                @foreach($datas as $data)
                <tr>
                    <td>{{ $data->CREACION}} </td>
                    <td>{{ $data->CEDULA}} </td>
                    <td>{{ $data->APELLIDOS}}</td>
                    <td>{{ $data->NOMBRES}} </td>
                    <td>{{ $data->TIPOCLIENTE}} </td>
                    <td>{{ $data->SUBTIPO}} </td>
                    <td>{{ $data->ORIGEN}} </td>
                    <td>{{ $data->CELULAR}} </td>
                    <td><span @if ($data->PASO == "PASO3")
                            class="badge badge-success"
                            @endif
                            @if ($data->PASO == "PASO2")
                            class="badge badge-primary"
                            @endif
                            @if ($data->PASO == "PASO1")
                            class="badge badge-warning"
                            @endif style="font-size: 11px;">{{ $data->PASO}}</span> </td>
                    <td>{{ $data->ESTADO}} </td>
                </tr>
                @endforeach

            <tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<div class="card mt-4">
    <div class="card-header">
        <div class="row resetRow">
            <div class="col-5 col-sm-8 col-md-8">
                <button class="btn btn-primary btn-sm-reset" ng-click="addProductList()">Agregar Lista</button>
            </div>
            <div class="col-7 col-sm-4 col-md-4">
                <div class="input-group input-group-sm">
                    <input type="text" ng-model="q.q" name="table_search" class="form-control float-right"
                        aria-describedby="searchIcon" placeholder="Buscar">
                    <div class="input-group-append">
                        <button type="button" ng-click="search()" class="btn btn-default"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table table-responsive">
            <table class="table table-hover table-stripped leadTable">
                <thead class="headTableLeads header-table">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">% P.P</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Verificado por:</th>
                        <th scope="col">Fecha de inicio</th>
                        <th scope="col">Fecha de Finalización</th>
                        <th scope="col">Zona</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody class="body-table">
                    <tr ng-repeat="productList in productLists">
                        <td>@{{ productList.name }}</td>
                        <td>@{{ productList.public_price_percentage }}</td>
                        <td>@{{ productList.checked }}</td>
                        <td>@{{ productList.checked_user_id }}</td>
                        <td>@{{ productList.start_date }}</td>
                        <td>@{{ productList.end_date }}</td>
                        <td>@{{ productList.zone }}</td>
                        <td>
                            <i class="fas fa-eye cursor" title="Ver" ng-click="showDialog(productList)"></i>
                            <i class="fas fa-edit cursor" title="Actualizar"
                                ng-click="showUpdateDialog(productList)"></i>
                            <i class="fas fa-times cursor" title="Eliminar" ng-click="showDialogDelete(productList)"
                                ng-if="activ"></i>

                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button class="btn btn-secondary btn-sm-reset" ng-disabled="cargando" ng-click="moreRegister()">Cargar
                    Más</button>
            </div>
        </div>
    </div>

</div>