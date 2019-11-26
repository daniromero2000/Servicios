<tbody>
    @if(!empty($datas))
    @foreach($datas as $data)
    <tr>
        @foreach($data->toArray() as $key => $value)

        <td class="text-center">
            {{ $data->toArray()[$key] }}
        </td>
        @endforeach
        <td class="text-center">
            {{ $data->vehicleType->vehicle_type }}
        </td>
        <td class="text-center">
            {{ $data->vehicleBrand->vehicle_brand }}
        </td>
    </tr>
    @endforeach
    @endif
<tbody>