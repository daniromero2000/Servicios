@php
$actions = session('actionsModule');
@endphp
<div class="row justify-content-center">
    @if ($actions)
        @foreach ($actions as $action)
            @if (strpos($action['route'], 'destroy'))
                <form id="form_{{ $data->id }}" action="{{ route($action['route'], $data->id) }}" method="post"
                    class="form-horizontal">
                    @csrf
                    <button onclick="return confirm('¿Estás seguro de eliminar este registro?')"
                        style="background: transparent; border: 0;" type="submit" class="table-action"
                        data-toggle="tooltip" data-original-title="{{ $action['name'] }}">
                        <i class="{{ $action['icon'] }}"></i>
                    </button>
                    <input type="hidden" name="_method" value="delete">
                </form>
            @elseif(strpos($action['route'], 'edit'))
                <a data-toggle="modal" data-target="#modal{{ $data->id }}" href="" class="table-action table-action"
                    data-toggle="tooltip" data-original-title="{{ $action['name'] }}">
                    <i class="{{ $action['icon'] }}"></i></a>

            @elseif(strpos($action['route'], 'asigne'))
                <a data-toggle="modal" data-target="#modal-assigne{{ $data->id }}"
                    onclick="data({{ $data->id }})" href="" class="table-action table-action" data-toggle="tooltip"
                    data-original-title="{{ $action['name'] }}">
                    <i class="{{ $action['icon'] }}"></i></a>
            @elseif(strpos($action['route'], 'comments'))
                <a data-toggle="modal" data-target="#commentmodal{{ $data->id }}" href=""
                    class="table-action table-action" data-toggle="tooltip"
                    data-original-title="{{ $action['name'] }}">
                    <i class="{{ $action['icon'] }}"></i></a>
            @else
                <a href="{{ route($action['route'], $data->id) }}" class=" table-action table-action"
                    data-toggle="tooltip" data-original-title="{{ $action['name'] }}">
                    <i class="{{ $action['icon'] }}"></i>
                </a>
            @endif
        @endforeach
    @endif
</div>
