@php
$actions = session('actionsModule');
@endphp
<div class="btn-group">
    @foreach ($actions as $action)
    @if (strpos($action['route'], 'destroy'))
    <form style="display:inline-block" id="form_{{$data->id}}" action="{{ route($action['route'], $data->id) }}"
        method="post" class="form-horizontal">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <a href="#" title="{{ $action['name'] }}" onclick="destroy({{ $data->id }})" class="iconList"><i
                class="{{ $action['icon'] }}"></i></a>
    </form>
    @else
    <a title="{{ $action['name'] }}" class="iconList" href="{{ route($action['route'], $data->id) }}"><i
            class="{{ $action['icon'] }}"></i></a>
    @endif
    @endforeach
</div>

<script>
    function destroy(id) {
        var opcion = confirm("¿Estas Seguro?");
        if (opcion == true) {
            document.getElementById("form_"+id).submit();
        } else {
        }
    }
</script>