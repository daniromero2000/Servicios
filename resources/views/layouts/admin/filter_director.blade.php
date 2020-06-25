<!-- search form -->
<div class="row">
    <div class="col-12 text-center">
        <h3 style="color: #007bff;">Filtrar</h3>
    </div>

    <div class="col-12 mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">


                <div class="row w-100 d-flex justify-content-center">
                    <div class="col-10 col-sm-6 col-md-4">
                        <label for="q">Buscar: Solicitud / Cedula</label>
                        <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                            value="{!! request()->input('q') !!}">
                    </div>
                    <div class="col-10 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select class="form-control  select2bs4" id="status" name="status" {!!
                                request()->input('status') !!} style="width: 100%;">
                                <option selected value> Selecciona Estado </option>
                                @foreach ($statuses as $status)
                                <option value="{{$status->id}}" @if(request()->input('status') == $status->id) selected
                                    @endif
                                    > {{ $status->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-10 col-sm-6 col-md-4">
                        <label for="from">Desde</label>
                        <input type="date" name="from" class="form-control " value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-10 col-sm-6 col-md-4">
                        <label for="to">Hasta</label>
                        <input type="date" name="to" class="form-control " value="{!! request()->input('to') !!}">
                    </div>
                    <div class="col-10 col-sm-6 col-md-4">
                        <label for="q">Buscar por Código de Asesor</label>
                        <input type="text" name="assessor" class="form-control" placeholder=" Buscar por Asesor..."
                            value="{!! request()->input('assessor') !!}">
                    </div>
                    <div class="col-12 d-flex align-items-end justify-content-end mt-3">
                        <span class="input-group-btn btn-pr">
                            <button type="submit" id="search-btn" class="btn btn-primary btn-sm-reset mt-2"><i
                                    class="fa fa-search"></i>
                                Buscar
                            </button>
                            <a class="btn btn-danger btn-sm-reset mt-2" href="{{$route}}">
                                <i class="fas fa-times"></i> Restaurar filtros
                            </a>
                        </span>
                    </div>
                </div>

            </div>


        </form>

    </div>
</div>