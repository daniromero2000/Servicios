<div class="row">
    <div class="col-12 text-center">
        <h2 class="headerAdmin ng-scope">Configuración consulta comercial</h2>
    </div>
    <div class="col-sm-12">
        <form ng-submit="edtCredit()">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <label for="pub_vigencia">Tiempo límite de consulta/Días (Servicios Financieros)</label>
                    <input type="number" id="pub_vigencia" validation-pattern="number" class="form-control" ng-model="credit.pub_vigencia" />
                </div>
                <div class="col-12 col-sm-6">
                    <label for="timeLimitAdmin">Tiempo límite de consulta/Días (Oportudata)</label>
                    <input type="number" id="fab_vigencia" validation-pattern="number" class="form-control" ng-model="credit.fab_vigencia" />
                </div>
            </div>
            <div class="row" style="margin-top:50px">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary buttonFormModal buttonFormModalSubmit">Actualizar</button>
                    <button type="button" class="btn btn-danger buttonFormModal buttonFormModalSubmit" ng-click="volver()">Volver</button>
                </div>
            </div>
        </form>
    </div>
</div>