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
            <td class="text-center">
                <p class="text-center label"
                    style="color: #ffffff; background-color: {{ $data->status_id->color }}">
                    {{ $data->status_id->status }}
                </p>
            </td>
            <td class="text-center">
                @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' => $optionsRoutes])
            </td>
        </tr>
        @endforeach
    <tbody>
</table>