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
          <td class="text-center">{{ $leadPrice->created_at->format('M d, Y h:i a') }}</td>
        </tr>
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