<!-- search form -->
<form action="{{ $route }}" method="get" id="admin-search">
    @if (request()->input() == null)
        <div class="input-group">
            <input type="text" name="t" class="form-control form-control-sm hidden" placeholder="Buscar..."
                value="{!!  request()->input('t') !!}">
            <span class="input-group-btn">
                <button title="Ver Eliminados" type="submit" id="search-btn" class="btn btn-flat"><i
                        class="fa fa-trash"></i></button>
            </span>
        </div>
    @else
        <div class="input-group">
            <span class="input-group-btn">.
                <button title="Ver Usuarios Activos" onclick="{{ route($optionsRoutes . '.index') }}" type="submit"
                    id="search-btn" class="btn btn-flat"><i class="fa fa-user"></i></button>
            </span>
        </div>
        <div class="input-group">
            <span class="input-group-btn">.
                <a title="Recuperar" href="{{ route($optionsRoutes . '.recover', 2) }}" id="recover"
                    class="btn btn-flat"><i class="fa fa-clock"></i></a>
            </span>
        </div>
    @endif
</form>
