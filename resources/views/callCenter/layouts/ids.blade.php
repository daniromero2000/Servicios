<!-- Identities -->
<div class="row">
  <div class="col-md-12">
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
      <div class="box-body">
        <h1><i class="fas fa-id-card" aria-hidden="true"></i> Datos de Identificación</h1>
        @if($customer->customerIdentities->isNotEmpty())
        <table class="table table-borderless table-hover table-sm">
          <thead>
            <tr>
              <th class="text-center" scope="col">Tipo de Documento</th>
              <th class="text-center" scope="col">Número</th>
              <th class="text-center" scope="col">Fecha de Expedición</th>
              <th class="text-center" scope="col">Ciudad de Expedición</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($customer->customerIdentities as $customer_identity)
            <tr>
              <td class="text-center">
                {{ $customer_identity->identityType->identity_type }}
              </td>
              <td class="text-center">{{ $customer_identity->identity_number }}</td>
              <td class="text-center">{{ $customer_identity->expedition_date }}</td>
              <td class="text-center">{{ $customer_identity->city->city }}</td>
            </tr>
            @endforeach
            </th>
          </tbody>
        </table>
        @else
        <span>Aún no tiene direcciones</span><br>
        @endif
        <div class="row">
          <div class="col">
            <a href="#" data-toggle="modal" data-target="#identitymodal" <i class="btn btn-primary btn-sm"><i
                class="fa fa-edit"></i>
              Agregar Documento</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>