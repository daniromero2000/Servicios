<form action="{{$route}}" method="get" id="admin-search">
    <div class="input-group">


        <div class="row justify-content-center">
            <div class="col-4 col-sm-4 col-md-12">
                <div class="form-group mb-1">
                    <label for="q">Buscar: Solicitud / Cedula</label>
                    <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                        value="{!! request()->input('q') !!}">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-12 d-flex align-items-end">
                <div class="form-group mb-1 w-100">
                    <label for="customerLine">Tipo de clientes</label>
                    <select class="form-control  select2bs4" id="customerLine" name="customerLine" {!!
                        request()->input('customerLine')!!}
                        style="width: 100%;">
                        <option selected value> Selecciona un tipo </option>
                        @if ($_GET)
                        @if (!empty($_GET['customerLine']))
                        <option selected>
                            {{ $_GET['customerLine'] }}</option>
                        @endif
                        @endif
                        <option>OPORTUYA</option>
                        <option>TRADICIONAL</option>
                    </select>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-12 d-flex align-items-end">
                <div class="form-group mb-1 w-100">
                    <label for="analyst">Analista</label>
                    <select class="form-control  select2bs4" id="analyst" name="analyst" {!!
                        request()->input('analyst')!!}
                        style="width: 100%;">
                        <option selected value> Selecciona Analista </option>
                        @foreach ($analysts as $analyst)
                        <option @if ($_GET) @if (!empty($_GET['analyst'])) @if($_GET['analyst']==$analyst->
                            CODIGO) selected
                            @endif
                            @endif
                            @endif>{{ $analyst->USUARIO }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-12 d-flex align-items-end">
                <div class="form-group mb-1 w-100">
                    <label for="groupStatus">Grupo de estatos</label>
                    <select class="form-control  select2bs4" id="groupStatus" name="groupStatus" {!!
                        request()->input('groupStatus')!!}
                        style="width: 100%;">
                        <option selected value> Selecciona Grupos </option>
                        @if ($_GET)
                        @if (!empty($_GET['groupStatus']))
                        <option selected>
                            {{ $_GET['groupStatus'] }}</option>
                        @endif
                        @endif
                        <option>APROBADOS</option>
                        <option>DESISTIDOS</option>
                        <option>NEGADOS</option>
                        <option>PENDIENTES</option>
                    </select>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-12">
                <div class="form-group mb-1">
                    <label for="status">Estado</label>
                    <select class="form-control  select2bs4" id="status" name="status" {!! request()->input('status')
                        !!} style="width: 100%;">
                        <option selected value> Selecciona Estado </option>
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
            <div class="col-4 col-sm-4 col-md-12 d-flex align-items-end">
                <div class="form-group mb-1 w-100">
                    <label for="subsidiary">Sucursal</label>
                    <select class="form-control  select2bs4" id="subsidiary" name="subsidiary" {!!
                        request()->input('subsidiary')!!}
                        style="width: 100%;">
                        <option selected value> Selecciona Sucursal </option>
                        @foreach ($Subsidiarys as $Subsidiary)
                        <option @if ($_GET) @if (!empty($_GET['subsidiary'])) @if($_GET['subsidiary']==$Subsidiary->
                            CODIGO) selected
                            @endif
                            @endif
                            @endif>{{ $Subsidiary->CODIGO }}</option>
                        @endforeach
                    </select>
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


            <div class="col-4 col-sm-4 col-md-12 d-flex align-items-center mt-4 justify-content-center">
                <div class="form-group mb-1">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" value="1" name="soliWeb" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Solicitudes Web</label>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex align-items-end justify-content-end">
                <div class="form-group mb-1">
                    <span class="input-group-btn btn-pr">
                        <a class="btn btn-danger btn-sm-reset mt-2" href="{{$route}}">
                            <i class="fas fa-times"></i> Restaurar filtros
                        </a>
                        <button type="submit" name="action" value="search" id="search-btn" class="btn btn-primary mt-2 btn-sm-reset"><i
                                class="fa fa-search"></i>
                            Buscar
                        </button>
                        <button type="submit" name="action" value="export" id="search-btn" class="btn btn-primary mt-2 btn-sm-reset"><i class="fa fa-search"></i>
                            Exportar
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>