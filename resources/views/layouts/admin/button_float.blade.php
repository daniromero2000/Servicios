@if (auth()->user()->Assessor)
    @if (auth()->user()->Assessor->subsidiary->CODIGO == '109' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '115' ||
    auth()->user()->codeOportudata == '10027766' ||
    auth()->user()->codeOportudata == '111000' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '139' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '144' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '146' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '147' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '133' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '155' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '149' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '151' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '138' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '108' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '111' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '117' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '121' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '123' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '124' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '125' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '132' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '141' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '140' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '150' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '154' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '158' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '159' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '152' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '602' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '1')
        <div class="button-absolute">
            <input type="checkbox" id="btn-mas">
            <div class="redes" data-toggle="tooltip" data-placement="top" title="Crear liquidación">
                <a href="" data-toggle="modal" data-target="#exampleModal" class="icon-primary"> <i
                        class="fas fa-user-clock m-auto"></i></a>
            </div>
            @if (auth()->user()->codeOportudata == '1088247299' ||
    auth()->user()->codeOportudata == '98587878' ||
    auth()->user()->codeOportudata == '998877' ||
    auth()->user()->codeOportudata == '10027766' ||
    auth()->user()->codeOportudata == '111000' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '109' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '115' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '139' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '144' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '146' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '147' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '133' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '155' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '149' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '151' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '138' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '108' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '111' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '117' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '121' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '123' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '124' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '125' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '132' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '141' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '140' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '150' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '154' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '158' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '159' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '152' ||
    auth()->user()->Assessor->subsidiary->CODIGO == '1')
                <div class="redes" data-toggle="tooltip" data-placement="top" title="Crear cotización">
                    <a href="/Administrator/assessorquotations/create" class="icon-success"> <i
                            class="fas fa-store m-auto"></i></a>
                </div>
            @endif
            <div class="btn-mas">
                <label for="btn-mas" class="icon-mas2"> <i class="fas fa-bars m-auto"></i></label>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Liquidación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/Administrator/creditLiquidator" method="GET">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Numero de cédula </label>
                                <input type="text" class="form-control" name="customer"
                                    validation-pattern="IdentificationNumber" required>
                                <small class="form-text text-muted">Por favor ingresa el numero de cédula del cliente al
                                    que se le desea crear una liquidación.</small>
                            </div>
                            <div class="w-100 d-flex">
                                <button type="submit" class="btn btn-primary ml-auto">Crear</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endif
