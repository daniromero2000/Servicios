<tbody>
    <tr>
        @foreach($data->toArray() as $key => $value)
        <td class="text-center">
            {{ $data[$key] }}
        </td>
        @endforeach
    </tr>
<tbody>