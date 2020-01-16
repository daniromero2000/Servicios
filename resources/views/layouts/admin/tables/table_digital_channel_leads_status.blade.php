@php
use Carbon\Carbon;
@endphp

<div class="table-responsive mb-3 p-0 height-table">
    <table class="table table-head-fixed">
        <thead class="text-center header-table">
            <tr>
                @foreach ($headers as $header)
                <th scope="col">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="body-table">
            @foreach($datas as $data)
            <tr>
                <td><span class="text-center badge"
                        style="color: white ; background-color:
                        @if($data->created_at->diffInDays(Carbon::now()) <= 1) green @endif
                        @if($data->created_at->diffInDays(Carbon::now()) <= 2 && $data->created_at->diffInDays(Carbon::now()) >1) yellow @endif
                        @if($data->created_at->diffInDays(Carbon::now()) >= 3) red @endif
                        @if($data->state === 2 || $data->state === 5 || $data->state === 6 || $data->state === 9 || $data->state === 4 || $data->state === 7) gray @endif"
                        class=" btn btn-info btn-block"><i class="fa fa-bell-o"></i> </span></td>
                <td> @if($data->leadStatuses) <span class="text-center badge"
                        style="color: white ; background-color: {{$data->leadStatuses->color }}"
                        class="btn btn-info btn-block">{{ $data->leadStatuses->status}}</span> @endif</td>
                <td>{{ $data->leadChannel->channel}}</td>
                <td>
                    @if($data->leadAssessor)
                        {{ $data->leadAssessor['name'] }}
                    @endif
                </td>
                <td><a href="{{ route('digitalchannelleads.show', $data->id) }}" data-toggle="tooltip"
                        title="Ver Cliente">{{ $data->name}} {{ $data->lastName}} </a></td>

                <td>{{ $data->telephone}}</td>
                <td>{{ $data->city}}/{{ $data->nearbyCity}}</td>
                <td> @if($data->leadService) {{ $data->leadService->service}} @else
                    {{$data->typeService}}
                    @endif</td>
                <td>
                    @if($data->leadProduct) {{ $data->leadProduct->lead_product }} @else
                    {{$data->typeProduct}} @endif</td>
                <td>{{ $data->created_at->format('M d, Y h:i a')}}</td>
                <td>
                    <form style="display:inline-block" action="{{ route('digitalchannelleads.destroy', $data->id) }}"
                        method="post" class="form-horizontal">
                        <input type="hidden" name="_method" value="delete">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <a href="#" title="Borrar Lead" onclick="return confirm('¿Estás Seguro?')" type="submit"
                            class="iconList"><i class="fas fa-times cursor"></i></a>
                    </form>
                        <i class="fas fa-edit cursor" data-toggle="modal" data-target="#editLead{{$data->id}}"></i>
                </td>
            </tr>

                            <div class="modal fade" id="editLead{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                            <form action="{{ route('digitalchannelleads.update', $data->id) }}" method="post"
                                              class="form">
                                              @csrf
                                              @method('PUT')

                                              <div class="form-group row">
                                                <div class="col-12 col-sm-6 no-padding-right">
                                                  <label for="lastName">Cédula </label>
                                                  <input type="text" name="identificationNumber" id="identificationNumber"
                                                    class="form-control" validation-pattern="IdentificationNumber" value="{!! $data->identificationNumber ?: old('lastName')  !!}">
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                  <label for="name">Nombre <span class="text-danger">*</span></label>
                                                  <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre"
                                                    class="form-control" value="{!! $data->name ?: old('name')  !!}" required>
                                                </div>
                                                <div class="col-12 col-sm-6 no-padding-right">
                                                  <label for="lastName">Apellido <span class="text-danger">*</span></label>
                                                  <input type="text" name="lastName" id="lastName" validation-pattern="name" placeholder="Apellido"
                                                    class="form-control" value="{!! $data->lastName ?: old('lastName')  !!}" required>
                                                </div>
                                              </div>
                                              <div class="form-group row">
                                                <div class="col-12 col-sm-6">
                                                  <label for="email">email </label>
                                                  <input type="text" name="email" id="email" validation-pattern="email" placeholder="Email"
                                                    class="form-control" value="{!! $data->email ?: old('email')  !!}">
                                                </div>
                                                <div class="col-12 col-sm-6 no-padding-right">
                                                  <label for="telephone">Teléfono </label>
                                                  <input type="text" name="telephone" id="telephone" validation-pattern="phone" placeholder="Teléfono"
                                                    class="form-control" value="{!! $data->telephone ?: old('telephone')  !!}" >
                                                </div>
                                              </div>


                                              <div class="form-group row">
                                                <div class="col-12 col-sm-6">
                                                  <label for="city">Ciudad <span class="text-danger">*</span></label>
                                                  <select name="city" id="city" class="form-control" enabled>
                                                    @if(!empty($cities))
                                                    @foreach($cities as $city)
                                                    <option @if($data->city==$city->CIUDAD) selected="selected" @endif value="{{ $city->CIUDAD }}">
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
                                                    <option @if($data->channel==$channel->id) selected="selected" @endif
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
                                                    value="{!! $data->nearbyCity ?: old('nearbyCity')  !!}">
                                                </div>
                                              </div>
                                              <div class="form-group row">
                                                <label for="campaign">Campaña</label>
                                                <select name="campaign" id="campaign" class="form-control" enabled>
                                                  @if(!empty($campaigns))
                                                  @foreach($campaigns as $campaign)
                                                  <option @if($data->campaing==$campaign->id) selected="selected" @endif
                                                    value="{{ $campaign->id }}">
                                                    {{ $campaign->name }}
                                                  </option>
                                                  @endforeach
                                                  @endif
                                                </select>
                                              </div>
                                              <div class="form-group row">
                                                <div class="col-12 col-sm-6">
                                                  <label for="typeService">Servicio </label>
                                                  <select name="typeService" id="typeService" class="form-control" enabled>
                                                    @if(!empty($services))
                                                    @foreach($services as $service)
                                                    <option @if($data->typeService==$service->id) selected="selected" @endif
                                                      value="{{ $service->id }}">
                                                      {{ $service->service }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                  </select>
                                                </div>
                                                <div class="col-12 col-sm-6 no-padding-right">
                                                  <label for="product">Producto </label>
                                                  <select name="typeProduct" id="typeProduct" class="form-control" enabled>
                                                    @if(!empty($lead_products))
                                                    @foreach($lead_products as $lead_product)
                                                    <option @if($data->typeProduct==$lead_product->id) selected="selected" @endif
                                                      value="{{ $lead_product->id }}">
                                                      {{ $lead_product->lead_product }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="col-12 col-sm-12 no-padding-right">
                                                <label for="telephone">Observación </label>
                                                <input type="textarea" name="description" id="description" validation-pattern="text"
                                                  placeholder="Observación" class="form-control"
                                                  value="{!! $data->description ?: old('description')  !!}">
                                              </div>
                                              <div class="row">
                                                <div class="col-6 d-flex align-items-end">
                                                  <div class="form-group w-100">
                                                    <label for="state">Estado</label>
                                                    <select name="state" id="state" class="form-control" enabled>
                                                      @if(!empty($lead_statuses))
                                                      @foreach($lead_statuses as $lead_status)
                                                      <option @if($data->state==$lead_status->id) selected="selected" @endif
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
            @endforeach
        <tbody>
    </table>
</div>