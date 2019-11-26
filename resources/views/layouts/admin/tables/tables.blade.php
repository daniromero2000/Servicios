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
                {{ $data->toArray()[$key] }}
            </td>
            @endforeach
        </tr>
        @endforeach
    <tbody>
</table>