<div class="col-md-6">
    <div class="card card-table-reset">
        <div class="card-body">
            <h2 class="title-table" class="title-table"><i class="fas fa-comments" aria-hidden="true"></i> Comentarios
                <div class="col">
                    <a href="#myModal" data-toggle="modal" data-target="#commentmodal" <i
                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                        Agregar Comentario</a>
                </div>
            </h2>
            @if($datas->isNotEmpty())
            <table class="table table-hover table-stripped leadTable">
                <thead class="header-table">
                    <tr>
                        <th class="text-center" scope="col">Fecha</th>
                        <th class="text-center" scope="col">Asesor</th>
                        <th class="text-center" scope="col">Comentario</th>
                    </tr>
                </thead>
                <tbody class="body-table">
                    @foreach($datas as $data)
                    <tr>
                        <td class="text-center">
                            {{ $data->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $data->user->name }}
                        </td>
                        <td class="text-center">
                            {{ $data->comment }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <table class="table table-hover table-stripped leadTable">
                <tbody class="body-table">
                    <tr>
                        <td>
                            Aún no tiene comentarios
                        </td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>

@include('digitalchannelleads.layouts.add_comment_modal')