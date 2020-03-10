<!-- search form -->
<div class="row">
    <div class="col-12 text-center">
        <h3 style="color: #007bff;">Filtrar</h3>
    </div>
    <div class="col-12 mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="row d-flex justify-content-center">
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <label for="q">Buscar (Cédula, Teléfono, Nombre y Apellido)</label>
                    <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                        value="{!! request()->input('q') !!}">
                </div>

                <div class="col-6 col-md-2">
                    <div class="form-group">
                        <label for="city">Ciudad </label>
                        <select name="city" class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                            data-select3-id="1" tabindex="-1" aria-hidden="true">
                            @if(!empty($cities))
                            <option data-select3-id="" disabled selected value> -- Selecciona Ciudad -- </option>
                            @foreach($cities as $city)
                            <option data-select3-id="{{ $city->NOMBRE }}" value="{{ $city->NOMBRE }}">
                                {{ $city->NOMBRE }}
                            </option>
                            @if ($_GET)
                            @if (!empty($_GET['city']))
                            @if($_GET['city']==$city->NOMBRE)
                            <option selected>{{ $city->NOMBRE }}</option>
                            @endif
                            @endif
                            @endif
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                @if (auth()->user()->idProfile == 2 )
                <div class="col-6 col-md-2">
                    <div class="form-group">
                        <label for="channel">Canal </label>
                        <select name="channel" id="channel" class="form-control select2 select2-hidden-accessible"
                            style="width: 100%;" data-select3-id="1" tabindex="-1" aria-hidden="true">
                            @if(!empty($cities))
                            <option data-select3-id="" disabled selected value> -- Selecciona Canal -- </option>
                            @foreach($channels as $channel)
                            <option data-select3-id="{{ $channel->id }}" value="{{ $channel->id }}">
                                {{ $channel->channel }}
                            </option>
                            @if ($_GET)
                            @if (!empty($_GET['channel']))
                            @if($_GET['channel']==$channel->id)
                            <option value="{{$channel->id}}" selected>{{ $channel->channel }}</option>
                            @endif
                            @endif
                            @endif
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                @endif
                @if ( auth()->user()->idProfile == 18 )
                <div class="col-6 col-md-2">
                    <div class="form-group">
                        <label for="channel">Canal </label>
                        <select name="channel" id="channel" class="form-control select2 select2-hidden-accessible"
                            style="width: 100%;" data-select3-id="1" tabindex="-1" aria-hidden="true">
                            @if(!empty($cities))
                            <option data-select3-id="" disabled selected value> -- Selecciona Canal -- </option>
                            @foreach($channels as $channel)
                            <option data-select3-id="{{ $channel->id }}" value="{{ $channel->id }}">
                                {{ $channel->channel }}
                            </option>
                            @if ($_GET)
                            @if (!empty($_GET['channel']))
                            @if($_GET['channel']==$channel->id)
                            <option value="{{$channel->id}}" selected>{{ $channel->channel }}</option>
                            @endif
                            @endif
                            @endif
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                @endif
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <label for="from">Desde</label>
                    <input type="date" name="from" class="form-control " value="{!! request()->input('from') !!}">
                </div>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <label for="to">Hasta</label>
                    <input type="date" name="to" class="form-control " value="{!! request()->input('to') !!}">
                </div>

                <div class="col-12">
                    <div class="row d-flex w-102 justify-content-center">
                        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
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
                                    @if ($_GET)
                                    @if (!empty($_GET['lead_area_id']))
                                    @if($_GET['lead_area_id']==$area->id)
                                    <option value="{{$area->id}}" selected>{{ $area->name }}</option>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class=" col-6 col-md-4 col-lg-3 col-xl-2">
                            <div class="form-group">
                                <label for="typeServiceFilter">Selecciona Servicio</label>
                                <select name="typeService" id="typeServiceFilter"
                                    class="form-control w-100 select2 select2-hidden-accessible" style="width: 100%;"
                                    enabled>
                                    <option disabled selected value> -- Selecciona Servicio -- </option>
                                    @if(!empty($services))
                                    @foreach ($services as $service)
                                    <option value="{{ $service->id }}">
                                        {{ $service->service }}
                                    </option>
                                    @if ($_GET)
                                    @if (!empty($_GET['typeService']))
                                    @if($_GET['typeService']==$service->id)
                                    <option value="{{$service->id}}" selected>{{ $service->service }}</option>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                    @endif
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
                                    @if(!empty($lead_products))
                                    @foreach ($lead_products as $lead_product)
                                    <option value="{{ $lead_product->id }}">
                                        {{ $lead_product->lead_product }}
                                    </option>
                                    @if ($_GET)
                                    @if (!empty($_GET['typeProduct']))
                                    @if($_GET['typeProduct']==$lead_product->id)
                                    <option value="{{$lead_product->id}}" selected>{{ $lead_product->lead_product }}
                                    </option>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                            <div class="form-group">
                                <label for="stateSelectFilter">Selecciona Estado </label>
                                <select name="state" id="stateSelectFilter"
                                    class="form-control select2  mt-2 select2-hidden-accessible" style="width: 100%;">
                                    <option disabled selected value> -- Selecciona Estado -- </option>
                                    @if(!empty($lead_statuses))
                                    @foreach ($lead_statuses as $lead_status)
                                    <option value="{{ $lead_status->id }}">
                                        {{ $lead_status->status }}
                                    </option>
                                    @if ( $_GET && !empty($_GET['state']))
                                    @if($_GET['state']==$lead_status->id)
                                    <option value="{{$lead_status->id}}" selected>
                                        {{ $lead_status->status }}
                                    </option>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                            <div class="form-group">
                                <label for="assessorSelectFilter">Asesor</label>
                                <select name="assessor_id" id="assessorSelectFilter"
                                    class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                    data-select4-id="1" tabindex="-1" aria-hidden="true">
                                    <option disabled selected value> -- Selecciona Asesor -- </option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-12">
                    <div class="col-12 d-flex ">
                        <span class="input-group-btn ml-auto btn-pr">
                            <button type="submit" id="search-btn" class="btn btn-primary"><i class="fa fa-search"></i>
                                Buscar
                            </button>
                            <a class="btn btn-danger" href="{{$route}}">
                                <i class="fas fa-times"></i> Restaurar filtros
                            </a>
                        </span>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>