<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-12 text-right">
      <a target="_blank" href="/Administrator/assessorquotations/create?q={{$digitalChannelLead->id}}" <i class="btn btn-primary btn-sm"><i
            class="fa fa-edit"></i>
          Agregar Cotizacion</a>
      </div>
      <div class="col-8">
        <h2 class="title-table"><i class="fas fa-user mr-2"></i> Cotizaciones
          </span>
        </h2>
      </div>
    </div>
  </div>
  <div class="card-body table-responsive pt-1">
    @if($digitalChannelLead->leadQuotations->isNotEmpty())
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Asesor</th>
          <th class="text-center" scope="col">Productos</th>
          <th class="text-center" scope="col">Monto</th>
          <th class="text-center" scope="col">Estado</th>
          <th class="text-center" scope="col">Fecha</th>
          <th class="text-center" scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody class="body-table text-center">

        @foreach ($digitalChannelLead->leadQuotations as $leadPrice)

      <tr>
        <td>{{$leadPrice->assessor->name}}</td>
        <td>
           @foreach ($leadPrice->quotationValues as $products)
           {{$products->article}} x {{$products->quantity}}
           <br>
           <br>
           @endforeach
        </td>
        <td>$ {{ number_format($leadPrice->total) }}</td>
        <td>@if ($leadPrice->state == 0)
            <span class="badge badge-primary">Sin gestionar</span>
            @else
            <span class="badge badge-success">Liquidado</span>
            @endif
        </td>
        <td>{{$leadPrice->created_at}}</td>
        <td><a leadPrice-toggle="tooltip" title="Ver Cotización"
                href="{{ route('assessorquotations.show', $leadPrice->id) }}"> <i class="far fa-eye"></i></a>
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

                          <div class="row">
                            <div class="col-12 col-sm-12 form-group no-padding-right">
                              <label for="lead_product_id">Producto <span class="text-danger">*</span></label>
                              <select id="lead_product_id" name="lead_product_id" class="form-control">
                                @if ($product_quotations)
                                @foreach($product_quotations as $lead_product)
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
                          <input name="lead_id" id="lead_id" hidden value="{{ $digitalChannelLead->id }}">
                            <div class="form-group">
                             <label for="description">Descripción<span class="text-danger">*</span></label>
                            <textarea id="my-textarea" class="form-control" validation-pattern="text" id="description" name="description" rows="3">{{ $leadPrice->description }}</textarea>
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

        <div class="modal fade" id="deleteLead{{$leadPrice->id}}" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form style="display:inline-block" action="{{ route('leadPrices.destroy', $leadPrice->id) }}"
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
  </div>
</div>


@include('digitalchannelleads.layouts.add_lead_price_modal')