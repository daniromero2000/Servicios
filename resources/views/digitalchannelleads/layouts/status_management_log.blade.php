<div class="col-md-6 mt-3 mx-auto">
    <h4 class="text-center">Historial</h4>
    <ul class="timeline">
        @if(!Empty($datas))
        @foreach($datas as $data)
        <li>
            <i class="fa fa-clock-o bg-primary"></i>
            <div class="timeline-item ">
                <span class="time"><i class="fa fa-clock-o"></i>
                    {{ $data->created_at->diffForHumans($digitalChannelLead->created_at) }}</span>
                <h3 class="timeline-header"><span class="text-center badge badge-primary"
                        class="btn btn-info btn-block">@if($data->statusManagement){{ $data->statusManagement->indicador}}
                        @endif</span> </h3>
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
</div>