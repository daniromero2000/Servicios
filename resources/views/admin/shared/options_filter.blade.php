@php
$actions = session('actionsModule');
@endphp
<div class="d-flex justify-content-center">
    @if($actions)
    @foreach ($actions as $action)
    @if (strpos($action['route'], 'destroy'))
    <form id="form_{{$data->id}}" action="{{ route($action['route'], $data->id) }}" method="post"
        class="form-horizontal">
        @csrf
        <button onclick="return confirm('Are you sure?')" type="submit"
            class="table-action table-action-delete button-reset" data-toggle="tooltip"
            data-original-title="{{ $action['name'] }}">
            <i class="{{ $action['icon'] }}"></i>
        </button>
        <input type="hidden" name="_method" value="delete">
    </form>
    @elseif(strpos($action['route'], 'edit'))
    <a data-toggle="modal" data-target="#modal{{ $data->id }}" href="" class="table-action table-action"
        data-toggle="tooltip" data-original-title="{{ $action['name'] }}">
        <i class="{{ $action['icon'] }}"></i></a>
    @else
    <a href="{{ route($action['route'], $data->id) }}" class=" table-action table-action" data-toggle="tooltip"
        data-original-title="{{ $action['name'] }}">
        <i class="{{ $action['icon'] }}"></i>
    </a>
    @endif
    @endforeach
    @endif
</div>
<script>
    function destroy(id) {
        var opcion = confirm("¿Estás seguro de eliminar este registro?");
        if (opcion == true) {
            document.getElementById("form_"+id).submit();
        } else {
        }
    }
</script>