
                <div class="table " style="font-size: 10pt;">

                    <table id="example2" class="table table-responsive table-stripped  table-hover">
                        <thead class="text-center">
                            <tr>
                                @foreach ($headers as $header)
                                <th  scope="col">{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                            <tr>
                                @foreach($data->toArray() as $key => $value)
                                <td>
                                    {{ $data[$key] }}
                                </td>
                                @endforeach

                                <td>

                                </td>
                            </tr>
                            @endforeach

                        <tbody>
                    </table>
                </div>
           
