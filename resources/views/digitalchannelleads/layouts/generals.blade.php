<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-8">
        <h2 class="title-table"><i class="fas fa-user mr-2"></i>{{ $digitalChannelLead->name }}
          {{ $digitalChannelLead->lastName }}
          </span>
        </h2>
        <span class="text-center badge" style="color: white ; background-color: {{$digitalChannelLead->leadStatuses->color }}"
          class="btn btn-info btn-block">{{ $digitalChannelLead->leadStatuses->status}}</span>
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
          <th class="text-center" scope="col">Crédito</th>
          <th class="text-center" scope="col">Avance</th>
          <th class="text-center" scope="col">Lead</th>
        </tr>
      </thead>
      <tbody class="body-table">
        <tr>
          <td class="text-center">{{ $digitalChannelLead->created_at }}</td>
          <td class="text-center">{{ $digitalChannelLead->email }}</td>
          <td class="text-center">{{ $digitalChannelLead->telephone }}</td>
          <td class="text-center">{{ $digitalChannelLead->city }}</td>
          <td class="text-center">{{ $digitalChannelLead->typeServie }}</td>
          <td class="text-center">{{ $digitalChannelLead->typeProduct }}</td>
          <td class="text-center">{{ $digitalChannelLead->EDAD }}</td>
          <td class="text-center">{{ $digitalChannelLead->TIEMPO_LABOR }}</td>
          <td class="text-center">{{ $digitalChannelLead->TIPO_5_ESPECIAL }}</td>
          <td class="text-center">{{ $digitalChannelLead->INSPECCION_OCULAR }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>