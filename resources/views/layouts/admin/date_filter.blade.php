<!-- search form -->
<div class="row">
    <div class="col-12 text-center">
        <h3>Filtrar Solicitudes Fábrica</h3>
    </div>
    <div class="col-12 mt-2 mb-5">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">
                <div class="row w-100 d-flex justify-content-center">
                    <div class="col-2">
                    </div>
                    <div class="col-md-3">
                        <label for="from">Desde</label>
                        <input type="date" name="from" class="form-control form-control-sm"
                            value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-md-3">
                        <label for="to">Hasta</label>
                        <input type="date" name="to" class="form-control form-control-sm"
                            value="{!! request()->input('to') !!}">
                    </div>
                    <div class="col-md-3 d-flex justify-content-center align-items-end">
                        <span class="input-group-btn ">
                            <button type="submit" id="search-btn" class="btn btn-primary"><i class="fa fa-search"></i>
                                Buscar
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>