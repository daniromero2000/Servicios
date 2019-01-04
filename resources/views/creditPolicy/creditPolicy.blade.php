<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                
                <th>Puntaje</th>
                <th>Tiempo limite</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="creditPolicy in creditPolicies">
                <td>@{{ creditPolicy.score }}</td>
                <td>@{{ creditPolicy.timeLimitText }}  Mes</td>
                <td>                          
                    <i class="fas fa-edit cursor" title="Actualizar usuario" ng-click="showUpdate(creditPolicy.id)"></i>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="">Cargar Más</button>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Actualizar Parámetros</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <div class="modal-body">
                <div class="container">
                    <div class="row resetRow " >
                        <div class="col-12 form-group">
                            <form ng-submit="updateCreditPolicy()" id="addForm">
                        	@csrf
		                        <div class="form-group row">
		                            <label for="name" class="col-md-4 col-form-label text-md-right">Puntaje
		                            </label>

		                            <div class="col-md-6">
		                                <input id="score" type="text" class="form-control" name="score" ng-model="creditPolicy.score" ng-value="creditPolicy.score" required autofocus>
		                            </div>
		                        </div>  
		                        <div class="form-group row">
		                            <label for="password" class="col-md-4 col-form-label text-md-right">Tiempo límite</label>
		                            <div class="col-md-6">
		                                <select id="timeLimit" type="text" class="form-control"ng-model="creditPolicy.timeLimit" ng-options="month.value as month.text for month in monthsOptions" required>
		                                </select>
		                            </div>
		                        </div>
		                        <div class="form-group row mb-0">
		                            <div class="col-md-6 offset-md-4">
		                                <button type="submit" class="btn btn-primary">
		                                    Actualizar datos
		                                </button>
		                            </div>
		                        </div>                        
		                    </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>