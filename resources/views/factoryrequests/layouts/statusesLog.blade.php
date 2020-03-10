<div class="col-sm-12 col-md-8 col-lg-4">
    <h3 class="text-center" style="color: #007bff;">Historial</h3>
    <ul class="timeline">
        @if(!Empty($datas))
        @foreach($datas as $data)
        <li>
            <i class="fa fa-clock-o"
                style="color: white ; background-color: @if($data->factoryRequestStatus){{$data->factoryRequestStatus['color'] }} @endif"></i>
            <div class="timeline-item p-2 shadow">
                <span class="time"><i class="fa fa-clock-o"></i>
                    {{ $data->created_at->diffForHumans($factoryRequest->FECHASOL) }}</span>
                <h3 class="timeline-header"><span class="text-center badge"
                        style="color: white ; background-color: {{$data->factoryRequestStatus['color'] }}"
                        class="btn btn-info btn-block">{{ $data->factoryRequestStatus['name']}}</span> </h3>
                <div class="timeline-body">
                    <i class="fa fa-user"></i> {{$data->usuario}}
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