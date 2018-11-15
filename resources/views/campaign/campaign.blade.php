<div class="table table-responsive">
    <table class="table table-hover table-stripped leadTable">
        <thead class="headTableLeads">
            <tr>
                <th>Nombre de Campaña</th>
                <th>Red Social</th>
                <th>Fecha de inicio</th>
                <th>Fecha de fin</th>
                <th>Presupuesto</th>
                <th>Presupuesto utilizado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="campaign in campaigns">
                <td>@{{ campaign.name }}</td>
                <td>@{{ campaign.socialNetwork }}</td>
                <td>@{{ campaign.beginDate }}</td>
                <td>@{{ campaign.endingDate }}</td>
                <td>@{{ campaign.budget }}</td>
                <td>@{{ campaign.usedBudget }}</td>
                <td>
                    
                    <i class="fas fa-comment cursor mr5" ></i>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-secondary" ng-disabled="cargando" ng-click="getCampaigns()">Cargar Más</button>
        </div>
    </div>
</div>

