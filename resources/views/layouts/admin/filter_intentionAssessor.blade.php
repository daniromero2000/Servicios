<div class="row">
    <div class="col-12 text-center">
        <h3 style="color: #007bff;">Filtrar</h3>
    </div>

    <div class="col-12 mt-2">
        <form action="{{$route}}" method="get" id="admin-search">
            <div class="input-group">


                <div class="row w-100 d-flex justify-content-center">
                    <div class="col-6 col-md-4 col-lg-2">
                        <label for="q">Buscar</label>
                        <input type="text" name="q" class="form-control" placeholder=" Buscar..."
                            value="{!! request()->input('q') !!}">
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="form-group">
                            <label for="creditprofile">Perfil Crediticio </label>
                            <select class="form-control  select2" id="creditprofile" name="creditprofile" {!!
                                request()->input('creditprofile') !!} style="width: 100%;">
                                <option selected value> Selecciona Perfil </option>
                                @if ($_GET) @if (!empty($_GET['creditprofile']))
                                <option selected>
                                    {{ $_GET['creditprofile'] }}</option>
                                @endif @endif
                                <option>TIPO A</option>
                                <option>TIPO B</option>
                                <option>TIPO C</option>
                                <option>TIPO D</option>
                                <option>TIPO 5</option>
                                <option>TIPO NE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select class="form-control  select2" id="status" name="status" {!!
                                request()->input('status') !!} style="width: 100%;">
                                <option selected value> Selecciona Estado </option>
                                @foreach ($status as $state)
                                <option value="{{ $state->ID }}" @if ($_GET && !empty($_GET['status']) &&
                                    $_GET['status']==$state->ID) selected @endif>{{ $state->NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <label for="from">Desde</label>
                        <input type="date" name="from" class="form-control " value="{!! request()->input('from') !!}">
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <label for="to">Hasta</label>
                        <input type="date" name="to" class="form-control " value="{!! request()->input('to') !!}">
                    </div>
                    <div class="col-12 d-flex align-items-end justify-content-end mt-3">
                        <span class="input-group-btn btn-pr">
                            <button type="submit" id="search-btn" class="btn btn-primary btn-sm-reset mt-2"><i
                                    class="fa fa-search"></i>
                                Buscar
                            </button>
                            <a class="btn btn-danger btn-sm-reset mt-2" href="{{$route}}">
                                <i class="fas fa-times"></i> Restaurar filtros
                            </a>
                        </span>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>