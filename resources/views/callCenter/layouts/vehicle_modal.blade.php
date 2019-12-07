<!-- The vehicle Modal -->
<div id="vehiclemodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa Vehículo</h4>
      </div>

      <div class="modal-body">
        <div class="box">
          <form action="{{ route('admin.customer-vehicles.store') }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
             @csrf
              <input name="customer_id" id="customer_id" class="hidden" value="{{ $customer->id }}">
              <div class="form-group">
                <label for="vehicle_type_id" class="">Tipo <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-car"></i>
                  </div>
                  <select name="vehicle_type_id" id="vehicle_type_id" class="form-control" enabled>
                    @foreach($vehicle_types as $vehicle_type)
                    <option value="{{ $vehicle_type->id }}">
                      {{ $vehicle_type->vehicle_type }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="vehicle_brand_id" class="">Tipo <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-car"></i>
                  </div>
                  <select name="vehicle_brand_id" id="vehicle_brand_id" class="form-control" enabled>
                    @foreach($vehicle_brands as $vehicle_brand)
                    <option value="{{ $vehicle_brand->id }}">
                      {{ $vehicle_brand->vehicle_brand }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="box-footer">
              <div class="btn-group">
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div>
            </div>
          </form>
        </div>

      </div>

    </div>
  </div>
</div>
