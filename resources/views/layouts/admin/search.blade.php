
    <!-- search form -->
    <form action="{{$route}}" method="get" id="admin-search">
        <div class="input-group">
            <input type="text" name="q" class="form-control form-control-sm" placeholder="Buscar..." value="{!! request()->input('q') !!}">
            <label for="from">Desde</label>
            <input type="date" name="from" class="form-control form-control-sm" value="{!! request()->input('from') !!}">
            <label for="to">Hasta</label>
            <input type="date" name="to" class="form-control form-control-sm" value="{!! request()->input('to') !!}">
            <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> Buscar </button>
            </span>
        </div>
    </form>