<!-- search form -->
<div class="row">
    <div class="col-12 text-center">
        <h3 style="color: #007bff;">Filtrar</h3>
    </div>
    <div class="col-12 mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">
                <div class="row w-100 d-flex justify-content-center">
                    <div class="col-6 col-md-2">
                        <label for="q">Buscar</label>
                        <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                            value="{!! request()->input('q') !!}">
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="form-group">
                            <label for="state">Estado </label>
                            <select name="state" id="state" class="form-control" enabled>
                                @if(!empty($lead_statuses))
                                <option disabled selected value> -- Selecciona Estado -- </option>
                                @foreach($lead_statuses as $lead_status)
                                <option value="{{ $lead_status->id }}">
                                    {{ $lead_status->status }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="form-group">
                            <label for="assessor_id">Asesor</label>
                            <select class="form-control  select2" id="assessor_id" name="assessor_id"
                                ng-model="lead.assessor_id" style="width: 100%;">
                                <option disabled selected value> -- Selecciona Asesor -- </option>
                                <option value="13">Evelyn Correa</option>
                                <option value="18">Vanessa Parra</option>
                                <option value="85">Danitza Naranjo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="from">Desde</label>
                        <input type="date" name="from" class="form-control " value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="to">Hasta</label>
                        <input type="date" name="to" class="form-control " value="{!! request()->input('to') !!}">
                    </div>
                    <div class="col-6 col-md-1 mt-2 d-flex justify-content-start align-items-center">
                        <span class="input-group-btn btn-pr">
                            <button type="submit" id="search-btn" class="btn btn-primary"><i class="fa fa-search"></i>
                                Buscar
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>