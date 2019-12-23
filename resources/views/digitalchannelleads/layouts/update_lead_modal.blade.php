<!--Update modal-->
<div class="modal fade" id="updateleadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Actualizar Lead</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row resetRow ">
            <div class="col-12 form-group">
              <form ng-submit="updateCommunityLeads()">
                {{ csrf_field() }}
                <div class="form-group row">
                  <div class="col-12 col-sm-6">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <input type="text" validation-pattern="name" id="name" cols="10"
                      class="form-control" value="" required>
                  </div>
                  <div class="col-12 col-sm-6 no-padding-right">
                    <label for="lastName">Apellido <span class="text-danger">*</span></label>
                    <input type="text" ng-model="lead.lastName" validation-pattern="name" id="lastName" cols="10"
                      class="form-control" value="@{{lead.lastName}}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-12 col-sm-6">
                    <label for="email">email </label>
                    <input type="text" ng-model="lead.email" validation-pattern="email" id="email" cols="10"
                      class="form-control" value="@{{lead.email}}">
                  </div>
                  <div class="col-12 col-sm-6 no-padding-right">
                    <label for="telephone">telefono <span class="text-danger">*</span></label>
                    <input type="text" ng-model="lead.telephone" id="telephone" cols="10" class="form-control"
                      value="@{{lead.telephone}}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-12 col-sm-6">
                    <label for="city">Ciudad <span class="text-danger">*</span></label>
                    <select id="city" class="form-control" ng-model="lead.city"
                      ng-options="city.CIUDAD as city.CIUDAD for city in cities">
                    </select>
                  </div>
                  <div class="col-12 col-sm-6 no-padding-right">
                    <label for="socialNetwork">Canal de adquisición <span class="text-danger">*</span></label>
                    <select id="socialNetwork" class="form-control" ng-model="lead.channel"
                      ng-options="socialNetwork.value as socialNetwork.label for socialNetwork in socialNetworks">
                      <option>
                      </option>
                    </select>

                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-6 form-group">
                    <label for="name">Ciudad aledaña</label>
                    <input type="text" ng-model="lead.nearbyCity" validation-pattern="name" id="nearbyCity" cols="10"
                      class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="socialNetwork">Campaña</label>
                  <select id="socialNetwork" class="form-control" ng-model="lead.campaign"
                    ng-options="campaign.id as campaign.name for campaign in campaigns">
                    <option ng-repeat="campaign in campaigns" value="@{{ campaigns.value}}"
                      label="@{{ campaigns.label}}">
                      @{{campaigns.value}}
                    </option>
                  </select>
                </div>
                <div class="form-group row">
                  <div class="col-12 col-sm-6">
                    <label for="service">Servicio <span class="text-danger">*</span></label>
                    <select id="service" class="form-control" ng-model="lead.typeService">
                      <option ng-repeat="service in typeServices" value="@{{service.value}}" label="@{{service.label}}">
                        @{{service.value}}
                      </option>
                    </select>
                  </div>
                  <div class="col-12 col-sm-6 no-padding-right">
                    <label for="product">Producto <span class="text-danger">*</span></label>
                    <input type="text" ng-model="lead.typeProduct" validation-pattern="text" id="product" cols="10"
                      class="form-control" value="@{{lead.typeProduct}}">
                  </div>
                </div>

                <div class="row">
                  <div class="col-6 d-flex align-items-end">
                    <div class="form-group w-100">
                      <label for="state">Estado</label>
                      <select class="form-control  select2" id="state" name="state" ng-model="lead.state"
                        style="width: 100%;">
                        <option disabled selected value> -- Selecciona Estado -- </option>
                        <option value="1">Contactado</option>
                        <option value="2">Vendido</option>
                        <option value="3">Asignado a:</option>
                        <option value="4">Impactado</option>
                        <option value="5">Desistido</option>
                        <option value="6">Negado</option>
                        <option value="7">Cotizado</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6 d-flex align-items-end">
                    <div class="form-group w-100">
                      <label for="assessor_id">Asesor</label>
                      <select class="form-control  select2" id="assessor_id" name="assessor_id"
                        ng-model="lead.assessor_id" style="width: 100%;">
                        <option disabled selected value> -- Selecciona Paso -- </option>
                        <option value="13">Evelyn Correa</option>
                        <option value="18">Vanessa Parra</option>
                        <option value="85">Danitza Naranjo</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group text-left">
                  <button class="btn btn-primary">Actualizar</button>
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