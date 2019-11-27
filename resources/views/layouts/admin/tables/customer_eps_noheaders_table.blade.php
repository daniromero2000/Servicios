<tbody>
  @if(!empty($data))

  <tr>
    @foreach($data->toArray() as $key => $value)
    <td class="text-center">
      {{ $data->toArray()[$key] }}
    </td>
    @endforeach
  </tr>
  @endif
<tbody>