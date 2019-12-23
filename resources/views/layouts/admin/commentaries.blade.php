<div class="col-md-6">
        <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
            <div class="box-body">
                <h1><i class="fas fa-comments" aria-hidden="true"></i> Comentarios</h1>
                             @if($datas->isNotEmpty())
                <table class="table table-borderless table-hover table-sm">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Comentario</th>
                            <th class="text-center" scope="col">Usuario</th>
                            <th class="text-center" scope="col">Fecha</th>
                        </tr>
                    </thead>
                    @include('layouts.admin.tables.noheaders_table', ['datas' => $datas ])
                </table>
                @else
                <span>Aún no tiene comentarios</span><br>
                @endif
                <div class="row">
                    <div class="col">
                        <a href="#myModal" data-toggle="modal" data-target="#commentmodal" <i
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                            Agregar Comentario</a>
                    </div>
                </div>
            </div>


        </div>
    </div>