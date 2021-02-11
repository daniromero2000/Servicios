@if(isset($status))
    @if($status == 1)
        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-check" ></i></button>
        @else
        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
    @endif
@endif