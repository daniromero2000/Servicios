
<div class="table-responsive">
     <table class="table align-items-center table-flush table-hover">
          <thead class="thead-light">
               <tr>
                    @foreach ($headers as $header)
                    <th class="text-center" scope="col">{{ $header }}</th>
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
                                   <h5 class="modal-title">Actualizar <b>Compañia {{$data->name}}</b></h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                   </button>
                              </div>
                              <form action="{{ route('admin.companies.update', $data->id) }}" method="post"
                                   class="form" enctype="multipart/form-data">
                                   @method('PUT')
                                   @csrf
                                   <div class="modal-body py-0">
                                        <input name="company_id" id="company_id" type="hidden"
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
                                                            for="identification{{ $data->id }}">Número Identificación</label>
                                                       <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                 <span class="input-group-text"><i
                                                                           class="fa fa-phone"></i></span>
                                                            </div>
                                                            <input type="text" name="identification" id="identification{{ $data->id }}"
                                                                 placeholder="Número de Identificación" validation-pattern="text"
                                                                 class="form-control"
                                                                 value="{!! $data->identification ?: old('identification')  !!}" required>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                       <label class="form-control-label"
                                                            for="company_type{{ $data->id }}">Tipo de Identificación</label>
                                                       <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                 <span class="input-group-text"> <i
                                                                           class="fa fa-clock-o"></i></span>
                                                            </div>

                                                            <select name="company_type" id="company_type{{ $data->id }}"
                                                                 class="form-control">
                                                                 <option selected="selected" value="1">
                                                                      Natural</option>
                                                                 <option value="2">Jurídica
                                                                 </option>
                                                            </select>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-sm-6">
                                                  <div id="countries" class="form-group">
                                                       <label class="form-control-label"
                                                            for="country_id{{ $data->id }}">País</label>
                                                       <div class="input-group">
                                                            <select name="country_id" id="country_id{{ $data->id }}"
                                                                 class="form-control">
                                                                 @foreach($countries as $country)
                                                                 @if($country->id == $data->country_id)
                                                                 <option selected="selected" value="{{ $country->id }}">
                                                                      {{ $country->name }}</option>
                                                                 @else
                                                                 <option value="{{ $country->id }}">{{ $country->name }}
                                                                 </option>
                                                                 @endif
                                                                 @endforeach
                                                            </select>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-sm-6">
                                                  <div id="countries" class="form-group">
                                                       <label class="form-control-label"
                                                            for="base_currency_id{{ $data->id }}">Tipo de Moneda</label>
                                                       <div class="input-group">
                                                            <select name="base_currency_id" id="base_currency_id{{ $data->id }}"
                                                                 class="form-control">
                                                                 <option selected="selected" value="1">
                                                                      US Dolar</option>
                                                                 <option value="2">Euro
                                                                 </option>
                                                                 <option value="3">Colombian Peso
                                                                 </option>
                                                            </select>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-sm-12">
                                                  <div class="form-group">
                                                       <label for="description">Descripción </label>
                                                       <textarea class="form-control ckeditor" name="description" id="description" rows="5"
                                                            >{!! $data->description ?: old('description')  !!}</textarea>
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