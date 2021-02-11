<div class="table-responsive">
     <table class="table align-items-center table-flush table-hover">
          <thead class="thead-light">
               <tr>
                    @foreach ($headers as $header)
                    <th class="text-center" scope="col">{{$header}}</th>
                    @endforeach
               </tr>
          </thead>
          <tbody>
               @foreach($datas as $data)
               <tr>
                    @foreach($data->toArray() as $key => $value)
                    <td class="text-center">
                         {{ $data[$key] }}
                    </td>
                    @endforeach
                    <td class="text-center">{{ $data->city->city }}</td>
                    <td class="text-center">
                         @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                         $optionsRoutes])
                    </td>
               </tr>
               <!-- Modal -->
               <div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <h5 class="modal-title">Actualizar <b>{{$data->name}}</b></h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                   </button>
                              </div>
                              <form action="{{ route('admin.subsidiaries.update', $data->id) }}" method="post"
                                   class="form" enctype="multipart/form-data">
                                   @method('PUT')
                                   @csrf
                                   <div class="modal-body py-0">
                                        <input name="notification_id" id="notification_id" type="hidden"
                                             value="{{ $data->id }}">
                                        <div class="row">
                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                       <label class="form-control-label"
                                                            for="name{{ $data->id }}">Nombre</label>
                                                       <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                 <span class="input-group-text"><i
                                                                           class="fas fa-user"></i></span>
                                                            </div>
                                                            <input type="text" name="name" id="name{{ $data->id }}"
                                                                 placeholder="Nombre" validation-pattern="text"
                                                                 class="form-control"
                                                                 value="{!! $data->name ?: old('name')  !!}" required>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                       <label class="form-control-label"
                                                            for="address{{ $data->id }}">Dirección</label>
                                                       <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                 <span class="input-group-text"><i
                                                                           class="fa fa-map-marker"></i></span>
                                                            </div>
                                                            <input type="text" name="address"
                                                                 id="address{{ $data->id }}" placeholder="Dirección"
                                                                 validation-pattern="text" class="form-control"
                                                                 value="{!! $data->address ?: old('address')  !!}"
                                                                 required>

                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                       <label class="form-control-label"
                                                            for="phone{{ $data->id }}">Teléfono</label>
                                                       <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                 <span class="input-group-text"><i
                                                                           class="fa fa-phone"></i></span>
                                                            </div>
                                                            <input type="text" name="phone" id="phone{{ $data->id }}"
                                                                 placeholder="Teléfono" validation-pattern="telephone"
                                                                 class="form-control"
                                                                 value="{!! $data->phone ?: old('phone')  !!}" required>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-sm-6">
                                                  <div id="cities" class="form-group">
                                                       <label class="form-control-label"
                                                            for="city_id{{ $data->id }}">Ciudad</label>
                                                       <div class="input-group">
                                                            <select name="city_id" id="city_id{{ $data->id }}"
                                                                 class="form-control">
                                                                 @foreach($cities as $city)
                                                                 @if($city->id == $data->city_id)
                                                                 <option selected="selected" value="{{ $city->id }}">
                                                                      {{ $city->city }}</option>
                                                                 @else
                                                                 <option value="{{ $city->id }}">{{ $city->city }}
                                                                 </option>
                                                                 @endif
                                                                 @endforeach
                                                            </select>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                       <label class="form-control-label"
                                                            for="opening_hours{{ $data->id }}">Horario Atenciòn</label>
                                                       <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                 <span class="input-group-text"> <i
                                                                           class="fa fa-clock-o"></i></span>
                                                            </div>
                                                            <input type="text" name="opening_hours"
                                                                 id="address{{ $data->id }}" placeholder="Horario"
                                                                 validation-pattern="text" class="form-control"
                                                                 value="{!! $data->opening_hours ?: old('opening_hours')  !!}"
                                                                 required>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                        <button type="button" class="btn btn-secondary btn-sm"
                                             data-dismiss="modal">Cerrar</button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               @endforeach
          <tbody>
     </table>
</div>