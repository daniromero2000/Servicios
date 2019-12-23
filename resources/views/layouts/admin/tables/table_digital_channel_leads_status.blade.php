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
                <td>{{ $data->typeService}}</td>
                <td>{{ $data->typeProduct}}</td>
                <td>{{ $data->created_at}}</td>
                <td>
                    <i class="fas fa-edit cursor" title="Actualizar Lead" data-toggle="modal" data-target="#updateleadModal"></i>
                    <i class="fas fa-comment cursor"
                        ng-click="viewCommentsCM(leadCM.name, leadCM.lastName, leadCM.state, leadCM.id)"></i>
                                       <i class="fas fa-times cursor" title="Eliminar Lead" ng-click="showDialogDelete(leadCM.id)"></i>
                </td>
            </tr>
            @endforeach
        <tbody>
    </table>
</div>


