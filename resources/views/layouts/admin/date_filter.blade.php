<!-- search form -->
<div class="row">
    <div class="col-12 text-center">
        <h3>Filtrar</h3>
    </div>
    <div class="col-12 mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">
                <div class="row w-100 d-flex justify-content-center">
                    <div class="col-3">
                        <label for="from">Desde</label>
                        <input type="date" name="from" class="form-control form-control-sm"
                            value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-3">
                        <label for="to">Hasta</label>
                        <input type="date" name="to" class="form-control form-control-sm"
                            value="{!! request()->input('to') !!}">
                    </div>
                </div>
            </div>
            <div class="col-12 text-right">
                <span class="input-group-btn">
                    <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> Buscar
                    </button>
                </span>
            </div>
        </form>
    </div>

</div>