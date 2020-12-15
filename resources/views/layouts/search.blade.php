<!-- search form -->
<div class="ml-auto justify-content-end d-flex" style=" position: absolute; top: 22px; right: 3%; z-index: 99; ">
    <p>
        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#contentId"
            aria-expanded="{{request()->input() ? 'true' : 'false'}}" aria-controls="contentId">
            Filtrar
        </a>
    </p>
</div>
<div class="collapse mt-3 {{request()->input()  ? 'show' : ''}}" id="contentId">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style=" box-shadow: 0 0 2rem 0 rgba(0, 0, 0, .0) !important; ">
                <form action="{{$route}}" method="get" id="admin-search">
                    <div class="row d-flex justify-content-start">
                        @foreach ($searchInputs as $input)
                        @if($input['type'] == 'text' || $input['type'] == 'number' || $input['type'] == 'date' ||
                        $input['type'] == 'time' || $input['type'] == 'datetime-local' || $input['type'] == 'url')
                        <div class="col-sm-6 col-md-4 col-12 form-group">
                            <label for="{{ $input['name'] }}" class="form-control-label">{{ $input['label'] }}</label>
                            <input type="{{ $input['type'] }}" id="{{ $input['name'] }}"
                                value="{!! request()->input($input['name']) !!}" name='{{ $input['name'] }}' step="any"
                                class="form-control form-control-sm">
                        </div>
                        @elseif($input['type'] == 'select')
                        <div class="col-sm-6 col-md-4 col-12 form-group">
                            <label for="{{ $input['name'] }}" class="form-control-label">{{ $input['label'] }}</label>
                            <select class="form-control form-control-sm" name="{{ $input['name'] }}"
                                id="{{ $input['name'] }}">
                                @foreach ($input['options'] as $option)
                                <option value="{{ $option['id'] }}">{{ $option['label'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @elseif($input['type'] == 'textarea')
                        <div class="col-12 form-group">
                            <label for="{{ $input['name'] }}" class="form-control-label">{{ $input['label'] }}</label>
                            <textarea class="form-control form-control-sm" name="{{ $input['name'] }}"
                                id="{{ $input['name'] }}" cols="10"
                                rows="5">{!! request()->input($input['name']) !!}</textarea>
                        </div>
                        @endif
                        @endforeach
                        <div class="col-12 mt-3">
                            <div class="col-12 d-flex ">
                                <span class="input-group-btn ml-auto btn-pr">
                                    <form action="{{$route}}" method="get" id="admin-search">
                                        @if (request()->input() != null)
                                        <span class="input-group-btn">

                                            <a title="Recuperar" href="{{$route}}" id="recover"
                                                class="btn btn-danger btn-sm">Restaurar</a>
                                        </span>
                                        @endif
                                    </form>

                                    <button type="submit" id="search-btn" class="btn btn-primary btn-sm"><i
                                            class="fa fa-search"></i>
                                        Buscar
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>