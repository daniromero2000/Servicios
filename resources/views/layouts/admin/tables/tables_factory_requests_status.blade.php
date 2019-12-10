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
          @foreach($data->toArray() as $key => $value)
          <td class="text-center">
            {{ $data[$key] }}
          </td>
          @endforeach
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->