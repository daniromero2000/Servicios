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
              <form action="{{ route('digitalchannelleads.update', $digitalChannelLead->id) }}" method="post"
                class="form">
                @csrf
                @method('PUT')
                             
                <div class="form-group row">
                  <div class="col-12 col-sm-6 no-padding-right">
                    <label for="lastName">Cédula <span class="text-danger">*</span></label>
                    <input type="text" name="identificationNumber" id="identificationNumber" 
                      class="form-control" validation-pattern="IdentificationNumber" value="{!! $digitalChannelLead->identificationNumber ?: old('lastName')  !!}" required>
                  </div>
                  <div class="col-12 col-sm-6">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre"
                      class="form-control" value="{!! $digitalChannelLead->name ?: old('name')  !!}" required>
                  </div>
                  <div class="col-12 col-sm-6 no-padding-right">
                    <label for="lastName">Apellido <span class="text-danger">*</span></label>
                    <input type="text" name="lastName" id="lastName" validation-pattern="name" placeholder="Apellido"
                      class="form-control" value="{!! $digitalChannelLead->lastName ?: old('lastName')  !!}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-12 col-sm-6">
                    <label for="email">email </label>
                    <input type="text" name="email" id="email" validation-pattern="email" placeholder="Email"
                      class="form-control" value="{!! $digitalChannelLead->email ?: old('email')  !!}">
                  </div>
                  <div class="col-12 col-sm-6 no-padding-right">
                    <label for="telephone">Teléfono <span class="text-danger">*</span></label>
                    <input type="text" name="telephone" id="telephone" validation-pattern="phone" placeholder="Teléfono"
                      class="form-control" value="{!! $digitalChannelLead->telephone ?: old('telephone')  !!}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-12 col-sm-6">
                    <label for="city">Ciudad <span class="text-danger">*</span></label>
                    <select name="city" id="city" class="form-control" enabled>
                      @if(!empty($cities))
                      @foreach($cities as $city)
                      <option @if($leadCity==$city->CIUDAD) selected="selected" @endif value="{{ $city->CIUDAD }}">
                        {{ $city->CIUDAD }}
                      </option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="col-12 col-sm-6 no-padding-right">
                    <label for="channel">Canal de adquisición <span class="text-danger">*</span></label>
                    <select name="channel" id="channel" class="form-control" enabled>
                      @if(!empty($channels))
                      @foreach($channels as $channel)
                      <option @if($leadChannel==$channel->id) selected="selected" @endif
                        value="{{ $channel->id }}">
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
                    <input type="text" name="nearbyCity" id="nearbyCity" validation-pattern="text"
                      placeholder="Ciudad Aledaña" class="form-control"
                      value="{!! $digitalChannelLead->nearbyCity ?: old('nearbyCity')  !!}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="campaign">Campaña</label>
                  <select name="campaign" id="campaign" class="form-control" enabled>
                    @if(!empty($campaigns))
                    @foreach($campaigns as $campaign)
                    <option @if($leadCampaign==$campaign->id) selected="selected" @endif
                      value="{{ $campaign->id }}">
                      {{ $campaign->name }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
                <div class="form-group row">
                  <div class="col-12 col-sm-6">
                    <label for="typeService">Servicio <span class="text-danger">*</span></label>
                    <select name="typeService" id="typeService" class="form-control" enabled>
                      @if(!empty($services))
                      @foreach($services as $service)
                      <option @if($leadService==$service->id) selected="selected" @endif
                        value="{{ $service->id }}">
                        {{ $service->service }}
                      </option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="col-12 col-sm-6 no-padding-right">
                    <label for="product">Producto <span class="text-danger">*</span></label>
                    <select name="typeProduct" id="typeProduct" class="form-control" enabled>
                      @if(!empty($lead_products))
                      @foreach($lead_products as $lead_product)
                      <option @if($leadProduct==$lead_product->id) selected="selected" @endif
                        value="{{ $lead_product->id }}">
                        {{ $lead_product->lead_product }}
                      </option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="col-12 col-sm-12 no-padding-right">
                  <label for="telephone">Observación <span class="text-danger">*</span></label>
                  <input type="textarea" name="description" id="description" validation-pattern="text"
                    placeholder="Observación" class="form-control"
                    value="{!! $digitalChannelLead->description ?: old('description')  !!}">
                </div>
                <div class="row">
                  <div class="col-6 d-flex align-items-end">
                    <div class="form-group w-100">
                      <label for="state">Estado</label>
                      <select name="state" id="state" class="form-control" enabled>
                        @if(!empty($lead_statuses))
                        @foreach($lead_statuses as $lead_status)
                        <option @if($leadStatus==$lead_status->id) selected="selected" @endif
                          value="{{ $lead_status->id }}">
                          {{ $lead_status->status }}
                        </option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-6 d-flex align-items-end">
                    <div class="form-group w-100">
                      <label for="assessor_id">Asesor</label>
                      <select class="form-control  select2" id="assessor_id" name="assessor_id"
                        ng-model="lead.assessor_id" style="width: 100%;">
                        <option disabled selected value> -- Selecciona Asesor-- </option>
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