<!-- search form -->
<div class="row">
    <div class="col-12 text-center">
        <h3 class="title-filter" style="color: #007bff;">Filtrar</h3>
    </div>

    <div class="col-12 mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">


                <div class="row w-100 d-flex justify-content-center">
                    <div class="col-12 col-sm-6 col-md-3">
                        <label for="q">Buscar: Solicitud / Cedula</label>
                        <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                            value="{!! request()->input('q') !!}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select class="form-control  select2bs4" id="status" name="status" {!!
                                request()->input('status') !!} style="width: 100%;">
                                <option selected value> -- Selecciona Estado -- </option>
                                @if ($_GET)
                                @if (!empty($_GET['status']))
                                <option selected>
                                    {{ $_GET['status'] }}</option>
                                @endif
                                @endif
                                <option>APROBADO</option>
                                <option>ANALISIS</option>
                                <option>ANULADA</option>
                                <option>ANULADO</option>
                                <option>CAMBIO CODEUDOR</option>
                                <option>COMITE</option>
                                <option>DEFINICION</option>
                                <option>DESISTIDO</option>
                                <option>EN ANALISIS</option>
                                <option>EN FACTURACION</option>
                                <option>EN SUCURSAL</option>
                                <option>NEGADO</option>
                                <option>PREACTIVO</option>
                                <option>PREAPROBADO</option>
                                <option>PROBLEMAS EN REFERENCIACION</option>
                                <option>PROBLEMAS EN ANALISIS</option>
                                <option>PROBLEMAS EN DEFINICION</option>
                                <option>REQUIERE 1 CODEUDOR</option>
                                <option>REQUIERE 2 CODEUDORES</option>
                                <option>SIN RESPUESTA</option>
                                <option>SUCURSAL</option>
                                <option>REFERENCIACION</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <label for="from">Desde</label>
                        <input type="date" name="from" class="form-control " value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <label for="to">Hasta</label>
                        <input type="date" name="to" class="form-control " value="{!! request()->input('to') !!}">
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