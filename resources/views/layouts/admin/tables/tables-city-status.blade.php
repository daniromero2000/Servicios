<table class="table table-borderless table-hover table-sm">
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
            <td class="text-center">{{ $data->city->name }}</td>
            <td class="text-center">
                @include('layouts.status', ['status' => $data->status])</td>
            <td class="text-center">
                @include('layouts.admin.tables.table_options', [$data, 'optionsRoutes' => $optionsRoutes])
            </td>
        </tr>
        @endforeach
    <tbody>
</table>