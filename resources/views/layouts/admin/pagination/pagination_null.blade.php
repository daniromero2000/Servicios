<div class="alert alert-primary" role="alert">
    No hay datos. <a href="{{ route("$optionsRoutes.create") }}">Crear uno
</div>
@php
$search3['skip'] = ($skip - 1);
@endphp

<ul class="pagination  d-flex justify-content-center">
    <li class="page-item">
        <a id="previous" name="previous" type="submit" class="page-link" href="{{ route("$optionsRoutes.index", $search3 ) }}" @if ($skip<1 ) hidden @endif>Anterior</a>

    </li>
</ul>
