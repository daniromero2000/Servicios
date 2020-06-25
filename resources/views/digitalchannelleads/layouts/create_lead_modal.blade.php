<!--AddCommunityLead modal-->
<div class="modal fade" id="addleadmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Lead</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">


        <form action="{{ route('digitalchannelleads.store') }}" method="post" class="form"
          enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="row">
            <div class="col-lg-6">
              <div class="card card-success">
                <div class="card-header bg-primary">
                  <h3 class="card-title">Información Básica</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus text-white"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-12  form-group no-padding-right">
                      <label for="telephone">Teléfono </label>
                      <input type="text" onblur=loadLead() id="telephoneCreate" name="telephone" cols="10"
                        class="form-control">
                    </div>
                    <div class="col-12 col-sm-6 form-group">
                      <label for="identificationNumber">Cédula</label>
                      <input type="text" class="form-control" validation-pattern="IdentificationNumber"
                        id="identificationNumberCreate" name="identificationNumber">
                    </div>
                    <div class="col-12 col-sm-6 form-group">
                      <label for="name">Nombre <span class="text-danger">*</span></label>
                      <input type="text" ng-model="lead.name" validation-pattern="name" id="nameCreate" name="name"
                        cols="10" class="form-control" required>
                    </div>
                    <div class="col-12 col-sm-6 form-group no-padding-right">
                      <label for="lastName">Apellido <span class="text-danger">*</span></label>
                      <input type="text" ng-model="lead.lastName" validation-pattern="name" id="lastNameCreate"
                        name="lastName" cols="10" class="form-control" required>
                    </div>
                    <div class="col-12 col-sm-6 form-group">
                      <label for="email">Email</label>
                      <input type="text" ng-model="lead.email" validation-pattern="email" id="emailCreate" name="email"
                        cols="10" class="form-control">
                    </div>
                    <div class="col-12 col-sm-6 form-group">
                      <label for="city">Ciudad <span class="text-danger">*</span></label>
                      <select id="cityCreate" name="city" class="form-control" required>
                        @if(!empty($cities))
                        <option selected value> Selecciona Ciudad </option>
                        @foreach($cities as $city)
                        <option value="{{ $city->NOMBRE }}">
                          {{ $city->NOMBRE }}
                        </option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="col-12 col-sm-6 form-group">
                      <label for="name">Ciudad aledaña</label>
                      <input type="text" ng-model="lead.nearbyCity" validation-pattern="name" id="nearbyCityCreate"
                        name="nearbyCity" cols="10" class="form-control">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card card-success">
                <div class="card-header bg-success">
                  <h3 class="card-title">Asignación</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus text-white"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">

                    <div class="col-12 col-sm-6 form-group no-padding-right">
                      <label for="channel">Canal de Adquisición <span class="text-danger">*</span></label>
                      <select id="channelCreate" name="channel" class="form-control" required>
                        @if(!empty($channels))
                        <option selected value> Selecciona Canal </option>
                        @foreach($channels as $channel)
                        <option value="{{ $channel->id }}">
                          {{ $channel->channel }}
                        </option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="col-12 col-sm-6 form-group no-padding-right">
                      <label for="socialNetwork">Campaña</label>
                      <select id="campaignCreate" name="campaign" class="form-control">
                        @if(!empty($campaigns))
                        <option selected value> Selecciona Campaña </option>
                        @foreach($campaigns as $campaign)
                        <option value="{{ $campaign->id }}">
                          {{ $campaign->name }}
                        </option>
                        @endforeach
                        @endif
                      </select>
                    </div>

                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label for="typeAreaSelectCreate">Selecciona Area </label>
                        <select name="lead_area_id" id="typeAreaSelectCreate" class="form-control "
                          style="width: 100%;">
                          <option selected value=""> Selecciona Area </option>
                          @if(!empty($areas))
                          @foreach($areas as $area)
                          <option value="{{ $area->id }}">
                            {{ $area->name }}
                          </option>
                          @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6" id="SubsidiaryCreate">
                      <div class="form-group">
                        <label for="expirationDateSoat">Sucursal</label>
                        <select name="subsidiary_id" id="subsidary"
                          class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                          data-select3-id="1" tabindex="-1" aria-hidden="true">
                          @if(!empty($subsidaries))
                          <option data-select3-id="" selected value> Selecciona Sucursal </option>
                          @foreach($subsidaries as $subsidary)
                          <option data-select3-id="{{ $subsidary->CODIGO }}" value="{{ $subsidary->CODIGO }}">
                            {{ $subsidary->CODIGO }}
                          </option>
                          @endforeach
                          @endif
                        </select>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6 form-group">
                      <label for="typeServiceSelectedCreate">Servicio <span class="text-danger">*</span></label>
                      <select id="typeServiceSelectedCreate" name="typeService" class="form-control" required>
                        <option selected value> Selecciona Servicio </option>
                      </select>
                    </div>
                    <div class="col-12 col-sm-6 form-group no-padding-right">
                      <label for="typeProductCreate">Producto <span class="text-danger">*</span></label>
                      <select id="typeProductCreate" name="typeProduct" class="form-control">
                        <option selected value> Selecciona Producto </option>
                      </select>
                    </div>
                    <div class="col-12 col-sm-6 form-group" id="fechExpirationCreate">
                      <label for="expirationDateSoat">Fecha de Vencimiento</label>
                      <input type="date" name="expirationDateSoat" class="form-control" value="">
                    </div>
                    <div class="col-12 col-sm-6 form-group no-padding-right">
                      <label for="selectAssessorCreate">Asesor</label>
                      <select class="form-control  select2" id="selectAssessorCreate" name="assessor_id"
                        ng-model="lead.assessor_id" style="width: 100%;">
                        <option data-select3-id="" selected value> Selecciona Asesor </option>
                      </select>
                    </div>

                    <div class="col-12 col-sm-12 form-group">
                      <label for="description">Observación</label>
                      <textarea validation-pattern="text" id="descriptionCreate" name="description" cols="10"
                        class="form-control"></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>



          <input type="text" id="termsAndConditions" name="termsAndConditions" value="1" class="form-control" hidden>
          <div class="form-group text-right mb-0 mt-2">
            <button class="btn btn-primary">Agregar</button>
            <button class=" btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>