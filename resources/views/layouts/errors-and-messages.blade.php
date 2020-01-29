@if($errors->all())

@foreach($errors->all() as $message)
<div class="row justify-content-end">
  <div class="col-12 col-md-4 ">
    <div class="card alert alert-warning alert-dismissible fade show" style="position: absolute;z-index: 999;"
      role="alert">

      <p> <i class="fas fa-exclamation-circle mr-2" style="font-size: 24px;"></i> {{ $message }}</p>

      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</div>
@endforeach
@elseif(session()->has('message'))
<div class="row justify-content-end">
  <div class="col-12 col-md-3 ">
    <div class="card alert alert-success  alert-dismissible fade show"
      style="position: absolute;z-index: 999;width: 94%;" role="alert">

      <p><i class="far fa-check-circle mr-2" style="font-size: 24px;"></i>
        {{ session()->get('message') }}</p>

      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</div>
@elseif(session()->has('error'))
<div class="row justify-content-end">
  <div class="col-12 col-md-4 ">
    <div class="card alert alert-danger  alert-dismissible fade show" style="position: absolute;z-index: 999;"
      role="alert">

      <p> <i class="fas fa-times-circle mr-2" style="font-size: 24px;"></i>
        {{ session()->get('error') }}</p>

      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</div>


@endif