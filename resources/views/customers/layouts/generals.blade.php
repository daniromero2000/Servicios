<div class="container-fluid card card-table-reset">
  <div class="card-header">
    <div class="row">
      <div class="col-8">
        <h2 class="title-table"><i class="fas fa-user mr-2"></i> {{ $customer->NOMBRES }}
          {{ $customer->APELLIDOS }} </span>
        </h2>
      </div>
      <div class="col-1 text-right"><span
          class="badge title-table-status badge-primary">{{ $customer->latestCifinScore['score'] }}
      </div>
      <div class="col-1 text-right"><span
          class="badge title-table-status badge-primary">{{ if($customer->latestIntention) endif $customer->latestIntention->PERFIL_CREDITICIO }}
      </div>
      <div class="col-1 text-right"><span class="badge title-table-status badge-primary">{{ $customer->ESTADO }}
      </div>
    </div>
  </div>
  <div class="card-body table-responsive pt-1">
    <table class="table table-hover table-stripped leadTable">
      <thead class="header-table">
        <tr>
          <th class="text-center" scope="col">Tipo Cliente / Subtipo</th>
          <th class="text-center" scope="col">Edad</th>
          <th class="text-center" scope="col">Sexo</th>
          <th class="text-center" scope="col">Fecha de Nacimiento</th>
          <th class="text-center" scope="col">Estado Civil</th>
        </tr>
      </thead>
      <tbody class="body-table">
        <tr>
          <td class="text-center">{{ $customer->TIPOCLIENTE }}/{{ $customer->SUBTIPO }}</td>
          <td class="text-center">{{ $customer->EDAD }} Años</td>
          <td class="text-center">{{ $customer->SEXO }}</td>
          <td class="text-center">{{ $customer->FEC_NAC }}</td>
          <td class="text-center">{{ $customer->ESTADOCIVIL }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>