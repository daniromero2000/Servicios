<!-- Professions -->
<div class="col-md-6">
  <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
    <div class="box-body">
      <h1><i class="fa fa-briefcase" aria-hidden="true"></i> Profesiones</h1>
      @if($customer->customerProfessions->isNotEmpty())
      <table class="table table-borderless table-hover table-sm">
        <thead>
          <tr>
            <th class="text-center" scope="col">Fecha Registro</th>
            <th class="text-center" scope="col">Profesión</th>
          </tr>
        </thead>
        <tbody>
          @include('layouts.admin.tables.customer_profession_noheaders_table', ['datas' =>
          $customer->customerProfessions])
        </tbody>
      </table>
      @else
      <span>Aún no tiene profesiones</span><br>
      @endif
      <div class="row">
        <div class="col">
          <a href="#" data-toggle="modal" data-target="#professionmodal" <i class="btn btn-primary btn-sm"><i
              class="fa fa-edit"></i>
            Agregar Profesion</a>
        </div>
      </div>
    </div>
  </div>
</div>