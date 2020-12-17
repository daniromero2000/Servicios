    <div id="footer">
        <div class="row resetRow">
            <div class="col-12 col-md-12 col-lg-3 resetCol footer-containMenu">
                <div class="footer-contianerLogo">
                    <img src="{{ asset('images/footer-oportunidadesServiciosFinancierosLogo.png') }}"
                        alt="Oportunidades Servicios Financieros" class="img-fluid">
                </div>
                <div class="footer-contianerNosotros">
                    <ul class="footer-menuNosotros">
                        <h5 class="footer-menuTitle">NOSOTROS</h5>
                        <li><a href="/codigo-etica" class="footer-menuItem"
                                title="Código de ética y buen gobierno corporativo">Código de ética y buen
                                gobierno
                                corporativo</a></li>
                        <li><a href="/quienes-somos" class="footer-menuItem" title="Quiénes somos">Quiénes
                                somos</a>
                        </li>
                        <li><a href="/Proteccion-de-datos-personales" class="footer-menuItem"
                                title="Protección de datos personales">Protección de datos personales</a></li>
                        <li><a href="/Terminos-y-condiciones" class="footer-menuItem"
                                title="Términos y condiciones">Términos y condiciones</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 resetCol footer-containMenu">
                @if (Request::path() != 'digitalWarranty')
                    <h4 class="text-center footer-title">Si tienes alguna inquietud <strong>¡Contáctanos!</strong>
                    </h4>
                @endif
                <div class="footer-containerServicioCliente">
                    <div class="footer-contianerTelefonos">
                        <img src="{{ asset('images/footer-telefonoIcon.png') }}" alt="Línea Nacional"
                            class="img-fluid footer-imgNosotros" />
                        <p class="footer-textTelefonos">
                            @if (Request::path() == 'digitalWarranty')
                                <span class="footer-textTelefonosNal"> Línea nacional: 01 8000 18 05 20</span>
                                <br />
                            @else
                                <span class="footer-textTelefonosNal"> Línea nacional: 57 (1)484 2122 - 01 8000 18
                                    05
                                    20</span> <br />
                            @endif
                            <span class="footer-textHorario">Lunes a Viernes 8:00 am a 5:00 pm</span>
                        </p>
                    </div>
                    <ul class="footer-menu">
                        <h5 class="footer-menuTitle">SERVICIO AL CLIENTE</h5>
                        <li><a href="/Por-que-comprar-con-nosotros" class="footer-menuItem"
                                title="Por qué comprar con nosotros">Por qué comprar con nosotros</a></li>
                        <li><a href="/Cambios-devoluciones-y-atencion-de-garantias" class="footer-menuItem"
                                title="Cambios , devoluciones y atención de garantías">Cambios , devoluciones y
                                atención de garantías</a></li>
                        <li><a href="http://www.sic.gov.co/proteccion-del-consumidor" target="_blank"
                                class="footer-menuItem" title="Protección al consumidor">Protección al
                                consumidor</a></li>
                        <li><a href="{{ route('preguntas.frecuentes') }}" class="footer-menuItem"
                                title="Preguntas Frecuentes">Preguntas Frecuentes</a></li>
                        <li><a href="{{ route('TermsAndConditions') }}" class="footer-menuItem"
                                title="Términos y condiciones garantía">Términos y condiciones garantía</a></li>
                        {{-- <li><a href="/indicadores" class="footer-menuItem"
                                title="Términos y condiciones garantía">Indicadores</a></li> --}}
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-3 resetCol">
                <div class="footer-containerNewsletter">
                    <h5 class="footer-titleNewsLetter">QUIERES RECIBIR LAS MEJORES OFERTAS</h5>
                    <form action="{{ route('newsletter.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control input-footer-max"
                                placeholder="Ingresa tu e-mail">
                            <div class="input-group-prepend">
                                <button class="btn btn-primary">Suscribirse</button>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="1"
                                    required>
                                <label for="termsAndConditions" style="font-size: 10px; font-style: italic;color:#FFF;">
                                    Aceptar <a href="/Terminos-y-condiciones" class="linkTermAndCondition"
                                        target="_blank">términos y condiciones</a> y <a
                                        href="/Proteccion-de-datos-personales" class="linkTermAndCondition"
                                        target="_blank">política de tratamiento de datos</a>
                                </label>
                            </div>
                    </form>
                </div>
                <span class="footer-menuText">SÍGUENOS:</span> <a
                    href="https://www.facebook.com/almacenes.oportunidades/" target="_blank"><img
                        src="{{ asset('images/footer-facebookIcon.png') }}"
                        alt="Facebook Oportunidades Servicios Financieros" class="img-fluid"></a>
            </div>
        </div>
    </div>
