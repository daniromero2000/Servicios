@if($leads->isNotEmpty())
<div class="container-fluid card card-table-reset pb-5">
  <div class="card-header">
    <h2 class="title-table"><i class="fas fa-cart-arrow-down mr-2"></i></i> Leads
    </h2>
  </div>
  <div class="card-body table-responsive header-table-responsive pt-0">
    <table class="table table-head-fixed table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">ID</th>
          <th class="text-center" scope="col">Fecha</th>
          <th class="text-center" scope="col">Canal</th>
          <th class="text-center" scope="col">Nombres</th>
          <th class="text-center" scope="col">Apellidos</th>
          <th class="text-center" scope="col">Servicio</th>
          <th class="text-center" scope="col">Producto</th>
          <th class="text-center" scope="col">Descripción</th>
          <th class="text-center" scope="col">Estado</th>
          <th class="text-center" scope="col">Asesor</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @foreach ($leads as $lead )
        <tr>
          <td class="text-center"><a data-toggle="tooltip" title="Ver Lead" href="{{ route('digitalchannelleads.show', $lead->id) }}">{{ $lead->id }}</a></td>
          <td class="text-center">{{ date('M d, Y h:i a', strtotime($lead->created_at)) }}</td>
          <td class="text-center">{{ $lead->leadChannel->channel }}</td>
          <td class="text-center">{{ $lead->name }}</td>
          <td class="text-center">{{ $lead->lastName }}</td>
          <td class="text-center">{{ $lead->leadService->service }}</td>
          <td class="text-center">{{ $lead->leadProduct->lead_product }}</td>
          <td class="text-center">{{ $lead->description }}</td>
          <td> @if($lead->leadStatuses) <span class="text-center badge"
              style="color: white ; background-color: {{$lead->leadStatuses->color }}"
              class="btn btn-info btn-block">{{ $lead->leadStatuses->status}}</span> @endif</td>
          <td class="text-center">{{ $lead->leadAssessor->name }}</td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@else
<table class="table table-hover table-stripped leadTable">
  <tbody class="body-table">
    <tr>
      <td>
        No tiene Leads
      </td>
    </tr>
  </tbody>
</table>
@endif