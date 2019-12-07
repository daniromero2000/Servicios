<div class="container-fluid mb-4">

    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 500px;">
        <table class="table table-head-fixed">
            <thead class="thead-dark">
                <tr>
                    @foreach ($headers as $header)
                    <th class="text-center" scope="col">{{ $header }}</th>
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
                    <td class="text-center">
                        <p class="text-center label"
                            style="color: #ffffff; background-color: {{ $data->status_id->color }}">
                            {{ $data->status_id->status }}
                        </p>
                    </td>
                    <td class="text-center">
                        @include('layouts.admin.tables.table_options', [$data, 'optionsRoutes' => $optionsRoutes])
                    </td>
                </tr>
                @endforeach
            <tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->