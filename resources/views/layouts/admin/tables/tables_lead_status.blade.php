
                <div class="table table-responsive-lg ">

                    <table id="example2" class="table  table-stripped  table-hover">
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
           
