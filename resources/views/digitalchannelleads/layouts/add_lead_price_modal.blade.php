<!-- The Identity Modal -->
<div id="leadPricemodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa Cotización</h4>
      </div>
      <div class="modal-body">
        <div class="box">
          <form action="{{ route('leadPrices.store') }}" method="post" class="form" enctype="multipart/form-data">
            <div class="box-body">
              @csrf
              <input name="lead_id" id="lead_id" hidden value="{{ $digitalChannelLead->id }}">
              <div class="row">
                <div class="col-12 col-sm-12 form-group no-padding-right">
                  <label for="lead_product_id">Producto <span class="text-danger">*</span></label>
                  <select id="lead_product_id" name="lead_product_id" class="form-control">
                    @if(!empty($lead_products))
                    @foreach($lead_products as $lead_product)
                    <option value="{{ $lead_product->id }}">
                      {{ $lead_product->lead_product }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="description">Descripción<span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </div>
                  <input type="text" name="description" validation-pattern="text" id="description"
                    placeholder="Descripcioón" class="form-control" value="{{ old('description') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="lead_price">Fecha de Expedición <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                  <input type="number" name="lead_price" validation-pattern="text" id="lead_price" placeholder="Precio"
                    class="form-control" value="{{ old('lead_price') }}" required>
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