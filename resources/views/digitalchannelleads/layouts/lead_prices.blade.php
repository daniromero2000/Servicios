<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-12">
        <h2 class="title-table"><i class="fas fa-user mr-2"></i> Cotizaciones
          </span>
        </h2>
      </div>
    </div>
  </div>
  <div class="card-body table-responsive pt-1">
    @if($digitalChannelLead->leadPrices->isNotEmpty())
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Cotización</th>
          <th class="text-center" scope="col">Producto</th>
          <th class="text-center" scope="col">Descripción</th>
          <th class="text-center" scope="col">Precio</th>
          <th class="text-center" scope="col">Asesor</th>
          <th class="text-center" scope="col">Fecha</th>
        </tr>
      </thead>
      <tbody class="body-table">

        @foreach ($digitalChannelLead->leadPrices as $leadPrice)

        <tr>
          <td class="text-center">{{ $leadPrice->id }}</td>
          <td class="text-center">{{ $leadPrice->leadProduct->lead_product }}</td>
          <td class="text-center">{{ $leadPrice->description }}</td>
          <td class="text-center">${{ number_format($leadPrice->lead_price) }}</td>
          <td class="text-center">{{ $leadPrice->user->name }}</td>
          <td class="text-center"><span class="badge badge-{{$leadPrice->leadPriceStatus->color}}">
              {{$leadPrice->leadPriceStatus->status}}
            </span></td>
          <td class="text-center">{{ $leadPrice->created_at->format('M d, Y h:i a') }}</td>
          <td> <i class="fas fa-comments cursor" data-toggle="modal"
              data-target="#leadPricemodal{{$leadPrice->id}}"></i>
          </td>
        </tr>
        <div class="modal fade" id="leadPricemodal{{$leadPrice->id}}" tabindex="-1" role="dialog"
          aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Actualizar Cotización</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="row resetRow ">
                    <div class="col-12 form-group">
                      <form action="{{ route('leadPrices.update', $leadPrice->id ) }}" method="post" class="form"
                        enctype="multipart/form-data">
                        <div class="box-body">
                          @csrf
                          @method('PUT')
                          <input name="id" id="lead_id" hidden value="{{ $digitalChannelLead->id }}">
                          <div class="row">
                            <div class="col-12 col-sm-12 form-group no-padding-right">
                              <label for="lead_product_id">Producto <span class="text-danger">*</span></label>
                              <select id="lead_product_id" name="lead_product_id" class="form-control">
                                @if ($lead_products)
                                @foreach($lead_products as $lead_product)
                                <option @if ($leadPrice->leadProduct == $lead_product)
                                  selected="selected" @endif
                                  value="{{ $lead_product->id }}">
                                  {{ $lead_product->lead_product }}
                                </option>
                                @endforeach
                                @endif
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="description">Descripción<span class="text-danger">*</span></label>
                            <div class="input-group">
                              <input type="text" name="description" validation-pattern="text" id="description"
                                placeholder="Descripcioón" class="form-control" value="{{ $leadPrice->description }}"
                                required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="lead_price">Precio <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <input type="number" name="lead_price" validation-pattern="text" id="lead_price"
                                placeholder="Precio" class="form-control" value="{{ $leadPrice->lead_price }}" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="lead_price_status_id">Estado <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <select id="lead_price_status_id" name="lead_price_status_id" class="form-control">
                                @if ($leadPriceStatus)
                                @foreach($leadPriceStatus as $leadPriceState)
                                <option @if ($leadPrice->leadPriceStatus == $leadPriceState)
                                  selected="selected" @endif
                                  value="{{ $leadPriceState->id }}">
                                  {{ $leadPriceState->status }}
                                </option>
                                @endforeach
                                @endif
                              </select>
                              {{-- <input type="text" name="lead_price_status_id" validation-pattern="text"
                                id="lead_price_status_id" placeholder="Precio" class="form-control"
                                value=" {{$leadPrice->leadPriceStatus->status}}" required>
                              {{$leadPrice->leadPriceStatus->status}} --}}
                            </div>
                          </div>
                        </div>
                        <div class="box-footer">
                          <div class="btn-group">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                          </div>
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
      </tbody>
    </table>
    @else
    <table class="table table-hover table-stripped leadTable">
      <tbody class="body-table">
        <tr>
          <td>
            Aún no tiene Cotizaciones
          </td>
        </tr>
      </tbody>

    </table>

    @endif
    <div class="row">
      <div class="col">
        <a href="#myModal" data-toggle="modal" data-target="#leadPricemodal" <i class="btn btn-primary btn-sm"><i
            class="fa fa-edit"></i>
          Agregar Cotizacion</a>
      </div>
    </div>
  </div>
</div>


@include('digitalchannelleads.layouts.add_lead_price_modal')