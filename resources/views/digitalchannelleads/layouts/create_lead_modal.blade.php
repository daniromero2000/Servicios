<!--AddCommunityLead modal-->
<div class="modal fade" id="addleadmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Agregar Lead</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row resetRow ">
            <form action="{{ route('digitalchannelleads.store') }}" method="post" class="form"
              enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-12 form-group">
                  <label for="identificationNumber">Cédula</label>
                  <input type="text" class="form-control" validation-pattern="IdentificationNumber"
                    id="identificationNumber" name="identificationNumber">
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 form-group">
                  <label for="name">Nombre <span class="text-danger">*</span></label>
                  <input type="text" ng-model="lead.name" validation-pattern="name" id="name" name="name" cols="10"
                    class="form-control" required>
                </div>
                <div class="col-12 col-sm-6 form-group no-padding-right">
                  <label for="lastName">Apellido <span class="text-danger">*</span></label>
                  <input type="text" ng-model="lead.lastName" validation-pattern="name" id="lastName" name="lastName"
                    cols="10" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 form-group">
                  <label for="email">Email</label>
                  <input type="text" ng-model="lead.email" validation-pattern="email" id="email" name="email" cols="10"
                    class="form-control">
                </div>
                <div class="col-12 col-sm-6 form-group no-padding-right">
                  <label for="telephone">Teléfono </label>
                  <input type="text" ng-model="lead.telephone" id="telephone" name="telephone" cols="10"
                    class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 form-group">
                  <label for="city">Ciudad <span class="text-danger">*</span></label>
                  <select id="city" name="city" class="form-control" required>
                    @if(!empty($cities))
                    <option disabled selected value> -- Selecciona Ciudad -- </option>
                    @foreach($cities as $city)
                    <option value="{{ $city->CIUDAD }}">
                      {{ $city->CIUDAD }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-12 col-sm-6 form-group no-padding-right">
                  <label for="channel">Canal de Adquisición <span class="text-danger">*</span></label>
                  <select id="channel" name="channel" class="form-control" required>
                    @if(!empty($channels))
                    <option disabled selected value> -- Selecciona Canal -- </option>
                    @foreach($channels as $channel)
                    <option value="{{ $channel->id }}">
                      {{ $channel->channel }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 form-group">
                  <label for="name">Ciudad aledaña</label>
                  <input type="text" ng-model="lead.nearbyCity" validation-pattern="name" id="nearbyCity"
                    name="nearbyCity" cols="10" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-12 form-group">
                  <label for="socialNetwork">Campaña</label>
                  <select id="campaign" name="campaign" class="form-control">
                    @if(!empty($campaigns))
                    <option disabled selected value> -- Selecciona Campaña -- </option>
                    @foreach($campaigns as $campaign)
                    <option value="{{ $campaign->id }}">
                      {{ $campaign->name }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 form-group">
                  <div class="form-group">
                    <label for="typeAreaSelectCreate">Selecciona Area </label>
                    <select name="lead_area_id" id="typeAreaSelectCreate" class="form-control " style="width: 100%;">
                      <option disabled selected value=""> -- Selecciona Area -- </option>
                      @if(!empty($areas))
                      @foreach($areas as $area)
                      <option value="{{ $area->id }}">
                        {{ $area->name }}
                      </option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="col-12 col-sm-6 form-group">
                  <label for="typeServiceSelectedCreate">Servicio <span class="text-danger">*</span></label>
                  <select id="typeServiceSelectedCreate" name="typeService" class="form-control" required>
                    <option disabled selected value> -- Selecciona Servicio -- </option>
                  </select>
                </div>
                <div class="col-12 col-sm-6 form-group no-padding-right">
                  <label for="typeProductCreate">Producto <span class="text-danger">*</span></label>
                  <select id="typeProductCreate" name="typeProduct" class="form-control">
                    <option disabled selected value> -- Selecciona Producto -- </option>
                  </select>
                </div>
                <div class="col-12 col-sm-6 form-group no-padding-right">
                  <label for="assessor_id">Asesor</label>
                  <select class="form-control  select2" id="assessor_id" name="assessor_id" ng-model="lead.assessor_id"
                    style="width: 100%;">
                    @if(!empty($listAssessors))
                    <option data-select3-id="" disabled selected value> -- Selecciona Asesor -- </option>
                    @foreach($listAssessors as $listAssessor)
                    <option data-select3-id="{{ $listAssessor->id }}" value="{{ $listAssessor->id }}">
                      {{ $listAssessor->name }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-12 form-group">
                  <label for="description">Observación</label>
                  <input type="textarea" ng-model="lead.nearbyCity" validation-pattern="text" id="description"
                    name="description" cols="10" class="form-control">
                </div>
              </div>

              <div class="form-group text-right mb-0 mt-2">
                <button class="btn btn-primary">Agregar</button>
                <button class=" btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>