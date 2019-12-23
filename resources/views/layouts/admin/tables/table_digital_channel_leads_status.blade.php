<div class="table-responsive mb-3 p-0 height-table">
    <table class="table table-head-fixed">
        <thead class="text-center header-table">
            <tr>
                @foreach ($headers as $header)
                <th scope="col">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="body-table">
            @foreach($datas as $data)
            <tr>
                <td><span class="text-center badge"
                        style="color: white ; background-color: {{$data->leadStatuses->color }}"
                        class="btn btn-info btn-block">{{ $data->leadStatuses->status}}</span></td>
                <td>{{ $data->leadChannel->channel}}</td>
                <td>{{ $data->leadAssessor['name']}}</td>
                <td>{{ $data->identificationNumber}}</td>
                <td>{{ $data->name}} {{ $data->lastName}}</td>
                <td>{{ $data->email}}</td>
                <td>{{ $data->telephone}}</td>
                <td>{{ $data->city}}</td>


            </tr>
            @endforeach
        <tbody>
    </table>
</div>