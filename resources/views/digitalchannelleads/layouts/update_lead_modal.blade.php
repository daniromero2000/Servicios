<!--Update modal-->
<div class="modal fade" id="updateleadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Actualizar Lead</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <form action="{{ route('digitalchannelleads.update', $digitalChannelLead->id) }}" method="post"
                class="form">
                @csrf
                @method('PUT')

                <div class="row">
                  <div class="col-lg-6">
                    <div class="card card-success">
                      <div class="card-header bg-primary">
                        <h3 class="card-title">Información Básica</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                              class="fas fa-minus text-white"></i>
                          </button>
                        </div>
                        <!-- /.card-tools -->
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="lastName">Cédula <span class="text-danger">*</span></label>
                            <input type="text" name="identificationNumber" id="identificationNumber"
                              class="form-control" validation-pattern="IdentificationNumber"
                              value="{!! $digitalChannelLead->identificationNumber ?: old('lastName')  !!}" required>
                          </div>
                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="name">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre"
                              class="form-control" value="{!! $digitalChannelLead->name ?: old('name')  !!}" required>
                          </div>
                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="lastName">Apellido <span class="text-danger">*</span></label>
                            <input type="text" name="lastName" id="lastName" validation-pattern="name"
                              placeholder="Apellido" class="form-control"
                              value="{!! $digitalChannelLead->lastName ?: old('lastName')  !!}" required>
                          </div>
                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="email">email </label>
                            <input type="text" name="email" id="email" validation-pattern="email" placeholder="Email"
                              class="form-control" value="{!! $digitalChannelLead->email ?: old('email')  !!}">
                          </div>
                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="telephone">Teléfono <span class="text-danger">*</span></label>
                            <input type="text" name="telephone" id="telephone" validation-pattern="phone"
                              placeholder="Teléfono" class="form-control"
                              value="{!! $digitalChannelLead->telephone ?: old('telephone')  !!}" required>
                          </div>
                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="city">Ciudad <span class="text-danger">*</span></label>
                            <select name="city" id="city" class="form-control" enabled>
                              @if(!empty($cities))
                              @foreach($cities as $city)
                              <option @if($leadCity==$city->NOMBRE) selected="selected" @endif
                                value="{{ $city->NOMBRE }}">
                                {{ $city->NOMBRE }}
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
                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="name">Ciudad aledaña</label>
                            <input type="text" name="nearbyCity" id="nearbyCity" validation-pattern="text"
                              placeholder="Ciudad Aledaña" class="form-control"
                              value="{!! $digitalChannelLead->nearbyCity ?: old('nearbyCity')  !!}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="card card-success">
                      <div class="card-header bg-success">
                        <h3 class="card-title">Asignación</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                              class="fas fa-minus text-white"></i>
                          </button>
                        </div>
                        <!-- /.card-tools -->
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12 col-sm-6 no-padding-right">
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
                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="typeAreaSelectEdit{{$digitalChannelLead->id}}">Selecciona Area </label>
                            <select onchange="ontypeServiceSelectedProductEditModal({{$digitalChannelLead->id}})"
                              name="lead_area_id" id="typeAreaSelectEdit{{$digitalChannelLead->id}}"
                              class="form-control" style="width: 100%;">
                              <option disabled selected value=""> -- Selecciona Area -- </option>
                              @if(!empty($areas))
                              @foreach($areas as $area)
                              <option @if($digitalChannelLead->lead_area_id==$area->id) selected="selected" @endif
                                value="{{ $area->id }}">
                                {{ $area->name }}
                              </option>
                              @endforeach
                              @endif
                            </select>
                          </div>
                          <div class="col-12 col-sm-6 no-padding-right" id="SubsidiaryEdit{{$digitalChannelLead->id}}">
                            <label for="expirationDateSoat">Sucursal</label>
                            <select name="subsidiary_id" id="subsidary{{$digitalChannelLead->id}}"
                              class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                              data-select3-id="1" tabindex="-1" aria-hidden="true">
                              @if(!empty($subsidaries))
                              @foreach($subsidaries as $subsidary)
                              <option data-select3-id="{{ $subsidary->CODIGO }}" @if($digitalChannelLead->subsidiary_id
                                ==
                                $subsidary->CODIGO)
                                selected="selected" @endif
                                value="{{ $subsidary->CODIGO }}">
                                {{ $subsidary->CODIGO }}
                              </option>
                              @endforeach
                              @endif
                            </select>
                          </div>
                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="typeServiceSelectedEdit{{$digitalChannelLead->id}}">Servicio <span
                                class="text-danger">*</span></label>
                            <select name="typeService" id="typeServiceSelectedEdit{{$digitalChannelLead->id}}"
                              class="form-control" enabled>
                              @if($digitalChannelLead->leadService)
                              <option value="{{ $digitalChannelLead->leadService['id'] }}" selected="selected">
                                {{$digitalChannelLead->leadService['service']}}
                              </option>
                              @endif
                            </select>
                          </div>
                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="typeProductselectedit{{$digitalChannelLead->id}}">Producto <span
                                class="text-danger">*</span></label>
                            <select name="typeProduct" id="typeProductselectedit{{$digitalChannelLead->id}}"
                              class="form-control" enabled>
                              @if(!empty($digitalChannelLead->leadProduct))
                              <option value="{{ $digitalChannelLead->leadProduct['id'] }}" selected="selected">
                                {{$digitalChannelLead->leadProduct['lead_product']}}
                              </option>
                              @endif
                            </select>
                          </div>
                          @php
                          $originalDate = $digitalChannelLead->expirationDateSoat;
                          $newDate = date('Y-m-d', strtotime($originalDate));
                          @endphp
                          <div class="col-12 col-sm-6 no-padding-right" id="fechExpiration{{$digitalChannelLead->id}}">
                            <label for="expirationDateSoat">Fecha de Vencimiento</label>
                            <input type="date" name="expirationDateSoat" class="form-control "
                              value="@if($digitalChannelLead->expirationDateSoat){{$newDate}}@endif">
                          </div>

                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="stateSelectEdit{{$digitalChannelLead->id}}">Estado</label>
                            <select name="state" id="stateSelectEdit{{$digitalChannelLead->id}}" class="form-control"
                              enabled>
                              @if($digitalChannelLead->state)
                              <option value="{{ $digitalChannelLead->state }}">
                                -- Selecciona Estado --
                              </option>
                              @endif
                            </select>
                          </div>
                          <div class="col-12 col-sm-6 no-padding-right">
                            <label for="selectAssessorEdit{{$digitalChannelLead->id}}">Asesor</label>
                            <select class="form-control  " id="selectAssessorEdit{{$digitalChannelLead->id}}"
                              name="assessor_id" ng-model="lead.assessor_id" style="width: 100%;">
                              @if($digitalChannelLead->leadAssessor)
                              <option value="{{ $digitalChannelLead->leadAssessor->id }}" selected="selected"
                                style="width: 100%;">
                                {{ $digitalChannelLead->leadAssessor->name }}
                              </option>
                              @endif
                            </select>
                          </div>
                          <div class="col-12 col-sm-12 no-padding-right">
                            <label for="telephone">Observación <span class="text-danger">*</span></label>
                            <input type="textarea" name="description" id="description" validation-pattern="text"
                              placeholder="Observación" class="form-control"
                              value="{!! $digitalChannelLead->description ?: old('description')  !!}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group text-left w-100 d-flex mb-0">
                  <button class="btn btn-primary ml-auto">Actualizar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>