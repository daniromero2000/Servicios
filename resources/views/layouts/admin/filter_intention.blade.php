<!-- search form -->
<div class="row">
    <div class="col-12 text-center">
        <h3 style="color: #007bff;">Filtrar</h3>
    </div>

    <div class="col-12 mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">


                <div class="row w-100 d-flex justify-content-center">
                    <div class="col-3">
                        <label for="q">Buscar</label>
                        <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                            value="{!! request()->input('q') !!}">
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="creditprofile">Estado</label>
                            <select class="form-control  select2" id="creditprofile" name="creditprofile" {!!
                                request()->input('creditprofile') !!} style="width: 100%;">
                                <option disabled selected value> -- Selecciona Estado -- </option>
                                <option>TIPO A</option>
                                <option>TIPO B</option>
                                <option>TIPO C</option>
                                <option>TIPO D</option>
                                <option>TIPO 5</option>
                                <option>TIPO D</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="from">Desde</label>
                        <input type="date" name="from" class="form-control " value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-3">
                        <label for="to">Hasta</label>
                        <input type="date" name="to" class="form-control " value="{!! request()->input('to') !!}">
                    </div>
                </div>

            </div>
            <div class="col-12 text-right">
                <span class="input-group-btn btn-pr">
                    <button type="submit" id="search-btn" class="btn btn-primary"><i class="fa fa-search"></i> Buscar
                    </button>
                </span>
            </div>

    </div>
    </form>
</div>