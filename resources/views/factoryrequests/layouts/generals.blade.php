<div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
  <div class="box-body">
    <h2><i class="fa fa-user" aria-hidden="true"></i> {{ $customer->name }} {{ $customer->last_name }}
    </h2>
    <table class="table table-borderless table-hover table-sm">
      <thead>
        <tr>
          <th class="text-center" scope="col">Fecha de Nacimiento</th>
          <th class="text-center" scope="col">Ciudad de Nacimiento</th>
          <th class="text-center" scope="col">Edad</th>
          <th class="text-center" scope="col">Estado Civil</th>
          <th class="text-center" scope="col">Genero</th>
          <th class="text-center" scope="col">Escolaridad</th>
          <th class="text-center" scope="col">Lead</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">{{ $customer->birthday }}</td>
          <td class="text-center">{{ $customer->city->city }}</td>
          <td class="text-center">{{ $customer->age }} años</td>
          <td class="text-center">{{ $customer->civilStatus->civil_status }}</td>
          <td class="text-center">{{ $customer->genre->genre }}</td>
          <td class="text-center">{{ $customer->scholarity->scholarity }}</td>
          <td class="text-center">{{ $customer->customerLead->lead }}</td>
        </tr>
      </tbody>
    </table>
    <div class="row">
      <div class="col">
        <form action="{{ route('admin.customers.destroy', $customer['id']) }}" method="post" class="form-horizontal">
         @csrf
          <input type="hidden" name="_method" value="delete">
          <div class="btn-group">
            <a href="{{ route('admin.customers.edit', $customer['id']) }}" class="btn btn-primary btn-sm"><i
                class="fa fa-edit"></i> Editar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>