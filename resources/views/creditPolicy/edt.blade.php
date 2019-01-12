<div class="row">
    <div class="col-12">
        <form ng-submit="edtCreditPolicy()">
            <div class="row">
                <div class="col-12 form-group">
                    <label for="name">Nombre</label>
                    <input type="text" ng-model="creditPolicy.name" id="name" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 form-group">
                    <label for="score">Score Inicial</label>
                    <input type="number" id="score" ng-model="creditPolicy.score" class="form-control">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                    <label for="scoreEnd">Score Final</label>
                    <input type="number" id="scoreEnd" ng-model="creditPolicy.scoreEnd" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 form-group">
                    <label for="salary">Salario Inicial</label>
                    <input type="number" id="salary" ng-model="creditPolicy.salary" class="form-control">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                    <label for="salaryEnd">Salario Final</label>
                    <input type="number" id="salaryEnd" ng-model="creditPolicy.salaryEnd" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 form-group">
                    <label for="age">Edad Inicial</label>
                    <input type="number" id="age" ng-model="creditPolicy.age" class="form-control">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                    <label for="ageEnd">Edad Final</label>
                    <input type="number" id="ageEnd" ng-model="creditPolicy.ageEnd" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <label for="activity">Actividad (Ocupación)</label>
                    <select ng-model="creditPolicy.activity" class="form-control" id="activity" ng-options="ocupation.value as ocupation.label for ocupation in occupations"></select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <label for="quotaApproved">Monto Aprobado.</label>
                    <input type="number" id="quotaApproved" ng-model="creditPolicy.quotaApproved" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" ng-click="volver()" class="btn btn-danger">Volver</button>
                </div>
            </div>
        </form>
    </div>
</div>