<div class="col-md-8">
    <div class="card card-table-reset">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 col-sm-8">
                    <h2 class="title-table" class="title-table"><i class="fas fa-comments"></i> Comentarios </h2>
                </div>
                <div class="col-12 col-sm-4 d-flex justify-content-end text-rigth">
                    <a href="#myModal" data-toggle="modal" data-target="#commentmodal" class="btn btn-primary btn-sm"><i
                            class="fa fa-edit"></i>
                        Agregar Comentario</a>
                </div>
            </div>
            @if($datas->isNotEmpty())
            <table class="table table-hover table-stripped leadTable">
                <thead class="header-table">
                    <tr>
                        <th class="text-center" scope="col"></th>
                        <th class="text-center" scope="col">Fecha</th>
                        <th class="text-center" scope="col">Asesor</th>
                        <th class="text-center" scope="col">Comentario</th>
                    </tr>
                </thead>
                <tbody class="body-table">
                    @foreach($datas as $data)
                    <tr>
                        <td>
                            @if ($data->user->master == 1)
                            <span class="text-center badge" style="color: white ; background-color:
                            #0bb010"><i class="fa fa-bell-o"></i> </span>
                            @endif
                        </td>
                        <td class="text-center">
                            {{ $data->created_at->format('M d, Y h:i a') }}
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