<div class="container-fluid card card-table-reset">

  @if($fosygaRuafs->isNotEmpty())
  <div class="card-header">
    <div class="row">

      <div class="col-11">
        <h2 class="title-table"><i class="fas fa-user-clock mr-3"></i>Resultado RUAF
        </h2>
      </div>
      <div class="col-1 text-center" data-toggle="tooltip" data-placement="top" title="Consultar">
        @if ($fosygaRuafs[0]->fuenteFallo == 'SI')
        <a href="{{route('customer_fosygaConsult', $customer->CEDULA) }}"> <i class="fas fa-search-plus"
            data-toggle="modal" data-target="#proccessConsult" style="
          font-size: 22px;
          margin: auto;
          color: #007bff;
      "></i></a>
        @endif
      </div>
    </div>

  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Regimen Salud</th>
          <th class="text-center" scope="col">Entidad Salud</th>
          <th class="text-center" scope="col">Estado Salud</th>
          <th class="text-center" scope="col">Tipo de Afiliación</th>
          <th class="text-center" scope="col">Ciudad</th>
          <th class="text-center" scope="col">Regimen Pensión</th>
          <th class="text-center" scope="col">Entidad Pensión</th>
          <th class="text-center" scope="col">Estado Pensión</th>
          <th class="text-center" scope="col">Fecha Consulta</th>
          <th class="text-center" scope="col">Falló?</th>
        </tr>
      </thead>
      <tbody class="body-table">
        @foreach ($fosygaRuafs as $ruaf )
        <tr>
          <td class="text-center"> @if ($ruaf->regimen_salud) {{ $ruaf->regimen_salud }} @else NA @endif</td>
          <td class="text-center"> @if ($ruaf->administradora_salud) {{ $ruaf->administradora_salud }} @else NA @endif
          </td>
          <td class="text-center"> @if ($ruaf->estado_salud) {{ $ruaf->estado_salud }} @else NA @endif</td>
          <td class="text-center"> @if ($ruaf->tipo_afiliado_salud) {{ $ruaf->tipo_afiliado_salud }} @else NA @endif
          </td>
          <td class="text-center"> @if ($ruaf->ciudad_afiliacion) {{ $ruaf->ciudad_afiliacion }} @else NA @endif</td>
          <td class="text-center"> @if ($ruaf->regimen_pension) {{ $ruaf->regimen_pension }} @else NA @endif</td>
          <td class="text-center"> @if ($ruaf->administradora_pension) {{ $ruaf->administradora_pension }} @else NA
            @endif</td>
          <td class="text-center"> @if ($ruaf->estado_pension) {{ $ruaf->estado_pension }} @else NA @endif</td>
          <td class="text-center"> @if ($ruaf->created_at) {{ $ruaf->created_at }} @else NA @endif</td>
          <td class="text-center"> @if ($ruaf->fuenteFallo) <span
              class="badge @if($ruaf->fuenteFallo == 'NO') badge-success @else badge-danger  @endif">{{ $ruaf->fuenteFallo }}</span>
            @else
            NA
            @endif</td>
        </tr>
        @endforeach
      </tbody class="body-table">
    </table>
  </div>@else
  <table class="table table-hover table-stripped leadTable">
    <tbody class="body-table">
      <tr>
        <td>
          No tiene Consultas
        </td>
      </tr>
    </tbody>
  </table>
  @endif
</div>