<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-8">
        <h2 class="title-table"><i class="fas fa-user mr-2"></i> Intención {{ $intention->id }}
          </span>
        </h2>
      </div>
      <div class="col-4 text-right"><span class="badge title-table-status badge-primary">
          {{ $intention->ESTADO_INTENCION }}
      </div>
    </div>
  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Fecha de Solicitud</th>
          <th class="text-center" scope="col">Codeudores</th>
          <th class="text-center" scope="col">Asesor</th>
          <th class="text-center" scope="col">Gran Total</th>
          <th class="text-center" scope="col">Credito</th>
          <th class="text-center" scope="col">Avance</th>
          <th class="text-center" scope="col">Lead</th>
        </tr>
      </thead>
      <tbody class="body-table">
        <tr>
          <td class="text-center">{{ $intention->FECHA_INTENCION }}</td>
          <td class="text-center">{{ $intention->definition->DESCRIPCION }}</td>
          <td class="text-center">{{ $intention->ESTADO_OBLIGACIONES }}</td>
          <td class="text-center">{{ $intention->PERFIL_CREDITICIO }}</td>
          <td class="text-center">{{ $intention->HISTORIAL_CREDITO }}</td>
          <td class="text-center">{{ $intention->TARJETA }}</td>
          <td class="text-center">{{ $intention->EDAD }}</td>
          <td class="text-center">{{ $intention->TIEMPO_LABOR }}</td>
          <td class="text-center">{{ $intention->TIPO_5_ESPECIAL }}</td>
          <td class="text-center">{{ $intention->INSPECCION_OCULAR }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>