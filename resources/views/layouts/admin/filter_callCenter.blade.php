<!-- search form -->
<div class="row">
    <div class="col-12 text-center">
        <h3 style="color: #007bff;">Filtrar</h3>
    </div>

    <div class="col-12 mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">


                <div class="row w-100 mb-4 d-flex justify-content-center">
                    <div class="col-3">
                        <label for="q">Buscar: Cedula hoil - Nombre - Apellido</label>
                        <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                            value="{!! request()->input('q') !!}">
                    </div>
                   
                    <div class="col-3">
                        <label for="from">Desde</label>
                        <input type="date" name="from" class="form-control " value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-3">
                        <label for="to">Hasta</label>
                        <input type="date" name="to" class="form-control " value="{!! request()->input('to') !!}">
                    </div>
                   
                    <div class="col-2 d-flex justify-content-center align-items-end">
                        <span class="input-group-btn btn-pr te">
                            <button type="submit" id="search-btn" class="btn btn-primary mt-2"><i
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