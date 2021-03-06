<!-- search form -->
<div class="row">
    <div class="col-12 mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">


                <div class="row w-100 d-flex justify-content-start">
                    <div class="col-md-12 col-sm-5 col-6">
                        <label for="q">Buscar: Cédula - Nombre - Apellido</label>
                        <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                            value="{!! request()->input('q') !!}">
                    </div>
                    <div class="col-md-12 col-sm-5 col-6">
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select class="form-control  select2" id="status" name="status" {!!
                                request()->input('status') !!} style="width: 100%;">
                                <option disabled selected value> -- Selecciona Estado -- </option>
                                @if ($_GET)
                                @if (!empty($_GET['status']))
                                <option selected>
                                    {{ $_GET['status'] }}</option>
                                @endif
                                @endif
                                <option>APROBADO</option>
                                <option>PREAPROBADO</option>
                                <option>NEGADO</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-5 col-6">
                        <label for="from">Desde</label>
                        <input type="date" name="from" class="form-control " value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-md-12 col-sm-5 col-6">
                        <label for="to">Hasta</label>
                        <input type="date" name="to" class="form-control " value="{!! request()->input('to') !!}">
                    </div>
                    <div class="col-md-12 col-sm-5 col-6 d-flex align-items-end">
                        <div class="form-group w-100">
                            <label for="step">Paso</label>
                            <select class="form-control  select2" id="step" name="step" {!! request()->input('step')!!}
                                style="width: 100%;">
                                <option disabled selected value> -- Selecciona Paso -- </option>
                                @if ($_GET)
                                @if (!empty($_GET['step']))
                                <option selected>
                                    {{ $_GET['step'] }}</option>
                                @endif
                                @endif
                                <option>PASO1</option>
                                <option>PASO2</option>
                                <option>PASO3</option>
                            </select>
                        </div>
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