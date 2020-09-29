<form action="{{$route}}" method="get" id="admin-search">
    <div class="input-group">


        <div class="row justify-content-center">
            <div class="col-4 col-sm-4 col-md-12">
                <div class="form-group mb-1">
                    <label for="q">Buscar: Solicitud / Cedula</label>
                    <input type="text" name="q" class="form-control" placeholder=" Buscar..." value="{!! request()->input('q') !!}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-12">
                <div class="form-group mb-1">
                    <label for="from">Desde</label>
                    <input type="date" name="from" class="form-control " value="{!! request()->input('from') !!}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-12">
                <div class="form-group mb-1">
                    <label for="to">Hasta</label>
                    <input type="date" name="to" class="form-control " value="{!! request()->input('to') !!}">
                </div>
            </div>
            <div class="col-12 d-flex align-items-end justify-content-end">
                <div class="form-group mb-1">
                    <span class="input-group-btn btn-pr">
                        <a class="btn btn-danger btn-sm mt-2" href="{{$route}}">
                            <i class="fas fa-times"></i> Restaurar filtros
                        </a>
                        <button type="submit" name="action" value="search" id="search-btn" class="btn btn-primary mt-2 btn-sm"><i class="fa fa-search"></i>
                            Buscar
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>
