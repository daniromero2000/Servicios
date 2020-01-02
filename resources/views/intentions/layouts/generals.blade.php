<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-8">
        <h2 class="title-table"><i class="fas fa-user mr-2"></i> 
          <span>
            Intención {{ $intention->id }} - <a href="{{ route('customers.show', $intention->CEDULA) }}" data-toggle="tooltip"
              title="Ver Cliente">{{ $intention->CEDULA}}</a>
          </span>
        </h2>
      </div>
      <div class="col-4 text-right"><span class="badge title-table-status badge-primary">
          {{ $intention->intentionStatus->NAME }}
      </div>
    </div>
  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Fecha de Intención</th>
          <th class="text-center" scope="col">Definición</th>
          <th class="text-center" scope="col">Estado Obligaciones</th>
          <th class="text-center" scope="col">Perfil Crediticio</th>
          <th class="text-center" scope="col">Historial Crediticio</th>
          <th class="text-center" scope="col">Crédito</th>
          <th class="text-center" scope="col">Edad</th>
          <th class="text-center" scope="col">Tiempo en Labor</th>
          <th class="text-center" scope="col">Tipo 5 Especial</th>
          <th class="text-center" scope="col">Inspección Ocular</th>
        </tr>
      </thead>
      <tbody class="body-table">
        <tr>
          <td class="text-center">{{ $intention->FECHA_INTENCION }}</td>
          <td class="text-center">{{ $intention->definition->DESCRIPCION }}</td>
          <td class="text-center">
            @if ($intention->ESTADO_OBLIGACIONES == 1)Normal @endif
            @if ($intention->ESTADO_OBLIGACIONES === 0)En Mora @endif
            @if ($intention->ESTADO_OBLIGACIONES === null)Sin Datos @endif
          </td>
          <td class="text-center">{{ $intention->PERFIL_CREDITICIO }}</td>
          <td class="text-center">
            @if ($intention->HISTORIAL_CREDITO == 1)Con Historial @endif
            @if ($intention->HISTORIAL_CREDITO == 0)Sin Historial @endif
          </td>
          <td class="text-center">{{ $intention->TARJETA }}</td>
          <td class="text-center">
            @if ($intention->EDAD == 1)Cumple @endif
            @if ($intention->EDAD == 0)NO Cumple @endif
          </td>
          <td class="text-center">
            @if ($intention->TIEMPO_LABOR == 1)Cumple @endif
            @if ($intention->TIEMPO_LABOR == 0)NO Cumple @endif
          </td>
          <td class="text-center">
            @if ($intention->TIPO_5_ESPECIAL == 1)SI @endif
            @if ($intention->TIPO_5_ESPECIAL == 0)NO @endif
          </td>
          <td class="text-center">
            @if ($intention->INSPECCION_OCULAR == 1)SI @endif
            @if ($intention->INSPECCION_OCULAR == 0)NO @endif
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>