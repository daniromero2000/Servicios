<div class="container-fluid mb-4">

    <!-- /.card-header -->
    <div class="card-body table-responsive p-0 height-table">
        <table class="table table-head-fixed">
            <thead class="thead-dark header-table">
                <tr>
                    @foreach ($headers as $header)
                    <th class="text-center" scope="col">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="body-table">
                @foreach($datas as $data)
                <tr>
                    @foreach($data->toArray() as $key => $value)
                    <td class="text-center">
                        {{ $data->toArray()[$key] }}
                    </td>
                    @endforeach
                </tr>
                @endforeach
            <tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->