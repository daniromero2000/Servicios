<div class="row">
  <!-- references -->
  <div class="col-md-12">
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
      <div class="box-body">
        <h1><i class="fa fa-users" aria-hidden="true"></i> Referencias</h1>
        @if($customer->customerReferences->isNotEmpty())
        <table class="table table-borderless table-hover table-sm">
          <thead>
            <tr>
              <th class="text-center" scope="col">Nombre</th>
              <th class="text-center" scope="col">Apellido</th>
              <th class="text-center" scope="col">Escolaridad</th>
              <th class="text-center" scope="col">Tipo Referencia</th>
              <th class="text-center" scope="col">Parentesco</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($customer->customerReferences as $customer_reference)
            <tr>
              <td class="text-center">
                {{ $customer_reference->customerPhone->customer->name}}</td>
              <td class="text-center">
                {{ $customer_reference->customerPhone->customer->last_name }}
              </td>
              <td class="text-center">
                {{ $customer_reference->customerPhone->customer->scholarity->scholarity }}
              </td>
              <td class="text-center">
                  {{ $customer_reference->relationship->referenceType->reference_type }}
                </td>
              <td class="text-center">
                {{ $customer_reference->relationship->relationship }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <span>Aún no tiene profesiones</span><br>
        @endif
        <div class="row">
          <div class="col">
            <a href="#" data-toggle="modal" data-target="#referencemodal" <i class="btn btn-primary btn-sm"><i
                class="fa fa-edit"></i>
              Agregar Referencia</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>