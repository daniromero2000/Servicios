<style>
    td {
        vertical-align: middle !important;
    }

    .container {
        max-width: 1300px !important;
        margin: auto;
    }
</style>

<div class="row form-group" ng-if="filtros">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <strong>Filtros</strong>
            </div>
            <div class="card-body">
                <form ng-submit="searchLeads()">
                    <div class="row form-group">
                        <div class="col-12 col-sm-6">
                            <label>Estado</label>
                            <select class="form-control" ng-model="q.qtypeStatus"
                                ng-options="typeStatus.label as typeStatus.label for typeStatus in typeStatuses"></select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="qtipoTarjeta">Tipo Tarjeta</label>
                            <select class="form-control" ng-model="q.qtipoTarjeta" id="qtipoTarjeta"
                                ng-options="cardType.label as cardType.label for cardType in cardTypes"></select>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-sm-6">
                            <label for="fechaInicialAprobados">Fecha Inicial</label>
                            <div class="input-group" moment-picker="q.qfechaInicial" format="YYYY-MM-DD">
                                <input class="form-control inputsSteps inputText" ng-model="q.qfechaInicial"
                                    id="fechaInicial" readonly="" required="" placeholder="Año/Mes/Día">
                                <span class="input-group-addon">
                                    <i class="octicon octicon-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="qfechaFinal">Fecha Final</label>
                            <div class="input-group" moment-picker="q.qfechaFinal" format="YYYY-MM-DD">
                                <input class="form-control inputsSteps inputText" ng-model="q.qfechaFinal"
                                    id="qfechaFinal" readonly="" required="" placeholder="Año/Mes/Día">
                                <span class="input-group-addon">
                                    <i class="octicon octicon-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="button" ng-click="resetFiltros()" class="btn btn-danger">Resetear
                                Filtros<i class="fas fa-times"></i></button>
                            <button type="submit" class="btn btn-primary ">Filtrar<i class="fas fa-filter"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row resetRow">
    <div class="col-sm-12 col-md-1">
        <p class="totalLeadsDigital text-center">
            @{{ totalLeads }}
        </p>
        <p class="text-center">
            Leads
        </p>
    </div>
    <div class="col-sm-12 offset-md-7 col-md-3 text-right">
        <div class="input-group mb-3">
            <input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
            <div class="input-group-append">
                <span class="input-group-text" id="searchIcon" ng-click="searchLeads()"><i
                        class="fas fa-search"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-1 resetCol">
        <button type="button" ng-click="filtros=!filtros" class="btn btn-primary btnFilter">Filtros <i
                class="fas fa-filter"></i></button>
    </div>
</div>
<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                <th scope="col">Cedula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Celular</th>
                <th scope="col">Email</th>
                <th scope="col" style="width: 10%;">Fecha registro</th>
                <th scope="col">Estado</th>
                <th scope="col">Tarjeta</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="lead in leads">
                <td>@{{ lead.CEDULA }}</td>
                <td>@{{ lead.NOMBRES + " " + lead.APELLIDOS}}</td>
                <td>@{{ lead.CELULAR }}</td>
                <td>@{{ lead.EMAIL }}</td>
                <td>@{{ lead.CREACION }}</td>
                <td>@{{ lead.ESTADO }}</td>
                <td>
                    @{{ lead.TARJETA }}
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="getLeads()">Cargar Más</button>
        </div>
    </div>
</div>
</div>