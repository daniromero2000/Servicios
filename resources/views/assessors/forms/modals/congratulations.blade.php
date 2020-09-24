    <div class="modal fade modalThankYouPage-asessors hide" data-backdrop="static" data-keyboard="false" id="congratulations" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body " style="padding: 0">
                    <div class="row resetRow">
                        <div class="col-12 text-center resetCol headThankYuoModal">
                            <img src="{{ asset('images/asessors/logoModal.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="row resetRow">
                        <div class="col-12 text-center" ng-if="estadoCliente == 'CONTADO'">
                            <p class="textTnakYouModal" style="font-size: 22px; margin-top:25px">
                                Cliente creado exitosamente.
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'TRADICIONAL'">
                            <img src="{{ asset('images/asessors/tarjetaIcon.jpg') }}" class="iconThankYouModal" />
                            @if (auth()->user()->Assessor->subsidiary->CODIGO == '133' || auth()->user()->Assessor->subsidiary->CODIGO == '155' || auth()->user()->Assessor->subsidiary->CODIGO == '147' || auth()->user()->Assessor->subsidiary->CODIGO == '138')
                            <p class="textTnakYouModal">
                                Solictud <strong style="font-size:18px">@{{ numSolic }}</strong> creada
                                exitosamente,
                                <br>
                                procede a ingresar los datos del negocio.
                            </p>
                            @else
                            <p class="textTnakYouModal">
                                Solictud <strong style="font-size:18px">@{{ numSolic }}</strong> creada
                                exitosamente,
                                <br>
                                procede en <strong>OPORTUDATA</strong> a ingresar los datos del negocio.
                            </p>
                            @endif
                        </div>
                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'APROBADO'">
                            <img src="{{ asset('images/asessors/openIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                <b>¡FELICIDADES!</b> <br>
                                <b>Solicitud aprobada</b> para tarjeta
                            </p>
                            <p class="textModalNumSolic text-center">
                                El número de solicitud es <strong style="font-size:16px; color: #1b8acc">@{{ numSolic }}</strong> <br>
                                Procede a hacer la preactivacion de la tarjeta
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'PREAPROBADO' && resp.policy.ID_DEF == '25'">
                            <img src="{{ asset('images/asessors/revisandoIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                Su intención ha sido aprobada.
                            </p>
                            @if (auth()->user()->Assessor->subsidiary->CODIGO == '133' || auth()->user()->Assessor->subsidiary->CODIGO == '155' || auth()->user()->Assessor->subsidiary->CODIGO == '147' || auth()->user()->Assessor->subsidiary->CODIGO == '138')
                            <p class="textTnakYouModal">
                                Solictud <strong style="font-size:18px">@{{ numSolic }}</strong> creada
                                exitosamente,
                                <br>
                                procede a ingresar los datos del negocio.
                            </p>
                            @else
                            <p class="textModalNumSolic text-center">
                                Proceda a ingresar el negocio en OPORTUDATA <br>
                                El número de solicitud es
                                <strong style="font-size:16px; color: #1b8acc">@{{ numSolic }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'PREAPROBADO' && resp.policy.ID_DEF != '25'">
                            <img src="{{ asset('images/asessors/revisandoIcon.jpg') }}" class="iconThankYouModal" />
                            @if (auth()->user()->Assessor->subsidiary->CODIGO == '133' || auth()->user()->Assessor->subsidiary->CODIGO == '155' || auth()->user()->Assessor->subsidiary->CODIGO == '147' || auth()->user()->Assessor->subsidiary->CODIGO == '138')
                            <p class="textTnakYouModal">
                                Solictud <strong style="font-size:18px">@{{ numSolic }}</strong> creada
                                exitosamente,
                                <br>
                                procede a ingresar los datos del negocio.
                            </p>
                            @else
                            <p class="textTnakYouModal">
                                <b>La solicitud</b> está siendo revisada <br>
                                por el área de fábrica de créditos.
                            </p>
                            <p class="textModalNumSolic text-center">
                                El número de solicitud es <strong style="font-size:16px; color: #1b8acc">@{{ numSolic }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'SIN COMERCIAL'">
                            <img src="{{ asset('images/asessors/revisandoIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                <b>El aplicativo, está presentado un error, <br /> por favor inténtalo de nuevo más
                                    tarde</b>
                            </p>
                        </div>
                        <div class="col-12 text-center containTextThankYouModal" ng-if="estadoCliente == 'NEGADO'">
                            <img src="{{ asset('images/asessors/revisandoIcon.jpg') }}" class="iconThankYouModal" />
                            <p class="textTnakYouModal">
                                <b>Lo sentimos,</b> en esta ocasión <br>
                                no tenemos una aprobación para ti.
                            </p>
                            <p class="textModalNumSolic text-center">
                                <strong style="font-size:13px; font-style: italic;color: #1b8acc">*
                                    @{{ infoLead.DESCRIPCION }}</strong>
                            </p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 text-center">
                            <a class="btn btn-danger buttonBackCardExist" href="/Administrator/crearCliente">Nuevo
                                Registro</a>
                            @if (auth()->user()->Assessor->subsidiary->CODIGO == '133' || auth()->user()->Assessor->subsidiary->CODIGO == '155' || auth()->user()->Assessor->subsidiary->CODIGO == '147' || auth()->user()->Assessor->subsidiary->CODIGO == '138')
                            <a ng-if="estadoCliente == 'TRADICIONAL' || estadoCliente == 'PREAPROBADO' || estadoCliente == 'APROBADO'" href="/Administrator/creditLiquidator/@{{lead.CEDULA}}" class="btn bg-primary buttonBackCardExist">Crear negocio</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
