
<div class="row justify-content-center">
    <form id="form_{{$data->id}}" action="{{ route('documents.destroy', $data->id) }}" method="post"
        class="form-horizontal">
        @csrf
        <button onclick="return confirm('¿Estás seguro de eliminar este registro?')" style="background: transparent; border: 0;" type="submit" 
            class="table-action" data-toggle="tooltip"
            data-original-title="">
            <i class=""></i>
        </button>
        <input type="hidden" name="_method" value="delete">
    </form>
    <a data-toggle="modal" data-target="#modal{{ $data->id }}" href="" class="table-action"
        data-toggle="tooltip" data-original-title="">
        <i class=""></i></a>
  
    <a href="{{ route('documents.show', $data->id) }}" class=" table-action" data-toggle="tooltip"
        data-original-title="">
        <i class=""></i>
    </a>
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