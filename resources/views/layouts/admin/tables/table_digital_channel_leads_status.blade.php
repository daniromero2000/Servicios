@php
use Carbon\Carbon;
@endphp
<div class="table-responsive mb-3 p-0 height-table">
    <table class="table table-head-fixed">
        <thead class="text-center header-table">
            <tr>
                @foreach ($headers as $header)
                <th scope="col">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="body-table">
            @foreach($datas as $data)
            <tr>
                <td><span class="text-center badge"
                        style="color: white ; background-color:
                        @if($data->created_at->diffInDays(Carbon::now()) <= 1) green @endif
                        @if($data->created_at->diffInDays(Carbon::now()) <= 2 && $data->created_at->diffInDays(Carbon::now()) >1) yellow @endif
                        @if($data->created_at->diffInDays(Carbon::now()) >= 3) red @endif
                        @if($data->state === 2 || $data->state === 5 || $data->state === 6 || $data->state === 9) gray @endif"
                        class=" btn btn-info btn-block"><i class="fa fa-bell-o"></i> </span></td>
                <td> @if($data->leadStatuses) <span class="text-center badge"
                        style="color: white ; background-color: {{$data->leadStatuses->color }}"
                        class="btn btn-info btn-block">{{ $data->leadStatuses->status}}</span> @endif</td>
                <td>{{ $data->leadChannel->channel}}</td>
                <td>{{ $data->leadAssessor['name']}}</td>
                <td><a href="{{ route('digitalchannelleads.show', $data->id) }}" data-toggle="tooltip"
                        title="Ver Cliente">{{ $data->name}} {{ $data->lastName}} </a></td>

                <td>{{ $data->telephone}}</td>
                <td>{{ $data->city}}/{{ $data->nearbyCity}}</td>
                <td> @if($data->leadService) {{ $data->leadService->service}} @else
                    {{$data->typeService}}
                    @endif</td>
                <td>
                    @if($data->leadProduct) {{ $data->leadProduct->lead_product }} @else
                    {{$data->typeProduct}} @endif</td>
                <td>{{ $data->created_at->format('M d, Y h:i a')}}</td>
                <td>
                    <form style="display:inline-block" action="{{ route('digitalchannelleads.destroy', $data->id) }}"
                        method="post" class="form-horizontal">
                        <input type="hidden" name="_method" value="delete">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <a href="#" title="Borrar Lead" onclick="return confirm('¿Estás Seguro?')" type="submit"
                            class="iconList"><i class="fas fa-times cursor"></i></a>
                    </form>
                </td>
            </tr>
            @endforeach
        <tbody>
    </table>
</div>