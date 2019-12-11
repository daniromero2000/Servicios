<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h2 class="title-table"class="title-table"><i class="fas fa-comments" aria-hidden="true"></i> Comentarios</h2>
            {{-- @if($datas->isNotEmpty())  --}}
            <table class="table table-hover table-stripped leadTable">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Comentario</th>
                        <th class="text-center" scope="col">Usuario</th>
                        <th class="text-center" scope="col">Fecha</th>
                    </tr>
                </thead>
                {{-- @include('layouts.admin.tables.noheaders_table', ['datas' => $datas ])  --}}
            </table>
            {{-- @else  --}}
            <span>Aún no tiene comentarios</span><br>
            {{-- @endif  --}}
            {{--  <div class="row">
                <div class="col">
                    <a href="#myModal" data-toggle="modal" data-target="#commentmodal"> <i
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                            Agregar Comentario</a>
                </div>
            </div>  --}}
        </div>


    </div>
</div>