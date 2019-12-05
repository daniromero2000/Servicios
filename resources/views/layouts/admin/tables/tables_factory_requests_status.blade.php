<div class="table ">

    <table id="example2" class="table table-responsive-lg table-stripped  table-hover">
        <thead class="text-center">
            <tr>
                @foreach ($headers as $header)
                <th scope="col">{{ $header }}</th>
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

                </td>
            </tr>
            @endforeach

        <tbody>
    </table>
</div>

