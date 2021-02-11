<div class="table-responsive">
    <table class="table align-items-center table-flush table-hover">
        <thead class="thead-light">
            <tr>
                @foreach ($headers as $header)
                <th class="text-center" scope="col">{{ $header }} </th>
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
                    @include('generals::layouts.admin..tables.table_options', [$data, 'optionsRoutes' => $optionsRoutes])
                </td>
            </tr>
            @endforeach
        <tbody>
    </table>
</div>