<!-- The reference Modal -->
<div id="referencemodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa Referencia</h4>
      </div>

      <div class="modal-body">
        <div class="box">
          <form action="{{ route('admin.customer-references.store') }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
             @csrf
              <input name="customer_id" id="customer_id" class="hidden" value="{{ $customer->id }}">
              <div class="form-group">
                <label for="name">Nombre <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre"
                    class="form-control" value="{{ old('name') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="last_name">Apellido <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input type="text" name="last_name" id="last_name" validation-pattern="name" placeholder="Apellido"
                    class="form-control" value="{{ old('last_name') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="phone">Teléfono <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                  </div>
                  <input type="text" name="phone" id="phone" validation-pattern="telephone" placeholder="Teléfono" class="form-control"
                    value="{{ old('phone') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="birthday">Fecha de Nacimiento<span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" name="birthday" min="1900-01-01" max="<?php echo $fechaMayorEdad;?>" id="birthday"
                    placeholder="Fecha Nacimiento" class="form-control" value="{{ old('birthday') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="scholarity_id" class="">Escolaridad <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-graduation-cap"></i>
                  </div>
                  <select name="scholarity_id" id="scholarity_id" class="form-control select2">
                    @if(!empty($scholarities))
                    @foreach($scholarities as $scholarity)
                    <option value="{{ $scholarity->id }}">
                      {{ $scholarity->scholarity }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="genre_id">Genero <span class="text-danger">*</span></label>
                <ul class="list-unstyled list-inline">
                  @if(!empty($genres))
                  @foreach($genres as $genre)
                  <li>
                    <div class="radio">
                      <label>
                        <input type="radio" name="genre_id" id="genre_id" value="{{ $genre->id }}">
                        {{ $genre->genre }}
                      </label>
                    </div>
                  </li>
                  @endforeach
                  @endif
                </ul>
              </div>
              <div class="form-group">
                <label for="civil_status_id" class="">Estado Civil <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-check"></i>
                  </div>
                  <select name="civil_status_id" id="civil_status_id" class="form-control select2">
                    @foreach($civil_statuses as $civil_status)
                    <option value="{{ $civil_status->id }}">{{ $civil_status->civil_status }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="relationship_id" class="">Parentesco <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-users"></i>
                  </div>
                  <select name="relationship_id" id="relationship_id" class="form-control select2">
                    @foreach($relationships as $relationship)
                    <option value="{{ $relationship->id }}">
                      {{ $relationship->relationship }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div id="cities" class="form-group">
                <label for="city_id">Ciudad<span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                  <select name="city_id" id="city_id" class="form-control" enabled required>
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->city }}</option>
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
