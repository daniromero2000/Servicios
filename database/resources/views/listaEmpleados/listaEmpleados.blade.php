<div class="row">
    <div class="col-12">
        <h2 class="headerAdmin">Lista de Empleados</h2>
    </div>
    <div class="col-12 col-sm-3">
		 <button class="btn btn-primary" ng-click="showAddEmploye()">Agregar Empleado</button>
    </div>
    <div class="col-12 col-sm-3 offset-md-6  text-right">
        <div class="input-group mb-3">
            <div class="input-group-append">
                <input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
                <span class="input-group-text" id="searchIcon" ng-click="searchEmployes()"><i class="fas fa-search"></i></span>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="headTableLeads">
                    <tr>
                        <th class="text-left" scope="col">Nombre</th>
                        <th scope="col">Cédula</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="employe in employes">
                        <td>@{{ employe.nombre }}</td>
                        <td class="text-center">@{{ employe.num_documento }}</td>
                    <td class="text-center"> 
                        <i class="fas fa-times cursor" title="Eliminar" ng-click="deleteEmploye(employe.identificador)"></i> 
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button class="btn btn-secondary" ng-disabled="cargando" ng-click="getMoreEmployes()">Cargar Más</button>
            </div>
        </div>
    </div>    
</div>

<div class="modal fade" id="addEmployeModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Nuevo Empleado</h5>
			</div>
			<div class="modal-body">
                <form ng-submit="addEmploye()">
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" ng-model="employe.nombre">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="num_documento">Número de documento</label>
                            <input type="text" class="form-control" id="num_documento" ng-model="employe.num_documento">
                        </div>
                        <div class="col-12 text-center" ng-show="existEmploye">
                            <div class="alert alert-danger" role="alert">
                                El número de cédula digitada ya esta registrado
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-secondary" ng-click="cerrar()">Volver</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>