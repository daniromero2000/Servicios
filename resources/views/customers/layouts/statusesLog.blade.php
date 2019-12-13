<div class="col-md-6">
  <h2 class="text-center">Historial</h2>
  <ul class="timeline">
      @if(!Empty($datas))
      @foreach($datas as $data)
      <li>
          <!-- timeline icon -->
          <i class="fa fa-clock-o bg-blue"></i>
          <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{$data->time_passed}}</span>
              <h3 class="timeline-header">{{ $data->status}}</h3>
              <div class="timeline-body">
            <i class="fa fa-user"></i>      {{$data->employee->name}}
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