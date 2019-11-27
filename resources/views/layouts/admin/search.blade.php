<!-- search form -->
<form action="{{$route}}" method="get" id="admin-search">
    <div class="input-group">
        <div class="form-group">
            <label for="q">Texto</label>
            <input type="text" name="q" class="form-control form-control-sm" placeholder="Buscar..."
                value="{!! request()->input('q') !!}">
        </div>
        <div class="form-group">
            <label for="status">Estado</label>
            <select class="form-control" id="status" name="status" {!! request()->input('status') !!}>
                <option disabled selected value> -- Selecciona Estado -- </option>
                <option>APROBADO</option>
                <option>ANALISIS</option>
                <option>EN SUCURSAL</option>
                <option>PROBLEMAS EN ANALISIS</option>
                <option>EN SUCURSAL</option>
                <option>PROBLEMAS EN REFERENCIACION</option>
            </select>
        </div>
        <div class="form-group">
           <label for="from">Desde</label>
            <input type="date" name="from" class="form-control form-control-sm" value="{!! request()->input('from') !!}">
        </div>
        <div class="form-group">
           <label for="to">Hasta</label>
            <input type="date" name="to" class="form-control form-control-sm" value="{!! request()->input('to') !!}">
        </div>
        <span class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> Buscar </button>
        </span>
    </div>
</form>