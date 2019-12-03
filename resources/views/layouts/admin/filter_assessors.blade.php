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
                        <label for="q">Buscar: Solicitud / Cedula</label>
                        <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                            value="{!! request()->input('q') !!}">
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select class="form-control  select2" id="status" name="status" {!!
                                request()->input('status') !!} style="width: 100%;">
                                <option disabled selected value> -- Selecciona Estado -- </option>
                                <option>APROBADO</option>
                                <option>ANALISIS</option>
                                <option>EN SUCURSAL</option>
                                <option>PROBLEMAS EN ANALISIS</option>
                                <option>EN SUCURSAL</option>
                                <option>PROBLEMAS EN REFERENCIACION</option>
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
                    <div class="col-3 d-flex align-items-end">
                        <div class="form-group w-100">
                            <label for="subsidiary">Sucursal</label>
                            <select class="form-control  select2" id="subsidiary" name="subsidiary" {!!
                                request()->input('subsidiary')!!} style="width: 100%;">
                                <option disabled selected value> -- Selecciona Sucursal -- </option>
                                <option>125</option>
                                <option>121</option>
                                <option>133</option>
                                <option>144</option>
                                <option>147</option>
                                <option>157</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3 d-flex align-items-center">
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