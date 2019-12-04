<!-- Emails -->
<div class="col-md-6">
  <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
    <div class="box-body">
      <h1><i class="fa fa-envelope" aria-hidden="true"></i> Emails</h1>
      @if($customer->customerEmails->isNotEmpty())
      <table class="table table-borderless table-hover table-sm">
        <thead>
          <tr>
            <th class="text-center" scope="col">Email</th>
            <th class="text-center" scope="col">Fecha Registro</th>
          </tr>
        </thead>
        <tbody>
          @include('layouts.admin.tables.noheaders_table', ['datas' => $customer->customerEmails])
        </tbody>
      </table>
      @else
      <span>Aún no tiene Emails</span><br>
      @endif
      <div class="row">
        <div class="col">
          <a href="#" data-toggle="modal" data-target="#emailmodal" <i class="btn btn-primary btn-sm"><i
              class="fa fa-edit"></i>
            Agregar Email</a>
        </div>
      </div>
    </div>
  </div>
</div>