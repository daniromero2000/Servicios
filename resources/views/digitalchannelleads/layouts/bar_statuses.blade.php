<div class="col-12">
  <div class="card">
    <div class="card-body">
      @include('layouts.admin.date_filter', ['route' => route('digitalchannelleads_dashboard')])

    </div>
  </div>
</div>
<div class="card ">
  <div class="card-header">
    <h3 class="card-title">Estados Leads</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>
  </div>

  <div class="card-body">

    <div class="chart">
      <canvas id="barChart" style="height:290px; min-height:230px"></canvas>
    </div>
  </div>
</div>