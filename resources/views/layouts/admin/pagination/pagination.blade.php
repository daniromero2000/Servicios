<nav aria-label="...">
    <ul class="pagination d-flex justify-content-center">
        <li class="page-item">
            @php
            $search = request()->input();
            $search['skip'] = ($skip + 1);
            @endphp

            <a id="previous" name="previous" type="submit" class="page-link btn-sm-reset" href="{{ route("$optionsRoutes.index",  $search ) }}" @if ($skip<1 ) hidden @endif>Anterior</a>

        </li>
        <li class="page-item">
            @php
            $search2['skip'] = ($skip + 1);
            @endphp
            <a type="submit" type="submit" class="page-link btn-sm-reset" href="{{ route("$optionsRoutes.index", $search2 ) }}">Siguiente</a>
        </li>
    </ul>
</nav>
