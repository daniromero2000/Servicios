<!-- search form -->
<div class="row">
    <div class="col-12 text-center">
        <h3 style="color: #007bff;">Filtrar</h3>
    </div>

    <div class="col-12  mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">


                <div class="row w-100 d-flex justify-content-center">
                    <div class="col-6 col-md-4">
                        <label for="q">Buscar: Solicitud / Cedula</label>
                        <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                            value="{!! request()->input('q') !!}">
                    </div>
                    <div class="col-6 col-md-4">
                            <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select class="form-control  select2bs4" id="status" name="status" {!!
                                        request()->input('status') !!} style="width: 100%;">
                                        <option disabled selected value> -- Selecciona Estado -- </option>
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

                    <div class="col-6 col-md-4">
                        <label for="from">Desde</label>
                        <input type="date" name="from" class="form-control " value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-6 col-md-4">
                        <label for="to">Hasta</label>
                        <input type="date" name="to" class="form-control " value="{!! request()->input('to') !!}">
                    </div>
                    <div class="col-6 col-md-4 d-flex align-items-end">
                        <div class="form-group w-100">
                            <label for="subsidiary">Sucursal</label>
                            <select class="form-control  select2bs4" id="subsidiary" name="subsidiary" {!!
                                request()->input('subsidiary')!!} style="width: 100%;">
                                <option disabled selected value> -- Selecciona Sucursal -- </option>
                                 @foreach ($Subsidiarys as $Subsidiary)
                                <option>{{ $Subsidiary->CODIGO }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 d-flex align-items-center">
                        <span class="input-group-btn btn-pr">
                            <button type="submit" id="search-btn" class="btn btn-primary mt-2"><i class="fa fa-search"></i>
                                Buscar
                            </button>
                        </span>
                    </div>
                </div>

            </div>


        </form>

    </div>
</div>