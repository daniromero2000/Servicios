@if($customer->customerIntentions->isNotEmpty())
<div class="card-body text-center pt-0 pb-0 ">
  <div class="table-responsive mb-3 p-0 height-table">
    <table class="table table-head-fixed">
      <thead class="text-center header-table">
        <tr>
          <th scope="col">Fecha</th>
          <th scope="col">Sucursal</th>
          <th scope="col">Asesor</th>
          <th scope="col">Origen</th>
          <th scope="col">Estado</th>
          <th scope="col">Actividad</th>
          <th scope="col">Estado Obligaciones</th>
          @if (auth()->user()->idProfile == 5)
          <th scope="col">Score</th>
          @endif
          <th scope="col">Perfil Crediticio</th>
          <th scope="col">Historial Crediticio</th>
          <th scope="col">Crédito</th>
          <th scope="col">Decisión</th>
          <th scope="col">Riesgo Zona</th>
          <th scope="col">Edad</th>
          <th scope="col">Tiempo en Labor</th>
          <th scope="col">Tipo 5 Especial</th>
          <th scope="col">Inspección Ocular</th>
          <th scope="col">Definición</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @foreach($datas as $data)
        <tr>
          <td>{{ $data->FECHA_INTENCION}}</td>
          <td>@if($data->assessor){{($data->assessor->SUCURSAL)}} @endif</td>
          <td>@if($data->assessor){{($data->assessor->NOMBRE)}} @endif</td>
          <td> @if($data->customer){{ $data->customer->ORIGEN}} @endif</td>
          <td>@if ($data->intentionStatus)
            <span @if ($data->intentionStatus['NAME'] == "PREAPROBADO")
              class="badge badge-warning"
              @endif
              @if ($data->intentionStatus['NAME'] == "APROBADO")
              class="badge badge-success"
              @endif
              @if ($data->intentionStatus['NAME'] == "ANALISIS")
              class="badge badge-primary"
              @endif
              @if ($data->intentionStatus['NAME'] == "NEGADO")
              class="badge badge-danger"
              @endif style="font-size: 11px;"> {{ $data->intentionStatus['NAME']}}</span>
            @endif
          </td>
          <td>{{ $data->customer['ACTIVIDAD']}}</td>
          <td>@if ($data->ESTADO_OBLIGACIONES == 1)Normal @endif
            @if ($data->ESTADO_OBLIGACIONES === 0)En Mora @endif
            @if ($data->ESTADO_OBLIGACIONES === null)Sin Datos @endif
          </td>
          @if (auth()->user()->idProfile == 5)
          <td> @if ($data->customer->latestCifinScore['score'] == '')Sin Datos
            @endif{{ $data->customer->latestCifinScore['score']}} @endif</td>
          <td>@if ($data->PERFIL_CREDITICIO == '')Sin Datos @endif{{ $data->PERFIL_CREDITICIO}}</td>
          <td>@if ($data->HISTORIAL_CREDITO == 1)Con Historial @endif
            @if ($data->HISTORIAL_CREDITO == 0)Sin Historial @endif</td>
          <td>@if ($data->TARJETA) {{ $data->TARJETA}} @else No Aplica @endif </td>
          <td>@if ($data->CREDIT_DECISION) {{ $data->CREDIT_DECISION}} @else NA @endif </td>
          <td>{{ $data->ZONA_RIESGO}}</td>
          <td>@if ($data->EDAD == 1)Cumple @endif
            @if ($data->EDAD == 0)NO Cumple @endif</td>
          <td>@if ($data->TIEMPO_LABOR == 1)Cumple @endif
            @if ($data->TIEMPO_LABOR == 0)NO Cumple @endif</td>
          <td>@if ($data->TIPO_5_ESPECIAL == 1)SI @endif
            @if ($data->TIPO_5_ESPECIAL == 0)NO @endif</td>
          <td>@if ($data->INSPECCION_OCULAR == 1)SI @endif
            @if ($data->INSPECCION_OCULAR == 0)NO @endif</td>
          <td>
            @if ($data->definition )
            {{ $data->definition['DESCRIPCION']}}
            @endif
          </td>
        </tr>
        @endforeach
      <tbody>
    </table>
  </div>
</div>
@else
<table class="table table-hover table-stripped leadTable">
  <tbody class="body-table">
    <tr>
      <td>
        Aun no tiene Intenciones Web
      </td>
    </tr>
  </tbody>
</table>
@endif