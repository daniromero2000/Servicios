<!-- Phones -->
<div class="col-md-6">
  <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
    <div class="box-body">
      <h1><i class="fa fa-phone" aria-hidden="true"></i> Teléfonos</h1>
      @if($customer->customerPhones->isNotEmpty())
      <table class="table table-borderless table-hover table-sm">
        <thead>
          <tr>
            <th class="text-center" scope="col">Tipo Teléfono</th>
            <th class="text-center" scope="col">Teléfono</th>
            <th class="text-center" scope="col">Fecha Registro</th>
          </tr>
        </thead>
        <tbody>
          @include('layouts.admin.tables.noheaders_table', ['datas' => $customer->customerPhones])
        </tbody>
      </table>
      @else
      <span>Aún no tiene Teléfonos</span><br>
      @endif
      <div class="row">
        <div class="col">
          <a href="# " data-toggle="modal" data-target="#phonemodal" <i class="btn btn-primary btn-sm"><i
              class="fa fa-edit"></i>
            Agregar Teléfono</a>
        </div>
      </div>
    </div>
  </div>
</div>