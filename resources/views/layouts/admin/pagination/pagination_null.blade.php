<p class="alert alert-warning">No hay datos. <a href="{{ route("$optionsRoutes.create") }}">Crear uno</a>
</p>
<ul class="pagination">
    <li class="page-item">
        <a id="previous" name="previous" type="submit" class="page-link"
            href="{{ route("$optionsRoutes.index", ['skip' => ($skip - 1)] ) }}" @if ($skip<1 ) hidden
            @endif>Anterior</a>
    </li>
</ul>