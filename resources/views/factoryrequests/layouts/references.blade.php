<div class="row">
  <!-- references -->
  <div class="col-md-12">
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
      <div class="box-body">
        <h1><i class="fa fa-users" aria-hidden="true"></i> Referencias</h1>
        @if($factoryRequest->references->isNotEmpty())
        <table class="table table-borderless table-hover table-sm">
          <thead>
            <tr>
              <th class="text-center" scope="col">Nombre Referencia Personal</th>
              <th class="text-center" scope="col">Apellido</th>
              <th class="text-center" scope="col">Escolaridad</th>
              <th class="text-center" scope="col">Tipo Referencia</th>
              <th class="text-center" scope="col">Parentesco</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($references as $reference)
            <tr>
              <td class="text-center">
                {{ $reference->NOM_REFPER}}</td>
              <td class="text-center">
                {{ $references }}
              </td>
              <td class="text-center">
                {{ $reference}}
              </td>
              <td class="text-center">
                {{ $reference}}
              </td>
              <td class="text-center">
                {{ $reference }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <span>Aún no tiene Referencias</span><br>
        @endif
      </div>
    </div>
  </div>
</div>