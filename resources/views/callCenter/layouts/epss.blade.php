<!-- Phones -->
<div class="col-md-6">
  <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
    <div class="box-body">
      <h1><i class="fa fa-stethoscope" aria-hidden="true"></i> Eps</h1>
      @if($customer->customerEpss->isNotEmpty())
      <table class="table table-borderless table-hover table-sm">
        <thead>
          <tr>
            <th class="text-center" scope="col">Fecha Registro</th>
            <th class="text-center" scope="col">Eps</th>
          </tr>
        </thead>
        <tbody>
          @include('layouts.admin.tables.customer_eps_noheaders_table', ['datas' => $customer->customerEpss])
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
  </div>
</div>