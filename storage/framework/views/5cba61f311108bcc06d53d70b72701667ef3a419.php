<div class="row resetRow">

    <div class="col-sm-12 col-md-4">
         <button class="btn btn-primary" ng-click="addFaqs()">Agregar FAQ's</button>
    </div>

    <div class="col-sm-12 offset-md-3 col-md-4 text-right">
        <div class="input-group mb-3">
            <div class="input-group-append">
                <span class="input-group-text" id="searchIcon" ng-click="searchFaq()"><i class="fas fa-search"></i></span>
            </div>
             <input type="text" ng-model="q.q" class="form-control" aria-describedby="searchIcon">
        </div>
    </div>
</div>

<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                <th scope="col" width="90%">Pregunta</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="Faq in Faq">
                <td>{{ Faq.question }}</td>
                <td>
                    <i class="fas fa-edit cursor" title="Actualizar" ng-click="showUpdateDialog(Faq.id)"></i>
                    <i class="fas fa-times cursor" title="Eliminar" ng-click="showDialogDelete(Faq.id)"></i>
                    <i class="fas fa-aye cursor" title="Ver" ng-click="showDialog(Faq.id)"></i>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="getFaq()">Cargar Más</button>
        </div>
    </div>
</div>