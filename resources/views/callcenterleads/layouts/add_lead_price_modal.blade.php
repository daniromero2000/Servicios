<!-- The Identity Modal -->
<div class="modal fade" id="leadPricemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Ingresa Cotización</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row resetRow ">
            <div class="col-12 form-group">
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
                      <input type="text" name="description" validation-pattern="text" id="description"
                        placeholder="Descripcioón" class="form-control" value="{{ old('description') }}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lead_price">Precio <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input type="number" name="lead_price" validation-pattern="text" id="lead_price"
                        placeholder="Precio" class="form-control" value="{{ old('lead_price') }}" required>
                    </div>
                  </div>
                  <div class="form-group" hidden>
                    <label for="lead_price_status_id">Fecha de Expedición <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input type="number" name="lead_price_status_id" validation-pattern="text"
                        id="lead_price_status_id" placeholder="Precio" class="form-control" value="3" required>
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
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>