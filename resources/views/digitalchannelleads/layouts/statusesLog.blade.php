<div class="col-md-3">
    <h2 class="text-center">Historial</h2>
    <ul class="timeline">
        @if(!Empty($datas))
        @foreach($datas as $data)
        <li>
            <i class="fa fa-clock-o bg-blue"></i>
            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i>
                    {{ $data->created_at->diffForHumans($digitalChannelLead->created_at) }}</span>
                <h3 class="timeline-header"><span class="text-center badge"
                        style="color: white ; background-color: @if($data->status){{$data->status->color }} @endif"
                        class="btn btn-info btn-block">@if($data->status){{ $data->status->status}} @endif</span> </h3>
                <div class="timeline-body">
                    <i class="fa fa-user"></i> @if ($data->user) {{$data->user->name}} @endif
                </div>
                <div class="timeline-body">
                    {{$data->created_at->format('M d, Y h:i a')}}
                </div>
            </div>
        </li>
        @endforeach
        @endif
    </ul>
</div>