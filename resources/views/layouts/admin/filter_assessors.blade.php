<!-- search form -->
<div class="row">
    <div class="col-12 text-center">
        <h3 class="title-filter" style="color: #007bff;">Filtrar</h3>
    </div>

    <div class="col-12 mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">
                <div class="row w-100 d-flex justify-content-center">
                    <div class="col-6 col-sm-6 col-md-3">
                        <label class="label-reset" for="q">Buscar: Solicitud / Cedula</label>
                        <input type="text" name="q" class="form-control input-reset" placeholder=" Buscar..."
                            value="{!! request()->input('q') !!}">
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <div class="form-group form-group-reset">
                            <label class="label-reset" for="status">Estado</label>
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

                    <div class="col-6 col-sm-6 col-md-3">
                        <label class="label-reset" for="from">Desde</label>
                        <input type="date" name="from" class="form-control input-reset"
                            value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <label class="label-reset" for="to">Hasta</label>
                        <input type="date" name="to" class="form-control input-reset"
                            value="{!! request()->input('to') !!}">
                    </div>

                    <div class="col-12 d-flex align-items-end justify-content-end mt-3">
                        <span class="input-group-btn btn-pr">
                            <a class="btn btn-danger btn-sm-reset mt-2" href="{{$route}}">
                                <i class="fas fa-times"></i> Restaurar filtros
                            </a>
                            <button type="submit" id="search-btn" class="btn btn-primary btn-sm-reset mt-2"><i
                                    class="fa fa-search"></i>
                                Buscar
                            </button>

                        </span>
                    </div>
                </div>

            </div>


        </form>

    </div>
</div>