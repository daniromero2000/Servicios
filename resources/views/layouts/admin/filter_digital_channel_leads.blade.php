<!-- search form -->
<div class="row">
    <div class="col-12 text-center">
        <h3 style="color: #007bff;">Filtrar</h3>
    </div>
    <div class="col-12 mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">
                <div class="row w-100 d-flex justify-content-center">
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <label for="q">Buscar (Cédula, Nombre y Apellido)</label>
                        <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                            value="{!! request()->input('q') !!}">
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="form-group">
                            <label for="city">Ciudad </label>
                            <select name="city" class="form-control select2 select2-hidden-accessible"
                                style="width: 100%;" data-select3-id="1" tabindex="-1" aria-hidden="true">
                                @if(!empty($cities))
                                <option data-select3-id="" disabled selected value> -- Selecciona Ciudad -- </option>
                                @foreach($cities as $city)
                                <option data-select3-id="{{ $city->CIUDAD }}" value="{{ $city->CIUDAD }}">
                                    {{ $city->CIUDAD }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="form-group">
                            <label for="assessor_id">Asesor</label>
                            <select name="assessor_id" class="form-control select2 select2-hidden-accessible"
                                style="width: 100%;" data-select4-id="1" tabindex="-1" aria-hidden="true">
                                @if(!empty($listAssessors))
                                <option data-select3-id="" disabled selected value> -- Selecciona Ciudad -- </option>
                                @foreach($listAssessors as $listAssessor)
                                <option data-select3-id="{{ $listAssessor->id }}" value="{{ $listAssessor->id }}">
                                    {{ $listAssessor->name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <label for="from">Desde</label>
                        <input type="date" name="from" class="form-control " value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <label for="to">Hasta</label>
                        <input type="date" name="to" class="form-control " value="{!! request()->input('to') !!}">
                    </div>
                    <div class="col-6 ml-1 col-md-4 col-lg-3 col-xl-2">
                        <div class="form-group">
                            <label for="typeAreaSelectFilter">Selecciona Area </label>
                            <select name="lead_area_id" id="typeAreaSelectFilter"
                                class="form-control select2  mt-2 select2-hidden-accessible" style="width: 100%;">
                                <option disabled selected value> -- Selecciona Area -- </option>
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
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="form-group">
                            <label for="typeServiceFilter">Selecciona Servicio</label>
                            <select name="typeService" id="typeServiceFilter"
                                class="form-control w-100 select2 select2-hidden-accessible" style="width: 100%;"
                                enabled>
                                <option disabled selected value> -- Selecciona Servicio -- </option>
                            </select>

                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="form-group">
                            <label for="typeProductFilter">Selecciona Producto</label>
                            <select name="typeProduct" id="typeProductFilter"
                                class="form-control w-100 select2 select2-hidden-accessible" style="width: 100%;"
                                enabled>
                                <option disabled selected value> -- Selecciona Producto -- </option>
                            </select>

                        </div>
                    </div>

                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="form-group">
                            <label for="stateSelectFilter">Selecciona Estado </label>
                            <select name="state" id="stateSelectFilter"
                                class="form-control select2  mt-2 select2-hidden-accessible" style="width: 100%;">
                                <option disabled selected value> -- Selecciona Estado -- </option>

                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2 mt-4 d-flex justify-content-start align-items-center">
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