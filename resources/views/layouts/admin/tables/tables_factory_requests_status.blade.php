<div class="container-fluid mb-4">
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0" style="height: 500px;">
    <table class="table table-head-fixed">
      <thead>
        <tr>
          @foreach ($headers as $header)
          <th scope="col">{{ $header }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach($datas as $data)
        <tr>
          <td class="text-center"><a data-toggle="tooltip" title="Ver Cliente" href="{{ route('customers.show', $data->CLIENTE) }}"> {{ $data->CLIENTE }} </a>
          </td>
          <td class="text-center">
            <a data-toggle="tooltip" title="Ver Solicitud" href="{{ route('factoryrequests.show', $data->SOLICITUD) }}">{{ $data->SOLICITUD }}</a></td>
          <td class="text-center">{{ $data->CODASESOR }} </td>
          <td class="text-center">{{ $data->SUCURSAL }}</td>
          <td class="text-center">{{ $data->FECHASOL }} </td>
          <td class="text-center"> {{ $data->ESTADO }} </td>
          <td class="text-center"> {{ $data->GRAN_TOTAL }} </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->