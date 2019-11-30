<!-- Phones -->

<div class="card-header">
  <h1><i class="fas fa-credit-card" aria-hidden="true"></i> Tarjeta de Crédito</h1>
</div>
<div class="card-body table-responsive pt-1">
  @if(!empty($intention->creditCard))
  <table class="table table-hover table-stripped leadTable">
    <thead>
      <tr>
        <th class="text-center" scope="col">Número</th>
        <th class="text-center" scope="col">Estado</th>
      </tr>
    </thead>
    <tbody>
      @include('layouts.admin.tables.intention_eps_noheaders_table', ['data' => $intention->creditCard])
    </tbody>
  </table>
  @else
  <span>Aún no tiene Eps</span><br>
  @endif
  <div class="row">
    <div class="col">
      <a href="# " data-toggle="modal" data-target="#epsmodal" <i class="btn btn-primary btn-sm"><i
          class="fa fa-edit"></i>
        Agregar Eps</a>
    </div>
  </div>
</div>