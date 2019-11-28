<div class="card-header">
  <h2><i class="fas fa-tags" aria-hidden="true"></i> Intención {{ $intention->id }} {{ $intention->ESTADO_INTENCION }}
  </h2>
</div>
<div class="card-body table-responsive pt-1">
  <table class="table table-hover table-stripped leadTable">
    <thead>
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
    <tbody>
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

@section('scriptsJs')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jsGrid -->
<script src="{{ asset('plugins/jsgrid/demos/db.js') }}"></script>
<script src="{{ asset('plugins/jsgrid/jsgrid.min.js') }}"></script>
@endsection