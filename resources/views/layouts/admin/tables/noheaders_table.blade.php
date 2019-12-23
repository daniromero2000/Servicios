<tbody>
  @foreach($datas as $data)
  <tr>
    @if(!empty($datas))
    @foreach($data->toArray() as $key => $value)
    <td class="text-center">
      {{ $data->toArray()[$key] }}
    </td>
    @endforeach
    @endif
  </tr>
  @endforeach
<tbody>