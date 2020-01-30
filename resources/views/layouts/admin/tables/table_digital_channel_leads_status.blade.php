@php
use Carbon\Carbon;
@endphp
<div class="lds-hourglass"></div>
<div class="table-responsive mb-3 p-0 height-table">
  <table class="table table-head-fixed text-center ">
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
                        @if($data->created_at->diffInDays(Carbon::now()) <= 1) #0bb010 @endif
                        @if($data->created_at->diffInDays(Carbon::now()) <= 2 && $data->created_at->diffInDays(Carbon::now()) >1) #ff9900 @endif
                        @if($data->created_at->diffInDays(Carbon::now()) >= 3) #b0130b @endif
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
        <td> {{$data->leadArea->name}}
        </td>
        <td> @if($data->leadService) {{ $data->leadService->service}} @else
          {{$data->typeService}}
          @endif</td>
        <td>
          @if($data->leadProduct) {{ $data->leadProduct->lead_product }} @else
          {{$data->typeProduct}} @endif</td>
        <td>{{ $data->created_at->format('M d, Y h:i a')}}</td>
        <td>
          <i class="fas fa-trash-alt cursor" data-toggle="modal" data-target="#deleteLead{{$data->id}}"></i>
          <i class="fas fa-edit cursor" data-toggle="modal" onclick="dataLead({{$data->id}})"
            data-target="#editLead{{$data->id}}"></i>
          <i class="fas fa-comments cursor" data-toggle="modal" data-target="#addComment{{$data->id}}"></i>

        </td>
      </tr>

      <div class="modal fade" id="deleteLead{{$data->id}}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form style="display:inline-block" action="{{ route('digitalchannelleads.destroy', $data->id) }}"
              method="post" class="form-horizontal">
              <input type="hidden" name="_method" value="delete">
              @csrf
              <input type="hidden" name="_method" value="delete">
              <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                Estas Seguro ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

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
                    <form action="{{ route('digitalchannelleads.update', $data->id) }}" method="post" class="form">
                      @csrf
                      @method('PUT')
                      <div class="form-group row">
                        <div class="col-12 col-sm-6 no-padding-right">
                          <label for="lastName">Cédula </label>
                          <input type="text" name="identificationNumber" id="identificationNumber" class="form-control"
                            value="{!! $data->identificationNumber ?: old('lastName')  !!}">
                        </div>
                        <input hidden type="text" id="valueModal" value="{{$data->id}}">
                        <div class="col-12 col-sm-6">
                          <label for="name">Nombre <span class="text-danger">*</span></label>
                          <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre"
                            class="form-control" value="{!! $data->name ?: old('name')  !!}" required>
                        </div>
                        <div class="col-12 col-sm-6 no-padding-right">
                          <label for="lastName">Apellido <span class="text-danger">*</span></label>
                          <input type="text" name="lastName" id="lastName" validation-pattern="name"
                            placeholder="Apellido" class="form-control"
                            value="{!! $data->lastName ?: old('lastName')  !!}" required>
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
                          <input type="text" name="telephone" id="telephone" validation-pattern="phone"
                            placeholder="Teléfono" class="form-control"
                            value="{!! $data->telephone ?: old('telephone')  !!}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-12 col-sm-6">
                          <label for="city{{$data->id}}">Ciudad <span class="text-danger">*</span></label>
                          <select name="city" id="city{{$data->id}}" class="form-control " style="width: 100%;">
                            @if(!empty($cities))
                            @foreach($cities as $city)
                            <option @if($data->city==$city->CIUDAD) selected="selected" @endif
                              value="{{ $city->CIUDAD }}">
                              {{ $city->CIUDAD }}
                            </option>
                            @endforeach
                            @endif
                          </select>
                        </div>
                        <div class="col-12 col-sm-6 no-padding-right">
                          <label for="channel{{$data->id}}">Canal de adquisición <span
                              class="text-danger">*</span></label>
                          <select name="channel" id="channel{{$data->id}}" class="form-control " style="width: 100%;">
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
                      <div class="form-group ">
                        <label for="campaign{{$data->id}}">Campaña</label>
                        <select name="campaign" id="campaign{{$data->id}}" class="form-control " style="width: 100%;">
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

                      <div class="form-group">
                        <label for="typeAreaSelectEdit{{$data->id}}">Selecciona Area </label>
                        <select onchange="ontypeServiceSelectedProductEditModal({{$data->id}})" name="lead_area_id"
                          id="typeAreaSelectEdit{{$data->id}}" class="form-control " style="width: 100%;">
                          <option disabled selected value=""> -- Selecciona Area -- </option>
                          @if(!empty($areas))
                          @foreach($areas as $area)
                          <option @if($data->lead_area_id==$area->id) selected="selected" @endif
                            value="{{ $area->id }}">
                            {{ $area->name }}
                          </option>
                          @endforeach
                          @endif
                        </select>
                      </div>
                      <div class="form-group row">
                        <div class="col-12 col-sm-6">
                          <label for="typeServiceSelectedEdit{{$data->id}}">Servicio </label>
                          <select name="typeService" id="typeServiceSelectedEdit{{$data->id}}" class="form-control "
                            style="width: 100%;">
                            @if ($data->leadService)
                            <option value="{{ $data->leadService['id'] }}">
                              {{ $data->leadService['service'] }}
                            </option>
                            @endif
                          </select>
                        </div>
                        <div class="col-12 col-sm-6 no-padding-right">
                          <label for="typeProductselectedit{{$data->id}}">Producto </label>
                          <select name="typeProduct" id="typeProductselectedit{{$data->id}}" class="form-control "
                            style="width: 100%;">
                            @if ($data->leadProduct)
                            <option value="{{ $data->leadProduct->id }}">
                              {{ $data->leadProduct->lead_product }}
                            </option>
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="telephone">Observación </label>
                        <input type="textarea" name="description" id="description" validation-pattern="text"
                          placeholder="Observación" class="form-control"
                          value="{!! $data->description ?: old('description')  !!}">
                      </div>
                      <div class="row">
                        <div class="col-6 d-flex align-items-end">
                          <div class="form-group">
                            <label for="stateSelectEdit{{$data->id}}">Selecciona Estado </label>
                            <select name="state" id="stateSelectEdit{{$data->id}}" class="form-control "
                              style="width: 100%;">
                              @if($data->state)
                              <option disabled selected value> -- Selecciona Estado -- </option>
                              @endif
                            </select>
                          </div>
                        </div>
                        <div class="col-6 d-flex align-items-end">
                          <div class="form-group w-100">
                            <label for="assessor_id{{$data->id}}">Asesor</label>
                            <select class="form-control  " id="assessor_id {{$data->id}}" name="assessor_id"
                              ng-model="lead.assessor_id" style="width: 100%;"> @if(!empty($listAssessors))
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
                      </div>
                      <div class="form-group mt-3 text-left">
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

      <div class="modal fade" id="addComment{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Actualizar Lead</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <div class="box">
                <form action="{{ route('Comments.store') }}" method="post" class="form" enctype="multipart/form-data">
                  <div class="box-body">
                    @csrf
                    <input name="idLead" id="idLead" hidden value="{{ $data->id }}">
                    <div class="form-group">

                      <label for="comment">Comentario <span class="text-danger">*</span></label>
                      <input type="text" name="comment" validation-pattern="text" id="comment" placeholder="Comentario"
                        class="form-control" value="{{ old('comment') }}" required autofocus>
                    </div>
                  </div>
                  <div class="box-footer">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      @endforeach
    <tbody>
  </table>
</div>