<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"> Obsequios </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                    class="fas fa-minus color-black"></i>
            </button>
        </div>
    </div>
    <div class="card-body" style="display: block;">
        <div class="table table-responsive">
            <table class="table table-hover table-stripped leadTable">
                <thead class="headTableLeads small">
                    <tr>
                        <th scope="col">Base de Obsequio</th>
                        <th scope="col">Incremento</th>
                        <th scope="col">Total</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <tr ng-repeat="listGiveAway in listGiveAways">
                        <td>
                            <span> $@{{ listGiveAway.base_give_aways | number:0}}</span>
                        </td>
                        <td>
                            <span> $@{{ listGiveAway.increment | number:0}}</span>
                        </td>
                        <td>
                            <span> $@{{ listGiveAway.total | number:0}}</span>
                        </td>
                        <td>
                            <i class="fas fa-edit cursor" title="Actualizar"
                                ng-click="showUpdateDialogListGiveAway(listGiveAway)"></i>
                            <i class="fas fa-times cursor" title="Eliminar"
                                ng-click="showDialogDeleteListGiveAway(listGiveAway)" ng-if="activ"></i>

                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="row">
            <div class="col-12 text-center">
                {{-- <button class="btn btn-secondary btn-sm" ng-disabled="cargando" ng-click="moreRegister()">Cargar
            M??s</button> --}}
            </div>
        </div>
        <div class="text-right mt-2">
            <button class="btn btn-primary btn-sm" ng-click="addListGiveAway()">Agregar Obsequio</button>
        </div>
    </div>
</div>
{{-- 
<div class="card bg-white shadow border-0">
    <div class="card-header">
        <div class="row resetRow">
            <div class=" col-5 col-sm-8 col-md-8">
                <h4 class="mb-2">
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

    </div>

</div> --}}