<div class="row">
    <div class="col-sm-12 offset-md-8 col-md-4 text-right">
        <div class="input-group mb-3">
            <input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
            <div class="input-group-append">
                <span class="input-group-text" id="searchIcon" ng-click="searchLeads()"><i class="fas fa-search"></i></span>
            </div>
        </div>
    </div>
</div>
<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Ciudad</th>
                <th>Servicio</th>
                <th>Producto</th>
                <th>Fecha de registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="lead in leads">
                <td>{{ lead.name }}</td>
                <td>{{ lead.lastName }}</td>
                <td>{{ lead.telephone }}</td>
                <td>{{ lead.city }}</td>
                <td>{{ lead.typeService }}</td>
                <td>{{ lead.typeProduct }}</td>
                <td>{{ lead.created_at }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <div class="pull-right">
        <i class="fas pageList fa-chevron-left" ng-class="{ disabled : current_page == 1 }" ng-click="setCurrentPage('resta', true)"></i>
        <span ng-repeat="page in pages" class="pageList" ng-click=setCurrentPage(page)>{{ page }}</span>
        <i class="fas pageList fa-chevron-right" ng-class="{ disabled : current_page == totalPages }" ng-click="setCurrentPage('suma', true)"></i>
    </div>
</div>