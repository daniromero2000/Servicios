<div class="container-fluid mb-4">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0 height-table">
        <table class="table table-head-fixed text-center">
            <thead class="header-table">
                <tr>
                    @foreach ($headers as $header)
                    <th scope="col">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="body-table">
                @foreach($datas as $data)
                <tr>
                    <td>{{$data->identificationNumber}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->lastName}}</td>
                    <td>{{$data->telephone}}</td>
                    <td>{{$data->assessor->email}}</td>
                    <td>$ {{ number_format($data->total) }}</td>
                    <td>@if ($data->state == 0)
                        <span class="badge badge-primary">Sin gestionar</span>
                        @else
                        <span class="badge badge-success">Liquidado</span>
                        @endif
                    </td>
                    <td>{{$data->created_at}}</td>
                    <td><a data-toggle="tooltip" title="Ver Cotización"
                            href="{{ route('assessorquotations.show', $data->id) }}"> <i class="far fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->