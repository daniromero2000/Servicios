<nav aria-label="...">
    <ul class="pagination d-flex justify-content-center">
        <li class="page-item">
            <a id="previous" name="previous" type="submit" class="page-link"
                href="{{ route("$optionsRoutes.index", ['skip' => ($skip - 1)] ) }}" @if ($skip<1 ) hidden
                @endif>Anterior</a>
        </li>
        <li class="page-item">
            <a type="submit" type="submit" class="page-link"
                href="{{ route("$optionsRoutes.index", ['skip' => ($skip + 1)] ) }}">Siguiente</a>
        </li>
    </ul>
</nav>