<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-8">
        <h2 class="title-table"><i class="fas fa-user mr-2"></i>{{ $digitalChannelLead->name }}
          {{ $digitalChannelLead->lastName }} ({{ $digitalChannelLead->identificationNumber }})
          </span>
        </h2>
        <span class="text-center badge"
          style="color: white ; background-color: {{$digitalChannelLead->leadStatuses->color }}"
          class="btn btn-info btn-block">{{ $digitalChannelLead->leadStatuses->status}}</span>
        @if($digitalChannelLead->leadAssessor)
        {{ $digitalChannelLead->leadAssessor['name']}}
        @endif
      </div>
      <div class="col-4 text-right">
        <button class="btn btn-primary btn-sm">
          <a data-toggle="modal" data-target="#addleadmodal">Agregar Lead <i class="far fa-plus-square"></i></a>
        </button>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateleadModal">
          Editar <i class="fas fa-edit    "></i>
        </button>
      </div>
    </div>
  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Fecha Ingreso</th>
          <th class="text-center" scope="col">Email</th>
          <th class="text-center" scope="col">Telefono</th>
          <th class="text-center" scope="col">Ciudad</th>
          <th class="text-center" scope="col">Servicio</th>
          <th class="text-center" scope="col">Producto</th>
          <th class="text-center" scope="col">Observación</th>
          <th class="text-center" scope="col">Canal</th>
        </tr>
      </thead>
      <tbody class="body-table">
        <tr>
          <td class="text-center">{{ $digitalChannelLead->created_at->format('M d, Y h:i a') }}</td>
          <td class="text-center">{{ $digitalChannelLead->email }}</td>
          <td class="text-center">{{ $digitalChannelLead->telephone }}</td>
          <td class="text-center">{{ $digitalChannelLead->city }}/{{ $digitalChannelLead->nearbyCity }} </td>
          <td class="text-center"> @if($digitalChannelLead->leadService) {{ $digitalChannelLead->leadService->service}}
            @else {{$digitalChannelLead->typeService}}
            @endif</td>
          <td class="text-center">
            @if($digitalChannelLead->leadProduct) {{ $digitalChannelLead->leadProduct->lead_product }} @else
            {{$digitalChannelLead->typeProduct}} @endif</td>
          <td class="text-center">{{ $digitalChannelLead->description }}</td>
          <td class="text-center">{{ $digitalChannelLead->leadChannel->channel }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>