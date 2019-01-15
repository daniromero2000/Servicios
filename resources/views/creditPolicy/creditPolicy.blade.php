<div class="row">
    <div class="col-sm-12 col-md-3">
        <button class="btn btn-primary" ng-click="addCreditPolicy()">Agregar Política</button>
    </div>
    <div class="col-sm-12 offset-md-6 col-md-3 text-right">
		<div class="input-group mb-3">
			<div class="input-group-append">
				<input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
				<span class="input-group-text" id="searchIcon" ng-click="searchCreditPolicies()"><i class="fas fa-search"></i></span>
			</div>
		</div>
	</div>
</div>
<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="credit in creditPolicy">
                <td>@{{ credit.name }}</td>
                <td>
                    <i class="fas fa-edit cursor" title="Editar Política" ng-click="edtCreditPolicy(credit.id)"></i>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="getCreditPolicy()">Cargar Más</button>
        </div>
    </div>
</div>